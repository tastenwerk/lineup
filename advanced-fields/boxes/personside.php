<?php 
  
  class Personside extends CustomMetaBox {

    public $title = 'lineupperson';
    public $post_type = 'lineupperson';
    public $boxname = 'Team Seite';
    public $context = 'side';
    public $priority = 'high';

    public function init_array(){
      $this->working_dir = preg_replace( '/\/boxes$/', '', dirname( __FILE__));
      $this->fields_array = array(
        array(
            'label' => 'In Team Seite anzeigen',
            'desc'  => '',
            'id'    => $this->title.'_show',
            'type'  => 'checkbox'
            ),
        array(
            'label' => 'Position in Team Seite',
            'desc'  => '',
            'id'    => $this->title.'_show_position',
            'size'  => '5',
            'type'  => 'text'
            )
      );
    }
  }
  
?>
