<?php

  namespace Lineup;

  include 'echo-methods/main-methods.php';

  class CustomMetabox
  {
    public function __construct( $box_array, $context, $title ) {
      
      $this->box_array = $box_array;
      $this->context = $context;
      $this->title = $title;
      add_action('add_meta_boxes', array( $this, 'add_custom_meta_box') );
      add_action('save_post', array( $this, 'save_custom_meta') );
      $this->main_methods = new MainMethods();
    }

    public $main_methods;

    public $title;
    public $box_title = 'Erweiterte Informationen';
    public $context = 'normal';
    public $box_array = array();

    public function add_custom_meta_box() {
      add_meta_box(
        $this->title.$this->context, // $id
        $this->box_title, // $title 
        array( $this, 'show_custom_meta_box' ), // $callback
        $this->title, // $page
        $this->context, // $context
        'high'); // $priority
    }


    public function show_custom_meta_box($array) {
      global $post;
      $jump_table = $this->context == 'normal' ? false : true;

      if (!$jump_table){
        echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
        echo '<table class="form-table">';
      }

      foreach ($this->box_array as $field) {
              // get value of this field if it exists for this post
        $meta = get_post_meta($post->ID, $field['id'], true);
              // begin a table row with
        if (!$jump_table) echo '<tr><th>';
        else echo '<div>';
        echo '<label for="'.$field['id'].'">'.$field['label'].'</label>';
        if (!$jump_table) echo '</th><td>';
        switch($field['type']) {
          case 'text':
          $this->main_methods->echo_text_field($field, $meta);
          break;
          case 'textarea':
          $this->main_methods->echo_text_area($field, $meta);
          break;
          case 'checkbox':
          $this->main_methods->echo_checkbox($field, $meta);
          break;    
          case 'select':
          $this->main_methods->echo_select($field, $meta);
          break;
          case 'radio':
          $this->main_methods->echo_radio($field, $meta);
          break;
          case 'checkbox_group':
          $this->main_methods->echo_checkbox_group($field, $meta);
          break;
          case 'date':
          $this->main_methods->echo_date($field, $meta);
          break;
          case 'tax_select':
          $this->main_methods->echo_tax_select($field, $meta, $post);
          break;
          case 'slider':
          $this->main_methods->echo_slider($field, $meta);
          break;
          case 'image':
          $this->main_methods->echo_image($field, $meta);
          break;
          case 'repeatable':
          $this->echo_repeatable($field, $meta);
          break;
          case 'appointments':
          $this->echo_appointments($field, $meta);
          break;
          case 'image-repeater':
          $this->echo_repeatable_image($field, $meta);
          break;
          case 'post_list':
          $this->echo_post_list($field, $meta);
          break;
        }
        if (!$jump_table) echo '</td></tr>';
        else echo '</div>';
      } 
      if (!$jump_table) echo '</table>'; 
    }

  function echo_appointments($field, $meta){
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

  function echo_repeatable($field, $meta){
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

  function echo_repeatable_image($field, $meta){
      echo '<a class="repeatable-add button" href="#">+</a>
              <ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
      $i = 0;
      // $meta=array();
      if ($meta) {
          foreach($meta as $row) {
              echo '<li><span class="sort hndle">|||</span>';
              echo '<span class="custom_default_image" style="display:none">'.$image.'</span>';
              if ($row) { $image = wp_get_attachment_image_src($row, 'medium'); $image = $image[0]; }               
              echo    '<input name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$row.'" />
                          <img src="'.$image.'" class="custom_preview_image" alt="" /><br />
                              <input class="custom_upload_image_button button" type="button" value="Choose Image" />
                              <small> <a href="#" class="custom_clear_image_button">Remove Image</a></small>
                              <br clear="all" />';            
              echo '<a class="repeatable-remove button" href="#">-</a></li>';
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


    // Save the Data
    public function save_custom_meta($post_id) {

      // verify nonce
      if ( !isset( $_POST['custom_meta_box_nonce'] )  || !wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__))) 
        return $post_id;
      // check autosave
      if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;
      // check permissions
      if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
          return $post_id;
      } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
      }

      // loop through fields and save the data
      foreach ($this->box_array as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];
        if ($new && $new != $old) {
          update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
          delete_post_meta($post_id, $field['id'], $old);
        }
      } // end foreach
    }

  }
?>
