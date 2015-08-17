<?php 
  $terms = get_terms( 'label', 'get=all');
  $selected = wp_get_object_terms($post->ID, 'label');
?>
<div class="label-taxonomys">
  <div class="current-labels">
    <div><em><?= __("Eintrag aktuell gelabelt mit", 'lineup') ?>:</em></div>
    <?php if( sizeof( $selected) > 0 ){ foreach ( $selected as $label ) { ?>
      <span style="background-color: red; color: white; border-color: red;" class="current-label">
        <?= $label->name ?>
      </span>
    <?php } } else { ?>
    <p><?= __("Keinem Label"), 'lineup' ?></p>
    <?php } ?>
  </div>
  <div class="available-lables">
  <em><?= __("Verfügbare Labels", 'lineup') ?>:</em>
  <span class="dashicons dashicons-plus add-label"></span>
  <ul>
  <?php foreach ($terms as $term) {?>
    <li>
      <span class="color"></span>
      <span class="name"><?= $term->name ?></span>
      <span class="dashicons dashicons-trash remove-label" title="Löschen"></span>
    </li>
  <?php } ?>
  </div>
</div>


<?php
  $colors = array(
    "background-color: white; border: 1px solid black;",
    "background-color: red; border: 1px solid red;",
    "background-color: green;  border: 1px solid green;",
    "background-color: yellow;  border: 1px solid yellow;",
    "background-color: blue;  border: 1px solid blue;",
  );
?>


<div class="label-overlay">
  <div class="label-dialog">
    <h2><?= __("Neues Label anlegen") ?>
      <span class="dashicons dashicons-no close-label"></span>
    </h2>
    <hr>
    <div class="label-data">
      
      <input placeholder="Name"/>
      <h3>
        Hintergrundfarbe:
      </h3>
      <div class="colors">
      <?php foreach ( $colors as $color ){ ?>
        <span class="color" style="<?= $color ?>"></span>
      <?php } ?>
      </div>
      <br>
      <h3>
        Textfarbe:
      </h3>
      <div class="colors">
      <?php foreach ( $colors as $color ){ ?>
        <span class="color" style="<?= $color ?>"></span>
      <?php } ?>
      </div>
    </div>
    <div class="label-preview">
      <h3>Vorschau:</h3>
      <span id="label-preview">Label</span>
      <a class="create-label button button-primary" href="#">Speichern</a>
    </div>
  </div>
</div>