<?php $items = get_posts( array (
        'post_type' => 'lineupperson',
        'posts_per_page' => -1
    ));
?>
<a class="repeatable-add-side-select button" href="#">Eintrag hinzufügen</a>
<ul id="<?= $field['id'] ?>-repeatable" class="custom_repeatable">
<?php
$i = 0;
if ($meta) {
  foreach($meta as $row) {
?>
<li>
  <input type="text" name="<?= $field['id'] ?>[<?= $i ?>][0]" id="<?= $field['id'] ?>[<?=$i?>][0]" 
           value="<?= $row[0] ?>" size="18" placeholder="Funktion" />
  <a class="repeatable-remove button" >x</a>
  <a class="add-member button" >+</a>

  <?php for( $counter = 1; $counter < sizeof($row); $counter++ ) { ?>

  <div class="select-repeater">
    <select name="<?= $field['id'] ?>[<?=$i?>][<?= $counter ?>]" id="<?= $field['id'] ?>[<?=$i?>][<?= $counter ?>]" class="chosen-select member-select">
      <option value=""> Auswählen </option>
    <?php foreach($items as $item) { ?>
      <option value="<?= $item->ID ?>" <?= $row[$counter] == $item->ID ? ' selected="selected"' : '' ?> >
        <?= localize( $item->post_title ) ?>
      </option>
    <?php  } ?>
    </select>
  </div>
  <?php } ?>

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