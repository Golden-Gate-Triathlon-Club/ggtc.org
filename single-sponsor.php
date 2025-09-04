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
<?php get_template_part('components/breadcrumbs'); ?>

<main id="site-content" role="main" class="padding-y-100">
  <?php if (have_posts()) : while ( have_posts() ) : the_post();?>
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container">
      <div class="row">
        <div class="col-lg-6">


          <?php 
            $sponsor_logo = get_field('sponsor_logo');
            if ($sponsor_logo) :
          ?>
          <div class="sponsor-logo mb-5">
            <img class="mx-auto d-block" src="<?php echo esc_url($sponsor_logo['url']); ?>"
              alt="<?php echo esc_attr($sponsor_logo['alt'] ?: get_the_title()); ?>">
          </div>

          <?php endif; ?>

        </div>

        <div class="col-lg-6 text-center">
          <?php 
          $sponsor_website = get_field('sponsor_website');
          if ($sponsor_website) :
          ?>

          <a href="<?php echo esc_url($sponsor_website); ?>" target="_blank" rel="noopener noreferrer"
            class="btn btn-primary">
            Visit Website
          </a>

          <?php endif; ?>
        </div>
        <div class="col-lg-12">
          <?php
          // Only show components if user is logged in
          if (ggtc_is_logged_in()) {
            if( have_rows('components') ):
                while( have_rows('components') ): the_row();
                    if( get_row_layout() == 'cta-banner' ):
                        get_template_part('components/section-cta-banner');
                    elseif( get_row_layout() == 'text-section-1-column' ):
                        get_template_part('components/section-text-1-column');
                    elseif( get_row_layout() == 'photo-banner-full-width' ):
                        get_template_part('components/section-photo-banner-full-width');
                    endif;
                endwhile;
            endif;
          } else {
            get_template_part('components/restricted-content');
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