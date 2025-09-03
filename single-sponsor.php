<?php get_header();?>


<section class="hero">
  <?php
  $hero_image = null;
  if( have_rows('components') ):
      while( have_rows('components') ): the_row();
          if( get_row_layout() == 'hero' ): 
            $hero_image = get_sub_field('hero_image');
            break; // Exit loop once we find the hero layout
          endif;
      endwhile; 
  endif;

  if ($hero_image): ?>
  <img src="<?php echo esc_url($hero_image['url']); ?>"
    alt="<?php echo esc_attr($hero_image['alt'] ?: get_the_title()); ?>">

  <?php else: ?>

  <img src="<?php echo get_template_directory_uri(); ?>/docs/assets/img/page-hero-run.webp" alt="">
  <?php endif; ?>

  <div class="caption">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="entry-title">
            <span class="eyebrow">
              <?php
              $terms = get_the_terms(get_the_ID(), 'sponsor-level');
              if ($terms && !is_wp_error($terms) && !empty($terms)) {
                $term = $terms[0];
                echo '<span class="sponsor-level">' . esc_html($term->name) . '</span> ';
              }
            ?>
              <?php echo ucfirst(get_post_type()); ?>
            </span>

            <span class="sponsor-name">
              <?php the_title(); ?>
            </span>

          </h1>
        </div>
      </div>
    </div>
  </div>
</section>

<main id="site-content" role="main" class="padding-y-100">
  <?php if (have_posts()) : while ( have_posts() ) : the_post();?>
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">


          <?php 
            $sponsor_logo = get_field('sponsor_logo');
            if ($sponsor_logo) :
          ?>
          <div class="logo mb-5">
            <img src="<?php echo esc_url($sponsor_logo['url']); ?>"
              alt="<?php echo esc_attr($sponsor_logo['alt'] ?: get_the_title()); ?>">
          </div>

          <?php endif; ?>


          <?php 
          // Only show sponsor details if user is logged in
          if (ggtc_is_logged_in()) {
            the_field('sponsor_details');
          } else {
            echo '<div class="login-required">';
            echo '<p>Please <a href="' . wp_login_url(get_permalink()) . '">log in</a> to view sponsor details.</p>';
            echo '</div>';
          }
          ?>


        </div>
      </div>
    </div>
  </article>
  <?php endwhile; ?>
  <?php endif;?>
</main>

<?php get_footer();?>