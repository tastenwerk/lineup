<?php

namespace Lineup;

class EventAjax{

  function localize( $string ){
    //  TODO!
    // echo qtrans_use( qtrans_getLanguage(), $string, false );
    // echo split('[:]', $string);
    // echo "HERE";
    
    if( preg_match( '/^\[:/', $string) )
      return substr( split('\[:', $string)[1], 3);
    else 
      return $string;
  }

  public function __construct() {
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

    $date = strtotime( $_POST['date']." ".$_POST['time'] );

    
    if( $_POST['id'] && $_POST['id'] !='' ){
      $post['id'] = $_POST['id'];
      $post_id = $post['id'];
      wp_update_post( $post );

      update_post_meta( $post_id, 'lineupevent_date', $date ); 

      update_post_meta( $post_id, 'lineupevent_entry_id', split( '=', $_POST['title'])[1] ); 
      update_post_meta( $post_id, 'lineupevent_venue_id', $_POST['venue_id'] ); 

      update_post_meta( $post_id, 'lineupevent_premiere', $_POST['premiere'] ); 
      update_post_meta( $post_id, 'lineupevent_derniere', $_POST['derniere'] ); 
      update_post_meta( $post_id, 'lineupevent_cancelled', $_POST['cancelled'] ); 

      update_post_meta( $post_id, 'lineupevent_email', $_POST['email'] ); 
      update_post_meta( $post_id, 'lineupevent_phone', $_POST['phone'] ); 
      update_post_meta( $post_id, 'lineupevent_email-link', $_POST['email_link'] ); 
      update_post_meta( $post_id, 'lineupevent_note', $_POST['note'] ); 

    } else{
      $post_id = wp_insert_post( $post );

      add_post_meta( $post_id, 'lineupevent_date', $date );

      add_post_meta( $post_id, 'lineupevent_entry_id', split( '=', $_POST['title'])[1] ); 
      add_post_meta( $post_id, 'lineupevent_venue_id', $_POST['venue_id'] ); 

      add_post_meta( $post_id, 'lineupevent_premiere', $_POST['premiere'] ); 
      add_post_meta( $post_id, 'lineupevent_derniere', $_POST['derniere'] ); 
      add_post_meta( $post_id, 'lineupevent_cancelled', $_POST['cancelled'] ); 

      add_post_meta( $post_id, 'lineupevent_email', $_POST['email'] ); 
      add_post_meta( $post_id, 'lineupevent_phone', $_POST['phone'] ); 
      add_post_meta( $post_id, 'lineupevent_email-link', $_POST['email_link'] ); 
      add_post_meta( $post_id, 'lineupevent_note', $_POST['note'] ); 
    
    }

    if( $_POST['label'] != 'false' )
      wp_set_post_terms( $post_id, $_POST['label'], 'label' );
    else{
      $term = wp_get_object_terms( $post_id, 'label')[0]->name;
      wp_remove_object_terms( $post_id, $term, 'label' );
    }

    $venue = get_post( $_POST['venue_id'] );

    $result = array();
    $result['id'] = $post_id;
    $result['venue_title'] = localize( $venue->post_title );
    $result['date'] = date_i18n("d.m", $date);
    $result['dayname'] = date_i18n("D", $date);
    $result['year'] = date_i18n("Y", $date);
    $result['time'] = date_i18n("H:i", $date);
    $result['other'] = $_POST['date']." ".$_POST['time'];
    $result['entry_id'] = get_post_meta( $post_id, 'lineupevent_entry_id', TRUE );

    echo json_encode( $result );

    die();
  }

  public function delete_event() { 
    wp_delete_post( $_POST['id'] );
    die();
  }
}


?>
