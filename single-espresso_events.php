<?php
/**
 * Template for single Event Espresso events
 * Place this file in your active theme root as:
 * single-espresso_events.php
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

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
    get_template_part('components/hero-no-img');
endif;
?>
<?php get_template_part('components/breadcrumbs'); ?>

<main id="site-content" role="main" class="site-main espresso-single-event">
  <?php while ( have_posts() ) : the_post(); ?>


  <div class="container">
    <div class="row">
      <div class="col-lg-12">

        <article id="post-<?php the_ID(); ?>" <?php post_class( 'espresso-single-event__article' ); ?>>
          <div class="row">
            <div class="col-lg-6">
              <div class="espresso-single-event__dates">
                <?php
                  if ( function_exists( 'espresso_list_of_event_dates' ) ) {
                    espresso_list_of_event_dates();
                  } elseif ( function_exists( 'espresso_event_date_range' ) ) {
                    espresso_event_date_range();
                  }
                ?>
              </div>
            </div>


            <div class="col-lg-6">
              <div class="espresso-single-event__ticket-selector">
                <?php
                    if ( function_exists( 'espresso_ticket_selector' ) ) {
                      espresso_ticket_selector();
                    } elseif ( shortcode_exists( 'ESPRESSO_TICKET_SELECTOR' ) ) {
                      echo do_shortcode( '[ESPRESSO_TICKET_SELECTOR]' );
                    }
                  ?>
              </div>
            </div>
          </div>

          <section class="espresso-single-event__meta">


            <section class="espresso-single-event__content">
              <?php the_content(); ?>
            </section>

            <div class="espresso-single-event__venue">
              <?php
                // espresso_event_venues() returns an array; the venue block is the venues template partial.
                if ( class_exists( 'EEH_Template' ) ) {
                  echo EEH_Template::locate_template( 'content-espresso_events-venues.php' );
                }
              ?>
            </div>
          </section>



        </article>

      </div>
    </div>
  </div>

  <?php endwhile; ?>
</main>
<?php get_footer(); ?>