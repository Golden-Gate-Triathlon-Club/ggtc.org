<?php 
  $photo_banner_photo = get_sub_field("photo_banner_photo");
?>


<?php
if ($photo_banner_photo) {
  ?>
<section id="photo-banner-full-width-<?php echo get_row_index(); ?>"
  class="section-<?php echo get_row_index(); ?> photo-banner-full-width">
  <img src="<?php echo $photo_banner_photo['url']; ?>" alt="<?php echo $photo_banner_photo['alt']; ?>">
</section>
<?php
}
?>