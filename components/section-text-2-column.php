<?php 
$section_background_color = get_sub_field("section_background_color"); 
?>

<section id="text-2-column-<?php echo get_row_index(); ?>"
  class="text-column text-2-column padding-y-100 <?php echo $section_background_color; ?>">
  <div class="container">
    <div class="row">
      <?php if (get_sub_field("text_section_headline")) : ?>
      <div class="col-lg-12">
        <h2><?php the_sub_field("text_section_headline"); ?></h2>
      </div>
      <?php endif; ?>
      <div class="col-lg-6">
        <?php if (get_sub_field("text_section_content_left")) : ?>
        <?php the_sub_field("text_section_content_left"); ?>
        <?php endif; ?>
      </div>
      <div class="col-lg-6">
        <?php if (get_sub_field("text_section_content_right")) : ?>
        <?php the_sub_field("text_section_content_right"); ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>