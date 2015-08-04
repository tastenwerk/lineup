<?php

namespace Lineup;

class MainMethods {

  public function echo_upload($field, $meta){
    // wp_nonce_field(plugin_basename(__FILE__), 'wp_custom_attachment_nonce');

    // echo '<li class="image-repeatable">';
    // // echo '<span class="sort hndle">|||</span>';
    // echo '<div class="pic-wrapper"><span class="pic-background dashicons dashicons-format-image"></span>';
    // echo '<div class="pic-tools repeatable-remove"><span class="dashicons dashicons-star-filled"></span>'; 
    // echo '<span class="dashicons dashicons-no-alt"></span>';
    // echo '</div>';
    // echo '<span class="custom_default_image" style="display:none">'.$image.'</span>';
    // if ($row) { $image = wp_get_attachment_image_src($row, 'thumb'); $image = $image[0]; }               
    echo '<input class="custom_upload_file_button button" type="button" value="Datei hochladen"/>';
    echo '<input name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'"/>';
            
    // echo '</li></div>';
     
    // echo $html;
  }

  public function echo_post_list($field, $meta){
    $items = get_posts( array (
        'post_type' => $field['post_type'],
        'posts_per_page' => -1
    ));
    echo '<select name="'.$field['id'].'" id="'.$field['id'].'">
            <option value="">Select One</option>'; // Select One
        foreach($items as $item) {
            echo '<option value="'.$item->ID.'"',$meta == $item->ID ? ' selected="selected"' : '','>'.qtrans_use( qtrans_getLanguage(), $item->post_title,false).'</option>';
        }
    echo '</select><br /><span class="description">'.$field['desc'].'</span>';
  }

  public function echo_text_field($field, $meta){
    echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
      <br /><span class="description">'.$field['desc'].'</span>';
  }

  public function echo_text_field_size($field, $meta, $size){
    echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="'.$size.'" />
      <br /><span class="description">'.$field['desc'].'</span>';
  }

  public function echo_text_area($field, $meta){
    echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
      <br /><span class="description">'.$field['desc'].'</span>';
  }

  public function echo_checkbox($field, $meta){
    echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/>
      <label for="'.$field['id'].'">'.$field['desc'].'</label>';
  }

  public function echo_select($field, $meta){
    echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';
    foreach ($field['options'] as $option) {
        echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
    }
    echo '</select><br /><span class="description">'.$field['desc'].'</span>';
  }

  public function echo_radio($field, $meta){
    foreach ( $field['options'] as $option ) {
      echo '<input type="radio" name="'.$field['id'].'" id="'.$option['value'].'" value="'.$option['value'].'" ',$meta == $option['value'] ? ' checked="checked"' : '',' />
        <label for="'.$option['value'].'">'.$option['label'].'</label><br />';
    }
  }

  public function echo_checkbox_group($field, $meta){
    foreach ($field['options'] as $option) {
      echo '<input type="checkbox" value="'.$option['value'].'" name="'.$field['id'].'[]" id="'.$option['value'].'"',$meta && in_array($option['value'], $meta) ? ' checked="checked"' : '',' /> 
      <label for="'.$option['value'].'">'.$option['label'].'</label><br />';
    }
    echo '<span class="description">'.$field['desc'].'</span>';
  }

  public function echo_date($field, $meta){
    echo '<input type="text" class="datepicker" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
      <br /><span class="description">'.$field['desc'].'</span>';   
  }

  public function echo_tax_select($field, $meta, $post){
    echo '<select name="'.$field['id'].'" id="'.$field['id'].'">
    <option value="">Select One</option>'; // Select One
    $terms = get_terms($field['id'], 'get=all');
    $selected = wp_get_object_terms($post->ID, $field['id']);
    foreach ($terms as $term) {
      if (!empty($selected) && !strcmp($term->slug, $selected[0]->slug)) 
        echo '<option value="'.$term->slug.'" selected="selected">'.$term->name.'</option>'; 
      else
        echo '<option value="'.$term->slug.'">'.$term->name.'</option>'; 
    }
    $taxonomy = get_taxonomy($field['id']);
    echo '</select><br /><span class="description"><a href="'.get_bloginfo('url').'/wp-admin/edit-tags.php?taxonomy='.$field['id'].'">Manage '.$taxonomy->label.'</a></span>';    
  }

  public function echo_slider($field, $meta){
    $value = $meta != '' ? $meta : '0';
      echo '<div id="'.$field['id'].'-slider"></div>
      <input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$value.'" size="5" />
      <br /><span class="description">'.$field['desc'].'</span>';
  }

  public function echo_image($field, $meta){
      $image = get_template_directory_uri().'/images/image.png';  
      echo '<span class="custom_default_image" style="display:none">'.$image.'</span>';
      if ($meta) { $image = wp_get_attachment_image_src($meta, 'medium'); $image = $image[0]; }               
      echo    '<input name="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$meta.'" />
                  <img src="'.$image.'" class="custom_preview_image" alt="" /><br />
                      <input class="custom_upload_image_button button" type="button" value="Choose Image" />
                      <small> <a href="#" class="custom_clear_image_button">Remove Image</a></small>
                      <br clear="all" /><span class="description">'.$field['desc'].'</span>';
    }

}

?>