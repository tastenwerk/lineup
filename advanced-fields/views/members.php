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
  <select name="<?= $field['id'] ?>[<?=$i?>][0]" id="<?= $field['id'] ?>[<?=$i?>][0]">
    <option value=""> Auswählen </option>
  <?php foreach($items as $item) { ?>
    <option value="<?= $item->ID ?>" <?= $row[0] == $item->ID ? ' selected="selected"' : '' ?> >
      <?= localize( $item->post_title ) ?>
    </option>
  <?php  } ?>
  </select>
  <input type="text" name="<?= $field['id'] ?>[<?= $i ?>][1]" id="<?= $field['id'] ?>[<?=$i?>][1]" 
           value="<?= $row[1] ?>" size="22" placeholder="Funktion" />
  <a class="repeatable-remove button" href="#">x</a>
</li>
<?php $i++;
    }
  } else { ?>
<li>
  <select name="<?= $field['id'] ?>[<?=$i?>][0]" id="<?= $field['id'] ?>[<?=$i?>][0]">
    <option value=""> Auswählen </option>
     <?php foreach($items as $item) { ?>
    <option value="<?= $item->ID ?>" <?= $row[0] == $item->ID ? ' selected="selected"' : '' ?> >
      <?= $item->post_title ?>
    </option>
  <?php  } ?>
  </select>
  <input type="text" name="<?= $field['id'] ?>[<?= $i ?>][1]" id="<?= $field['id'] ?>[<?=$i?>][1]" 
           value="" size="22" placeholder="Funktion" />
  <a class="repeatable-remove button" href="#">x</a>
</li>
<?php } ?>
</ul>
<span class="description"><?= $field['desc'] ?></span>