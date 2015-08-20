<?php 
  
  class EntrySide extends CustomMetaBox {

    public $title = 'lineupentry';
    public $post_type = 'lineupentry';
    public $boxname = 'Termine';
    public $context = 'side';

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
