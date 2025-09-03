<?php get_header();?>

<?php get_template_part('components/breadcrumbs'); ?>

<main id="site-content" role="main">
  <?php if (have_posts()) : while ( have_posts() ) : the_post();?>
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
      <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    </header>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
  </article>
  <?php endwhile; ?>
  <?php endif;?>
</main>

<?php get_footer();?>