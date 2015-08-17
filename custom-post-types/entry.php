<?php 

  namespace Lineup;
  
  class Entry extends Lineupfields {

    public $title = 'lineupentry';

    public function create_post_type(){
      register_post_type($this->title, 
        array(
          'labels' => array(
          'name' => __('Spielplaneinträge','lineup'), 
          'singular_name' => __('Spielplaneintrag','lineup'),
          'add_new' => __('Neuen Eintrag anlegen','lineup'),
          'add_new_item' => __('Neuer Spielplaneintrag','lineup'),
          'edit' => __('Bearbeiten','lineup'),
          'edit_item' => __('Spielplaneintrag bearbeiten','lineup'),
          'new_item' => __('New HTML5 Blank Custom Post','lineup'),
          'view' => __('View HTML5 Blank Custom Post', 'mezz' ),
          'view_item' => __('View HTML5 Blank Custom Post', 'lineup'),
          'search_items' => __('Search HTML5 Blank Custom Post','lineup'),
          'not_found' => __('No HTML5 Blank Custom Posts found','lineup'),
          'not_found_in_trash' => __('No HTML5 Blank Custom Posts found in Trash','lineup')
          ),
          'public' => true,
        'hierarchical' => true, 
        'has_archive' => true,
        'supports' => array(
          'title',
          'editor',
          // 'excerpt',
          // 'thumbnail'
        ), 
        'can_export' => true,
        'taxonomies' => array(
          // 'label',
          // 'person',
          // 'category'
        ),
        'menu_icon' => 'dashicons-media-document'     
        ));

    }
}

    
  
?>
