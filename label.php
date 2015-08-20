<?php

namespace Lineup;

class Label{

  public function __construct() {
    add_action( 'init', array( $this, 'register_label_taxonomy' ) );
    add_action( 'wp_ajax_post_label', array( $this,'create_or_update_label') );
    add_action( 'wp_ajax_delete_label', array( $this,'delete_label') );
    add_action( 'wp_ajax_toggle_label', array( $this,'toggle_label') );
    // add_action( 'init' , array( $this, 'remove_label_meta' ) );
  }

  public function create_or_update_label() {  
    $meta = array();
    $meta['background-color'] = $_POST['background_color'];
    $meta['text-color'] = $_POST['text_color'];
    $meta['border-color'] = $_POST['border_color'];
    if( $_POST['term_id'] && $_POST['term_id'] != ""  ){
      $termId = wp_update_term( $_POST['term_id'], 'label', array(
        'name' => $_POST['title'],
        'slug' => $_POST['title']
      ))['term_id'];
    }
    else
      $termId = wp_insert_term( $_POST['title'], 'label', array(
        'name' => $_POST['title'],
        'slug' => $_POST['title']
      ))['term_id'];
    update_option( 'custom_taxonomy_meta_'.$termId, $meta );
  }

  public function delete_label() {  
    wp_delete_term( $_POST['term_id'], 'label' );
  }

  public function toggle_label() {  
    $selected = wp_get_object_terms( $_POST['post_id'], 'label');
    $add = true;
    foreach ( $selected as $label ) {
      if( $label->term_id == $_POST['term_id'] )
        $add = false;
    }
    if( $add )
      wp_add_object_terms( $_POST['post_id'], $_POST['term_name'], 'label' );
    else
      wp_remove_object_terms( $_POST['post_id'], $_POST['term_name'], 'label' );
  }

  public function localize_script(){
    wp_localize_script( 'ajax-labels', 'ajaxpagination', array(
      'ajaxurl' => admin_url( 'admin-ajax.php' )
    ));
  }

  public function remove_label_meta() {
    // if ( is_admin() )
      \remove_meta_box( 'tagsdiv-label', 'lineupentry', 'side' );
  } 

  public function register_label_taxonomy(){

    $labels = array(
      'name'                       => _x( 'Labels', 'taxonomy general name' ),
      'singular_name'              => _x( 'Label', 'taxonomy singular name' ),
      'search_items'               => __( 'Labels suchen' ),
      'popular_items'              => __( 'Meistverwendete Lables' ),
      'all_items'                  => __( 'Alle Labes' ),
      'parent_item'                => null,
      'parent_item_colon'          => null,
      'edit_item'                  => __( 'Label bearbeiten' ),
      'update_item'                => __( 'Label updaten' ),
      'add_new_item'               => __( 'Add New Label' ),
      'new_item_name'              => __( 'New Label Name' ),
      'separate_items_with_commas' => __( '' ),
      'add_or_remove_items'        => __( 'Add or remove Labels' ),
      'choose_from_most_used'      => __( '' ),
      'not_found'                  => __( 'No Labels found.' ),
      'menu_name'                  => __( 'Labels' ),
    );

    $args = array(
      'hierarchical'          => false,
      'labels'                => $labels,
      'show_ui'               => true,
      'show_admin_column'     => true,
      'update_count_callback' => '_update_post_term_count',
      'query_var'             => true,
      'rewrite'               => array( 'slug' => 'label' ),
      // 'show_ui'                 => false,
    );

    register_taxonomy( 'label', 'lineupentry', $args );

  }

}

?>
