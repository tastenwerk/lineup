<?php 

  namespace Lineup;
  
  class Lineupentry extends Lineupfields {

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
          // 'people',
          // 'person',
          'category'
        ) // Add Category and Post Tags support
        ));

    }

    public function init_array(){
      $this->side_array = array(
         array(
          'label' => '',
          'desc'  => ' ',
          'id'    => $this->title.'_dates',
          'type'  => 'appointments'
        ),
        array(
          'label' => 'Mitwirkende',
          'type'  => 'sub'
        ),
        array(
          'label' => '',
          'id'    => $this->title.'_members',
          'type'  => 'member-repeater'
        ),
        array(
          'label' => 'Marketing',
          'type'  => 'sub'
        ),
        array(
          'label' => 'Videolink',
          'desc'  => '',
          'size'  => '20',
          'id'    => $this->title.'_video-link',
          'type'  => 'text'
        ),
        array(
          'label' => 'Youtubelink ',
          'desc'  => '',
          'id'    => $this->title.'_youtube',
          'type'  => 'checkbox'
        )
      );
      $this->fields_array = array(
        //  array(
        //   'label' => 'Termin(e)',
        //   'desc'  => 'Termin(e) der geplanten Veranstaltung',
        //   'id'    => $this->title.'_dates',
        //   'type'  => 'appointments'
        // ),
        array(
            'label'=> 'Untertitel',
            'desc'  => '',
            'id'    => $this->title.'_subtitle',
            'type'  => 'text'
            ),
        array(
          'label' => 'Ensembles',
          'id'    => $this->title.'_ensemble',
          'post_type' => 'lineupensemble',
          'type'  => 'post_list'
        ),
        array(
          'label' => 'Autorenschaft',
          'id'    => $this->title.'_author',
          'post_type' => 'lineupperson',
          'type'  => 'post_list'
        ),
        array(
          'label' => 'Inszenierung',
          'id'    => $this->title.'_director',
          'post_type' => 'lineupperson',
          'type'  => 'post_list'
        ),
        array(
          'label'=> 'Dauer',
          'desc'  => '',
          'id'    => $this->title.'_duration',
          'type'  => 'text'
        ),
        array(
          'label'=> 'Anzahl Pausen',
          'desc'  => '',
          'id'    => $this->title.'_breaks',
          'type'  => 'text'
        ),
        array(
          'label'=> 'ab',
          'desc'  => '',
          'id'    => $this->title.'_age',
          'type'  => 'text'
        ),
        array(
          'label'=> 'Pressestimmen',
          'desc'  => '',
          'id'    => $this->title.'_press',
          'type'  => 'textarea'
        ),
        array(
          'label'=> 'Ankünder',
          'desc'  => '',
          'id'    => $this->title.'_announcement',
          'type'  => 'textarea'
        ),
        array(
          'label'=> 'Infos Veranstalter',
          'desc'  => '',
          'id'    => $this->title.'_info-host',
          'type'  => 'textarea'
        ),
        array(
          'label'=> 'Bilder',
          'desc'  => '',
          'id'    => $this->title.'_images',
          'type'  => 'image-repeater'
        ),
        array(
          'label'=> 'Downloads',
          'desc'  => '',
          'id'    => $this->title.'_downloads',
          'type'  => 'upload'
        )
      );
    }
  }

        // array(
        //     'label'=> 'Pressestimmen',
        //     'desc'  => '',
        //     'id'    => $this->title.'textarea',
        //     'type'  => 'textarea'
        //     ),
        // array(
        //     'label'=> 'Ankünder',
        //     'desc'  => '',
        //     'id'    => $this->title.'textarea',
        //     'type'  => 'textarea'
        //     ),
        // array(
        //     'label'=> 'Veranstalter Infos',
        //     'desc'  => 'Für den Veranstalter relevante Informationen',
        //     'id'    => $this->title.'textarea',
        //     'type'  => 'textarea'
        //     ),
        // array(
        //     'label'=> 'Checkbox Input',
        //     'desc'  => 'A description for the field.',
        //     'id'    => $this->title.'checkbox',
        //     'type'  => 'checkbox'
        //     ),
        // array (
        //   'label' => 'Radio Group',
        //   'desc'  => 'A description for the field.',
        //   'id'    => $this->title.'radio',
        //   'type'  => 'radio',
        //   'options' => array (
        //     'one' => array (
        //       'label' => 'Option One',
        //       'value' => 'one'
        //     ),
        //     'two' => array (
        //       'label' => 'Option Two',
        //       'value' => 'two'
        //     ),
        //     'three' => array (
        //       'label' => 'Option Three',
        //       'value' => 'three'
        //     )
        //   )
        // ),
        // array(
        //   'label'=> 'Select Box',
        //   'desc'  => 'A description for the field.',
        //   'id'    => $this->title.'select',
        //   'type'  => 'select',
        //   'options' => array (
        //     'one' => array (
        //       'label' => 'Option One',
        //       'value' => 'one'
        //       ),
        //     'two' => array (
        //       'label' => 'Option Two',
        //       'value' => 'two'
        //       ),
        //     'three' => array (
        //       'label' => 'Option Three',
        //       'value' => 'three'
        //     )
        //   )
        // ),
        // array (
        //   'label' => 'Checkbox Group',
        //   'desc'  => 'A description for the field.',
        //   'id'    => $this->title.'checkbox_group',
        //   'type'  => 'checkbox_group',
        //   'options' => array (
        //     'one' => array (
        //       'label' => 'Option One',
        //       'value' => 'one'
        //       ),
        //     'two' => array (
        //       'label' => 'Option Two',
        //       'value' => 'two'
        //       ),
        //     'three' => array (
        //       'label' => 'Option Three',
        //       'value' => 'three'
        //       )
        //     )
        // ),
        // array(
        //   'label' => 'Lineup Person',
        //   'id'    => 'category',
        //   'type'  => 'tax_select'
        // ),
        // array(
        //   'label' => 'Date',
        //   'desc'  => 'A description for the field.',
        //   'id'    => $this->title.'date',
        //   'type'  => 'date'
        // ),
        // array(
        //   'label' => 'Slider',
        //   'desc'  => 'A description for the field.',
        //   'id'    => $this->title.'slider',
        //   'type'  => 'slider',
        //   'min'   => '0',
        //   'max'   => '100',
        //   'step'  => '5'
        // ),
        // array(
        //   'label'  => 'Image',
        //   'desc'  => 'A description for the field.',
        //   'id'    => $this->title.'image',
        //   'type'  => 'image'
        // ),
        // array(
        //   'label' => 'Termin(e)',
        //   'desc'  => 'Termin(e) der geplanten Veranstaltung',
        //   'id'    => $this->title.'repeatable',
        //   'type'  => 'dates-repeater'
        // )
  
?>
