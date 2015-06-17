<?php // some-functions.php

  namespace Lineup;

  $this->prefix = 'custom_';


  $titel = array(
    'label'=> 'Titel',
    'desc'  => 'Titel der Veranstaltung',
    'id'    => $this->prefix.'text',
    'type'  => 'text'
  );

  $date_repeater = array(
    'label' => 'Termin(e)',
    'desc'  => 'Termin(e) der geplanten Veranstaltung',
    'id'    => $this->prefix.'repeatable',
    'type'  => 'dates-repeater'
  ); 

  $lineup_entry_array = array(
      $titel,
      array(
          'label'=> 'Untertitel',
          'desc'  => '',
          'id'    => $this->prefix.'text',
          'type'  => 'text'
          ),
      array(
          'label'=> 'Bechreibung',
          'desc'  => '',
          'id'    => $this->prefix.'textarea',
          'type'  => 'textarea'
          ),
      array(
          'label'=> 'Pressestimmen',
          'desc'  => '',
          'id'    => $this->prefix.'textarea',
          'type'  => 'textarea'
          ),
      array(
          'label'=> 'Ankünder',
          'desc'  => '',
          'id'    => $this->prefix.'textarea',
          'type'  => 'textarea'
          ),
      array(
          'label'=> 'Veranstalter Infos',
          'desc'  => 'Für den Veranstalter relevante Informationen',
          'id'    => $this->prefix.'textarea',
          'type'  => 'textarea'
          ),
      array(
          'label'=> 'Checkbox Input',
          'desc'  => 'A description for the field.',
          'id'    => $this->prefix.'checkbox',
          'type'  => 'checkbox'
          ),
      array (
        'label' => 'Radio Group',
        'desc'  => 'A description for the field.',
        'id'    => $this->prefix.'radio',
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
        'id'    => $this->prefix.'select',
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
        'id'    => $this->prefix.'checkbox_group',
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
        'id'    => $this->prefix.'date',
        'type'  => 'date'
      ),
      array(
        'label' => 'Slider',
        'desc'  => 'A description for the field.',
        'id'    => $this->prefix.'slider',
        'type'  => 'slider',
        'min'   => '0',
        'max'   => '100',
        'step'  => '5'
      ),
      array(
        'label'  => 'Image',
        'desc'  => 'A description for the field.',
        'id'    => $this->prefix.'image',
        'type'  => 'image'
      ),
      $date_repeater
    );

?>