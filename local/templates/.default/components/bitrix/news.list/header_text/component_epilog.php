<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if($arParams['SHOW_MORE_LINK'] == 'Y') {?>
<script>
    $(document).ready(function() {
        if($(window).width()<1000) {
            $(".important_more").click(function(){
                if($(this).hasClass("active")) {
                    $(this).removeClass("active").html("Подробнее").siblings(".important_txt").removeClass("all");
                } else {
                    $(this).addClass("active").html("Свернуть").siblings(".important_txt").addClass("all");
                };
                return false;
            });
        };
    });
</script>
<?}?>