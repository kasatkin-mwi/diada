$(document).ready(function()
{
    $("body").on("submit", ".vozvrat_form_r form", function()
    {
        $(".result_cont").prepend('<div class="center_loader_mask"><div class="img-loader" style="top: 45%;"></div></div>');
        var data = $(this).serialize();
        $.ajax ({
            url: "/return/ajax.php",
            type: "POST",
            data: data,
            dataType: "html",
            success: function(data)
            {
                $('.result_cont').html($(data).find('.result_cont').html());
                if($('.vozvrat_page_bl .vozvrat_page_cont').length)
                {
                    $('.vozvrat_page_bl .vozvrat_page_cont').remove();    
                }    
            }
        });
        return false;
    });
    $('body').on('click', '.requirements-toggle', function()
    {
        $(this).parents('.requirements').find('.vozvrat_page_gray').toggleClass('active');
        if($(this).find('.fa').hasClass('fa-angle-down'))
        {
            $(this).find('.fa').removeClass('fa-angle-down');    
            $(this).find('.fa').addClass('fa-angle-right');
        }
        else
        {
            $(this).find('.fa').removeClass('fa-angle-right');    
            $(this).find('.fa').addClass('fa-angle-down');
        }
        return false;    
    });
});