<?
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
if(IntVal($_REQUEST["album_id"])):
$album_id = IntVal($_REQUEST["album_id"]);
?>

<script type="text/javascript" src="/3d_viewer/js/libraries/jquery.js"></script>
<script type="text/javascript" src="/3d_viewer/js/libraries/jquery.mobile.vmouse.js"></script>
<script type="text/javascript" src="/3d_viewer/js/libraries/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="/3d_viewer/js/libraries/jquery.mousewheel-3.0.4.js"></script>
<script type="text/javascript" src="/3d_viewer/js/buttons.js"></script>
<script type="text/javascript" src="/3d_viewer/js/Expo360.js"></script>
<script type="text/javascript" src="/3d_viewer/js/pngFixer.js"></script>
<script type="text/javascript">
    $(document).ready(function($) {
        var expo = new Expo360({xml:"/3d_viewer/configuration/settings.php?album_id=<?=$album_id?>", where:"#viewer"});
    });
</script>
<?
endif;
?>
<div id="viewer"></div>
