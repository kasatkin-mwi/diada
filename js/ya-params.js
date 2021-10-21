// version 7.12.2017
// Чтобы такое событие срабатывало, в код инициализации счетчика ЯМ нужно добавить параметр triggerEvent:true
jQuery(document).on('yacounter25448447inited', function () {

    // Получаем домен с которого пришел посетитель. Достаточно простой и надежный способ
    var a = document.createElement('a');
    a.href = document.referrer;
    
    // Если визит был с самого сайта, то не считаем его, так как оптимизаторам нужны переходы только с других ресурсов
    if(a.host == window.location.host) {
        return;
    }

    // параметр для метрики и хлебная крошка с прошлой итерации
    var ya_breadcrumbs = false;

    // получаем див с ХК и сами ХК
/*
    // без jQuery
    var breadcrumbs_wrapper = document.getElementsByClassName('breadcrumbs');
    
    if (breadcrumbs_wrapper.length == 0) {
        return;
    }

    breadcrumbs_wrapper = breadcrumbs_wrapper[0].getElementsByTagName('div')
    if (breadcrumbs_wrapper.length == 0) {
        return;
    }

    var breadcrumbs = breadcrumbs_wrapper[0].childNodes;
*/
    // если все отдельные крошки являются детьми одного элемента с id = "breadcrumbs", то можно проще:
    /*var breadcrumbs_wrapper = document.getElementById('breadcrumbs');
    if (breadcrumbs_wrapper == null) {
        return;
    }
    var breadcrumbs = breadcrumbs_wrapper.childNodes;*/

    // с jQuery
    
     //если у ХК нет тегов у последнего элемента вместо того что выше
    //var str_bread = ('.bread').text();
    //var breadcrumbs = str_bread.split(' >');
    
    var breadcrumbs = $('.bread_crumbs > li');
    if (breadcrumbs.length == 0) {
        return;
    }

    // цикл по хлебным крошкам от текущей страницы до родителя
    for (var i = breadcrumbs.length - 1; i >= 0; i--) {
        var current = breadcrumbs[i].textContent.trim();

        // пропускаем пустые элементы и разделители
        if (!current || current == '/') {
            continue;
        }

        // последнюю ХК просто оборачиваем в массив, а под остальные создаем объект
        if (!ya_breadcrumbs) {
            ya_breadcrumbs = [current];
        } else {
            var tempCrumbs = ya_breadcrumbs;
		  	ya_breadcrumbs = {};
		  	ya_breadcrumbs[current] = tempCrumbs;
        }
    }

    var yaParams = [];

    yaParams.push({'breadcrumbs': ya_breadcrumbs});



    // Любым удобным способом проверяем находимся ли мы на странице товара.
    // Например, можно в шаблоне товара задавать JS переменную: <script> var isProductPage = true; </script>
    // а тут её проверять:
    if (typeof window.isProductPage != 'undefined' && isProductPage) {
        
        // Название товара
        var productName = '';
        
        // Возьмем из h1
        var h1 = document.getElementsByTagName('h1')[0];
        
        // и добавим в параметры визита
        productName = h1.innerText;

        yaParams.push({'Карточка товара': productName});
    }


    yaCounter25448447.params(yaParams);

    // Для предварительной проверки выводим получивший массив в консоль браузера.
    // console.log(yaParams);
    //
    // Должны получить массив из 2-х javascript-объектов:
    // Вложенный объект с элементами хлебных крошек и объект c названием товара 
    //
    // Не забываем проверить, что данные отправляются с помощью режима отладки http://example.com/?_ym_debug=1
});
