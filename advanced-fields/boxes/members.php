<?php 
  
  class Members extends CustomMetaBox {

    public $title = 'members';
    public $post_type = 'lineupentry';
    public $boxname = 'Mitwirkende';
    public $context = 'side';
    public $priority = 'low';

    public function init_array(){
      $this->working_dir = preg_replace( '/\/boxes$/', '', dirname( __FILE__));
      $this->fields_array = array(
         array(
          'id'    => 'lineupentry_members',
          'type'  => 'members'
        )
      );
    }
  }
  
?>
