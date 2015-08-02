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

include 'lineup-custom-fields.php';  
include 'lineupentry-custom-fields.php';   
include 'lineupevent-custom-fields.php';   
include 'lineupvenue-custom-fields.php';  
include 'lineupensemble-custom-fields.php';  
include 'lineupfestival-custom-fields.php';  
include 'lineupperson-custom-fields.php';  


defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class Plugin{

  public function __construct() {

    new Lineupvenue();
    new Lineupentry();
    new Lineupensemble();
    // new Lineupfestival();
    new Lineupperson();

    add_action( 'init', array( $this, 'add_js_and_css_files' ) );

  }

  public function add_js_and_css_files(){

    if(is_admin()) {
      wp_enqueue_style('lineup-theme', plugin_dir_url( __FILE__ ).'css/lineup-theme.css');
      wp_enqueue_style('jquery-ui-theme', plugin_dir_url( __FILE__ ).'css/jquery-ui.theme.min.css');
      wp_enqueue_style('jquery-ui', plugin_dir_url( __FILE__ ).'css/jquery-ui.min.css');
      wp_enqueue_script('jquery-ui', plugin_dir_url( __FILE__ ).'js/jquery-ui.min.js');
      wp_enqueue_script('image-upload', plugin_dir_url( __FILE__ ).'js/image-upload.js');
      wp_enqueue_script('repeatable-fields', plugin_dir_url( __FILE__ ).'js/repeatable-fields.js');
    }
  }

}

/**
 * Save post metadata when a post is saved.
 *
 * @param int $post_id The post ID.
 * @param post $post The post object.
 * @param bool $update Whether this is an existing post being updated or not.
 */
function update_ticketeer( $post_id, $post, $update ) {

    /*
     * In production code, $slug should be set only once in the plugin,
     * preferably as a class property, rather than in each function that needs it.
     */
    $slug = 'book';

    // If this isn't a 'book' post, don't update it.
    if ( $slug != $post->post_type ) {
        return;
    }

    // - Update the post's metadata.

    // if ( isset( $_REQUEST['book_author'] ) ) {
    //     update_post_meta( $post_id, 'book_author', sanitize_text_field( $_REQUEST['book_author'] ) );
    // }

    // if ( isset( $_REQUEST['publisher'] ) ) {
    //     update_post_meta( $post_id, 'publisher', sanitize_text_field( $_REQUEST['publisher'] ) );
    // }

    // // Checkboxes are present if checked, absent if not.
    // if ( isset( $_REQUEST['inprint'] ) ) {
    //     update_post_meta( $post_id, 'inprint', TRUE );
    // } else {
    //     update_post_meta( $post_id, 'inprint', FALSE );
    // }
}
// add_action( 'save_post', 'update_ticketeer', 10, 3 );

$lineup_plugin = new Plugin();

?>
