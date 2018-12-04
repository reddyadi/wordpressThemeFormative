<footer class=" container footer-bg">

  <?php

  function my_social_icons_output() {

    $social_sites = ct_formativeOneCustomTheme_social_array();

    foreach ( $social_sites as $social_site => $profile ) {

      if ( strlen( get_theme_mod( $social_site ) ) > 0 ) {
        $active_sites[ $social_site ] = $social_site;
      }
    }

    if ( ! empty( $active_sites ) ) {
      echo '<ul class="social-media-icons icon-list">';
      foreach ( $active_sites as $key => $active_site ) {
            $class = 'fab fa-' . $active_site; ?>
        <li class="icon-social-media">
          <a class=" icon-colour <?php echo esc_attr( $active_site ); ?>" target="_blank" href="<?php echo esc_url( get_theme_mod( $key ) ); ?>">
            <i class="<?php echo esc_attr( $class ); ?>" title="<?php echo esc_attr( $active_site ); ?>"></i>
          </a>
        </li>
      <?php }
      echo "</ul>";
    }
  }
my_social_icons_output();

?>
</footer>
<?php wp_footer(); ?>
</body>
</html>
