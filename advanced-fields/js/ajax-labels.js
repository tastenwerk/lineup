jQuery(function($) {

  $(document).on( 'click', '.add-label', function( event ) {
    $('.label-overlay').css('display', 'block');
    $('#label-preview').html( "Label" );
    $('.label-dialog').attr('term-id', "" );
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
        $cur_label = $('.label-taxonomys .current-label[term-id='+$parent.attr('term-id')+']' );
        if( $cur_label.css('display') == 'none' )
          $cur_label.css('display', 'inline-block');
        else
          $cur_label.css('display', 'none');
        if( $('.label-taxonomys .current-label:visible').length == 0 )
          $('.label-taxonomys .current-labels p').css('display', 'block');
        else
          $('.label-taxonomys .current-labels p').css('display', 'none');

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
        text_color: $('.color-text[selected=selected]').css('background-color'),
        border_color: $('.color-border[selected=selected]').css('background-color'),
        term_id: $('.label-dialog').attr('term-id')
      },
      success: function( result ) {
        location.reload();
      }
    });
  });



  $(document).on( 'click', '.edit-label', function( event ) {
    $parent = $(this).closest('li');
    $('#label-preview').html( $parent.find('.name').html() );
    $('.label-name').html( $parent.find('.name').html() );
    $('.label-dialog').attr('term-id', $parent.attr('term-id') );
    $('.label-overlay').css('display', 'block');
  });

  $(document).on( 'click', '.remove-label', function( event ) {   
    $parent = $(this).closest('li');
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
          $('.label-taxonomys .current-labels p').css('display', 'block');
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

  $('.add-member ').click(function() {
    console.log( $(this).parent().find('.member-select') );
    $anc =  $(this).parent().find('.member-select')
    $clone = $anc.clone(true);
    $clone.val('');
    $clone.attr('name', function(index, name) {
      return name.replace(/\]\[(\d+)/, function(fullMatch, n) {
        console.log('HERE; ', n);
        return '][' + n.replace(/(\d+)/, function(fullMatch, i) {
          return Number(i) + 1;
        });
      });
    })
    $clone.attr('id', function(index, name) {
      return name.replace(/\]\[(\d+)/, function(fullMatch, n) {
        console.log('HERE; ', n);
        return '][' + n.replace(/(\d+)/, function(fullMatch, i) {
          return Number(i) + 1;
        });
      });
    })
    $clone.insertAfter( $anc );
    // field = jQuery(this).closest('td').find('.custom_repeatable li:last').clone(true);
    // fieldLocation = jQuery(this).closest('td').find('.custom_repeatable li:last');
    // jQuery('input', field).val('').attr('name', function(index, name) {
    //   return name.replace(/(\d+)/, function(fullMatch, n) {
    //     return Number(n) + 1;
    //   });
    // })
    // field.insertAfter(fieldLocation, jQuery(this).closest('td'))
    // return false;
  });

});