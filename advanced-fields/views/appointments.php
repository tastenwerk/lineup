<a class="add-event button" href="#">Neuen Termin anlegen</a>
<ul id="'.$field['id'].'-repeatable" class="events"> 

<hr>

<?php $events = get_posts( array (
    'post_type' => 'lineupevent',
    'post_title' => 'entry_id='.get_the_ID(),
    'meta_key' => 'lineupevent_date',
    'orderby' => 'meta_value',
    'order' => 'ASC'
  ));

  $items = get_posts( array (
    'post_type' => 'lineupvenue',
    'posts_per_page' => -1
  ));


  $terms = get_terms( 'label', 'get=all');

  if( sizeof( $events ) > 0 ){ 
    foreach ($events as $index => $event ) {
      $premiere = get_post_meta( $event->ID, 'lineupevent_premiere', TRUE );
      $venue_id = get_post_meta( $event->ID, 'lineupevent_venue_id', TRUE );
      $date = get_post_meta( $event->ID, 'lineupevent_date', TRUE );
      $venue = get_post( $venue_id );

      $selected = wp_get_object_terms( $event->ID, 'label' );
      $selected_id = array_map( function( $term ){
          return $term->term_id;
        }, wp_get_object_terms($event->ID, 'label') );
?>
<li id='entry=<?= the_ID(); ?>;event=<?= $event->ID ?>' class="event">
  <div class="preview">
    <div class="wrapper">
      <div class="calendar">
        <p class="date"><?= date_i18n('d.m', $date) ?></p>
        <p class="dayname"><?= date_i18n('D', $date) ?></p>
        <p class="year"><?= date_i18n('Y', $date) ?></p>
      </div>
      <h3><?= localize( $venue->post_title ) ?></h3>
      <div class="tools">
        <p class="time"><?= date_i18n('H:i', $date) ?></p>
        <span class="dashicons dashicons-welcome-write-blog edit-date" title="Bearbeiten"></span>
        <span class="dashicons dashicons-trash remove-event" title="Löschen"></span>
        <?php foreach ( $terms as $label ) { 
          $meta = get_option( 'custom_taxonomy_meta_'.$label->term_id ); ?>
          <span class="current-label" term-id=<?= $label->term_id ?> 
            style="background-color: <?= $meta['background-color'] ?>;  
              border-color: <?= $meta['border-color'] ?>;
              color: <?= $meta['text-color'] ?>;
              display: <?= in_array( $label->term_id, $selected_id ) ? 'inline-block' : none ?> ">
            <?= $label->name ?>
          </span>
        <?php } ?>
      </div>
    </div>
    <div class="saved-changes" style="display: none;" > Änderungen gespeichert </div>
    <hr>
  </div>

  <div class="infos">

    <label>Spielort: </label>
    <select name="venue-selector" class="venue-select">
      <option value="">Spielort wählen</option>'
      <?php foreach($items as $item) { ?>
        <option value="<?= $item->ID ?>" selected="<?= $venue_id == $item-> ID ? 'selected': '' ?>"
          class="<?= $venue_id == $item-> ID ? 'selected': '' ?>"><?= localize( $item->post_title ) ?></option>
      <?}?>
    </select>      
    <input type="text" class="date-selector" placeholder="Datum" value="<?= date_i18n('d.m.Y', $date) ?>" size="12" />
    <input type="text" class="time-selector" size="6" placeholder="Uhrzeit" value="<?= date_i18n('H:i', $date) ?>"/>
    <br>
    <a class="button toggle-button <?= $premiere ? 'active-button' : '' ?>" bool="false">Premiere</a>
    <a class="button toggle-button" bool="false">Derniere</a>
    <a class="button toggle-button" bool="false">Abgesagt</a>
    <br>
    <input type="text" value="<?= get_post_meta( $event->ID, 'lineupevent_email', TRUE ) ?>" 
      class="email" placeholder="Reservierungen Email" />
    <br>
    <input type="text" value="<?= get_post_meta( $event->ID, 'lineupevent_phone', TRUE ) ?>" 
      class="phone" placeholder="Reservierung Telefon" />
    <br>
    <input type="text" value="<?= get_post_meta( $event->ID, 'lineupevent_email-link', TRUE ) ?>" 
      class="email-link" size="22" placeholder="Reservierungslink" />
    <br>
    <input type="text" value="<?= get_post_meta( $event->ID, 'lineupevent_note', TRUE ) ?>" 
      class="note" size="25" placeholder="Notiz" />

    <span class="label-text">Label:</span>
    <select class="label-select" id='<?= $post->ID.$event->ID ?>_labels'>
      <option value=""> Keine </option>
      <?php 
        foreach ($terms as $term) {
          if (!empty($selected) && !strcmp($term->slug, $selected[0]->slug)){ 
      ?>
        <option value="<?= $term->slug ?>" term-id="<?= $term->term_id ?>" selected="selected"><?= $term->name ?></option>
      <?php }else{ ?>
        <option value="<?= $term->slug ?>" term-id="<?= $term->term_id ?>" ><?= $term->name ?></option> 
      <?php } } ?>
    </select><br>

    <a class="remove-event button" href="#">Entfernen</a>
    <a class="save-event button button-primary" href="#">Speichern</a>
    <hr>
  </div>
</li>

<?php } } else { ?>

<li id='entry=<?= the_ID(); ?>;' class="event">

  <div class="preview" style="display: none;">
    <p>date</p>
    <h3> Spielort 
    <span class="dashicons dashicons-welcome-write-blog edit-date"></span></h3>
    <div class="saved-changes" style="display: none;" > Änderungen gespeichert </div>
    <hr>
  </div>

  <div class="infos" style="display: block;">

    <label>Spielort: </label>
    <select name="venue-selector" class="venue-select">
      <option value="">Spielort wählen</option>'
      <?php foreach($items as $item) { ?>
        <option value="<?= $item->ID ?>"><?= $item->post_title ?></option>
      <?}?>
    </select>      
    <input type="text" class="date-selector" placeholder="Datum" value="" size="12" />
    <input type="text" class="time-selector" size="6" placeholder="Uhrzeit" />
    <br>
    <a class="button toggle-button" bool="false">Premiere</a>
    <a class="button toggle-button" bool="false">Derniere</a>
    <a class="button toggle-button" bool="false">Abgesagt</a>
    <br>
    <input type="text" value="" class="email" size="22" placeholder="Reservierungen Email" />
    <br>
    <input type="text" value="" class="phone" size="22" placeholder="Reservierung Telefon" />
    <br>
    <input type="text" value="" class="email-link" size="22" placeholder="Reservierungslink" />
    <br>
    <input type="text" value="" class="note" size="22" placeholder="Notiz" />
    <a class="save-event button button-primary" href="#">Speichern</a>
    <hr>
  </div>
</li>

<?php } ?>