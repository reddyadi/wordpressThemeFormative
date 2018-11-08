<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Sweet Mother's</title>
    <?php wp_head(); ?>
  </head>
  <body>
    <header>
      <div class="container-fluid">

        <?php
          $custom_logo = get_theme_mod('custom_logo');
          $logo_url = wp_get_attachment_image_url($custom_logo, 'medium');
        ?>

        <?php
          if(get_header_image() == false){
            $bannerImage = get_template_directory_uri() . '/assets/images/default.jpg';
          } else {
            $bannerImage = get_header_image();
          }
        ?>

        <?php if(get_header_image()): ?>
            <div id="front-page-banner" class="bg-dark" style="background-image: url(<?= $bannerImage; ?>);">

            </div>
        <?php endif; ?>

          <?php wp_nav_menu( array
            ( 'theme_location' => 'header_nav',
              'menu_id' => 'menu'
            ) );
          ?>
      </div>
    </header>
