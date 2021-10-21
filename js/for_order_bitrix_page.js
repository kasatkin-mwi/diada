$(document).on("click","[name^='PROPERTIES[20]']",function(){
    SalaveyGetTableUser($(this).attr("name"));
});
$(document).ready(function ($) {
    $("[name^='PROPERTIES[20]']").each(function () {
        $_this = $(this),
        $_this.siblings(".name_otvetstvet").remove();
        $.ajax({
            url: "/scripts/get_user_name.php",
            method: "POST",
            data: "USER_ID="+$_this.val(),
            dataType: "json",
            async: false,
            success: function (data) {
                if (data.success){
                    $_this.after("<span class='name_otvetstvet' style='font-weight: bold; padding-left: 5px;'>"+data.name+"</span><br />");
                }
            }
        })
    })
});
$(document).on("change", "[name^='PROPERTIES[20]']>label>input[type=checkbox]", function () {
    $("[name^='PROPERTIES[20]").each(function(){console.log($(this).prop("disabled"))});
})
$(document).on("change","[name^='PROPERTIES[20]']",function(){
    $_this = $(this);
    $(this).siblings(".name_otvetstvet").remove();
    $.ajax({
        url: "/scripts/get_user_name.php",
        method: "POST",
        data: "USER_ID="+$(this).val(),
        dataType: "json",
        success: function (data) {
            if (data.success){
                $_this.after("<span class='name_otvetstvet' style='font-weight: bold; padding-left: 5px;'>"+data.name+"</span><br />");
            }
        }
    })
});
function SalaveyGetTableUser(fildName)
{
    window.open(
        '/bitrix/admin/user_search.php?lang=ru&FN='+BX.Sale.Admin.OrderEditPage.formId+'&FC='+fildName,
        '',
        'scrollbars=yes,resizable=yes,width=840,height=500,top='+Math.floor((screen.height - 840)/2-14)+',left='+Math.floor((screen.width - 760)/2-5)
    );
}