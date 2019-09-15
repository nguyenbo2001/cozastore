$('.js-addwish-b2').on('click', function(e){
  e.preventDefault();
});

$('.js-addwish-b2').each(function(){
  var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
  $(this).on('click', function(){
      swal(nameProduct, "is added to wishlist !", "success");

      $(this).addClass('js-addedwish-b2');
      $(this).off('click');
  });
});

$('.js-addwish-detail').each(function(){
  var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

  $(this).on('click', function(){
      swal(nameProduct, "is added to wishlist !", "success");

      $(this).addClass('js-addedwish-detail');
      $(this).off('click');
  });
});

/*---------------------------------------------*/

$('.js-addcart-detail').each(function(){
  var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
  $(this).on('click', function(){
    let productID = $(this).data('product-id');
    let productAddCartLink = $(this).data('product-add-cart-link');
    let cartSizeID = $('.js-modal1').find('select[name=cart_size_id]').val();
    let cartColorID = $('.js-modal1').find("select[name=cart_color_id]").val();
    let cartProductCount = $('.js-modal1').find('input[name=cart_product_count]').val();
    $.ajax({
      url: productAddCartLink,
      method: 'post',
      data: {
        cartSizeID,
        cartColorID,
        cartProductCount
      }
    })
    swal(nameProduct, "is added to cart !", "success");
  });
});