<?php
  $metaboxes = array(
    'serviceTypes'  => array(
      'title' => 'Choose Service',
      'applicableto'  => 'servicetypes',
      'location'  => 'normal',
      'priority'  => 'high',
      'fields'  => array(
        'servicetype' => array(
          'type' => 'select',
          'description' => 'Choose Service category'
        )
      )
    )
  );

  function add_custom_fields(){
    global $metaboxes;

    if(! empty($metaboxes) ){
      foreach ($metaboxes as $id => $metabox) {
        add_meta_box($id, $metabox['title'], 'show_metaboxes', $metabox['applicableto'], $metabox['location'], $metabox['priority'], $id);
      }
    }
  }
  add_action('admin_init', 'add_custom_fields');

  function show_metaboxes($post, $args){
    global $metaboxes;

    $fields = $metaboxes[$args['id']]['fields'];


    $customValues = get_post_custom($post->ID);

    $output = '<input type="hidden" name="post_format_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'">';

    if(! empty($fields)){
        foreach ($fields as $id => $field) {
            switch($field['type']){
                case 'text':
                    $output .= '<label for="'.$id.'" class="customLabel">'.$field['title'].'</label>';
                    $output .= '<p>'.$field['description'].'</p>';
                    $output .= '<input type="text" name="'.$id.'" class="customField" value="'.$customValues[$id][0].'">';
                break;
                case 'number':
                    $output .= '<label for="'.$id.'" class="customLabel">'.$field['title'].'</label>';
                    $output .= '<input type="number" name="'.$id.'" class="customField" value="'.$customValues[$id][0].'">';
                break;
                case 'select':
                      $servArg = array(
                        'post_type' => 'services',
                        'order' => 'ASC',
                        'orderby' => 'title'
                      );
                      $allServices = new WP_Query($servArg);

                      $output .= '<label class="customLabel">'.$field['title'].'</label><br>';
                      $output .= '<select name="'.$id.'"><option>Choose Service Category</option>';
                        if($allServices->have_posts() ):
                        while($allServices->have_posts()): $allServices->the_post();
                          $options = get_the_title();
                          $output .= '<option value="'.$options.'">'.$options.'</option>';
                        endwhile;
                          $output .= '</select>';
                        endif;
                break;
                case 'email':
                    $output .= '<label class="customLabel">'.$field['title'].'</label>';
                    $output .= '<input type="email" name="'.$id.'" class="customField" value="'.$customValues[$id][0].'">';
                break;
                default:
                    $output .= '<label class="customLabel">'.$field['title'].'</label>';
                    $output .= '<input type="text" name="'.$id.'">';
                break;
            }
        }
    }
    echo $output;
}


function save_metaboxes($postID){
    global $metaboxes;
    if(! wp_verify_nonce( $_POST['post_format_meta_box_nonce'], basename(__FILE__) )){
        return $postID;
    }
    if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
        return $postID;
    }
    if($_POST['post_type'] == 'page'){
        if(! current_user_can('edit_page', $postID) ){
            return $postID;
        }
    } elseif(! current_user_can('edit_page', $postID) ){
        return $postID;
    }
    $post_type = get_post_type();

    foreach($metaboxes as $id => $metabox){
        if( $metabox['applicableto'] == $post_type ){
            $fields = $metaboxes[$id]['fields'];
            foreach ($fields as $id => $field) {
                $oldValue = get_post_meta($postID, $id, true);
                $newValue = $_POST[$id];
                if($newValue && $newValue != $oldValue){
                    update_post_meta($postID, $id, $newValue);
                } elseif($newValue == '' && $oldValue || !isset($_POST[$id])){
                    delete_post_meta($postID, $id, $oldValue);
                }
            }
        }
    }
}
add_action('save_post', 'save_metaboxes');
