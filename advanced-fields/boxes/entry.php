<?php 
  
  class Entry extends CustomMetaBox {

    public $title = 'lineupentry';
    public $post_type = 'lineupentry';
    public $boxname = 'Zusätzliche Informationen';

    public function init_array(){
      $this->working_dir = preg_replace( '/\/boxes$/', '', dirname( __FILE__));
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
          'type'  => 'post-list'
        ),
        array(
          'label' => 'Autorenschaft',
          'id'    => $this->title.'_author',
          'post_type' => 'lineupperson',
          'type'  => 'post-list'
        ),
        array(
          'label' => 'Inszenierung',
          'id'    => $this->title.'_director',
          'post_type' => 'lineupperson',
          'type'  => 'post-list'
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
          'type'  => 'images'
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
