<?
Class TelphinCall {
    private $APP_KEY;
    private $APP_SECRET;
    private $API_SERVER;
    private $EXTENSION_ID;
    const MAX_COUNT_IP = 10000;        // максимальное кол-во попыток звонка с одного ip
    const MAX_COUNT_TEL = 1000;        // максимальное кол-во попыток звонка на один номер
    const BLOCK_PERIOD  = 86400;    // в течение какого временного периода действует ограничение на кол-во звонков. По умолчанию, 24 часа

    // конструктор класса
    function __construct( $app_key, $app_secret, $server_name, $extension_id) {
        $this->APP_KEY    = $app_key;
        $this->APP_SECRET = $app_secret;
        $this->API_SERVER = $server_name;
        $this->EXTENSION_ID = $extension_id;
    }

    // get_token -- получение токена
    // если локально не сохранён или протух, то получаем новый
    public function get_token() {
        $file_data = $this->get_file_data();

        if ( $file_data ) {
            if ( isset( $file_data['access_token'] ) && isset( $file_data['expires_in'] ) ) {
                if ( $file_data['expires_in'] > time() ) {
                    return $file_data['access_token'];
                }
            }
        }

        $res = $this->gen_token();
        $this->save_token( $res['access_token'], $res['expires_in'] );
        return $res['access_token'];
    }

    // gen_token -- сгенерировать токен
    private function gen_token() {
        $url = 'https://' . $this->API_SERVER . '/oauth/token';

        $post_data = array(
        'client_id'       => $this->APP_KEY,
        'client_secret'   => $this->APP_SECRET,
        'grant_type'      => 'client_credentials',
        );

        $req = curl_init();
        curl_setopt( $req, CURLOPT_URL, $url );
        curl_setopt( $req, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $req, CURLOPT_FOLLOWLOCATION, true );
        curl_setopt( $req, CURLOPT_POST, true );
        curl_setopt( $req, CURLOPT_POSTFIELDS, http_build_query( $post_data, '', '&' ) );
        curl_setopt( $req, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $req, CURLOPT_HTTPHEADER, array( 'Content-type: application/x-www-form-urlencoded' ) );
        curl_setopt( $req, CURLOPT_USERAGENT, 'TelphinWebCall-RingMeScript' );
        $res = json_decode( curl_exec( $req ), true );

        if ( ! $res )
            return array( 'error' => 'Error get token' );
        elseif ( isset( $res['error'] ) )
            return array( 'error' => $res['error'] );
        else
            return $res;
    }

    // save_token -- сохранить токен на диск
    private function save_token( $access_token, $expires_in ) {
        $expires_in += time();

        $token_data = array(
            'access_token'  => $access_token,
            'expires_in'    => $expires_in,
        );

        return $this->save_data( $token_data );
    }

    // save_data -- сохраняет данные на диск в виде JSON
    private function save_data( $data ) {
        if ( $data ) {
            $file_data = $this->get_file_data();
            foreach ( $data as $data_key => $data_value ) {
                if ( $data_key == 'access_token' || $data_key == 'expires_in' )
                    $file_data[ $data_key ] = $data_value;
                elseif ( $data_key == 'ips' || $data_key == 'tels' ) {
                    $field_key = $data_value[0];
                    $ncount = ( isset( $data_value[1] ) ) ? $data_value[1] : 1;
                    $file_data[ $data_key ][ $field_key ]['timestamp'] = time();
                    $file_data[ $data_key ][ $field_key ]['ncount']    = $ncount;
                }
            }

            $json = json_encode( $file_data );
            $file = fopen( $this->get_filename(), 'w' );
            fwrite( $file, $json . "\n" );
            fclose( $file );
            return true;
        }

        return false;
    }

    // prepare_count_field -- подготавливает и возвращает ncount запрашиваемого значения
    // сбрасывает счётчик попыток если со времени последней попытки прошло более BLOCK_PERIOD секунд
    private function prepare_count_field( $field_type, $field_name ) {
        if ( ! in_array( $field_type, array( 'ips', 'tels' ) ) ) {
            return 0;
        }

        $file_data = $this->get_file_data();
        $field_ncount;
        if ( isset( $file_data[ $field_type ][ $field_name ] ) ) {
            $field_timestamp = $file_data[ $field_type ][ $field_name ]['timestamp'];
            $field_ncount    = $file_data[ $field_type ][ $field_name ]['ncount'];
            if ( $field_timestamp + self::BLOCK_PERIOD <= time() ) // прошёл период блокировки, сбрасываем счётчик
                $field_ncount = 0;
        }
        else
            $field_ncount = 0;
        $this->save_data( array( $field_type => array( $field_name, $field_ncount + 1 ) ) );
        return $field_ncount;
    }

    private function get_count_ips( $ip ) {
        return $this->prepare_count_field( 'ips', 'ip_' . $ip );
    }

    private function get_count_tels( $tel ) {
        return $this->prepare_count_field( 'tels', 'tel_' . $tel );
    }

    // get_file_data -- получение данных с диска в виде именованного массива
    private function get_file_data() {
        $filename = $this->get_filename();
        if ( file_exists( $filename ) ) {
            $file_data = file_get_contents( $filename );
            return json_decode( $file_data, true );
        }
        else {
            return false;
        }
    }

    // файл на диске, куда записывается информация о токене и посетителях
    private function get_filename() {
        return '._ttmc_' . md5( $this->APP_KEY . $this->APP_SECRET );
    }

    // check_permit -- проверяем, можем ли совершить вызов на телефонный номер
    private function check_permit( $source ) {
        $ip;
        if ( isset( $_SERVER['REMOTE_ADDR'] ) )
            $ip = $_SERVER['REMOTE_ADDR'];
        else
            $ip = '127.0.0.1';

        if ( $ip == '127.0.0.1' )   // для локальной отладки не смотрим на лимиты
            return array( 'result' => 'SUCCESS' );
        else {
            $count_ip = $this->get_count_ips( $ip );
            if ( $count_ip >= self::MAX_COUNT_IP )
                return array( 'result' => 'FAIL', 'error' => 'limit exceeded requests from the ip-address ' . $ip );

            $count_tel = $this->get_count_tels( $source );
            if ( $count_tel >= self::MAX_COUNT_TEL )
                return array( 'result' => 'FAIL', 'error' => 'exceeded the limit of calls to a phone number ' . $source );
        }

        return array( 'result' => 'SUCCESS' );
    }

    // make_call( $extension, $source, $destination, $caller_id, $call_type ) -- совершение вызова на указанные номера
    /********* params *********
        $extension   -- абонент PBX, для совершения вызова( по данному номеру система проверяет, можно ли сделать вызов )
        $source      -- первый абонент, которому идёт звонок(А-плечо). Для типа звонка 'callback' подходит только внешний номер
        $destination -- абонент, которму направляется вызов, если первый абонент(source) ответил на звонок(Б-плечо).
                        Для типа звонка 'callback' подходит только внешний номер.
        $caller_id   -- имя и номер, которые высветятся у абонента-А на телефоне. Формат: Имя <Номер>, например, TestCall <111111>
        $call_type   -- Тип звонка. Допустимые значения: 'callback', 'simple'. Необязательный параметр, по умолчанию, используется тип 'simple'
    ***************************/
    public function make_call($source, $destination, $phonenumber ) {

        $check_permit = $this->check_permit( $source );
        if ( $check_permit['result'] == 'FAIL' )
            return array( 'error' => $check_permit['error'] );

        $url = 'https://' . $this->API_SERVER . '/api/ver1.0/extension/'.EXTENSION_ID.'/callback/';

        $post_data_array = array(
            'dst_num' => $destination,
            'caller_id_name' => 'Web Call '.$phonenumber,
            'caller_id_number' => $phonenumber,
            'call_duration' => '3600',            
            'src_num' => array($source)
        );

        $post_data = json_encode( $post_data_array );

        $req = curl_init();
        curl_setopt( $req, CURLOPT_URL, $url );
        curl_setopt( $req, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $req, CURLOPT_FOLLOWLOCATION, true );
        curl_setopt( $req, CURLOPT_POST, true );
        curl_setopt( $req, CURLOPT_POSTFIELDS, $post_data );
        curl_setopt( $req, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $req, CURLOPT_HTTPHEADER, array(
                'Content-type: application/json',
                "Authorization: Bearer " . $this->get_token()
            )
        );
        curl_setopt( $req, CURLOPT_USERAGENT, 'TelphinWebCall-RingМeScript' );
        $res = json_decode( curl_exec( $req ), true );

        if ( ! $res )
            return array( 'error' => 'Error make call' );
        elseif ( isset( $res['error'] ) )
            return array( 'error' => $res['error'] );
        else
            return $res;
    }
}