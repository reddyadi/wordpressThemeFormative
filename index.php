<?php get_header(); ?>

  <?php if(have_posts()): ?>
      <?php while(have_posts()): the_post();?>
          <div class="container">
              <div class="row">
                  <div class="col">
                      <div class="row">
                        <div class="col-md-6 offset-md-3">
                          <h1 class="comfortaa"><?= the_title(); ?></h1>
                          <div class="poiret">
                            <?php the_content(); ?>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="row">
                <?php

                  $args = array(
                    'post_type' => 'servicetype',
                    'order' => 'ASC',
                    'orderby'  => 'title'
                  );
                  $allServiceTypes = new WP_Query($args);
                ?>

                <?php if( $allServiceTypes->have_posts() ): ?>
                  <?php while($allServiceTypes->have_posts()): $allServiceTypes->the_post();?>
                    <div class="row">
                      <div class="col">
                        <h5><?php the_title(); ?></h5>
                        <?php the_content(); ?>
                      </div>
                    </div>
                  <?php endwhile; ?>
                <?php endif; ?>
              </div>
          </div>
      <?php endwhile; ?>
  <?php endif; ?>

<?php get_footer(); ?>
