jQuery(function($) {
  $(document).on( 'click', '.add-label', function( event ) {
    $('.label-overlay').css('display', 'block');
    $('#label-preview').html( "Label" );
  });  

  $(document).on( 'click', '.close-label', function( event ) {
    $('.label-overlay').css('display', 'none');
  });      

  $(document).on( 'click', '.available-label .highlight', function( event ) {
    $parent = $(this).closest('li');
    $.ajax({
      url: ajaxpagination.ajaxurl,
      type: 'post',
      data: {
        action: 'toggle_label',
        post_id: $('.current-labels').attr('post-id'),       
        term_name: $parent.attr('term-name'),
        term_id: $parent.attr('term-id')
      },
      success: function( result ) {
        $cur_label = $('.current-label[term-id='+$parent.attr('term-id')+']' );
        if( $cur_label.css('display') == 'none' )
          $cur_label.css('display', 'inline-block');
        else
          $cur_label.css('display', 'none');
        if( $('.current-label:visible').length == 0 )
          $('.current-labels p').css('display', 'block');
        else
          $('.current-labels p').css('display', 'none');

      }
    });
  });  

  $(document).on( 'click', '.create-label', function( event ) {
    $.ajax({
      url: ajaxpagination.ajaxurl,
      type: 'post',
      data: {
        action: 'post_label',
        title: $('.label-name').val(),
        background_color: $('.color-background[selected=selected]').css('background-color'),
        text_color: $('.color-border[selected=selected]').css('background-color'),
        border_color: $('.color-text[selected=selected]').css('background-color')
      },
      success: function( result ) {
        location.reload();
      }
    });
  });

  $(document).on( 'click', '.remove-label', function( event ) {   
    id = $parent = $(this).closest('li');
    $.ajax({
      url: ajaxpagination.ajaxurl,
      type: 'post',
      data: {
        action: 'delete_label',
        term_id: $parent.attr('term-id')
      },
      success: function( result ) {
        $('.current-label[term-id='+$parent.attr('term-id')+']' ).remove();
        $parent.remove();
        if( $('.current-label:visible').length == 0 )
          $('.current-labels p').css('display', 'block');
      }
    })
  });

  $( document ).ready(function() {
    $('.color-background:first-child').attr('selected', 'selected');
    $('.color-text:nth-child(2)').attr('selected', 'selected');
    $('.color-border:nth-child(2)').attr('selected', 'selected');
  });


  $(document).on( 'click', '.color-background, .color-text, .color-border', function( event ) {
    $(this).closest('.colors').children().removeAttr('selected');
    $(this).attr('selected', 'selected');
    $('#label-preview').css('background-color', $('.color-background[selected=selected]').css('background-color') );
    $('#label-preview').css('border-color', $('.color-border[selected=selected]').css('background-color') );
    $('#label-preview').css('color', $('.color-text[selected=selected]').css('background-color') );
  });



  $(".label-name").on("change paste keyup", function() {
    $('#label-preview').html( $('.label-name').val() );
  });


});