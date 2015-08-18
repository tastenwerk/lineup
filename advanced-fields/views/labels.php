<?php 
  $terms = get_terms( 'label', 'get=all');
  $selected = array_map( function( $term ){
      return $term->term_id;
    }, wp_get_object_terms($post->ID, 'label') );
?>
<div class="label-taxonomys">
  <div><em><?= __("Eintrag aktuell gelabelt mit", 'lineup') ?>:</em></div>
  <div class="current-labels" post-id=<?= $post->ID ?> >
    <?php foreach ( $terms as $label ) { 
      $meta = get_option( 'custom_taxonomy_meta_'.$label->term_id ); ?>
      <span class="current-label" term-id=<?= $label->term_id ?> 
        style="background-color: <?= $meta['background-color'] ?>; 
          display: <?= in_array( $label->term_id, $selected ) ? 'inline-block' : none ?> ">
        <?= $label->name ?>
      </span>
    <?php } ?>
    <p style="display: <?= sizeof( $selected) == 0 ? 'block' : none ?>">
      <?= __("Keinem Label", 'lineup') ?>
    </p>
  </div>
  <div class="available-lables">
  <em><?= __("Verfügbare Labels", 'lineup') ?>:</em>
  <span class="dashicons dashicons-plus add-label"></span>
  <ul>
  <?php foreach ($terms as $term) {
    $meta = get_option( 'custom_taxonomy_meta_'.$term->term_id );
  ?>
    <li class="available-label" term-id=<?= $term->term_id ?> term-name=<?= $term->name ?> >
      <div class="highlight" title="Labeln / Entlabeln"></div>
      <span class="color" style="background-color: <?= $meta['background-color'] ?>;"></span>
      <span class="name" ><?= $term->name ?></span>
      <span class="dashicons dashicons-trash remove-label" title="Löschen"></span>
      <span class="dashicons dashicons-edit edit-label" title="Bearbeiten"></span>
    </li>
  <?php } ?>
  </div>
</div>


<?php
  $colors = array(
    "background-color: white; border: 1px solid black;",
    "background-color: black; border: 1px solid black;",
    "background-color: #6A00FF; border: 1px solid #6A00FF;",
    "background-color: #F96700;  border: 1px solid #F96700;",
    "background-color: #00ABA8;  border: 1px solid #00ABA8;",
    "background-color: #A4C300;  border: 1px solid #A4C300;",
    "background-color: #D80072;  border: 1px solid #D80072;",
    "background-color: #F0A209;  border: 1px solid #F0A209;",
  );
?>


<div class="label-overlay">
  <div class="label-dialog">
    <h2><?= __("Neues Label anlegen") ?>
      <span class="dashicons dashicons-no close-label"></span>
    </h2>
    <hr>
    <div class="label-data">
      <h3>
        Hintergrundfarbe:
      </h3>
      <div class="colors">
      <?php foreach ( $colors as $color ){ ?>
        <span class="color color-background" style="<?= $color ?>"></span>
      <?php } ?>
      </div>
      <br>
      <h3>
        Textfarbe:
      </h3>
      <div class="colors">
      <?php foreach ( $colors as $color ){ ?>
        <span class="color color-text" style="<?= $color ?>"></span>
      <?php } ?>
      </div>
      <br>
      <h3>
        Umrandungsfarbe:
      </h3>
      <div class="colors">
      <?php foreach ( $colors as $color ){ ?>
        <span class="color color-border" style="<?= $color ?>"></span>
      <?php } ?>
      </div>
    </div>
    <div class="label-preview">
      <h3>
        Text:
      </h3>
      <input type="text" class="label-name" placeholder="Name" value="Label" size="12"/>
      <h3>Vorschau:</h3>
      <span id="label-preview">Label</span>
      <a class="create-label button button-primary" href="#">Speichern</a>
    </div>
  </div>
</div>