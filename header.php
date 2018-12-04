<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Sweet Mother's</title>
    <?php wp_head(); ?>
    <link href="https://fonts.googleapis.com/css?family=Comfortaa|Poiret+One" rel="stylesheet">
  </head>
  <body>
    <header class="container">

      <?php
        $custom_logo = get_theme_mod('custom_logo');
        $logo_url = wp_get_attachment_image_url($custom_logo, 'medium');
      ?>

      <nav class="navbar navbar-light justify-content-center header-bg">
        <?php if($custom_logo): ?>
          <a class ="navbar-brand" href="<?= bloginfo('home');?>">
            <img src="<?= $logo_url ?>" height="50" alt"">
          </a>
        <?php else: ?>
          <a class="navbar-brand" href="<?= bloginfo('home');?>"><?= bloginfo('name'); ?></a>
        <?php endif; ?>
      </nav>

      <?php
        if(get_header_image() == false){
            $bannerImage = get_template_directory_uri() . '/assets/images/default.jpeg';
        } else {
            $bannerImage = get_header_image();
        }
      ?>

      <?php if(get_header_image()): ?>
        <div id="front-page-banner" class="bg-dark" style="background-image: url(<?= $bannerImage; ?>);">

        </div>
      <?php endif; ?>

      <nav class="navbar navbar-expand-md navbar-light header-bg" role="navigation">
        <div class="container">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <?php
            wp_nav_menu( array(
              'theme_location'  => 'header_nav',
              'depth'           => 2,
              'container'       => 'div',
              'container_class' => 'collapse navbar-collapse',
              'container_id'    => 'bs-example-navbar-collapse-1',
              'menu_class'      => 'nav navbar-nav justify-content-around w-100 comfortaa',
              'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
              'walker'          => new WP_Bootstrap_Navwalker(),
            ));
          ?>
        </div>
      </nav>
    </header>
