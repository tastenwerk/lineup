<?php
/**
 * @package Lineup
 * @version 1.0
 */
/*
Plugin Name: Lineup
Plugin URI: http://wordpress.org/plugins/lineup/
Description: Event Manager for theatres in Wordpress
Author: TZ, DR (TASTENWERK)
Version: 1.0
Author URI: http://tastenwerk.com
*/

namespace Lineup;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class Plugin{

  public function __construct() {

    include 'lineup-entry-custom-fields.php';

    // Field Array
    $this->prefix = 'custom_';
    $this->custom_meta_fields = $lineup_entry_array;

    add_action('init', array( $this, 'people_init' ) );
    add_action('init', array( $this, 'create_post_type') );
    add_action('add_meta_boxes', array( $this, 'add_custom_meta_box') );
    add_action('save_post', array( $this, 'save_custom_meta') );
    
    add_action( 'init', array( $this, 'add_datepicker_files' ) );
    add_action('admin_head', array( $this, 'add_custom_scripts') );

  }

  public function add_datepicker_files(){

    if(is_admin()) {
      wp_enqueue_style('jquery-ui-theme', plugin_dir_url( __FILE__ ).'css/jquery-ui.theme.min.css');
      wp_enqueue_style('jquery-ui', plugin_dir_url( __FILE__ ).'css/jquery-ui.min.css');
      wp_enqueue_script('jquery-ui', plugin_dir_url( __FILE__ ).'js/jquery-ui.min.js');
      wp_enqueue_script('image-upload', plugin_dir_url( __FILE__ ).'js/image-upload.js');
      wp_enqueue_script('repeatable-fields', plugin_dir_url( __FILE__ ).'js/repeatable-fields.js');
    }
  }

  public function add_custom_scripts() {
    global $post;
     
    $output = '<script type="text/javascript">
                jQuery(function() {';

    // error_log($post);
  
   foreach ( $this->custom_meta_fields as $field) { // loop through the fields looking for certain types
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

  public function people_init() {
    // create a new taxonomy
    register_taxonomy(
      'people',
      'post',
      array(
        'label' => __( 'Lineup Person' ),
        'rewrite' => array( 'slug' => 'person' ),
        'capabilities' => array(
          'assign_terms' => 'edit_guides',
          'edit_terms' => 'publish_guides'
        )
      )
    );
  }

  public function create_post_type(){

    register_taxonomy_for_object_type('category', 'html5-blank'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'html5-blank');
    register_post_type('html5-blank', // Register Custom Post Type
      array(
        'labels' => array(
        'name' => __('Lineup Events', 'html5blank'), // Rename these to suit
        'singular_name' => __('HTML5 Blank Custom Post', 'html5blank'),
        'add_new' => __('Add New', 'html5blank'),
        'add_new_item' => __('Add New HTML5 Blank Custom Post', 'html5blank'),
        'edit' => __('Edit', 'html5blank'),
        'edit_item' => __('Edit HTML5 Blank Custom Post', 'html5blank'),
        'new_item' => __('New HTML5 Blank Custom Post', 'html5blank'),
        'view' => __('View HTML5 Blank Custom Post', 'html5blank'),
        'view_item' => __('View HTML5 Blank Custom Post', 'html5blank'),
        'search_items' => __('Search HTML5 Blank Custom Post', 'html5blank'),
        'not_found' => __('No HTML5 Blank Custom Posts found', 'html5blank'),
        'not_found_in_trash' => __('No HTML5 Blank Custom Posts found in Trash', 'html5blank')
        ),
        'public' => true,
      'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
      'has_archive' => true,
      'supports' => array(
        'title',
        'editor',
        'excerpt',
        'thumbnail'
      ), // Go to Dashboard Custom HTML5 Blank post for supports
      'can_export' => true, // Allows export in Tools > Export
      'taxonomies' => array(
        'post_tag',
        'category'
      ) // Add Category and Post Tags support
      ));

  }

  public function add_custom_meta_box() {
    add_meta_box(
      'custom_meta_box', // $id
      'Custom Meta Box', // $title 
      array( $this, 'show_custom_meta_box' ), // $callback
      'post', // $page
      'normal', // $context
      'high'); // $priority
  }

  public function show_custom_meta_box() {
    global $post;

    include 'advanced-fields.php';
    
    // Use nonce for verification
    echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
    // Begin the field table and loop
    echo '<table class="form-table">';

    foreach ($this->custom_meta_fields as $field) {
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
    foreach ($this->custom_meta_fields as $field) {
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

$lineup_plugin = new Plugin();

?>
