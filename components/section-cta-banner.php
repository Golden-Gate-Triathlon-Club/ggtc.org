<?php 
$section_background_color = get_sub_field("section_background_color"); 
$cta_banner_headline = get_sub_field("cta_banner_headline");
$cta_button_link = get_sub_field('cta_button_link');
$cta_banner_button_url = isset($cta_button_link['url']) ? $cta_button_link['url'] : '';
$cta_banner_button_text = isset($cta_button_link['title']) ? $cta_button_link['title'] : '';
$cta_banner_button_target = isset($cta_button_link['target']) ? $cta_button_link['target'] : '_self';
$cta_banner_button_color = get_sub_field("cta_button_color");
?>

<section id="cta-banner-<?php echo get_row_index(); ?>"
  class="section-<?php echo get_row_index(); ?> cta-banner <?php echo $section_background_color; ?> padding-y-100">
  <div class="container">
    <div class="row">
      <div class="col-lg-9">
        <h2><?php the_sub_field("cta_banner_headline"); ?></h2>
        <?php if (get_sub_field("cta_banner_text")) : ?>
        <p class="lead"><?php the_sub_field("cta_banner_text"); ?></p>
        <?php endif; ?>
      </div>
      <div class="col-lg-3">
        <a href="<?php echo $cta_banner_button_url; ?>"
          class="btn <?php echo $cta_banner_button_color; ?>"><?php echo $cta_banner_button_text; ?></a>
      </div>
    </div>
  </div>
</section>