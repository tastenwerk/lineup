<?php

namespace Lineup;

class RepeaterMethods {

  function echo_post_select_repeater( $field, $meta ){
    $items = get_posts( array (
        'post_type' => $field['post_type'],
        'posts_per_page' => -1
    ));

    echo '<a class="repeatable-add-side-select button" href="#">Eintrag hinzufügen</a>
          <ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
    $i = 0;
    if ($meta) {
      foreach($meta as $row) {
        echo '<li>';
        echo '<select name="'.$field['id'].'['.$i.']" id="'.$field['id'].'">
                <option value="">Select One</option>'; // Select One
            foreach($items as $item) {
                echo '<option value="'.$item->ID.'"',$row == $item->ID ? ' selected="selected"' : '','>'.$item->post_title.'</option>';
            }
        echo '</select><a class="repeatable-remove button" href="#">x</a></li>';
        $i++;
      }
    } else {
      echo '<li>';
      echo '<select name="'.$field['id'].'['.$i.']" id="'.$field['id'].'">
              <option value="">Select One</option>'; // Select One
          foreach($items as $item) {
              echo '<option value="'.$item->ID.'"', '','>'.$item->post_title.'</option>';
          }
      echo '</select><a class="repeatable-remove button" href="#">x</a></li>';
    }
    echo '</ul>
    <span class="description">'.$field['desc'].'</span>';
  }

  function echo_member_repeater( $field, $meta ){
    $items = get_posts( array (
        'post_type' => 'lineupperson',
        'posts_per_page' => -1
    ));

    echo '<a class="repeatable-add-side-select button" href="#">Eintrag hinzufügen</a>
          <ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
    $i = 0;
    if ($meta) {
      foreach($meta as $row) {
        echo '<li>';
        echo '<select name="'.$field['id'].'['.$i.'][0]" id="'.$field['id'].'">
                <option value="">Select One</option>'; // Select One
            foreach($items as $item) {
                echo '<option value="'.$item->ID.'"',$row[0] == $item->ID ? ' selected="selected"' : '','>'.$item->post_title.'</option>';
            }
        echo '</select>';
        echo '<input type="text" name="'.$field['id'].'['.$i.'][1]" id="'.$field['id'].'" 
           value="'.$row[1].'" size="22" placeholder="Funktion" />';
        echo '<a class="repeatable-remove button" href="#">x</a></li>';
        $i++;
      }
    } else {
      echo '<li>';
      echo '<select name="'.$field['id'].'['.$i.'][0]" id="'.$field['id'].'">
              <option value="">Select One</option>'; // Select One
          foreach($items as $item) {
              echo '<option value="'.$item->ID.'"', '','>'.$item->post_title.'</option>';
          }
      echo '</select>';
      echo '<input type="text" name="'.$field['id'].'['.$i.'][1]" id="'.$field['id'].'" 
         value="" size="22" placeholder="Funktion" />';
      echo '<a class="repeatable-remove button" href="#">x</a></li>';
    }
    echo '</ul>
    <span class="description">'.$field['desc'].'</span>';
    // print_r($meta);
  }

  function echo_venue_select($field, $meta, $i){
    $items = get_posts( array (
        'post_type' => 'lineupvenue',
        'posts_per_page' => -1
    ));
    echo '<select name="'.$field['id'].'['.$i.'][0]" id="'.$field['id'].'">
            <option value="">Select One</option>'; // Select One
        foreach($items as $item) {
            echo '<option value="'.$item->ID.'"',$meta[0] == $item->ID ? ' selected="selected"' : '','>'. $item->post_title .'</option>';
        }
    echo '</select>';
  }

  function echo_date_select($field, $meta, $i){
    // TODO class datepicker
    echo '<input type="text" class="" placeholder="Datum"
      name="'.$field['id'].'['.$i.'][1]" id="'.$field['id'].'" value="'.$meta[1].'" size="12" />';
      // <input type="text" name="'.$field['id'].'['.$i.'][4]" id="'.$field['id'].'" 
      //     value="'.$row[4].'" size="6" placeholder="Uhrzeit" />
      // <br />'; 
  }

