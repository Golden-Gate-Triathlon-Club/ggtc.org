<section id="community" class="community-banner padding-y-100">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <h2>
          <span class="eyebrow">
            Looking to socialize?
          </span>
          Our Community
        </h2>
        <p>From happy hours, beer miles, end-of-year parties, and costume races, we know how to have fun too.
          Don't just work hard with your team, but get to know them in fun social settings at our events around San
          Francisco!
        </p>

        <p>
          <a href="#" class="btn btn-primary">Learn More about our Social Events</a>
        </p>

      </div>
      <div class="col-lg-6">
        <div class="swiper-community-slider">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <img src="https://placehold.co/600x400?text=Photo1" alt="">
            </div>
            <div class="swiper-slide">
              <img src="https://placehold.co/600x400?text=Photo2" alt="">
            </div>
            <div class="swiper-slide">
              <img src="https://placehold.co/600x400?text=Photo3" alt="">
            </div>
          </div>
          <div class="swiper-pagination-2"></div>

        </div>

        <script>
          const swiperCommunity = new Swiper('.swiper-community-slider', {
            speed: 400,
            spaceBetween: 0,
            loop: true,
            effect: 'fade',
            fadeEffect: {
              crossFade: true
            },
            autoplay: {
              delay: 5000,
              disableOnInteraction: true,
            },
            pagination: {
              el: ".swiper-pagination-2",
              clickable: true,
            },
          });
        </script>
      </div>
    </div>
  </div>
</section>
