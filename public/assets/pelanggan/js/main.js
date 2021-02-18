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
$('#exampleModal').on('shown.bs.modal', function () {
    $("button[open-modal=modal-confirmation]").trigger('focus')
})

$(document).ready(function () {
    $('.showQuickInfo').click(function () {
      $('#QuickInfo').toggleClass('is-active'); // MODAL
  
      var $entry = this.getAttribute('data-entry');
      getEntryData($entry);
    });
},
  
function getEntryData(entryId) {
    $.ajax({
      url: '/entries/getEntryDataForAjax/' + entryId,
      type: 'get',
      dataType: 'json',
      success: function (response) {
        if (response.length == 0) {
          console.log( "Datensatz-ID nicht gefunden.");
        } else { 
          // set values
          $('#category').val( response[0].category );         
          $('#customer').val( response[0].customer );
          // and so on
        }
      }
    });
  }