  public function echo_appointments($field, $meta){
    echo '<a class="repeatable-add-venue button" href="#">Neuen Termin anlegen</a>
          <ul id="'.$field['id'].'-repeatable" class="custom_repeatable"> <hr>';
    $i = 0;
    if ($meta) {
      foreach($meta as $row) {
        echo '<li>';
        echo '<label>Spielort: </label>';
        $this->echo_venue_select($field, $row, $i); 
        // echo '<br>';
        // echo '<label>Datum: </label>';
        $this->echo_date_select($field, $row, $i);
        echo '<input type="text" name="'.$field['id'].'['.$i.'][5]" id="'.$field['id'].'" 
          value="'.$row[5].'" size="6" placeholder="Uhrzeit" />';
        echo '<br>';
        echo '<input type="text" name="'.$field['id'].'['.$i.'][2]" id="'.$field['id'].'" 
          value="'.$row[2].'" size="22" placeholder="Reservierungen Email" />';
        echo '<br>';
        echo '<input type="text" name="'.$field['id'].'['.$i.'][3]" id="'.$field['id'].'" 
          value="'.$row[3].'" size="22" placeholder="Reservierungs Link" />';
        echo '<br>';
        echo '<a class="repeatable-remove button" href="#">Termin entfernen</a></li>';
        echo '<hr>';
        $i++;
      }
    } else {
      echo '<li>';
        echo '<label>Reservierungen Email: </label>';
        echo '<input type="text" name="'.$field['id'].'['.$i.'][2]" id="'.$field['id'].'" value="'.$row[2].'" size="22" />';
        echo '<br>';
        echo '<label>Reservierungs Link: </label>';
        echo '<input type="text" name="'.$field['id'].'['.$i.'][3]" id="'.$field['id'].'" value="'.$row[3].'" size="22" />';
        echo '<br>';
        echo '<a class="repeatable-remove button" href="#">Termin entfernen</a></li>';
        echo '<hr>';
    }
    echo '</ul>
    <span class="description">'.$field['desc'].'</span>';
  }

  public function echo_repeatable($field, $meta){
    echo '<a class="repeatable-add button" href="#">+</a>
          <ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
    $i = 0;
    if ($meta) {
      foreach($meta as $row) {
        echo '<li><span class="sort hndle">|||</span>
        <input type="text" name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" value="'.$row.'" size="30" />
        <a class="repeatable-remove button" href="#">-</a></li>';
        $i++;
      }
    } else {
      echo '<li><span class="sort hndle">|||</span>
      <input type="text" name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" value="" size="30" />
      <a class="repeatable-remove button" href="#">-</a></li>';
    }
    echo '</ul>
    <span class="description">'.$field['desc'].'</span>';
  }

  public function echo_repeatable_image($field, $meta){
      echo '<a class="repeatable-add button" href="#">+</a>
              <ul id="'.$field['id'].'-repeatable" class="custom_repeatable image-repeatable">';
      $i = 0;
      // $meta=array();
      if ($meta) {
          foreach($meta as $row) {
              // echo '<li><span class="sort hndle">|||</span>';
              echo '<div class="pic-wrapper"><span class="custom_default_image" style="display:none">'.$image.'</span>';
              echo '<span class="dashicons dashicons-smiley"></span>';
              if ($row) { $image = wp_get_attachment_image_src($row, 'thumb'); $image = $image[0]; }               
              echo    '<input name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$row.'" />
                          <img src="'.$image.'" class="custom_preview_image" alt="" /><br />
                              <input class="custom_upload_image_button button" type="button" value="Choose Image" />
                              <small> <a href="#" class="custom_clear_image_button">Remove Image</a></small>
                              <br clear="all" />';            
              echo '<a class="repeatable-remove button" href="#">-</a></li></div>';
              $i++;
          }
      } else {
          echo '<li><span class="sort hndle">|||</span>';
          $image = get_template_directory_uri().'/images/image.png'; 
          echo '<span class="custom_default_image" style="display:none">'.$image.'</span>';
          echo    '<input name="'.$field['id'].'['.$i.']" id="'.$field['id'].'"  type="hidden" class="custom_upload_image" value="'.$meta.'" />
                      <img src="'.$image.'" class="custom_preview_image" alt="" /><br />
                          <input class="custom_upload_image_button button" type="button" value="Choose Image" />
                          <small> <a href="#" class="custom_clear_image_button">Remove Image</a></small>
                          <br clear="all" />';
          echo '<a class="repeatable-remove button" href="#">-</a></li>';
      }
      echo '</ul>
         <span class="description">'.$field['desc'].'</span>';
    }


}

?>