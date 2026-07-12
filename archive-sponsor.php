<?php get_header(); ?>

<section class="hero">
  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/page-hero-run.webp" alt="">
  <div class="caption">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="entry-title">
            <span>Our Sponsors</span>
          </h1>
        </div>
      </div>
    </div>
  </div>
</section>



<?php get_template_part('components/breadcrumbs'); ?>

<main id="site-content" role="main" class="padding-y-100">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">

        <?php if (have_posts()) : ?>
        <!-- Sponsors Grid -->
        <div class="sponsors-grid">
          <?php
          // Define sponsor levels in order
          $sponsor_level_order = array('diamond', 'platinum', 'gold', 'friends');
          
          // Get all sponsor levels
          $all_sponsor_levels = get_terms(array(
            'taxonomy' => 'sponsor-level',
            'hide_empty' => false,
          ));
          
          // Create a mapping of slug to term object
          $level_map = array();
          if ($all_sponsor_levels && !is_wp_error($all_sponsor_levels)) {
            foreach ($all_sponsor_levels as $level) {
              $level_map[$level->slug] = $level;
            }
          }
          
          // Loop through sponsor levels in specified order
          foreach ($sponsor_level_order as $level_slug) {
            if (isset($level_map[$level_slug])) {
              $level = $level_map[$level_slug];
              
              // Get sponsors for this level
              $sponsors_in_level = get_posts(array(
                'post_type' => 'sponsor',
                'numberposts' => -1,
                'post_status' => 'publish',
                'orderby' => 'title',
                'order' => 'ASC',
                'tax_query' => array(
                  array(
                    'taxonomy' => 'sponsor-level',
                    'field'    => 'slug',
                    'terms'    => $level_slug,
                  ),
                ),
              ));
              
              if (!empty($sponsors_in_level)) :
          ?>

          <div class="sponsor-level-section mb-5">
            <h2 id="<?php echo esc_attr($level_slug); ?>" class="sponsor-level-title mb-4">
              <?php echo esc_html($level->name); ?></h2>
            <hr>
            <div class="row">
              <?php foreach ($sponsors_in_level as $sponsor_post) : 
                setup_postdata($sponsor_post);
                $sponsor_logo = get_field('sponsor_logo', $sponsor_post->ID);
              ?>
              <div class="col-lg-4 mb-4 d-flex">
                <a href="<?php echo get_permalink($sponsor_post->ID); ?>"
                  class="d-flex align-items-center justify-content-center p-5 h-100 w-100 sponsor-<?php echo esc_attr($level_slug); ?>"
                  data-level="<?php echo esc_attr($level_slug); ?>">
                  <?php if ($sponsor_logo) : ?>
                  <img class="img-fluid" src="<?php echo esc_url($sponsor_logo['url']); ?>"
                    alt="<?php echo esc_attr($sponsor_logo['alt'] ?: $sponsor_post->post_title); ?>">
                  <? else : ?>
                  <h3 class="sponsor-name">
                    <?php echo esc_html($sponsor_post->post_title); ?>
                  </h3>
                  <?php endif; ?>
                </a>
              </div>
              <?php endforeach; ?>
            </div>
          </div>

          <?php 
              endif;
              wp_reset_postdata();
            }
          }
          ?>

          <?php else : ?>

          <div class="no-sponsors">
            <h2>No Sponsors Found</h2>
            <p>We're working on adding our amazing sponsors. Check back soon!</p>
          </div>

          <?php endif; ?>

        </div>
      </div>
    </div>
</main>

<?php get_footer(); ?>