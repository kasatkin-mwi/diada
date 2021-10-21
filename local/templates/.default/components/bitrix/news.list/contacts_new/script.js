$(document).ready(function()
{
    $('body').on('click', '.cont_city_select_bt', function()
    {
        $(this).parent().find('.cont_city_select_list').toggleClass('active');
        
        return false;   
    });
})