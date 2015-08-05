(function($) {
  $(document).on( 'click', '.date-selector', function( event ) {
    $('.date-selector').attr('value', 'test');
    event.preventDefault();
    $.ajax({
      url: ajaxpagination.ajaxurl,
      type: 'post',
      data: {
        action: 'ajax_pagination',
        query_vars: 'hello',
        email_link: $('.email-link').attr('value'),
        title: '1'
      },
      success: function( result ) {
        $('.date-selector').attr( 'value', "WHAT"+result );
      }
    })
  })
})(jQuery);