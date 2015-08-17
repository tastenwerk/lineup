<?php 

  namespace Lineup;
    
  class Venue extends Lineupfields {
    public $title = 'lineupvenue';
    public $side_box_title = 'Erreichbarkeit';

    public function create_post_type(){
      register_post_type($this->title, // Register Custom Post Type
        array(
          'labels' => array(
          'name' => __('Spielorte', $this->title), // Rename these to suit
          'singular_name' => __('Spielort', $this->title),
          'add_new' => __('Neuen Eintrag anlegen', $this->title),
          'add_new_item' => __('Neuer Spielort', $this->title),
          'edit' => __('Edit', $this->title),
          'edit_item' => __('Spielort bearbeiten', $this->title),
          'new_item' => __('New HTML5 Blank Custom Post', $this->title),
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
          'editor'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'menu_icon' => 'dashicons-admin-home',
        'taxonomies' => array(
          // 'post_tag'
        ) // Add Category and Post Tags support
        ));

    }
    
    public function init_array(){ 
      $this->side_array = array(
        array(
            'label' => 'Öffnungszeiten',
            'desc'  => '',
            'id'    => $this->title.'_opening_hours',
            'size'  => '27',
            'type'  => 'text'
            ),
        array(
            'label' => 'Öffentliche Verkehrsmittel',
            'desc'  => '',
            'first' => 'true',
            'type'  => 'sub'
            ),
        array(
            'label' => 'Bus',
            'desc'  => '',
            'id'    => $this->title.'_bus',
            'size'  => '27',
            'type'  => 'text'
            ),
        array(
            'label' => 'Straßenbahn',
            'desc'  => '',
            'id'    => $this->title.'_tram',
            'size'  => '27',
            'type'  => 'text'
            ),
        array(
            'label' => 'Zug',
            'desc'  => '',
            'id'    => $this->title.'_train',
            'size'  => '27',
            'type'  => 'text'
            )
      );
      $this->fields_array = array( 
        array(
            'label'=> 'Kontakt',
            'desc'  => '',
            'first' => 'true',
            'type'  => 'sub'
            ),
        array(
            'label'=> 'Email',
            'desc'  => '',
            'id'    => $this->title.'_email',
            'type'  => 'text'
            ),
        array(
            'label'=> 'Telefon',
            'desc'  => '',
            'id'    => $this->title.'_phone',
            'type'  => 'text'
            ),
        array(
            'label'=> 'Adresse',
            'desc'  => '',
            'type'  => 'sub'
            ),
        array(
            'label'=> 'Straße',
            'desc'  => '',
            'id'    => $this->title.'_street',
            'type'  => 'text'
            ),
        array(
            'label'=> 'Postleitzahl',
            'desc'  => '',
            'id'    => $this->title.'_zip',
            'type'  => 'text'
            ),
        array(
            'label'=> 'Stadt',
            'desc'  => '',
            'id'    => $this->title.'_city',
            'type'  => 'text'
            ),
        array(
            'label'=> 'Bundesland',
            'desc'  => '',
            'id'    => $this->title.'_state',
            'type'  => 'text'
            ),
        array(
            'label'=> 'Land',
            'desc'  => '',
            'id'    => $this->title.'_country',
            'type'  => 'text'
            )
      );
    }
  }

?>