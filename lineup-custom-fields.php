<?php

  namespace Lineup;

  class Lineupfields
  {
    public function __construct() {
      $this->init_array();
      add_action('add_meta_boxes', array( $this, 'add_custom_meta_box') );
      add_action('add_meta_boxes', array( $this, 'add_side_meta_box') );
      add_action('save_post', array( $this, 'save_custom_meta') );
      add_action('admin_head', array( $this, 'add_custom_scripts') );
      add_action('init', array( $this, 'create_post_type') );
    }

    public $fields_array = array();
    public $side_array = array();

    public $title = '';
    public function create_post_type(){}
    public function init_array(){}
    
    public function add_custom_scripts() {
      $this->add_scripts($this->fields_array);
      $this->add_scripts($this->side_array);
    }

    function add_scripts( $array ){
      global $post;
       
      $output = '<script type="text/javascript">
                  jQuery(function() {';
    
     foreach ( $array as $field) { // loop through the fields looking for certain types
        if($field['type'] == 'date')
          $output .= 'jQuery(".datepicker").datepicker();';
        if ($field['type'] == 'slider') {
          $value = get_post_meta($post->ID, $field['id'], true);
          if ($value == '') $value = $field['min'];
            $output .= '
              jQuery( "#'.$field['id'].'-slider" ).slider({
                  value: '.$value.',
                  min: '.$field['min'].',
                  max: '.$field['max'].',
                  step: '.$field['step'].',
                  slide: function( event, ui ) {
                      jQuery( "#'.$field['id'].'" ).val( ui.value );
                  }
              });';
        }
      }
       
      $output .= '});
        </script>';
           
      echo $output;
    }


    public function add_custom_meta_box() {
      add_meta_box(
        'custom_meta_box', // $id
        'Custom Meta Box', // $title 
        array( $this, 'show_normal' ), // $callback
        $this->title, // $page
        'normal', // $context
        'high'); // $priority
    }

    public function add_side_meta_box() {
      add_meta_box(
        'side_meta_box', // $id
        'Side Meta Box', // $title 
        array( $this, 'show_side' ), // $callback
        $this->title, // $page
        'side', // $context
        'high'); // $priority
    }

    public function show_normal(){
      $this->show_custom_meta_box( $this->fields_array );
    }

    public function show_side(){
      // $this->show_custom_meta_box( $this->side_array );
    }

    public function show_custom_meta_box($array) {
      global $post;

      include 'advanced-fields.php';

            // Use nonce for verification
      echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
            // Begin the field table and loop
      echo '<table class="form-table">';

      foreach ($array as $field) {
              // get value of this field if it exists for this post
        $meta = get_post_meta($post->ID, $field['id'], true);
              // begin a table row with
        echo '<tr><th><label for="'.$field['id'].'">'.$field['label'].'</label></th><td>';
        switch($field['type']) {
          case 'text':
          echo_text_field($field, $meta);
          break;
          case 'textarea':
          echo_text_area($field, $meta);
          break;
          case 'checkbox':
          echo_checkbox($field, $meta);
          break;    
          case 'select':
          echo_select($field, $meta);
          break;
          case 'radio':
          echo_radio($field, $meta);
          break;
          case 'checkbox_group':
          echo_checkbox_group($field, $meta);
          break;
          case 'date':
          echo_date($field, $meta);
          break;
          case 'tax_select':
          echo_tax_select($field, $meta, $post);
          break;
          case 'slider':
          echo_slider($field, $meta);
          break;
          case 'image':
          echo_image($field, $meta);
          break;
          case 'repeatable':
          echo_repeatable($field, $meta);
          break;
          case 'dates-repeater':
          echo_dates($field, $meta);
          break;
        }
        echo '</td></tr>';
            } // end foreach
            echo '</table>'; // end table
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
            foreach ($this->fields_array as $field) {
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
