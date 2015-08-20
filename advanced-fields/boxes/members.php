<?php 
  
  class Members extends CustomMetaBox {

    public $title = 'members';
    public $post_type = 'lineupentry';
    public $boxname = 'Mitwirkende';
    public $context = 'side';

    public function init_array(){
      $this->working_dir = preg_replace( '/\/boxes$/', '', dirname( __FILE__));
      $this->fields_array = array(
         array(
          'id'    => $this->title.'_members',
          'type'  => 'members'
        )
      );
    }
  }
  
?>
