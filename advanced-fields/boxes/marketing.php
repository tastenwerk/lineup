<?php 
  
  class Marketing extends CustomMetaBox {

    public $title = 'marketing';
    public $post_type = 'lineupentry';
    public $boxname = 'Marketing';
    public $context = 'side';

    public function init_array(){
      $this->working_dir = preg_replace( '/\/boxes$/', '', dirname( __FILE__));
      $this->fields_array = array(
        array(
          'label' => 'Videolink',
          'desc'  => 'Link zum Video einfügen',
          'size'  => '28',
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
