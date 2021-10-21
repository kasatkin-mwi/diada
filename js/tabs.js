(function($){
    $(function(){
        $("ul.tabs").on("click","li:not(.current)",function(){$(this).addClass("current").siblings().removeClass("current").parents("div.section").find("div.box").eq($(this).index()).fadeIn(150).siblings("div.box").hide();});
        $("ul.tabs1").on("click","li:not(.current)",function(){
            $(this).addClass("current").siblings().removeClass("current").parents("div.section").find("div.box1").eq($(this).index()).fadeIn(150).siblings("div.box1").hide();
        });
    });
})(jQuery);