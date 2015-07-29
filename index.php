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

$lineup_plugin = new Plugin();

?>
