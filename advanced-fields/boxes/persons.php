<?php 
  
  class Persons extends CustomMetaBox {

    public $title = 'lineupperson';
    public $post_type = 'lineupperson';
    public $boxname = 'Persönliche Informationen';

    public function init_array(){
      $this->working_dir = preg_replace( '/\/boxes$/', '', dirname( __FILE__));
      $this->fields_array = array(
        array(
            'label' => 'Funktion',
            'desc'  => '',
            'id'    => $this->title.'_position',
            'type'  => 'text'
            ),
        array(
            'label' => 'Kontakt',
            'type'  => 'sub'
            ),
        array(
            'label' => 'Email',
            'desc'  => '',
            'id'    => $this->title.'_email',
            'type'  => 'text'
            ),
        array(
            'label' => 'Telefon',
            'desc'  => '',
            'id'    => $this->title.'_phone',
            'type'  => 'text'
            ),
        array(
            'label' => 'Adresse',
            'type'  => 'sub'
            ),
        array(
            'label' => 'Straße',
            'desc'  => '',
            'id'    => $this->title.'textarea',
            'type'  => 'text'
            ),
        array(
            'label' => 'Stadt',
            'desc'  => '',
            'id'    => $this->title.'textarea',
            'type'  => 'text'
            ),
        array(
            'label' => 'Bundesland',
            'desc'  => '',
            'id'    => $this->title.'textarea',
            'type'  => 'text'
            ),
        array(
            'label' => 'Land',
            'desc'  => '',
            'id'    => $this->title.'textarea',
            'type'  => 'text'
            ),     
        array(
            'label' => 'Medien',
            'type'  => 'sub'
            ),   
        array(
          'label'  => 'Profilbild',
          'desc'  => 'Profilbild der Person für die Homepage',
          'id'    => $this->title.'_profile_pic',
          'type'  => 'image'
        ),    
        array(
          'label'  => 'Bildergallerie',
          'id'    => $this->title.'_images',
          'type'  => 'images'
        )
      );
    }
  }  
?>
