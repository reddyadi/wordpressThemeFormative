<?php

function addCustomThemeStyles(){
    // Style
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.1.3', 'all');
    wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/theme-style.css', array(), '0.0.2', 'all');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/all.css');

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
  register_nav_menu('footer_nav', 'This is the navigation that appears at the bottom of the page');
}
add_action('init', 'addCustomMenus');

/*Adding Navwalker to utilise bootstrap nav*/
require_once get_template_directory() . '/addons/class-wp-bootstrap-navwalker.php';

/*Registering Header Image holder*/
function create_header_tab(){

  register_default_headers( array(
    'defaultImage' => array(
      'url' => get_template_directory_uri() . '/assets/images/default.jpg',
      'thumbnail_url' => get_template_directory_uri() . 'assets/images/default.jpg',
      'description' => __('defaultImage', 'formativeOneCustomTheme')
    )
  ));
  $defaultImage = array(
    'default-image' => get_template_directory_uri() . '/assets/images/default.jpg',
    'width' => 1580,
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

/*Adding custom_customizer.php to functions*/
require get_parent_theme_file_path('./addons/custom_customizer.php');


/* Adding logo feature */
function custom_logo_create() {

  add_theme_support('custom-logo', array(
    'height' => 100,
    'width' => 300,
    'flex-width' => true,
    'flex-height' => true
  ));
}
add_action('init', 'custom_logo_create');

function ct_formativeOneCustomTheme_social_array(){

  $social_sites = array(
    'twitter'       => 'formativeOneCustomTheme_twitter_profile',
    'facebook'      => 'formativeOneCustomTheme_facebook_profile',
    'google-plus'   => 'formativeOneCustomTheme_googleplus_profile',
    'pinterest'     => 'formativeOneCustomTheme_pinterest_profile',
    'linkedin'      => 'formativeOneCustomTheme_linkedin_profile',
    'youtube'       => 'formativeOneCustomTheme_youtube_profile',
    'instagram'     => 'formativeOneCustomTheme_instagram_profile',
    'flickr'        => 'formativeOneCustomTheme_flickr_profile',
    'dribbble'      => 'formativeOneCustomTheme_dribbble_profile',
    'rss'           => 'formativeOneCustomTheme_rss_profile',
    'yahoo'         => 'formativeOneCustomTheme_yahoo_profile',
    'behance'       => 'formativeOneCustomTheme_behance_profile',
    'codepen'       => 'formativeOneCustomTheme_codepen_profile',
    'github'        => 'formativeOneCustomTheme_github_profile',
    'slack'         => 'formativeOneCustomTheme_slack_profile',
    'skype'         => 'formativeOneCustomTheme_skype_profile',
    'paypal'        => 'formativeOneCustomTheme_paypal_profile',
    'email-form'    => 'formativeOneCustomTheme_email_form_profile'
  );

  return apply_filters( 'ct_formativeOneCustomTheme_social_array_filter', $social_sites);

}
ct_formativeOneCustomTheme_social_array();

/*Adding custom post to dashboard*/
require get_parent_theme_file_path('./addons/custom_post_types.php');

/*Adding metaboxes to theme*/
require get_parent_theme_file_path('./addons/custom_fields.php');
