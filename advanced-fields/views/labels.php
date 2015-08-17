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