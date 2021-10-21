

$( document ).ready(function() {
    $(".detail_complect_left_block .red_buy_detail, .table_buy_money .buy_element_button, .index_hit .red_buy").click(function(){
        var basketvaluepro = $(".head_white_basket_ic span").text();
        basketvaluepro = parseInt(basketvaluepro);
        basketvaluepro++;
        $(".head_white_basket_ic span").text(basketvaluepro);
        $(".head_white_basket_ic span").css('background','#c41a1c');
    });
});