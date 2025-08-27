<section id="sponsors" class="sponsors-slider padding-y-100">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h2 class="text-center">GGTC Club Sponsors</h2>
        <p class="text-center">
          Short blurb about our sponsors and how they support us. Lorem ipsum dolor sit amet consectetur adipisicing
          elit. Quisquam, quos.
        </p>

        <div class="swiper swiper-sponsors-slider">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <img src="https://placehold.co/150x100?text=Logo1" alt="">
            </div>
            <div class="swiper-slide">
              <img src="https://placehold.co/150x100?text=Logo2" alt="">
            </div>
            <div class="swiper-slide">
              <img src="https://placehold.co/150x100?text=Logo3" alt="">
            </div>
            <div class="swiper-slide">
              <img src="https://placehold.co/150x100?text=Logo4" alt="">
            </div>
            <div class="swiper-slide">
              <img src="https://placehold.co/150x100?text=Logo5" alt="">
            </div>
            <div class="swiper-slide">
              <img src="https://placehold.co/150x100?text=Logo6" alt="">
            </div>
            <div class="swiper-slide">
              <img src="https://placehold.co/150x100?text=Logo7" alt="">
            </div>
            <div class="swiper-slide">
              <img src="https://placehold.co/150x100?text=Logo8" alt="">
            </div>
            <div class="swiper-slide">
              <img src="https://placehold.co/150x100?text=Logo9" alt="">
            </div>
            <div class="swiper-slide">
              <img src="https://placehold.co/150x100?text=Logo10" alt="">
            </div>
          </div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
        </div>

        <p class="text-center">
          <a href="#" class="btn btn-primary">View All Sponsors</a>
        </p>

      </div>
    </div>
  </div>

</section>
<script>
const swiperSponsors = new Swiper('.swiper-sponsors-slider', {
  slidesPerView: 2,
  spaceBetween: 20,
  autoHeight: true,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  loop: true,
  breakpoints: {

    991: {
      slidesPerView: 4,
    }
  }
});
</script>