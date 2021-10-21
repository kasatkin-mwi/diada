<?php
return array(
	'mail'  => array(
        'to_email'   => array('info@diada-arms.ru'),
        'subject'    => 'Заказ звонка',
    ),
    'call'  => array(
		'make_call'   => 'Y',
	),
	'configform' => array(
        /* HTML код */
        array(
        'type' => 'freearea',
        'value'=>'<div class="help_form_tit">Нужна помощь?</div><div class="help_form_txt">Оставьте свой телефон и мы перезвоним Вам!</div>'
        ),
        /* Однострочный текст */
       /* array(
        'type' => 'input',
        'label' => 'Ваше имя',
        'error'=>'Поле "Ваше имя" заполнено некорректно',
        'formail' => 1,
        'name_mail'=>'Имя',
        'attributs' => array(
             'id'=>'field-id203412',
             'name'=>'field-name203412',
             'type'=>'text',
             'placeholder'=>'Как к Вам обращаться?',
             'value'=>'',
             'required'=>'required',
             'pattern'=>'',
             ),
        ),*/

        /* Однострочный текст */
        array(
        'type' => 'input',
        'label' => '',//'Ваш телефон:',
        'error'=>'Поле "Ваш телефон" заполнено некорректно',
        'formail' => 1,
        'name_mail'=>'Телефон',
        'attributs' => array(
             'id'=>'field-id238580',
             'name'=>'field-name238580',
             'type'=>'text',
             'placeholder'=>'+7 (___) ___-__-__',
             'value'=>'',
              'required'=>'required',
             'pattern'=>'^\+?[\d,\-,(,),\s]+$',
             ),
        ),
        array(
        'type' => 'recaptcha',
        'error' => 'Пожалуйста, подтвердите, что Вы не робот.',
        'attributs' => array(
             'id'=>'field-id23858',
             'name'=>'g-recaptcha-response',
             'value' => '<div class="g_recaptcha_bl"><div class="g-recaptcha" style="transform:scale(0.77); transform-origin:0;" data-sitekey="6LdHJ6sUAAAAAEvPyj5li0cqUSTR8qAal7y6LwPL" id="'.uniqid ('r_').'"></div></div>',
              'required'=>'required',
              
              ),
        ),
        /*--Кнопка--*/ array( 'type' => 'input',
         'class' => 'buttonform',
         'attributs' => array( 'type'=>'submit', 'value'=>'Жду звонка', ),
         ), 

        /*--Блок ошибок--*/
        #array( 'type' => 'freearea', 'value' => '<div class="error_form"></div>', ),
    ),
);
