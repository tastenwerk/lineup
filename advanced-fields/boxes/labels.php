<?php 
  
  class Labels extends CustomMetaBox {

    public $title = 'labels';
    public $post_type = 'lineupentry';
    public $boxname = 'Labels';
    public $context = 'side';
    public $priority = 'low';
    
    public function init_array(){
      $this->working_dir = preg_replace( '/\/boxes$/', '', dirname( __FILE__));
      $this->fields_array = array(
         array(
          'type'  => 'labels'
        )
      );
    }
  }
  
?>
