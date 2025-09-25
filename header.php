<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/docs/assets/css/global.css" />
  <link href="light-mode-favicon.png" rel="icon" media="(prefers-color-scheme: light)">
  <link href="dark-mode-favicon.png" rel="icon" media="(prefers-color-scheme: dark)">
  <link href="light-mode-favicon.png" rel="icon" media="(prefers-color-scheme: no-preference)">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <header>
    <nav class="navbar navbar-expand-xl">
      <div class="container">
        <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
          <img src="<?php echo get_template_directory_uri(); ?>/docs/assets/img/ggtc-logo.svg"
            alt="Golden Gate Triathlon Club">
        </a>
        <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button> -->


        <!-- TODO - mega menu? -->

        <label for="toggle" class="navbar-toggler-label">☰</label>
        <input id="toggle" type="checkbox" class="navbar-toggler visually-hidden" />
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mb-2 mb-lg-0">

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="<?php echo get_permalink(313); ?>" data-bs-toggle="dropdown"
                data-bs-auto-close="outside">About</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?php echo get_permalink(328); ?>">Mission &amp; Values</a></li>
                <li><a class="dropdown-item" href="<?php echo get_permalink(337); ?>">Code of Conduct</a></li>
                <li><a class="dropdown-item" href="<?php echo get_permalink(315); ?>">Board Members</a></li>
                <li><a class="dropdown-item" href="<?php echo get_permalink(318); ?>">Ambassador Team</a></li>
                <li><a class="dropdown-item" href="/sponsors">Sponsors</a></li>
                <li><a class="dropdown-item" href="<?php echo get_permalink(339); ?>">Social</a></li>
                <li><a class="dropdown-item" href="<?php echo get_permalink(331); ?>">Triathlon Survival Checklist</a>
                </li>
                <li><a class="dropdown-item" href="#">Donate</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Calendar</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="<?php echo get_permalink(344); ?>" data-bs-toggle="dropdown"
                data-bs-auto-close="outside">Sports</a>
              <ul class="dropdown-menu">
                <li class=" dir">
                  <a class="dropdown-item" href="<?php echo get_permalink(346); ?>" title="Swim"><span>Swim</span></a>
                  <ul class="secondLevel">
                    <li class=" ">
                      <a class="dropdown-item" href="<?php echo get_permalink(349); ?>"
                        title="Swimming in Aquatic Park"><span>Swimming in Aquatic
                          Park</span></a>
                    </li>

                    <li class=" ">
                      <a class="dropdown-item" href="<?php echo get_permalink(358); ?>"
                        title="Public Pool Schedule"><span>Public Pool
                          Schedule</span></a>
                    </li>

                    <li class=" ">
                      <a class="dropdown-item" href="<?php echo get_permalink(361); ?>"
                        title="Becoming a Better Swimmer"><span>Becoming a Better
                          Swimmer</span></a>
                    </li>

                    <li class=" ">
                      <a class="dropdown-item" href="<?php echo get_permalink(364); ?>"
                        title="Coached Swimming 101"><span>Coached Swimming
                          101</span></a>
                    </li>

                    <li class=" ">
                      <a class="dropdown-item"
                        href="https://felixr.notion.site/Swim-Sets-0afb3bfeaf74436ab00f43d1ceb182d3" target="_blank"
                        title="Set Library"><span>Set Library <span>&neArr;</span></span></a>
                    </li>

                    <li class=" ">
                      <a class="dropdown-item" href="<?php echo get_permalink(372); ?>"
                        title="Registration Requirements for Thursday Swims"><span>Registration Requirements for
                          Thursday Swims</span></a>
                    </li>

                  </ul>
                </li>

                <li class=" dir">
                  <a class="dropdown-item" href="<?php echo get_permalink(410); ?>" title="Bike"><span>Bike</span></a>
                  <ul class="secondLevel">
                    <li class=" ">
                      <a class="dropdown-item" href="<?php echo get_permalink(413); ?>"
                        title="Ride Rating System"><span>Ride Rating
                          System</span></a>
                    </li>

                    <li class=" ">
                      <a class="dropdown-item" href="<?php echo get_permalink(422); ?>" title="Route Repo"><span>Popular
                          Cycling Routes</span></a>
                    </li>

                    <li class=" ">
                      <a class="dropdown-item" href="<?php echo get_permalink(425); ?>"
                        title="Getting a Bike"><span>Getting a Bike</span></a>
                    </li>

                    <li class=" ">
                      <a class="dropdown-item" href="<?php echo get_permalink(430); ?>" title="Gearing Up"><span>Gearing
                          Up</span></a>
                    </li>

                    <li class=" ">
                      <a class="dropdown-item" href="<?php echo get_permalink(428); ?>"
                        title="Using GPS Routes"><span>Using GPS Routes</span></a>
                    </li>

                  </ul>
                </li>

                <li class=" dir">
                  <a class="dropdown-item" href="#" title="Run"><span>Run</span></a>
                  <ul class="secondLevel">
                    <li class=" ">
                      <a class="dropdown-item" href="#" title="Popular Routes"><span>Popular Routes</span></a>
                    </li>

                    <li class=" ">
                      <a class="dropdown-item" href="#" title="Track Etiquette"><span>Track Etiquette</span></a>
                    </li>

                    <li class=" ">
                      <a class="dropdown-item" href="#" title="Trail Running 101"><span>Trail Running 101</span></a>
                    </li>

                  </ul>
                </li>

                <li class=" ">
                  <a class="dropdown-item" href="#" title="Strength Training"><span>Strength Training</span></a>
                </li>

              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">Community</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="<?php echo get_permalink(444); ?>"
                data-bs-toggle="dropdown">Training Programs</a>
              <ul class="dropdown-menu">
                <li class="dropend">
                  <a class="dropdown-item " href="<?php echo get_permalink(442); ?>">
                    Short Distance Program
                  </a>
                  <!-- <ul class="secondLevel">
                    <li><a class="dropdown-item" href="#">Sprint Training</a></li>
                    <li><a class="dropdown-item" href="#">Olympic Training</a></li>
                    <li><a class="dropdown-item" href="#">Beginner Friendly</a></li>
                  </ul> -->
                </li>
                <li class="dropend">
                  <a class="dropdown-item " href="<?php echo get_permalink(447); ?>">
                    Women Tri Together
                  </a>
                  <!-- <ul class="secondLevel">
                    <li><a class="dropdown-item" href="#">Program Overview</a></li>
                    <li><a class="dropdown-item" href="#">Schedule</a></li>
                    <li><a class="dropdown-item" href="#">Registration</a></li>
                  </ul> -->
                </li>
                <li class="dropend">
                  <a class="dropdown-item " href="<?php echo get_permalink(452); ?>">
                    Long Distance Program
                  </a>
                  <!-- <ul class="secondLevel">
                    <li><a class="dropdown-item" href="#">Half Ironman</a></li>
                    <li><a class="dropdown-item" href="#">Full Ironman</a></li>
                    <li><a class="dropdown-item" href="#">Ultra Distance</a></li>
                  </ul> -->
                </li>
                <li><a class="dropdown-item" href="<?php echo get_permalink(468); ?>">Century Program</a></li>
                <li><a class="dropdown-item" href="<?php echo get_permalink(471); ?>">Marathon Training Program</a></li>
                <li><a class="dropdown-item" href="<?php echo get_permalink(484); ?>">Trail Running Program</a></li>
                <li><a class="dropdown-item" href="#">1:1 Coaching</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">Why Join</a>
            </li>
          </ul>

          <div class="ms-xl-auto">
            <a href="#" class="btn btn-primary">Join Now</a>
            <a href="#" class="btn btn-outline-primary">Login</a>

          </div>


        </div>
      </div>
    </nav>
  </header>

  <script>
  // Handle dropdown links that should also navigate
  document.addEventListener('DOMContentLoaded', function() {
    const dropdownToggles = document.querySelectorAll('.nav-link.dropdown-toggle[href]');

    dropdownToggles.forEach(function(toggle) {
      let hoverTimeout;

      // Show dropdown on hover
      toggle.addEventListener('mouseenter', function() {
        clearTimeout(hoverTimeout);
        const dropdown = bootstrap.Dropdown.getOrCreateInstance(toggle);
        dropdown.show();
      });

      // Hide dropdown when mouse leaves
      toggle.addEventListener('mouseleave', function() {
        hoverTimeout = setTimeout(function() {
          const dropdown = bootstrap.Dropdown.getOrCreateInstance(toggle);
          dropdown.hide();
        }, 150); // Small delay to prevent flickering
      });

      // Also hide when mouse leaves the dropdown menu itself
      const dropdownMenu = toggle.nextElementSibling;
      if (dropdownMenu) {
        dropdownMenu.addEventListener('mouseleave', function() {
          hoverTimeout = setTimeout(function() {
            const dropdown = bootstrap.Dropdown.getOrCreateInstance(toggle);
            dropdown.hide();
          }, 150);
        });
      }

      // Allow the link to work normally on direct click
      toggle.addEventListener('click', function(e) {
        // If it's a direct click (not from dropdown), navigate
        if (e.target === toggle) {
          window.location.href = toggle.href;
        }
      });
    });
  });
  </script>