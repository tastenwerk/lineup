<?php

  namespace Lineup;

  class CustomMetabox
  {
    public function __construct( $box_array, $context, $title ) {
      $this->box_array = $box_array;
      $this->context = $context;
      $this->title = $title;
      add_action('add_meta_boxes', array( $this, 'add_custom_meta_box') );
      add_action('save_post', array( $this, 'save_custom_meta') );
    }

    public $title;
    public $context = 'normal';
    public $box_array = array();

    public function add_custom_meta_box() {
      add_meta_box(
        $this->title.$this->context, // $id
        ' ', // $title 
        array( $this, 'show_custom_meta_box' ), // $callback
        $this->title, // $page
        $this->context, // $context
        'high'); // $priority
    }


    public function show_custom_meta_box($array) {
      global $post;


            // Use nonce for verification
      echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
            // Begin the field table and loop
      echo '<table class="form-table">';

      foreach ($this->box_array as $field) {
              // get value of this field if it exists for this post
        $meta = get_post_meta($post->ID, $field['id'], true);
              // begin a table row with
        echo '<tr><th><label for="'.$field['id'].'">'.$field['label'].'</label></th><td>';
        switch($field['type']) {
          case 'text':
          $this->echo_text_field($field, $meta);
          break;
          case 'textarea':
          $this->echo_text_area($field, $meta);
          break;
          case 'checkbox':
          $this->echo_checkbox($field, $meta);
          break;    
          case 'select':
          $this->echo_select($field, $meta);
          break;
          case 'radio':
          $this->echo_radio($field, $meta);
          break;
          case 'checkbox_group':
          $this->echo_checkbox_group($field, $meta);
          break;
          case 'date':
          $this->echo_date($field, $meta);
          break;
          case 'tax_select':
          $this->echo_tax_select($field, $meta, $post);
          break;
          case 'slider':
          $this->echo_slider($field, $meta);
          break;
          case 'image':
          $this->echo_image($field, $meta);
          break;
          case 'repeatable':
          $this->echo_repeatable($field, $meta);
          break;
          case 'dates-repeater':
          $this->echo_dates($field, $meta);
          break;
        }
        echo '</td></tr>';
      } // end foreach
      echo '</table>'; // end table
    }

    function echo_text_field($field, $meta){
    echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
      <br /><span class="description">'.$field['desc'].'</span>';
  }

  function echo_text_area($field, $meta){
    echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
      <br /><span class="description">'.$field['desc'].'</span>';
  }

  function echo_checkbox($field, $meta){
    echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/>
      <label for="'.$field['id'].'">'.$field['desc'].'</label>';
  }

  function echo_select($field, $meta){
    echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';
    foreach ($field['options'] as $option) {
        echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
    }
    echo '</select><br /><span class="description">'.$field['desc'].'</span>';
  }

  function echo_radio($field, $meta){
    foreach ( $field['options'] as $option ) {
      echo '<input type="radio" name="'.$field['id'].'" id="'.$option['value'].'" value="'.$option['value'].'" ',$meta == $option['value'] ? ' checked="checked"' : '',' />
        <label for="'.$option['value'].'">'.$option['label'].'</label><br />';
    }
  }

  function echo_checkbox_group($field, $meta){
    foreach ($field['options'] as $option) {
      echo '<input type="checkbox" value="'.$option['value'].'" name="'.$field['id'].'[]" id="'.$option['value'].'"',$meta && in_array($option['value'], $meta) ? ' checked="checked"' : '',' /> 
      <label for="'.$option['value'].'">'.$option['label'].'</label><br />';
    }
    echo '<span class="description">'.$field['desc'].'</span>';
  }

  function echo_date($field, $meta){
    echo '<input type="text" class="datepicker" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
      <br /><span class="description">'.$field['desc'].'</span>';   
  }

  function echo_tax_select($field, $meta, $post){
    echo '<select name="'.$field['id'].'" id="'.$field['id'].'">
    <option value="">Select One</option>'; // Select One
    $terms = get_terms($field['id'], 'get=all');
    $selected = wp_get_object_terms($post->ID, $field['id']);
    foreach ($terms as $term) {
      if (!empty($selected) && !strcmp($term->slug, $selected[0]->slug)) 
        echo '<option value="'.$term->slug.'" selected="selected">'.$term->name.'</option>'; 
      else
        echo '<option value="'.$term->slug.'">'.$term->name.'</option>'; 
    }
    $taxonomy = get_taxonomy($field['id']);
    echo '</select><br /><span class="description"><a href="'.get_bloginfo('url').'/wp-admin/edit-tags.php?taxonomy='.$field['id'].'">Manage '.$taxonomy->label.'</a></span>';    
  }

  function echo_slider($field, $meta){
    $value = $meta != '' ? $meta : '0';
      echo '<div id="'.$field['id'].'-slider"></div>
      <input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$value.'" size="5" />
      <br /><span class="description">'.$field['desc'].'</span>';
  }

  function echo_image($field, $meta){
      $image = get_template_directory_uri().'/images/image.png';  
      echo '<span class="custom_default_image" style="display:none">'.$image.'</span>';
      if ($meta) { $image = wp_get_attachment_image_src($meta, 'medium'); $image = $image[0]; }               
      echo    '<input name="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$meta.'" />
                  <img src="'.$image.'" class="custom_preview_image" alt="" /><br />
                      <input class="custom_upload_image_button button" type="button" value="Choose Image" />
                      <small> <a href="#" class="custom_clear_image_button">Remove Image</a></small>
                      <br clear="all" /><span class="description">'.$field['desc'].'</span>';
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

  function echo_dates($field, $meta){
    echo '<a class="repeatable-add button" href="#">+</a>
          <ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
    $i = 0;
    if ($meta) {
      foreach($meta as $row) {
        echo '<li><span class="sort hndle">|||</span>
        <input type="text" class="datepicker" name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" value="'.$row.'" size="30" />
        <a class="repeatable-remove button" href="#">-</a></li>';
        $i++;
      }
    } else {
      echo '<li><span class="sort hndle">|||</span>
      <input type="text" class="datepicker" name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" value="" size="30" />
      <a class="repeatable-remove button" href="#">-</a></li>';
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
