<?php

function custom_theme_customizer( $wp_customize ){

  /*Customizer for the header section*/

  $wp_customize->add_section('custom_theme_header_info', array(
    'title' => __('Header Styles', 'formativeOneCustomTheme'),
    'priority' => 20
  ));

  $wp_customize->add_setting('header_background_colour_setting', array(
    'default' => '#ffffff',
    'transport' => 'refresh'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'header_background_colour_control',
      array(
        'label' => __('Header Background Colour', 'formativeOneCustomTheme'),
        'section' => 'custom_theme_header_info',
        'settings' => 'header_background_colour_setting'
      )
    )
  );

  $wp_customize->add_setting('header_link_colour_setting', array(
    'default' => '#ffffff',
    'transport' => 'refresh'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'header_link_colour_control',
      array(
        'label' => __('Header Link Colour', 'formativeOneCustomTheme'),
        'section' => 'custom_theme_header_info',
        'settings' => 'header_link_colour_setting'
      )
    )
  );

  /*Customizer for footer section*/
  $wp_customize->add_section('custom_theme_footer_info', array(
    'title'     => __('Footer Styles', 'formativeOneCustomTheme'),
    'priority'  => 20
  ));

  $wp_customize->add_setting('footer_background_colour_setting', array(
    'default'   => '#ffffff',
    'transport' => 'refresh'
  ));

  $wp_customize->add_control(
      new WP_Customize_Color_Control(
        $wp_customize,
        'footer_background_colour_control',
        array(
          'label'     => __('Footer Background Colour', 'formativeOneCustomTheme'),
          'section'   => 'custom_theme_footer_info',
          'settings'  => 'footer_background_colour_setting'
        )
      )
  );

  $wp_customize->add_setting('footer_link_colour_setting', array(
    'default'   => '0000FF',
    'transport' => 'refresh'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'footer_link_colour_control',
      array(
        'label'     => __('Footer Link Colour', 'formativeOneCustomTheme'),
        'section'   => 'custom_theme_footer_info',
        'settings'  => 'footer_link_colour_setting'
      )
    )
  );

  /*Customizer to add social media icons*/

  $social_sites = ct_formativeOneCustomTheme_social_array();

  $priority = 5;

  $wp_customize->add_section( 'ct_formativeOneCustomTheme_social_media_icons', array(
    'title'         => __('Social Media Icons', 'formativeOneCustomTheme'),
    'priority'      => 25,
    'description'   => __('Add the URL for each of the social profiles', 'formativeOneCustomTheme')
  ));

  foreach ( $social_sites as $social_site => $value ) {
    $label = ucfirst( $social_site );

    if ($social_site == 'twitter'){
      $label = 'Twitter';
    } elseif ( $social_site == 'facebook'){
      $label = 'Facebook';
    } elseif ($social_site == 'google-plus'){
      $label = 'Google Plus';
    } elseif ($social_site == 'pinterest'){
      $label = 'Pinterest';
    } elseif ($social_site == 'linkedin'){
      $label = 'Linkedin';
    } elseif ($social_site == 'youtube'){
      $label = 'Youtube';
    } elseif ($social_site == 'flickr'){
      $label = 'Flickr';
    } elseif ($social_site == 'dribble'){
      $label = 'Dribble';
    } elseif ($social_site == 'rss'){
      $label = 'RSS';
    } elseif ($social_site == 'yahoo'){
      $label = 'Yahoo';
    } elseif ($social_site == 'behance'){
      $label = 'Behance';
    } elseif ($social_site == 'codepen'){
      $label = 'CodePen';
    } elseif ($social_site == 'github'){
      $label = 'GitHub';
    } elseif ($social_site == 'slack'){
      $label = 'Slack';
    } elseif ($social_site == 'skype'){
      $label = 'Skype';
    } elseif ($social_site == 'paypal'){
      $label = 'PayPal';
    } elseif ($social_site == 'email-form'){
      $label = 'Contact Form';
    }

    $wp_customize->add_setting($social_site, array(
      'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control($social_site, array(
      'type'      => 'url',
      'label'     => $label,
      'section'   => 'ct_formativeOneCustomTheme_social_media_icons',
      'priority'  => $priority
    ));

    $priority = $priority + 5;
  }

}
add_action('customize_register', 'custom_theme_customizer');

function custom_theme_customizer_styles(){
  ?>

    <style type="text/css">
        .header-bg{
            background-color: <?php echo get_theme_mod('header_background_colour_setting', '#ffffff'); ?>!important;
        }
        .navbar-light .navbar-nav .nav-link{
            color: <?php echo get_theme_mod('header_link_colour_setting', '#ffffff'); ?>!important;
        }

        .footer-bg{
          background-color: <?php echo get_theme_mod('footer_background_colour_setting', '#ffffff'); ?>!important;
        }

        .icon-colour{
          color: <?php echo get_theme_mod('footer_link_colour_setting', '#0000FF'); ?>!important;
        }
    </style>

  <?php
}
add_action('wp_head', 'custom_theme_customizer_styles');
