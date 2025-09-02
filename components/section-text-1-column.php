<?php 
$section_background_color = get_sub_field("section_background_color"); 
?>

<section id="intro" class="intro padding-y-100 <?php echo $section_background_color; ?>">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">

        <?php if (get_sub_field("text_section_content")) : ?>
        <?php the_sub_field("text_section_content"); ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>