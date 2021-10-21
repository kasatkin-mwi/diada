$(document).ready(function()
{ 
    if(location.pathname == "/bitrix/admin/sale_order_view.php")
    {
        if($("#sale-adm-user-description-view").length)
        {
            var comment = $(".adm-bus-component-content-container").find("#sale-adm-user-description-view").parents(".sale-order-props-group");
            $(".adm-bus-component-content-container").find(".sale-order-props-group:first").after('<div class="adm-bus-table-container caption border sale-order-props-group">'+comment.html()+'</div>');
            comment.remove();
        }
        if($(".adm-bus-component-content-container .sale-order-props-group:first").find(".adm-bus-table-caption-title").text() != "Адрес доставки")
        {
            $(".adm-bus-component-content-container .sale-order-props-group").each(function()
            {
                if($(this).find(".adm-bus-table-caption-title").text() == "Адрес доставки")
                {
                    console.log($(this).find(".adm-bus-table-caption-title").text());
                    var delivery_address = $(this);
                    $(".adm-bus-component-content-container").find(".sale-order-props-group:first").before('<div class="adm-bus-table-container caption border sale-order-props-group">'+delivery_address.html()+'</div>');
                    delivery_address.remove();
                }
            })
        }
    }
    if(location.pathname == "/bitrix/admin/sale_order_edit.php")
    {
        if($('input[name="PROPERTIES[69]"]').length)
        {
            $('input[name="PROPERTIES[69]"]').parent().append(' <a href="javascript:void(0);" class="fill-index-by-loaction">Заполнить индекс в соответствии с указанным местоположением</a>')
        }
        
        $('body').on('click', '.fill-index-by-loaction', function()
        {
            var code,
                _this = $(this);
            if($('input[name="PROPERTIES[17]"]').length)
            {
                code = $('input[name="PROPERTIES[17]"]').parents('.dropdown-block').find('.bx-ui-sls-fake').attr('data-code');
                if(code != '' && code != undefined)
                {
                    BX.ajax({
                        url: '/include/admin/get.index.php',
                        method: 'POST',
                        dataType: 'json',
                        timeout: 60,
                        data: {action:'getIndex', code:code},
                        onsuccess: function(result){
                            
                            if (!result)
                                return;
                                
                            _this.parents('.adm-detail-content-cell-r').find('input').val(result.code);
                            
                        }
                    });    
                }
                
                
                //PROPERTIES[17]    
            }
        });
    }
    setTimeout(function() {
        
        if($("#USER_DESCRIPTION").length)
        {
            var comment = $(".adm-bus-component-content-container").find("#USER_DESCRIPTION").parents(".sale-order-props-group");    
            $(".adm-bus-component-content-container").find(".sale-order-props-group:first").after('<div class="adm-bus-table-container caption border sale-order-props-group">'+comment.html()+'</div>');
            comment.remove();
        }
        
        $('select[name="PROPERTIES[25]"]').select2({
            placeholder: "Выберите значение",
            allowClear: true,
            "language": {
               "noResults": function(){
                   return "Ничего не найдено";
               }
            },
            escapeMarkup: function (markup) {
                return markup;
            }
        });
        $('select[name="PROPERTIES[31]"]').select2({
            placeholder: "Выберите значение",
            allowClear: true,
            "language": {
               "noResults": function(){
                   return "Ничего не найдено";
               }
            },
            escapeMarkup: function (markup) {
                return markup;
            }
        });
        $('select[name="PROPERTIES[44]"]').select2({
            placeholder: "Выберите значение",
            allowClear: true,
            "language": {
               "noResults": function(){
                   return "Ничего не найдено";
               }
            },
            escapeMarkup: function (markup) {
                return markup;
            }
        });
        if($('select[name="PROPERTIES[26]"]').val() != 1 && $('select[name="PROPERTIES[26]"]').val() != 2)
        {
            $('select[name="PROPERTIES[25]"]').prop("disabled", true);    
        }
        $("body").on("change",'select[name="PROPERTIES[26]"]',function()
        {
            if($(this).val() != 1 && $(this).val() != 2)
            {
                $('select[name="PROPERTIES[25]"]').prop("disabled", true);
            }
            else
            {
                $('select[name="PROPERTIES[25]"]').prop("disabled", false);
            }
            return false;     
        });
        $('input[name="PROPERTIES[34]"]').mask("99:99");
        $('input[name="PROPERTIES[35]"]').mask("99:99");
        
        $(".adm-bus-component-content-container").find(".sale-order-props-group").each(function(index,val)
        {        
            var hide = true;
            
            if($(this).find("#sale-adm-user-description-view").length)
            {
                if($(this).find("#sale-adm-user-description-view").text() != "Нет")
                {
                    hide = false;
                    
                    var text = $(this).find("#sale-adm-user-description-view").html();
                    $(this).find("#sale-adm-user-description-view").html('<span style="background: #54ff9f; color:#000;padding: 0 3px;font-weight: bold;">'+text+'</span>')
                }
            }             
            if((index != 0 && $(this).find('.adm-bus-table-caption-title:first').text() != "Адрес доставки") && hide)
            {
                $(this).find(".adm-detail-content-table.edit-table").before( '<div class="adm-bus-table-caption-title adm-bus-table-caption-toggle">Развернуть</div>' );    
                $(this).find(".adm-detail-content-table.edit-table").addClass("hide");        
            }
        });
        
        $("body").on("click",".adm-bus-table-caption-toggle",function()
        {
            if($(this).parent().find(".adm-detail-content-table.edit-table").hasClass("hide"))
            {
                $(this).html("Свернуть");
            }
            else
            {
                $(this).html("Развернуть");    
            }
            $(this).parent().find(".adm-detail-content-table.edit-table").toggleClass("hide");
            return false; 
        });
        
        if(location.pathname == "/bitrix/admin/iblock_edit_property.php")
        {
            var type = $("#PROPERTY_PROPERTY_TYPE").val();
            
            if($("#list-tbl").length && type == "L")
            {
                var params = new Array();
                var request = location.search;
                request = request.split('?');
                
                if(request[1].length)
                {
                    request = request[1].split('&');
                    $.each(request,function(index, value)
                    {
                        var param = value.split("=");
                        params[param[0]] = param[1];
                    });
                    
                    if(params["ID"] != "" && params["ID"] != undefined && params["IBLOCK_ID"] != "" && params["IBLOCK_ID"] != undefined)
                    {
                        BX.ajax
                        ({
                            method: "post",
                            url: "/include/get_prop_link.php",
                            data: {action:'getProp',ID:params["ID"], IBLOCK_ID:params["IBLOCK_ID"]},
                            dataType: "json",
                            cache: false,
                            onsuccess: function (data)
                            {  
                                var num = 0;
                                $("#list-tbl").find("tr").each(function()
                                {
                                    if($(this).index() > 0)
                                    {
                                        var prop_enum = "";
                                        $(this).find("td").each(function( index, value )
                                        {   
                                            if(index == 0)
                                            {
                                                if($(value).text() != "")
                                                {
                                                    prop_enum = parseInt($(value).text());    
                                                }
                                                
                                            }
                                            
                                            if(index == 2)
                                            {
                                                if(prop_enum != "" && prop_enum != undefined && prop_enum > 0)
                                                {
                                                    var value = "";
                                                    if(data.links[prop_enum] != undefined && data.links[prop_enum] != "")
                                                    {
                                                        value = data.links[prop_enum];    
                                                    }
                                                    $( '<br><input placeholder="Ссылка" type="text" class="prop_link" name="UF_ENUM_ID['+prop_enum+']" id="UF_ENUM_ID_'+prop_enum+'" value="'+value+'" size="35" maxlength="255" style="width:90%">' ).insertAfter($(this).find("input"));
                                                }
                                                /*else
                                                {
                                                    $( '<br><input placeholder="Ссылка" type="text" class="prop_link" name="UF_ENUM_ID[n'+num+']" id="UF_ENUM_ID_n'+num+'" value="" size="35" maxlength="255" style="width:90%">' ).insertAfter($(this).find("input"));    
                                                }*/
                                                
                                                num++;
                                            }    
                                        });    
                                    }
                                })   
                            }
                        });
                    }
                }
            }
            /*$("body").on("click","#propedit_add_btn", function()
            {
                var count = $("#list-tbl").find("tr").length;
                if(params["ID"] == "n0")
                {
                    count = count - 2;    
                }
                else
                {
                    count = count - 1;
                }
                
                var i = 0;
                $("#list-tbl").find("tr").each(function()
                {
                    if($(this).index() > 0)
                    {
                        $(this).find("td").each(function( index, value )
                        {
                            if(index == 2)
                            {
                                i++;
                                if(i == count)
                                {
                                    $( '<br><input placeholder="Ссылка" type="text" class="prop_link" name="UF_ENUM_ID[n'+count+']" id="UF_ENUM_ID_n'+count+'" value="" size="35" maxlength="255" style="width:90%">' ).insertAfter($(this).find("input"));   
                                }
                            }    
                        });    
                    }
                })
            });*/   
        }
         
    }, 1000);    
});