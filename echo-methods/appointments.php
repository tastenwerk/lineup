<a class="add-event button" href="#">Neuen Termin anlegen</a>
<ul id="'.$field['id'].'-repeatable" class="events"> 
<hr>

<?php $events = get_posts( array (
    'post_type' => 'lineupevent',
    'post_title' => 'entry_id='.get_the_ID()
  ));
  if( sizeof( $events ) > 0 ){ 
    foreach ($events as $index => $event ) {
      $premiere = get_post_meta( $event->ID, 'lineupevent_premiere', TRUE );
      echo $event->ID;
?>

<li id='entry=<?= the_ID(); ?>;event=<?= $event->ID ?>' class="event">
  <label>Spielort: </label>
  <?php $items = get_posts( array (
        'post_type' => 'lineupvenue',
        'posts_per_page' => -1
    )); ?>
  <select class="venue-select">
    <option value="">Spielort wählen</option>'
    <?php foreach($items as $item) { ?>
      <option value="<?= $item->ID ?>"><?= $item->post_title ?></option>
    <?}?>
  </select>      
  <input type="text" class="date-selector" placeholder="Datum" value="" size="12" />
  <input type="text" size="6" placeholder="Uhrzeit" />
  <br>
  <a class="button toggle-button <?= $premiere ? 'active-button' : '' ?>" bool="false">Premiere</a>
  <a class="button toggle-button" bool="false">Derniere</a>
  <a class="button toggle-button" bool="false">Abgesagt</a>
  <br>
  <input type="text" value="<?= get_post_meta( $event->ID, 'lineupevent_email', TRUE ) ?>" 
    class="email" size="22" placeholder="Reservierungen Email" />
  <br>
  <input type="text" value="<?= get_post_meta( $event->ID, 'lineupevent_phone', TRUE ) ?>" 
    class="phone" size="22" placeholder="Reservierung Telefon" />
  <br>
  <input type="text" value="<?= get_post_meta( $event->ID, 'lineupevent_email-link', TRUE ) ?>" 
    class="email-link" size="22" placeholder="Reservierungslink" />
  <br>
  <input type="text" value="<?= get_post_meta( $event->ID, 'lineupevent_note', TRUE ) ?>" 
    class="note" size="22" placeholder="Notiz" />
  <a class="remove-event button" href="#">Entfernen</a>
  <a class="save-event button button-primary" href="#">Speichern</a>
  <div class="saved-changes" style="display: none;" > Änderungen gespeichert </div>
  <hr>
</li>

<?php } } else { ?>

tODO

<?php } ?>