jQuery(function($) {
  $(document).on( 'click', '.add-label', function( event ) {
    $('.label-overlay').css('display', 'block');
  });  

  $(document).on( 'click', '.close-label', function( event ) {
    $('.label-overlay').css('display', 'none');
  });      

});