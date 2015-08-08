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

    // add_action( 'wp_ajax_nopriv_post_event', array( $this,'create_or_update_event') );
    add_action( 'wp_ajax_post_event', array( $this,'create_or_update_event') );
    add_action( 'wp_ajax_delete_event', array( $this,'delete_event') );
  }

  public function create_or_update_event() {  
    $post = array(
      'post_name'      => $_POST['title'],
      'post_title'     => $_POST['title'],
      'post_type'      => "lineupevent",
      'post_status'    => 'publish' 
    );

    echo $_POST['date']."orig\n";
    $date = strtotime( $_POST['date']." ".$_POST['time'] );
    echo date( 'd.m.Y H:i', $date )."mv\n";
    // echo $date;
    
    if( $_POST['id'] && $_POST['id'] !='' ){
      $post['id'] = $_POST['id'];
      $post_id = $post['id'];
      wp_update_post( $post );

      update_post_meta( $post_id, 'lineupevent_date', $date ); 

      update_post_meta( $post_id, 'lineupevent_venue_id', $_POST['venue_id'] ); 

      update_post_meta( $post_id, 'lineupevent_premiere', $_POST['premiere'] ); 
      update_post_meta( $post_id, 'lineupevent_derniere', $_POST['derniere'] ); 
      update_post_meta( $post_id, 'lineupevent_cancelled', $_POST['cancelled'] ); 

      update_post_meta( $post_id, 'lineupevent_email', $_POST['email'] ); 
      update_post_meta( $post_id, 'lineupevent_phone', $_POST['phone'] ); 
      update_post_meta( $post_id, 'lineupevent_email-link', $_POST['email_link'] ); 

    } else{
      $post_id = wp_insert_post( $post );

      add_post_meta( $post_id, 'lineupevent_date', $date );

      add_post_meta( $post_id, 'lineupevent_venue_id', $_POST['venue_id'] ); 

      add_post_meta( $post_id, 'lineupevent_premiere', $_POST['premiere'] ); 
      add_post_meta( $post_id, 'lineupevent_derniere', $_POST['derniere'] ); 
      add_post_meta( $post_id, 'lineupevent_cancelled', $_POST['cancelled'] ); 

      add_post_meta( $post_id, 'lineupevent_email', $_POST['email'] ); 
      add_post_meta( $post_id, 'lineupevent_phone', $_POST['phone'] ); 
      add_post_meta( $post_id, 'lineupevent_email-link', $_POST['email_link'] ); 
    
    }

    print_r( get_post_meta( $post_id ) );

    die();
  }

  public function delete_event() { 
    echo  $_POST['id'];
    print_r( wp_delete_post( $_POST['id'] ) );
    die();
  }
    

  public function add_js_and_css_files(){

    // add js and css files for custom fields
    if(is_admin()) { 

      wp_enqueue_script( 'ajax-lineup-events', plugin_dir_url( __FILE__ ) . 'js/ajax-lineup-events.js', array( 'jquery' ), '1.0', true );
      wp_localize_script( 'ajax-lineup-events', 'ajaxpagination', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' )
      ));



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
