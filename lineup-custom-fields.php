<?php

  namespace Lineup;

  include 'custom-meta-box.php';  

  class Lineupfields
  {
    public function __construct() {
      $this->init_array();
      if( sizeof( $this->fields_array ) > 0 )
        new CustomMetabox( $this->fields_array, 'normal', $this->title, $this->main_box_title );
      if( sizeof( $this->side_array ) > 0 )
        new CustomMetabox( $this->side_array, 'side', $this->title, $this->side_box_title );
      add_action('admin_head', array( $this, 'add_custom_scripts') );
      add_action('init', array( $this, 'create_post_type') );
    }

    public $main_box_title = 'Erweiterte Informationen';
    public $side_box_title = 'Erweiterte Informationen';
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
    
  }
?>
