(function($) {

  $(document).on( 'click', '.save-event', function( event ) {
    $parent = $(this).closest('li');

    $date = $parent.find('.date-selector').attr('value');
    $time = $parent.find('.time-selector').attr('value');

    $premiere = $parent.find('.premiere').attr('bool') == 'true' ? 1 : '';
    $derniere = $parent.find('.derniere').attr('bool') == 'true' ? 1 : '';
    $cancelled = $parent.find('.cancelled').attr('bool') == 'true' ? 1 : '';

    $email = $parent.find('.email').attr('value');
    $phone = $parent.find('.phone').attr('value');
    $email_link = $parent.find('.email-link').attr('value');
    $note = $parent.find('.note').attr('value');

    $venue_id = $parent.find('.venue-select').val();

    if( !$venue_id ){
      // SHOW REQUIRED VALUES
      $parent.find('.required-values').show();
      setTimeout(function() {
        $parent.find('.required-values').hide();
      }, 3000);
      return;
    }

    $label = $parent.find('.label-select').val();
    $label_id = $parent.find('.label-select option[value="'+$label+'"]').attr('term-id');

    $parent.find('.current-label').css('display', 'none');
    $current_label = $parent.find('.current-label[term-id='+$label_id+']' );
    $current_label.css('display', 'inline-block');

    $ids = $parent.attr('id').split(';');
    if( $ids.length > 1 ){
      $entry_id = $ids[0].split('=')[1];
      $event_id = $ids[1].split('=')[1];
    } else{
      $entry_id = $ids[0].split('=')[1];
      $event_id = '';      
    } 
    $.ajax({
      url: ajaxpagination.ajaxurl,
      type: 'post',
      data: {
        action: 'post_event',
        venue_id: $venue_id,
        date: $date,
        time: $time,
        premiere: $premiere,
        derniere: $derniere,
        cancelled: $cancelled,
        email: $email,
        phone: $phone,
        email_link: $email_link,
        note: $note,
        title: 'entry_id='+$entry_id,
        id: $event_id,
        label: $label ? $label : false
      },
      success: function( result ) {
        data = JSON.parse( result );
        // UPDATE ID
        $parent.attr('id', function(index, name){
          return name.replace(/;$/, ';event='+data.id );
        });
        // UPDATE PREVIEW
        $preview = $parent.find('.preview');
        $preview.find('.date').html( data.date );
        $preview.find('.time').html( data.time );
        $preview.find('.dayname').html( data.dayname );
        $preview.find('.year').html( data.year );
        $preview.find('h3').html( $parent.find('.venue-select option.selected').html() );
        // HIDE INFOS AND SHOW PREVIEW
        $parent.find('.infos').css('display', 'none');
        $parent.find('.preview').css('display', 'block');
        // SHOW SAVED INFO
        $parent.find('.saved-changes').show();
        setTimeout(function() {
          $parent.find('.saved-changes').hide();
        }, 3000);
      }
    })
  })

  $(document).on( 'click', '.remove-event', function( event ) {
    $parent = $(this).closest('li');
    $ids = $parent.attr('id').split(';');
    if( $ids.length > 1 )
      $event_id = $ids[1].split('=')[1];
    else
      $event_id = '';      
    
    $.ajax({
      url: ajaxpagination.ajaxurl,
      type: 'post',
      data: {
        action: 'delete_event',
        id: $event_id
      },
      success: function( result ) {
        if( $ids.length > 1 ){
          $parent.remove();
        }
      }
    })
  })

  $(document).on( 'click', '.add-event', function( event ) {
      $li = $(this).next().find('li:first').clone(true);
      $location = $(this).next().find('li:first');
      // RESET ALL VALUES
      $('input', $li ).val('').attr('value', ''); 
      $li.attr('id', function(index, name){
        return name.replace(/;.*=\d*$/, ';');
      });
      $('.toggle-button', $li ).attr('bool', 'false' );
      $('.toggle-button', $li ).removeClass('active-button');
      $li.find('.venue-select').children().removeClass('selected');
      $li.find('.venue-select').children().removeAttr('selected');
      $li.insertBefore( $location );
      // DISPLAY INFOS
      $li.find('.infos').css('display', 'block');
      $li.find('.preview').css('display', 'none');
      return false;
  })

  $(document).on( 'click', '.edit-date', function( event ) {
    $('li .preview').css('display', 'block');
    $('li .infos').css('display', 'none');
    $(this).closest('li').find('.infos').css('display', 'block');
    $(this).closest('li').find('.preview').css('display', 'none');
  })

  //  $(document).on( 'click', '.venue-select option', function( event ) {
  //   console.log('HERE');
  //   $(this).closest('.venue-select').children().removeClass('selected');
  //   $(this).closest('.venue-select').children().removeAttr('selected');
  //   $(this).addClass('selected');
  //   $(this).attr('selected', 'selected');
  // })

  $("option").bind('change',function() {
    // console.log( $(this).val() );
    // $(this).closest('select').children().removeClass('selected');
    // // $(this).closest('select').children().removeAttr('selected');
    // $(this).addClass('selected');
    // $(this).attr('selected', 'selected');
  });


  // $(document).on( 'click', '.label-select option', function( event ) {
  //   $(this).closest('.label-select').children().removeAttr('selected');
  //   $(this).attr('selected', 'selected');
  // })

  $(document).on( 'click', '.toggle-button', function( event ) {
    $(this).toggleClass('active-button');
    if( $(this).attr('bool') == 'true' )
      $(this).attr('bool', false );
    else      
      $(this).attr('bool', true );
  })
  
})(jQuery);
