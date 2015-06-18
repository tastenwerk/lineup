<?php 

  namespace Lineup;
    
  class Lineupfestival extends Lineupfields {
    public $title = 'lineupfestival';

    public function create_post_type(){
      register_post_type($this->title, // Register Custom Post Type
        array(
          'labels' => array(
          'name' => __('Lineup Festivals', $this->title), // Rename these to suit
          'singular_name' => __('HTML5 Blank Custom Post', $this->title),
          'add_new' => __('Add New', $this->title),
          'add_new_item' => __('Add New HTML5 Blank Custom Post', $this->title),
          'edit' => __('Edit', $this->title),
          'edit_item' => __('Edit HTML5 Blank Custom Post', $this->title),
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
          'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
          'post_tag'
        ) // Add Category and Post Tags support
        ));

    }
    
    public function init_array(){
      $this->fields_array = array(
        array(
              'label'=> 'Titel',
              'desc'  => 'Titel der Veranstaltung',
              'id'    => $this->title.'text',
              'type'  => 'text'
            ),
        array(
            'label'=> 'Untertitel',
            'desc'  => '',
            'id'    => $this->title.'text',
            'type'  => 'text'
            )
      );
    }
  }

?>