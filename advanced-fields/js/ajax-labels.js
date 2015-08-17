jQuery(function($) {
  $(document).on( 'click', '.add-label', function( event ) {
    $('.label-overlay').css('display', 'block');
  });  

  $(document).on( 'click', '.close-label', function( event ) {
    $('.label-overlay').css('display', 'none');
  });      

  $(document).on( 'click', '.create-label', function( event ) {
    console.log( $('.label-name').val() );
    $.ajax({
      url: ajaxpagination.ajaxurl,
      type: 'post',
      data: {
        action: 'post_label',
        title: $('.label-name').val()
      },
      success: function( result ) {
        alert(result);
      }
    })
  });

});