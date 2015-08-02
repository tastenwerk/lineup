<?php

  namespace Lineup;

  include 'echo-methods/main-methods.php';
  include 'echo-methods/repeater-methods.php';

  class CustomMetabox
  {
    public function __construct( $box_array, $context, $title, $box_title ) {
      
      $this->box_array = $box_array;
      $this->context = $context;
      $this->title = $title;
      $this->box_title = $box_title;
      add_action('add_meta_boxes', array( $this, 'add_custom_meta_box') );
      add_action('save_post', array( $this, 'save_custom_meta') );
      $this->main_methods = new MainMethods();
      $this->repeater_methods = new RepeaterMethods();
    }

    public $main_methods;
    public $repeater_methods;

    public $title;
    public $box_title;
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
        $meta = get_post_meta($post->ID, $field['id'], true);
        if (!$jump_table) echo '<tr><th>';
        else echo '<div>';
        echo '<label'; 
        if($field['id']) echo ' for="'.$field['id'];
        if($field['type']=='sub') echo ' class="mini-title"';
        echo '">'.$field['label'].'</label>';
        if (!$jump_table) echo '</th><td>';
        if( $field['type'] == 'sub' && !$field['first'] ) echo '<hr>';
        
        $this->switch_case( $field, $meta );
        
        if (!$jump_table) echo '</td></tr>';
        else echo '</div>';
      } 
      if (!$jump_table) echo '</table>'; 
    }

    public function save_custom_meta($post_id) {  
      if ( !isset( $_POST['custom_meta_box_nonce'] )  || !wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__))) 
        return $post_id;
   
      if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;
   
      if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
          return $post_id;
      } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
      }
      
      foreach ($this->box_array as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];
        if ($new && $new != $old) {
          update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
          delete_post_meta($post_id, $field['id'], $old);
        }
      } 
    }

    public function switch_case($field, $meta){
      switch($field['type']) {
        case 'text':
        if( $field['size'] )
          $this->main_methods->echo_text_field_size($field, $meta, $field['size'] );
        else
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
        $this->repeater_methods->echo_repeatable($field, $meta);
        break;
        case 'appointments':
        $this->repeater_methods->echo_appointments($field, $meta);
        break;
        case 'image-repeater':
        $this->repeater_methods->echo_repeatable_image($field, $meta);
        break;
        case 'post_list':
        $this->main_methods->echo_post_list($field, $meta);
        break;
        case 'post_repeater':
        $this->repeater_methods->echo_post_select_repeater($field, $meta);
        break;
        case 'member-repeater':
        $this->repeater_methods->echo_member_repeater($field, $meta);
        break;
        case 'upload':
        $this->main_methods->echo_upload($field, $meta);
        break;
      }
    }

  }
?>
