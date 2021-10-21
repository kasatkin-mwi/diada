$(".refund_prava.styler input:checkbox").styler();
$(".refund_form_el.styler.defect input:file").styler({
    filePlaceholder: 'Прикрепите, пожалуйста, фото или видео дефекта или неисправности',
    fileBrowse: 'Загрузить файлы'
});
$(".refund_form_el.styler.guarantee input:file").styler({
    filePlaceholder: 'Прикрепите, пожалуйста, Заявление по гарантии',
    fileBrowse: 'Загрузить файл'
});
function nextStep(val)
{
    if(!val)
     return false;
    
    var hideId = '';
               
    $('.refund_cont').each(function()
    {
        if($(this).is(':visible'))
        {
            hideId = $(this).attr('id');
        }
    });
    if(!!hideId)
    {
        $('#'+hideId).hide();   
    }
    $('#step_'+val).fadeIn(500);   
    
}
$(document).ready(function() {
    $('.refund_form_el input[name="PROPERTY[5902][0]"]').inputmask('dd.mm.yyyy',{ "placeholder": "__.__.____" });
    var current = 0;
    $.validator.addMethod('filesize', function (value, element, param) 
    {
        var filesAccepted = true;
        $.each(element.files, function(index, val)
        {
            if(val.size > param)
                filesAccepted = false;
        });
        
        return this.optional(element) || filesAccepted 
    }, 'Размер файла должен быть меньше чем 5 МБ');

    var v = $("#return_form").validate({
        onkeyup: false,
        onfocusout: false,
        submitHandler: function(form) 
        {
            $(form).parents('.refund_bl').prepend('<div class="center_loader_mask"><div class="img-loader" style="top: 45%;"></div></div>');
            var formData = new FormData($(form)[0]);
            $.ajax({   
                url: location.pathname,
                data: formData,
                type: 'POST',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function(data)
                {
                    if(parseInt(data.ID) > 0)
                    {
                        $('#step_4 .request_num').html(parseInt(data.ID));
                        nextStep(4);
                        $('.refund_bl .center_loader_mask').remove();    
                    }
                }
            });  
        },
        rules: {
            'UF_NAME': {
                required: true,
            },
            'PROPERTY[NAME][0]': {
                required: true,
            },
            'PROPERTY[5901][0]': {
                required: true,
                number: true,
            },
            'PROPERTY[5902][0]': {
                required: true,
            },
            'PROPERTY[5944][0]': {
                required: true,
                email: true,
            },
            'PROPERTY[PREVIEW_TEXT][0]': {
                required: true,
            },
            'PROPERTY[DETAIL_TEXT][0]': {
                required: true,
            },
            'PROPERTY_FILE_5903_0[]': {
                required: true,
                filesize: 5000000
            },
            'PROPERTY_FILE_5904_0': {
                required: true,
                filesize: 5000000
            },
            'check': {
                required: true,
            }
        },
        messages: {
            'PROPERTY[NAME][0]': {
                required: "Поле \"ФИО\" обязательно для заполнения"
            },
            'PROPERTY[5901][0]': {
                required: "Поле \"Номер заказа\" обязательно для заполнения",
                number: "Введенное значение должно быть числом"
            },
            'PROPERTY[5944][0]': {
                required: "Поле \"Email\" обязательно для заполнения",
                email: "Введите корректный e-mail"
            },
            'PROPERTY[5902][0]': {
                required: "Поле \"Дата заказа\" обязательно для заполнения"
            },
            'PROPERTY[PREVIEW_TEXT][0]': {
                required: "Поле \"Описание неисправности\" обязательно для заполнения",
            },
            'PROPERTY[DETAIL_TEXT][0]': {
                required: "Поле \"Описание требования\" обязательно для заполнения",
            },
            'PROPERTY_FILE_5903_0[]': {
                required: "Поле \"Фото или видео дефекта\" обязательно для заполнения",
            },
            'PROPERTY_FILE_5904_0': {
                required: "Поле \"Заявление по гарантии\" обязательно для заполнения",
            },
            'check': {
                required: "Вы не ознакомились с гарантийными условиями",
            }
        }
    });
    
    $("body").on('click', "#step_2 .prevbutton", function() 
    {
        current = 0;
        nextStep(1);
    });
    $("body").on('click', "#step_3 .prevbutton", function() 
    {
        current = 1;
        nextStep(2);
    });
    $("body").on('click', ".open2", function() 
    {
        if (v.form()) 
        {
            current = 2;
            nextStep(3);
        }
    });
    $("body").on('click', ".open1", function() 
    {
        if (v.form()) 
        {
            current = 1;
            nextStep(2);
        }
    });
    $("body").on('click', '.open0', function() 
    {
        if (v.form()) 
        {
            current = 0;
            nextStep(1);
        }
    });
});