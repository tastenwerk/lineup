<?php 
  
  class Entry extends CustomMetaBox {

    public $title = 'lineupentry';
    public $post_type = 'lineupentry';
    public $boxname = 'Informationen zum Spielplaneintrag';

    public function init_array(){
      $this->working_dir = preg_replace( '/\/boxes$/', '', dirname( __FILE__));
      $this->fields_array = array(
        array(
            'label'=> 'Untertitel',
            'desc'  => '',
            'id'    => $this->title.'_subtitle',
            'type'  => 'text'
            ),
        array(
            'type' => 'sub'
          ),
        array(
          'label' => 'Ensemble',
          'id'    => $this->title.'_ensemble',
          'post_type' => 'lineupensemble',
          'type'  => 'post-list'
        ),
        array(
          'label' => 'Autorenschaft',
          'id'    => $this->title.'_author',
          'post_type' => 'lineupperson',
          'type'  => 'post-list'
        ),
        array(
          'label' => 'Inszenierung',
          'id'    => $this->title.'_director',
          'post_type' => 'lineupperson',
          'type'  => 'post-list'
        ),
        array(
            'type' => 'sub'
          ),
        array(
          'label'=> 'Dauer',
          'desc'  => '',
          'id'    => $this->title.'_duration',
          'type'  => 'text'
        ),
        array(
          'label'=> 'Anzahl Pausen',
          'desc'  => '',
          'id'    => $this->title.'_breaks',
          'type'  => 'text'
        ),
        array(
          'label'=> 'ab',
          'desc'  => '',
          'id'    => $this->title.'_age',
          'type'  => 'text'
        ),
        array(
          'label'=> 'Pressestimmen',
          'desc'  => '',
          'id'    => $this->title.'_press',
          'rows'  => 15,
          'type'  => 'editor'
        ), 
        array(
          'label'=> 'Ankünder',
          'desc'  => '',
          'id'    => $this->title.'_announcement',
          'rows'  => 7,
          'type'  => 'editor'
        ),
        array(
          'label'=> 'Bilder',
          'desc'  => '',
          'id'    => $this->title.'_images',
          'type'  => 'images'
        ),
        array(
          'label'=> 'Downloads',
          'desc'  => '',
          'id'    => $this->title.'_downloads',
          'type'  => 'uploads'
        )
      );
    }
  }  
?>
