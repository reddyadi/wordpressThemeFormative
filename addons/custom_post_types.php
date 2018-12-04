<?php

  function add_services_post_type(){

    $labels = array(
      'name'            => _x('Services', 'post type name', 'formativeOneCustomTheme'),
      'singular_name'   => _x('Service', 'post types singular name', 'formativeOneCustomTheme'),
      'add_new_item'    => _x('Add New Service', 'adding new service', 'formativeOneCustomTheme')
    );

    $args = array(
      'labels' => $labels,
      'description' => 'a post type for the services offered by the company',
      'public' => true,
      'hierarchical' => true,
      'exclude_from_search' => false,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_nav_menu' => false,
      'menu_position' => 20,
      'menu_icon' => 'dashicons-portfolio',
      'supports' => array(
        'title',
        'thumbnail'
      ),
      'query_var' => true
    );

    register_post_type('services', $args);
  }
  add_action('init', 'add_services_post_type');



  function add_service_type_post_type(){
    $labels = array(
      'name'  => _x('Services Types', 'post type name', 'formativeOneCustomTheme'),
      'singular_name' => _x('Service Type', 'post types singular name', 'formativeOneCustomTheme'),
      'add_new_item'  => _x('Add New Service Type', 'adding new service type', 'formativeOneCustomTheme')
    );

    $args = array(
      'labels'  => $labels,
      'description' => 'Service types that we offer',
      'public'  => false,
      'hierarchical' => true,
      'exclude_from_search' => true,
      'show_ui' => true,
      'show_ui_menu' => true,
      'show_in_nav_menu' => false,
      'menu_position' => 20,
      'menu_icon' => 'dashicons-admin-plugins',
      'support' => array(
        'title',
        'thumbnail'
      ),
      'query_var' => true
    );

    register_post_type('serviceTypes', $args);
  }

  add_action('init', 'add_service_type_post_type');

?>
