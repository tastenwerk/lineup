<?php

namespace Lineup;

class Label{

  public function __construct() {
    add_action( 'init', array( $this, 'register_label_taxonomy' ) );
    add_action( 'wp_ajax_post_label', array( $this,'create_or_update_label') );
    add_action( 'wp_ajax_delete_label', array( $this,'delete_label') );
    // add_action( 'init' , array( $this, 'remove_label_meta' ) );
  }

  public function create_or_update_label() {  
    echo $_POST['title'];
    $meta = array();
    $meta['test'] = sanitize_text_field( "hello world");
    $termId = wp_insert_term( $_POST['title'], 'label' )['term_id'];
    update_option( 'custom_taxonomy_meta_'.$termId, $meta );
    print_r( get_option( 'custom_taxonomy_meta_'.$termId ) );
  }

  public function delete_label() {  

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
