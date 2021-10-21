window.addEventListener('load', function() {
    var touchsurface = document.getElementsByTagName("body")[0],
        startX,
        startY,
        dist,
        threshold = 150,
        allowedTime = 1000,
        elapsedTime,
        startTime

    function handleswipe(isrightswipe) {
        console.log("swipe");
        if (isrightswipe>0){
            if (!$(".js_catalog_mobile_menu_light").hasClass("catalog_mobile_menu_open")) {
                $(".js_catalog_menu_mobile_button").click();
            }
        }
        else{
            if ($(".js_catalog_mobile_menu_light").hasClass("catalog_mobile_menu_open")) {
                $(".js_catalog_menu_mobile_button").click();
            }
            if ($(".js_filter_block").hasClass("filter_block_menu_open")) {
                $(".js_filter_button_block").click();
            }
        }
    }

    touchsurface.addEventListener('touchstart', function (e) {
        var touchobj = e.changedTouches[0]
        dist = 0
        startX = touchobj.pageX
        startY = touchobj.pageY
        startTime = new Date().getTime() // время контакта с поверхностью сенсора
    }, false)

    touchsurface.addEventListener('touchend', function (e) {
        var touchobj = e.changedTouches[0]
        dist = touchobj.pageX - startX
        elapsedTime = new Date().getTime() - startTime
        var swiperightBol = (elapsedTime <= allowedTime && Math.abs(dist) >= threshold && Math.abs(touchobj.pageY - startY) <= 100)
        if (swiperightBol) handleswipe(dist)
    }, false)
});