<?php get_header();?>
<?php if (have_posts()) : while ( have_posts() ) : the_post();?>




<?php
if( have_rows('components') ):
    while( have_rows('components') ): the_row();
        if( get_row_layout() == 'hero-slider' ):
            get_template_part('components/hero-slider'); 
        elseif( get_row_layout() == 'cta-banner' ):
            get_template_part('components/section-cta-banner');
        endif;
    endwhile;
endif;
?>

<main id="site-content" role="main">
  <?php get_template_part('components/section-full-width'); ?>
  <?php get_template_part('components/section-stats'); ?>
  <?php get_template_part('components/sponsors-slider'); ?>
  <?php get_template_part('components/section-events'); ?>
  <?php get_template_part('components/section-sports-banner'); ?>
  <?php get_template_part('components/section-training-programs'); ?>
  <?php get_template_part('components/section-member-benefits'); ?>
  <?php get_template_part('components/section-photo-banner-full-width'); ?>
  <?php get_template_part('components/section-community'); ?>
  <?php get_template_part('components/section-photo-banner-tall'); ?>
  <?php get_template_part('components/section-cta-banner'); ?>



</main>
<?php endwhile; ?>
<?php endif;?>
<?php get_footer();?>