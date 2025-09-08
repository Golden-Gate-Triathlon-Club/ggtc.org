<?php get_header();?>
<?php if (have_posts()) : while ( have_posts() ) : the_post();?>

<?php
$hero_found = false;
if( have_rows('components') ):
    while( have_rows('components') ): the_row();
        if( get_row_layout() == 'hero' ):
            $hero_found = true;
            get_template_part('components/hero'); 
        endif;
    endwhile;
endif;

// If no hero component was found, show default hero
if (!$hero_found) :
    get_template_part('components/hero-default');
endif;
?>
<?php get_template_part('components/breadcrumbs'); ?>
<main id="site-content" role="main">
  <?php get_template_part('components/all-components'); ?>
</main>
<?php endwhile; ?>
<?php endif;?>
<?php get_footer();?>