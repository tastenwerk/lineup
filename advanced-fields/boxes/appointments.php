<?php 
  
  class Appointments extends CustomMetaBox {

    public $title = 'appointments';
    public $post_type = 'lineupentry';
    public $boxname = 'Termine';
    public $context = 'side';
    public $priority = 'high';

    public function init_array(){
      $this->working_dir = preg_replace( '/\/boxes$/', '', dirname( __FILE__));
      $this->fields_array = array(
         array(
          'label' => '',
          'desc'  => ' ',
          'id'    => $this->title.'_dates',
          'type'  => 'appointments'
        )
      );
    }
  }
  
?>
