<?php get_header(); ?>

<section class="hero">
  <img src="<?php echo get_template_directory_uri(); ?>/docs/assets/img/page-hero-run.webp" alt="">
  <div class="caption">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="entry-title">
            <span>Club Leadership</span>
          </h1>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_template_part('components/breadcrumbs'); ?>

<main id="site-content" role="main" class="padding-y-100">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">

        <?php if (have_posts()) : ?>



        <!-- Profiles Grid -->
        <?php
          // Define profile levels in order
          $profile_level_order = array('board-member', 'ambassador');
          
          // Get all profile types
          $all_profile_types = get_terms(array(
            'taxonomy' => 'profile-type',
            'hide_empty' => false,
          ));
          
          // Create a mapping of slug to term object
          $level_map = array();
          if ($all_profile_types && !is_wp_error($all_profile_types)) {
            foreach ($all_profile_types as $level) {
              $level_map[$level->slug] = $level;
            }
          }
          
          // Loop through profile levels in specified order
          foreach ($profile_level_order as $level_slug) {
            if (isset($level_map[$level_slug])) {
              $level = $level_map[$level_slug];
              
              // Get profiles for this level
              $profiles_in_level = get_posts(array(
                'post_type' => 'profile',
                'numberposts' => -1,
                'post_status' => 'publish',
                'orderby' => 'title',
                'order' => 'ASC',
                'tax_query' => array(
                  array(
                    'taxonomy' => 'profile-type',
                    'field'    => 'slug',
                    'terms'    => $level_slug,
                  ),
                ),
              ));
              
              if (!empty($profiles_in_level)) :
          ?>

        <!-- <?php echo esc_html($level->name); ?> Profiles -->
        <div class="profile-level-section mb-5">
          <h2 id="<?php echo esc_attr($level_slug === 'board-member' ? 'board-members' : 'ambassadors'); ?>"
            class="profile-level-title mb-4">
            <?php 
              // Make taxonomy terms plural
              $plural_name = $level->name;
              if ($level_slug === 'board-member') {
                $plural_name = 'Board Members';
              } elseif ($level_slug === 'ambassador') {
                $plural_name = 'Ambassadors';
              }
              echo esc_html($plural_name); 
              ?></h2>
          <hr>
          <div class="board-bio-list">
            <?php 
             $profiles_array = $profiles_in_level;
             $profile_index = 1;
             
             // Group profiles in sets of three
             for ($i = 0; $i < count($profiles_array); $i += 3) {
               $group = array_slice($profiles_array, $i, 3);
               
               // Output the three cards in this group
               foreach ($group as $profile_post) {
                 setup_postdata($profile_post);
                 $profile_headshot = get_field('profile_headshot', $profile_post->ID);
                 $board_position_title = get_field('board_position_title', $profile_post->ID);
                 $email = get_field('email', $profile_post->ID);
                 $profile_bio = get_field('profile_bio', $profile_post->ID);
                 $pronouns = get_field('pronouns', $profile_post->ID);
                 $strava = get_field('strava', $profile_post->ID);
             ?>

            <div
              class="card bio-card bio-card-<?php echo $profile_index; ?> <?php //echo $profile_index === 1 ? 'selected' : ''; ?>"
              data-id="<?php echo esc_attr($level_slug); ?>-<?php echo $profile_index; ?>">
              <?php if ($email || $strava) : ?>
              <span class="badge text-bg-light">
                <?php if ($email) : ?>
                <a href="mailto:<?php echo esc_html($email); ?>">
                  <svg class="icon email-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                    <path
                      d="M112 128C85.5 128 64 149.5 64 176C64 191.1 71.1 205.3 83.2 214.4L291.2 370.4C308.3 383.2 331.7 383.2 348.8 370.4L556.8 214.4C568.9 205.3 576 191.1 576 176C576 149.5 554.5 128 528 128L112 128zM64 260L64 448C64 483.3 92.7 512 128 512L512 512C547.3 512 576 483.3 576 448L576 260L377.6 408.8C343.5 434.4 296.5 434.4 262.4 408.8L64 260z" />
                  </svg>
                </a>
                <?php endif; ?>
                <?php if ($strava) : ?>
                <a href="<?php echo esc_url($strava); ?>" target="_blank">
                  <svg class="icon strava-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                    <path
                      d="M286.4 64L135 356L224.2 356L286.4 239.9L348.1 356L436.6 356L286.4 64zM436.6 356L392.7 444.2L348.1 356L280.5 356L392.7 576L504.2 356L436.6 356z" />
                  </svg>
                </a>
                <?php endif; ?>
              </span>
              <?php endif; ?>
              <?php if ($profile_headshot) : ?>
              <img class="card-img-top" src="<?php echo esc_url($profile_headshot['sizes']['large']); ?>"
                alt="<?php echo esc_attr($profile_headshot['alt'] ?: $profile_post->post_title); ?>">
              <?php endif; ?>

              <div class="card-body">
                <h3><?php echo esc_html($profile_post->post_title); ?>
                  <?php if ($pronouns) : ?>
                  <span class="text-muted"><small><?php echo esc_html($pronouns); ?></small></span>
                  <?php endif; ?>

                </h3>
                <?php if ($board_position_title) : ?>
                <p><?php echo esc_html($board_position_title); ?></p>
                <?php endif; ?>
              </div>
            </div>

            <?php 
               $profile_index++;
               }
               
               // Output the bio-details for this group of three
               for ($j = 1; $j <= count($group); $j++) {
                 $current_profile = $group[$j-1];
                 setup_postdata($current_profile);
                 $current_headshot = get_field('profile_headshot', $current_profile->ID);
                 $current_bio = get_field('profile_bio', $current_profile->ID);
                 $bio_index = $profile_index - count($group) + $j - 1;
             ?>

            <div id="<?php echo esc_attr($level_slug); ?>-<?php echo $bio_index; ?>"
              class="bio-details bio-details-<?php echo $bio_index; ?>" style="display: none">
              <div class="island bg-light text-dark">


                <?php if ($current_bio) : ?>
                <?php echo wp_kses_post($current_bio); ?>
                <?php else : ?>
                <p>No Bio Information available</p>
                <?php endif; ?>
              </div>
            </div>

            <?php 
               }
             }
             ?>
          </div>
        </div>

        <?php endif; wp_reset_postdata(); } } ?>

        <?php else : ?>

        <div class="no-profiles">
          <h2>No Profiles Found</h2>
          <p>We're working on adding our leadership profiles. Check back soon!</p>
        </div>

        <?php endif; ?>

      </div>
    </div>
  </div>
</main>

<script>
// when you click on a bio card, show the bio card with the data-id
const bioCards = document.querySelectorAll(".bio-card")
bioCards.forEach((card) => {
  card.addEventListener("click", () => {
    // add class of selected to the bio card that was clicked and remove it from all other bio cards
    bioCards.forEach((card) => {
      card.classList.remove("selected")
    })
    card.classList.add("selected")

    // hide all bio-details
    const bioDetails = document.querySelectorAll(".bio-details")
    bioDetails.forEach((detail) => {
      detail.style.display = "none"
    })
    // show the bio-details with the data-id
    const id = card.getAttribute("data-id")
    const bio = document.getElementById(id)
    if (bio) {
      bio.style.display = "block"
    }
  })
})
</script>



<?php get_footer(); ?>