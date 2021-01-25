$('.delete').click(function () {
    var res = confirm('Подтвердите удаление заказа');
    if (!res) return false;
});