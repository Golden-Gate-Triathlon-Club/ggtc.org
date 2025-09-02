<?php 
$section_background_color = get_sub_field("section_background_color"); 
// $cta_banner_headline = get_sub_field("cta_banner_headline");
// $cta_button_link = get_sub_field('cta_button_link');
// $cta_banner_button_url = isset($cta_button_link['url']) ? $cta_button_link['url'] : '';
// $cta_banner_button_text = isset($cta_button_link['title']) ? $cta_button_link['title'] : '';
// $cta_banner_button_target = isset($cta_button_link['target']) ? $cta_button_link['target'] : '_self';
// $cta_banner_button_color = get_sub_field("cta_button_color");
?>

<section id="intro" class="intro padding-y-100 <?php echo $section_background_color; ?>">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">

        <?php if (get_sub_field("text_section_content")) : ?>
        <?php the_sub_field("text_section_content"); ?>
        <?php endif; ?>
        <!-- <h1 class="">We are <span class="highlight">GGTC</span></h1>
        <div class="row">
          <div class="col-lg-12">
            <p class="lead">
              Swim, Bike, Run, Fun! 4 Clubs in one! Intro text that gives visitors a brief overview of golden gate
              triathlon club. I like to think that we
              are
              a pretty cool group of people who like to swim, bike and run. We have weekly coached workouts and
              social
              gatherings. Join us. It's super fun.
            </p>

            <a href="#" class="btn btn-primary">Learn More about GGTC</a>
          </div>

        </div> -->
      </div>
    </div>
  </div>
</section>