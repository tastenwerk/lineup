<?php 

  namespace Lineup;
    
  class Event extends Lineupfields {
    public $title = 'lineupevent';
    public $main_box_title = 'Eigenschaften';

    public function create_post_type(){
      register_post_type($this->title, // Register Custom Post Type
        array(
          'labels' => array(
          'name' => __('Events', $this->title), // Rename these to suit
          'singular_name' => __('Event', $this->title),
          'add_new' => __('Neues Event anlegen', $this->title),
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
          // 'editor'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
          // 'post_tag'
        ) // Add Category and Post Tags support
        ));

    }
    
    public function init_array(){ 
      $this->fields_array = array( 
        array(
            'label'=> 'Emaillink',
            'desc'  => '',
            'id'    => $this->title.'_email-link',
            'type'  => 'text'
            )
      );
    }
  }

?>