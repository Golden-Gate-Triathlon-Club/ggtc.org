<section id="events" class="events bg-dark text-light padding-y-100">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <h2>
          <span class="eyebrow"> Want to check us out? </span>
          Upcoming Events
        </h2>


        <?php //echo do_shortcode('[ESPRESSO_EVENTS show_desc=false show_tickets=false show_expired=false limit=5]'); ?>

        <?php
        $upcoming_events = array();
        if ( class_exists( 'EEM_Event' ) ) {
            $upcoming_events = EEM_Event::instance()->get_active_and_upcoming_events(
                array(
                    'limit'    => 5,
                    'order_by' => 'Datetime.DTT_EVT_start',
                    'order'    => 'ASC',
                    'group_by' => 'EVT_ID',
                )
            );
        }

        $featured_events = get_sub_field( 'featured_event' );
        $featured_post   = is_array( $featured_events ) ? reset( $featured_events ) : $featured_events;
        ?>

        <?php if ( $upcoming_events ) : ?>
        <table class="table table-dark table-striped event-table">
          <thead>
            <tr>
              <th scope="col">Date</th>
              <th scope="col">Event</th>
              <th scope="col">Location</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ( $upcoming_events as $event ) : ?>
            <?php
              $first_datetime = $event->get_first_related('Datetime');
              $venue = $event->get_first_related('Venue');

              $date = $first_datetime ? $first_datetime->get_i18n_datetime( 'DTT_EVT_start', 'n/j/y' ) : '';
              $location = $venue ? $venue->name() : 'No Location Set';
              $title = $event->name();

              $category = $event->first_event_category();
              $sport = $category ? $category->name() : '';

              $sport_icon_class = '';
              if ( $sport ) {
                switch ( strtolower( $sport ) ) {
                  case 'run':
                    $sport_icon_class = 'fa-person-running';
                    break;
                  case 'swim':
                    $sport_icon_class = 'fa-person-swimming';
                    break;
                  case 'bike':
                    $sport_icon_class = 'fa-person-biking';
                    break;
                  case 'social':
                    $sport_icon_class = 'fa-user-group';
                    break;
                }
              }
            ?>
            <tr>
              <td><?php echo esc_html( $date ); ?></td>
              <td>
                <a href="<?php echo esc_url( $event->get_permalink() ); ?>">
                  <?php if ( $sport_icon_class ) : ?><i
                    class="fa-solid <?php echo esc_attr( $sport_icon_class ); ?>"></i>
                  <?php endif; ?>
                  <?php echo esc_html( $title ); ?></a>
              </td>
              <td><?php echo esc_html( $location ); ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php else : ?>
        <p>No upcoming events found.</p>
        <?php endif; ?>

        <div class="text-center mt-5">
          <a href="<?php echo esc_url( get_permalink( 68 ) ); ?>" class="btn btn-primary">View Calendar</a>
        </div>
      </div>

      <div class="col-lg-4">
        <?php if ( $featured_post ) : ?>
        <?php
          $featured_title = get_the_title( $featured_post );
          $featured_link  = get_permalink( $featured_post );
          $featured_sport = get_the_terms( $featured_post, 'espresso_event_categories' );
          $featured_sport = is_array( $featured_sport ) ? reset( $featured_sport ) : $featured_sport;
          $featured_sport = $featured_sport ? $featured_sport->name : '';

          $featured_sport_icon_class = '';
          if ( $featured_sport ) {
            switch ( strtolower( $featured_sport ) ) {
              case 'run':
                $featured_sport_icon_class = 'fa-person-running';
                break;
              case 'swim':
                $featured_sport_icon_class = 'fa-person-swimming';
                break;
              case 'bike':
                $featured_sport_icon_class = 'fa-person-biking';
                break;
              case 'social':
                $featured_sport_icon_class = 'fa-user-group';
                break;
            }
          }

          $featured_desc  = get_the_excerpt( $featured_post );
          if ( ! $featured_desc ) {
            $featured_desc = wp_trim_words( wp_strip_all_tags( $featured_post->post_content ), 40 );
          }
        ?>
        <div class="featured-event">
          <h3><?php if ( $featured_sport_icon_class ) : ?><i
              class="fa-solid <?php echo esc_attr( $featured_sport_icon_class ); ?>"></i>
            <?php endif; ?><?php echo esc_html( $featured_title ); ?></h3>
          <?php if ( $featured_desc ) : ?>
          <p><?php echo esc_html( $featured_desc ); ?></p>
          <?php endif; ?>
          <div class="">
            <a href="<?php echo esc_url( $featured_link ); ?>" class="btn btn-secondary">Register</a>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>