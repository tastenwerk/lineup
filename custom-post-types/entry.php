<?php 

  namespace Lineup;
  
  class Entry extends Lineupfields {

    public $title = 'lineupentry';

    public function create_post_type(){
      register_post_type($this->title, // Register Custom Post Type
        array(
          'labels' => array(
          'name' => __('Spielplaneinträge', $this->title), 
          'singular_name' => __('Spielplaneintrag', $this->title),
          'add_new' => __('Neuen Eintrag anlegen', $this->title),
          'add_new_item' => __('Neuer Spielplaneintrag', $this->title),
          'edit' => __('Bearbeiten', $this->title),
          'edit_item' => __('Spielplaneintrag bearbeiten', $this->title),
          'new_item' => __('New HTML5 Blank Custom Post', $this->title),
          'view' => __('View HTML5 Blank Custom Post', $this->title),
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
          // 'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
          // 'label',
          // 'person',
          // 'category'
        ) // Add Category and Post Tags support
        ));

    }
}

    
  
?>
