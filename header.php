<head>
  <title>Golden Gate Triathlon Club</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/docs/assets/css/global.css" />
  <link href="light-mode-favicon.png" rel="icon" media="(prefers-color-scheme: light)">
  <link href="dark-mode-favicon.png" rel="icon" media="(prefers-color-scheme: dark)">
  <link href="light-mode-favicon.png" rel="icon" media="(prefers-color-scheme: no-preference)">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<header>
  <nav class="navbar navbar-expand-xl">
    <div class="container">
      <a class="navbar-brand" href="#">
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
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">About</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Mission &amp; Values</a></li>
              <li><a class="dropdown-item" href="#">Code of Conduct</a></li>
              <li><a class="dropdown-item" href="#">Board Members</a></li>
              <li><a class="dropdown-item" href="#">Ambassador Team</a></li>
              <li><a class="dropdown-item" href="#">Sponsors</a></li>
              <li><a class="dropdown-item" href="#">Social</a></li>
              <li><a class="dropdown-item" href="#">Triathlon Survival Checklist</a></li>
              <li><a class="dropdown-item" href="#">Donate</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">Calendar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Sports</a>
            <ul class="dropdown-menu">
              <li class=" dir">
                <div class="item">
                  <a class="dropdown-item" href="#" title="Swim"><span>Swim</span></a>
                  <ul class="secondLevel">
                    <li class=" ">
                      <div class="item">
                        <a class="dropdown-item" href="#" title="Swimming in Aquatic Park"><span>Swimming in Aquatic
                            Park</span></a>
                      </div>
                    </li>

                    <li class=" ">
                      <div class="item">
                        <a class="dropdown-item" href="#" title="Public Pool Schedule"><span>Public Pool
                            Schedule</span></a>
                      </div>
                    </li>

                    <li class=" ">
                      <div class="item">
                        <a class="dropdown-item" href="#" title="Becoming a Better Swimmer"><span>Becoming a Better
                            Swimmer</span></a>
                      </div>
                    </li>

                    <li class=" ">
                      <div class="item">
                        <a class="dropdown-item" href="#" title="Coached Swimming 101"><span>Coached Swimming
                            101</span></a>
                      </div>
                    </li>

                    <li class=" ">
                      <div class="item">
                        <a class="dropdown-item" href="#" title="Set Library"><span>Set Library</span></a>
                      </div>
                    </li>

                    <li class=" ">
                      <div class="item">
                        <a class="dropdown-item" href="#"
                          title="Registration Requirements for Thursday Swims"><span>Registration Requirements for
                            Thursday Swims</span></a>
                      </div>
                    </li>

                  </ul>
                </div>
              </li>

              <li class=" dir">
                <div class="item">
                  <a class="dropdown-item" href="#" title="Bike"><span>Bike</span></a>
                  <ul class="secondLevel">
                    <li class=" ">
                      <div class="item">
                        <a class="dropdown-item" href="#" title="Ride Rating System"><span>Ride Rating System</span></a>
                      </div>
                    </li>

                    <li class=" ">
                      <div class="item">
                        <a class="dropdown-item" href="#" title="Route Repo"><span>Route Repo</span></a>
                      </div>
                    </li>

                    <li class=" ">
                      <div class="item">
                        <a class="dropdown-item" href="#" title="Getting a Bike"><span>Getting a Bike</span></a>
                      </div>
                    </li>

                    <li class=" ">
                      <div class="item">
                        <a class="dropdown-item" href="#" title="Gearing Up"><span>Gearing Up</span></a>
                      </div>
                    </li>

                    <li class=" ">
                      <div class="item">
                        <a class="dropdown-item" href="#" title="Using GPS Routes"><span>Using GPS Routes</span></a>
                      </div>
                    </li>

                  </ul>
                </div>
              </li>

              <li class=" dir">
                <div class="item">
                  <a class="dropdown-item" href="#" title="Run"><span>Run</span></a>
                  <ul class="secondLevel">
                    <li class=" ">
                      <div class="item">
                        <a class="dropdown-item" href="#" title="Popular Routes"><span>Popular Routes</span></a>
                      </div>
                    </li>

                    <li class=" ">
                      <div class="item">
                        <a class="dropdown-item" href="#" title="Track Etiquette"><span>Track Etiquette</span></a>
                      </div>
                    </li>

                    <li class=" ">
                      <div class="item">
                        <a class="dropdown-item" href="#" title="Trail Running 101"><span>Trail Running 101</span></a>
                      </div>
                    </li>

                  </ul>
                </div>
              </li>

              <li class=" ">
                <div class="item">
                  <a class="dropdown-item" href="#" title="Strength Training"><span>Strength Training</span></a>
                </div>
              </li>

            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">Community</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Training Programs</a>
            <ul class="dropdown-menu">
              <li class="dropend">
                <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                  Short Distance Program
                </a>
                <ul class="">
                  <li><a class="dropdown-item" href="#">Sprint Training</a></li>
                  <li><a class="dropdown-item" href="#">Olympic Training</a></li>
                  <li><a class="dropdown-item" href="#">Beginner Friendly</a></li>
                </ul>
              </li>
              <li class="dropend">
                <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                  Women Tri Together
                </a>
                <ul class="">
                  <li><a class="dropdown-item" href="#">Program Overview</a></li>
                  <li><a class="dropdown-item" href="#">Schedule</a></li>
                  <li><a class="dropdown-item" href="#">Registration</a></li>
                </ul>
              </li>
              <li class="dropend">
                <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                  Long Distance Program
                </a>
                <ul class="">
                  <li><a class="dropdown-item" href="#">Half Ironman</a></li>
                  <li><a class="dropdown-item" href="#">Full Ironman</a></li>
                  <li><a class="dropdown-item" href="#">Ultra Distance</a></li>
                </ul>
              </li>
              <li><a class="dropdown-item" href="#">Century Program</a></li>
              <li><a class="dropdown-item" href="#">Marathon Training Program</a></li>
              <li><a class="dropdown-item" href="#">Trail Running Program</a></li>
              <li><a class="dropdown-item" href="#">1:1 Coaching</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">Why Join</a>
          </li>
        </ul>

        <div class="ms-auto ">
          <a href="#" class="btn btn-primary">Join Now</a>
          <a href="#" class="btn btn-outline-primary">Login</a>

        </div>


      </div>
    </div>
  </nav>
</header>