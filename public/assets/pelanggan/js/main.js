var swiper = new Swiper('.swiper-container', {
    slidesPerView: 5,
    spaceBetween: 24,
    slidesPerGroup: 2,
    loop: true,
    loopFillGroupWithBlank: true,
    pagination: {
    el: '.swiper-pagination',
    clickable: true,
    },
    navigation: {
    nextEl: '.slide-next',
    prevEl: '.slide-prev',
    },
});
$('#modalconfirmation').on('shown.bs.modal', function () {
    $("button[open-modal=modal-confirmation]").trigger('focus')
})
$('#revieworder').on('shown.bs.modal', function () {
  $("button[open-modal=modal-review]").trigger('focus')
})

$(document).ready(function(){
  // Check Radio-box
  $(".rating-order-input input:radio").attr("checked", false);

  $('.rating-order-input input').click(function () {
      $(".rating-order-input span").removeClass('checked');
      $(this).parent().addClass('checked');
  });

  $('input:radio').change(
    function(){
      var userRating = this.value;
      // alert(userRating);
  }); 
});