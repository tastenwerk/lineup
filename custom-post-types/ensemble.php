<?php 

  namespace Lineup;
  
  class Ensemble extends Lineupfields {

    public $title = 'lineupensemble';
    public $side_box_title = 'Mitglieder';

    public function create_post_type(){
      register_post_type($this->title, // Register Custom Post Type
        array(
          'labels' => array(
          'name' => __('Ensembles', $this->title), 
          'singular_name' => __('Ensemble', $this->title),
          'add_new' => __('Neuen Eintrag hinzufügen', $this->title),
          'add_new_item' => __('Neues Ensemble', $this->title),
          'edit' => __('Edit', $this->title),
          'edit_item' => __('Ensemble bearbeiten', $this->title),
          'new_item' => __('New HTML5 Blank Custom Post', $this->title),
          'view' => __('View HTML5 Blank Custom Post', 'mezz'),
          'view_item' => __('View HTML5 Blank Custom Post', $this->title),
          'search_items' => __('Search HTML5 Blank Custom Post', $this->title),
          'not_found' => __('No HTML5 Blank Custom Posts found', $this->title),
          'not_found_in_trash' => __('No HTML5 Blank Custom Posts found in Trash', $this->title)
          ),
          'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
          'title',
          'editor',
          // 'excerpt',
          'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
          // 'post_tag',
          'category'
        ), // Add Category and Post Tags support,
        'menu_icon' => 'dashicons-groups'    
        ));

    }

    public function init_array(){
      $this->side_array = array(
        array(
          'label' => '',
          'post_type' => 'lineupperson',
          'id'    => $this->title.'_show',
          'type'  => 'post_repeater'
        )
      );
      $this->fields_array = array(
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
            )     
      );
    }
  }

?>