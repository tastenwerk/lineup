<a class="repeatable-add-venue button" href="#">Neuen Termin anlegen</a>
<ul id="'.$field['id'].'-repeatable" class="custom_repeatable"> 
<hr>

<?php $events = get_posts( array (
    'post_type' => 'lineupevent',
  ));
  if( sizeof( $events ) > 0 ){ 
    foreach ($events as $index => $event ) {
      // print_r(  $event );
    echo get_post_meta( $event->ID, 'lineupevent_email-link', TRUE );
?>

<li>
  <label>Spielort: </label>
  <?php $items = get_posts( array (
        'post_type' => 'lineupvenue',
        'posts_per_page' => -1
    )); ?>
  <select>
    <option value="">Spielort wählen</option>'
    <?php foreach($items as $item) { ?>
      <option value="<?= $item->ID ?>"><?= $item->post_title ?></option>
    <?}?>
  </select>      
  <input type="text" class="date-selector" placeholder="Datum" value="" size="12" />
  <input type="text" size="6" placeholder="Uhrzeit" />
  <br>
  <input type="text" value="<?= get_post_meta( $event, 'lineupevent_email-link', TRUE ) ?>" 
    class="email-link" size="22" placeholder="Reservierungen Email" />
  <br>
  <input type="text" value="" size="22" placeholder="Reservierungslink" />
  <br>
  <input type="text" value="" size="22" placeholder="Notiz" />
  <a class="repeatable-remove button" href="#">Termin entfernen</a>
</li>
<hr>

<?php } } else { ?>

tODO

<?php } ?>