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
include 'ess-feed.php';

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class Plugin{

  public function __construct() {

    $files = scandir ( dirname( __FILE__)."/custom-post-types" );
    foreach ( $files as $file ) {
      if( preg_match( "/.php$/", $file) ){
        include( dirname( __FILE__)."/custom-post-types/".$file);
        // Make filename to classname with namespace and creates class
        $classname = "Lineup\\".ucfirst ( str_replace( '.php', '', $file ) );
        new $classname();
      }
    }

    add_action( 'init', array( $this, 'add_js_and_css_files' ) );
    
  }

  public function add_js_and_css_files(){

    // add js and css files for custom fields
    if(is_admin()) {
      wp_enqueue_style('lineup-theme', plugin_dir_url( __FILE__ ).'css/lineup-theme.css');
      wp_enqueue_style('jquery-ui-theme', plugin_dir_url( __FILE__ ).'css/jquery-ui.theme.min.css');
      wp_enqueue_style('jquery-ui', plugin_dir_url( __FILE__ ).'css/jquery-ui.min.css');
      wp_enqueue_script('jquery-ui', plugin_dir_url( __FILE__ ).'js/jquery-ui.min.js');
      wp_enqueue_script('image-upload', plugin_dir_url( __FILE__ ).'js/image-upload.js');
      wp_enqueue_script('repeatable-fields', plugin_dir_url( __FILE__ ).'js/repeatable  -fields.js');
    }

    // add ess feed
    add_feed('ess', 'add_ess_feed' );
    global $wp_rewrite;
    $wp_rewrite->flush_rules( TRUE );

  }

}



$lineup_plugin = new Plugin();

?>
