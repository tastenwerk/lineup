<?php 
  
  class EntrySide extends CustomMetaBox {

    public $title = 'lineupentry';
    public $post_type = 'lineupentry';
    public $boxname = 'Zusätzliche Informationen';
    public $context = 'side';

    public function init_array(){
      $this->working_dir = preg_replace( '/\/boxes$/', '', dirname( __FILE__));
      $this->fields_array = array(
         array(
          'label' => '',
          'desc'  => ' ',
          'id'    => $this->title.'_dates',
          'type'  => 'appointments'
        ),
        array(
          'label' => 'Mitwirkende',
          'type'  => 'sub'
        ),
        array(
          'label' => '',
          'id'    => $this->title.'_members',
          'type'  => 'members'
        ),
        array(
          'label' => 'Marketing',
          'type'  => 'sub'
        ),
        array(
          'label' => 'Videolink',
          'desc'  => '',
          'size'  => '20',
          'id'    => $this->title.'_video-link',
          'type'  => 'text'
        ),
        array(
          'label' => 'Youtubelink ',
          'desc'  => '',
          'id'    => $this->title.'_youtube',
          'type'  => 'checkbox'
        )
      );
    }
  }
  
?>
