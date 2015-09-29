<?php 

  namespace Lineup;
    
  class Person extends Lineupfields {

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
        ),
        'menu_icon' => 'dashicons-groups'        
      ));
    
    }
  }

?>