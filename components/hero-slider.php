<?php
/**
 * Hero Slider Component
 * Uses ACF flexible content fields for dynamic content management
 */
?>
<section id="hero-slider-<?php echo get_row_index(); ?>" class="section-<?php echo get_row_index(); ?> hero-slider">
  <div class="swiper swiper-hero-slider">
    <div class="swiper-wrapper">
      <?php if (have_rows('hero_slider')) : ?>
      <?php while (have_rows('hero_slider')) : the_row(); 
        $image = get_sub_field('slider_image');
        $text = get_sub_field('slider_text');
        $link = get_sub_field('slide_link');
      ?>
      <div class="swiper-slide">
        <?php if ($link) : ?>
        <a href="<?php echo esc_url($link['url']); ?>"
          <?php echo ($link['target'] ? 'target="' . esc_attr($link['target']) . '"' : ''); ?>>
          <?php endif; ?>

          <?php if ($image) : ?>
          <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
          <?php endif; ?>

          <?php if ($text) : ?>
          <div class="caption">
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                  <p><?php echo acf_esc_html($text); ?></p>
                </div>
              </div>
            </div>
          </div>
          <?php endif; ?>
          <?php if ($link) : ?>
        </a>
        <?php endif; ?>
      </div>
      <?php endwhile; ?>
      <?php endif; ?>
    </div>
    <div class="swiper-pagination"></div>
  </div>
</section>

<script>
// slider config
const swiper = new Swiper('.swiper-hero-slider', {
  speed: 400,
  spaceBetween: 0,
  loop: true,
  effect: 'fade',
  fadeEffect: {
    crossFade: true
  },
  autoplay: {
    delay: 7000,
    disableOnInteraction: true,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
});
</script>