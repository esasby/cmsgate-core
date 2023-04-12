$('.basket_item_total').on('DOMSubtreeModified', function() {
    var sum = 0;
    $('.basket_item_total').each(function(){
        sum += parseFloat($(this).text());
    });
    $('#basket_total').text(sum);
});