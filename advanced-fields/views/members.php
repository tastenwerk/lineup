<?php $items = get_posts( array (
        'post_type' => 'lineupperson',
        'posts_per_page' => -1
    ));
?>
<a class="repeatable-add-members button" >Eintrag hinzufügen</a>
<p>1. Funktion eingeben <br> 2. Person suchen <br> 3. Plus drücken </p>
<ul id="<?= $field['id'] ?>-repeatable" class="custom_repeatable member-repeatable">
<?php
$i = 0;
if ($meta) {
  foreach($meta as $row) {
?>
<li>

  <!-- <span class="repeatable-remove dashicons dashicons-dismiss"></span> -->
  <input type="text" name="<?= $field['id'] ?>[<?= $i ?>][0]" id="<?= $field['id'] ?>[<?=$i?>][0]" 
    class="member-function" value="<?= $row[0] ?>" size="18" placeholder="Funktion" />
  <span class="add-member dashicons dashicons-plus-alt"></span>
  <span class="dashicons dashicons-trash remove-member" title="Löschen"></span>

  <div class="select-repeater">
    <select  class="chosen-select member-select">
      <option value=""> Auswählen </option>
    <?php foreach($items as $item) { ?>
      <option value="<?= $item->ID ?>" >
        <?= localize( $item->post_title ) ?>
      </option>
    <?php  } ?>
    </select>
  </div>

  <ul class="members-list">
  <?php for( $counter = 1; $counter < sizeof($row); $counter++ ) { ?> 
    <li>
      <input type='text' class="member-hide" name="<?= $field['id'] ?>[<?=$i?>][<?= $counter ?>]" id="<?= $field['id'] ?>[<?=$i?>][<?= $counter ?>]" value=<?= $row[$counter] ?> >
      <span class="member-name"><?= localize( get_post( $row[$counter] )->post_title ) ?></span><span class="dashicons dashicons-no remove-member"></span>
    </li>
  <?php } ?> 
  </ul>

</li>
<?php $i++;
    }
  } else { ?>
<li>
  <input type="text" name="<?= $field['id'] ?>[<?= $i ?>][0]" id="<?= $field['id'] ?>[<?=$i?>][0]" 
           value="" size="18" placeholder="Funktion" />
  <a class="repeatable-remove button" href="#">x</a>
  <a class="repeatable-add button" href="#">+</a>
  <div class="select-repeater">
    <select name="<?= $field['id'] ?>[<?=$i?>][1]" id="<?= $field['id'] ?>[<?=$i?>][1]" class="chosen-select member-select">
      <option value=""> Auswählen </option>
       <?php foreach($items as $item) { ?>
      <option value="<?= $item->ID ?>" <?= $row[1] == $item->ID ? ' selected="selected"' : '' ?> >
        <?= $item->post_title ?>
      </option>
    <?php  } ?>
    </select>
  </div>
</li>
<?php } ?>
</ul>
<span class="description"><?= $field['desc'] ?></span>