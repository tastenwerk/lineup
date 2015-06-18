<?php 

  namespace Lineup;
    
  class Lineupperson extends Lineupfields {
    public $title = 'lineupperson';

    public function create_post_type(){
      register_post_type($this->title, // Register Custom Post Type
        array(
          'labels' => array(
          'name' => __('Lineup Persons', $this->title), // Rename these to suit
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
            ),
        array(
            'label'=> 'Bechreibung',
            'desc'  => '',
            'id'    => $this->title.'textarea',
            'type'  => 'textarea'
            ),
        array(
            'label'=> 'Pressestimmen',
            'desc'  => '',
            'id'    => $this->title.'textarea',
            'type'  => 'textarea'
            ),
        array(
            'label'=> 'Ankünder',
            'desc'  => '',
            'id'    => $this->title.'textarea',
            'type'  => 'textarea'
            ),
        array(
            'label'=> 'Veranstalter Infos',
            'desc'  => 'Für den Veranstalter relevante Informationen',
            'id'    => $this->title.'textarea',
            'type'  => 'textarea'
            ),
        array(
            'label'=> 'Checkbox Input',
            'desc'  => 'A description for the field.',
            'id'    => $this->title.'checkbox',
            'type'  => 'checkbox'
            ),
        array (
          'label' => 'Radio Group',
          'desc'  => 'A description for the field.',
          'id'    => $this->title.'radio',
          'type'  => 'radio',
          'options' => array (
            'one' => array (
              'label' => 'Option One',
              'value' => 'one'
            ),
            'two' => array (
              'label' => 'Option Two',
              'value' => 'two'
            ),
            'three' => array (
              'label' => 'Option Three',
              'value' => 'three'
            )
          )
        ),
        array(
          'label'=> 'Select Box',
          'desc'  => 'A description for the field.',
          'id'    => $this->title.'select',
          'type'  => 'select',
          'options' => array (
            'one' => array (
              'label' => 'Option One',
              'value' => 'one'
              ),
            'two' => array (
              'label' => 'Option Two',
              'value' => 'two'
              ),
            'three' => array (
              'label' => 'Option Three',
              'value' => 'three'
            )
          )
        ),
        array (
          'label' => 'Checkbox Group',
          'desc'  => 'A description for the field.',
          'id'    => $this->title.'checkbox_group',
          'type'  => 'checkbox_group',
          'options' => array (
            'one' => array (
              'label' => 'Option One',
              'value' => 'one'
              ),
            'two' => array (
              'label' => 'Option Two',
              'value' => 'two'
              ),
            'three' => array (
              'label' => 'Option Three',
              'value' => 'three'
              )
            )
        ),
        array(
          'label' => 'Lineup Person',
          'id'    => 'category',
          'type'  => 'tax_select'
        ),
        array(
          'label' => 'Date',
          'desc'  => 'A description for the field.',
          'id'    => $this->title.'date',
          'type'  => 'date'
        ),
        array(
          'label' => 'Slider',
          'desc'  => 'A description for the field.',
          'id'    => $this->title.'slider',
          'type'  => 'slider',
          'min'   => '0',
          'max'   => '100',
          'step'  => '5'
        ),
        array(
          'label'  => 'Image',
          'desc'  => 'A description for the field.',
          'id'    => $this->title.'image',
          'type'  => 'image'
        ),
        array(
          'label' => 'Termin(e)',
          'desc'  => 'Termin(e) der geplanten Veranstaltung',
          'id'    => $this->title.'repeatable',
          'type'  => 'dates-repeater'
        )
      );
    }
  }

?>