$('body').on('click', '.rates__btn', function(e){
    e.preventDefault();
    var id = $(this).data('id'),
        qty = 1; //проба
    $.ajax({
        url: 'cart/add',//Куда передаются данные
        // data: {id: id},//Передача данных
        data: {id: id, qty: qty},//Передача данных
        type: 'GET',//Каким типом идёт передача
        success: function (res) {
            showCart(res);
        },
        error: function () {
            alert('Ошибка. Попробуйте снова');
        }
    });
});
function showCart(cart) {
    if ($.trim(cart) == '<h3>Корзина пуста</h3>'){
        $('#cart .modal-footer a, #cart .modal-footer .btn-danger').css('display', 'none');
    } else {
        $('#cart .modal-footer a, #cart .modal-footer .btn-danger').css('display', 'inline-block');
    }
    $('#cart .modal-body').html(cart);
    $('#cart').modal();
    if ($('.cart-sum').text()){
        $('.cartModal').html($('#cart .cart-sum')).text();
    } else {
        $('.cartModal').text('');
    }
}

function getCart() {
    $.ajax({
        url: 'cart/show',//Куда передаются данные
        type: 'GET',//Каким типом идёт передача
        success: function (res) {
            showCart(res);
        },
        error: function () {
            alert('Ошибка. Попробуйте снова');
        }
    });
}

function clearCart() {
    $.ajax({
        url: 'cart/clear',//Куда передаются данные
        type: 'GET',//Каким типом идёт передача
        success: function (res) {
            showCart(res);
        },
        error: function () {
            alert('Ошибка. Попробуйте снова');
        }
    });
    // return false;
}