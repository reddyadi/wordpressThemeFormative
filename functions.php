<?php
/*
    This file holds all the functionality of our theme.
    It will be different on every theme you create.
*/

/*
    What we are doing bellow is adding our bootstrap styles into our theme.
    We can't do it the normal way which we have done in the past, but rather add it into the wp_head or wp_footer sections

    Whenever we work in the functions.php file, we need to create a function to tell it what to do
    and then tell wordpress what loading que do you want that function to be a part of.
    This one bellow is adding in our css and js into the scripts que which gets loaded when the page loads
    https://codex.wordpress.org/Plugin_API/Action_Reference/wp_enqueue_scripts
*/
function addCustomThemeStyles(){
    // Style
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.1.3', 'all');
    wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/theme-style.css', array(), '0.0.2', 'all');

    // Scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrapjs', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), '4.1.3', true);
    wp_enqueue_script('theme-scripts', get_template_directory_uri() . '/assets/js/theme-scripts.js', array(), '0.0.1', true);
}
add_action('wp_enqueue_scripts', 'addCustomThemeStyles');

/*Adding nav-menu*/
function addCustomMenus() {
  add_theme_support('menus');
  register_nav_menu('header_nav', 'This is the navigation that appears at the top of the page');
}
add_action('init', 'addCustomMenus');


/*Registering Header Image holder*/
function create_header_tab(){

  register_default_headers( array(
    'defaultImage' => array(
      'url' => get_template_directory_uri() . '/assets/images/default.jpg',
      'thumbnail_url' => get_template_directory_uri() . 'assets/images/default.jpg',
      'description' => __('defaultImage', '18wdwu02customtheme')
    )
  ));
  $defaultImage = array(
    'default-image' => get_template_directory_uri() . '/assets/images/default.jpg',
    'width' => 1280,
    'height' => 720,
    'header-text' => false
  );
  add_theme_support('custom-header', $defaultImage);

  $default = array(
    'default-color' => 'ffffff',
    'default-repeat' => 'repeat',
    'default-position-x' => 'left',
    'default-position-y' => 'top',
    'default-size' => 'auto',
    'default-attachment' => 'scroll',
    'wp-head-callback' => '_custom_background_cb',
    'admin-head-callback' => '',
    'admin-preview-callback' => ''
  );
  add_theme_support('custom-background', $defaults);
}
add_action('init', 'create_header_tab');

function custom_logo_create() {

  add_theme_support('custom-logo', array(
    'height' => 100,
    'width' => 300,
    'flex-width' => true,
    'flex-height' => true
  ));
}
add_action('init', 'custom_logo_create');
