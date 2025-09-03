<?php get_header(); ?>

<section class="hero">
  <img src="<?php echo get_template_directory_uri(); ?>/docs/assets/img/page-hero-run.webp" alt="">
  <div class="caption">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="entry-title">
            <span class="eyebrow">Sponsor Level:</span>
            <span class="sponsor-name"><?php single_term_title(); ?></span>
          </h1>
        </div>
      </div>
    </div>
  </div>
</section>

<main id="site-content" role="main" class="padding-y-100">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">

        <?php if (have_posts()) : ?>

        <!-- Level Description -->
        <?php 
          $term_description = term_description();
          if ($term_description) : 
          ?>
        <div class="level-description mb-5">
          <?php echo $term_description; ?>
        </div>
        <?php endif; ?>

        <!-- Sponsors Grid -->
        <div class="sponsors-grid">
          <?php while (have_posts()) : the_post(); ?>
          <?php
              $sponsor_logo = get_field('sponsor_logo');
              $sponsor_levels = get_the_terms(get_the_ID(), 'sponsor-level');
              $level_classes = '';
              
              if ($sponsor_levels && !is_wp_error($sponsor_levels)) {
                foreach ($sponsor_levels as $level) {
                  $level_classes .= ' ' . $level->slug;
                }
              }
              ?>

          <div class="sponsor-card<?php echo esc_attr($level_classes); ?>">
            <div class="sponsor-card-inner">

              <?php if ($sponsor_logo) : ?>
              <div class="sponsor-logo">
                <img src="<?php echo esc_url($sponsor_logo['url']); ?>"
                  alt="<?php echo esc_attr($sponsor_logo['alt'] ?: get_the_title()); ?>">
              </div>
              <?php endif; ?>

              <div class="sponsor-info">
                <h3 class="sponsor-name">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>

                <?php if ($sponsor_levels && !is_wp_error($sponsor_levels)) : ?>
                <div class="sponsor-level">
                  <?php foreach ($sponsor_levels as $level) : ?>
                  <span class="level-badge"><?php echo esc_html($level->name); ?></span>
                  <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <?php 
                    $sponsor_details = get_field('sponsor_details');
                    if ($sponsor_details) : 
                    ?>
                <div class="sponsor-excerpt">
                  <?php echo wp_trim_words($sponsor_details, 20, '...'); ?>
                </div>
                <?php endif; ?>

                <div class="sponsor-link">
                  <a href="<?php the_permalink(); ?>" class="btn btn-outline">Learn More</a>
                </div>
              </div>

            </div>
          </div>

          <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper mt-5">
          <?php
            the_posts_pagination(array(
              'mid_size' => 2,
              'prev_text' => __('Previous', 'ggtc'),
              'next_text' => __('Next', 'ggtc'),
            ));
            ?>
        </div>

        <?php else : ?>

        <div class="no-sponsors">
          <h2>No Sponsors Found</h2>
          <p>No sponsors found in this level. <a href="<?php echo get_post_type_archive_link('sponsor'); ?>">View all
              sponsors</a>.</p>
        </div>

        <?php endif; ?>

      </div>
    </div>
  </div>
</main>

<?php get_footer(); ?>