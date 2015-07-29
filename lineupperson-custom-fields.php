<?php 

  namespace Lineup;
    
  class Lineupperson extends Lineupfields {

    public $title = 'lineupperson';
    public $main_box_title = 'Persönliche Informationen';
    

    public function create_post_type(){
      register_post_type($this->title, // Register Custom Post Type
        array(
          'labels' => array(
          'name' => __('Personen', $this->title), // Rename these to suit
          'singular_name' => __('HTML5 Blank Custom Post', $this->title),
          'add_new' => __('Neue Person erstellen', $this->title),
          'add_new_item' => __('Neue Person', $this->title),
          'edit' => __('Edit', $this->title),
          'edit_item' => __('Person bearbeiten', $this->title),
          'new_item' => __('Neue Person', $this->title),
          'view' => __('View HTML5 Blank Custom Post', $this->title),
          'view_item' => __('View HTML5 Blank Custom Post', $this->title),
          'search_items' => __('Search HTML5 Blank Custom Post', $this->title),
          'not_found' => __('No HTML5 Blank Custom Posts found', $this->title),
          'not_found_in_trash' => __('No HTML5 Blank Custom Posts found in Trash', $this->title)
          ),
        'public' => true,
        'hierarchical' => false, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
          'title',
          'editor',
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
          // 'post_tag',
          'category'
        ) // Add Category and Post Tags support
        ));
    }
    
    public function init_array(){
      $this->side_array = array(
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
            ),
      );
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
        )    
        // array(
        //   'label'  => 'Hintergrundbild',
        //   'desc'  => 'Hintergrundbild der Person für die Homepage',
        //   'id'    => $this->title.'_background_pic',
        //   'type'  => 'image'
        // )
      );
    }
  }

?>