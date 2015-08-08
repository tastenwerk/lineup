(function($) {
  $(document).on( 'click', '.save-event', function( event ) {

    $(this).closest('li').find('.infos').css('display', 'none');
    $(this).closest('li').find('.preview').css('display', 'block');

    $parent = $(this).closest('li');

    $date = $parent.find('.date-selector').attr('value');
    $time = $parent.find('.time').attr('value');

    $premiere = $parent.find('.premiere').attr('bool');
    $derniere = $parent.find('.derniere').attr('bool');
    $cancelled = $parent.find('.cancelled').attr('bool');

    $email = $parent.find('.email').attr('value');
    $phone = $parent.find('.phone').attr('value');
    $email_link = $parent.find('.email-link').attr('value');
    $note = $parent.find('.note').attr('value');

    $venue_id = $parent.find('.venue-select:selected').val();

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
        premiere: $premiere == 'true' ? true : false,
        derniere: $derniere == 'true' ? true : false,
        cancelled: $cancelled == 'true' ? true : false,
        email: $email,
        phone: $phone,
        email_link: $email_link,
        note: $note,
        title: 'entry_id='+$entry_id,
        id: $event_id
      },
      success: function( result ) {
        console.log( result );
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
      // console.log( $li );
      $('input', $li ).val('').attr('value', ''); 
      $li.attr('id', function(index, name){
        return name.replace(/;.*=\d*$/, ';');
      });
      // $('input', field ).val('').attr('value', function(index, name) {
      //   return name.replace(/(\d+)/, function(fullMatch, n) {
      //     return Number(n) + 1;
      //   });
      // });
      console.log( $li.find('.venue-select option') );

      console.log( $li.find('.venue-select:selected') );
      $li.insertBefore( $location );
      $li.find('.infos').css('display', 'block');
      $li.find('.preview').css('display', 'none');
      return false;
  })

  $(document).on( 'click', '.edit-date', function( event ) {
    $(this).closest('li').find('.infos').css('display', 'block');
    $(this).closest('li').find('.preview').css('display', 'none');
  })

   $(document).on( 'click', '.venue-select option', function( event ) {
    $(this).closest('.venue-select').children().prop('selected', false );
    $(this).attr("selected", "selected");
    console.log( $(this).closest('.venue-select').children().prop('selected') );
  })

  $(document).on( 'click', '.toggle-button', function( event ) {
    $(this).toggleClass('active-button');
    if( $(this).attr('bool') == 'true' )
      $(this).attr('bool', 'false' );
    else      
      $(this).attr('bool', 'true' );
  })

})(jQuery);
