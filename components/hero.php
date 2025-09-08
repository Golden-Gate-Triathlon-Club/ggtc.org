<section class="hero">
  <?php 
  $hero_image = get_sub_field('hero_image');
  if ($hero_image) : ?>
  <img src="<?php echo esc_url($hero_image['url']); ?>" alt="<?php echo esc_attr($hero_image['alt']); ?>">
  <?php else : ?>
  <img src="<?php echo get_template_directory_uri(); ?>/docs/assets/img/page-hero-run.webp" alt="">
  <?php endif; ?>
  <div class="caption">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="entry-title">
            <span><?php the_title(); ?></span>
          </h1>
        </div>
      </div>
    </div>
  </div>
</section>