<?php
/**
 * Section Cards Component
 * Uses ACF flexible content fields for dynamic content management
 */
?>


<?php 
$before_cards_content = get_sub_field("before_cards_content"); 
$cards = get_sub_field("cards");
$after_cards_content = get_sub_field("after_cards_content");
?>

<section id="cards-<?php echo get_row_index(); ?>" class="cards-banner padding-y-100">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <?php if ($before_cards_content) : ?>
        <?php echo acf_esc_html($before_cards_content); ?>
        <?php endif; ?>
      </div>
      <?php if ($cards) : ?>
      <?php foreach ($cards as $card) : ?>
      <?php
        $card_fields = isset($card['card']) ? $card['card'] : array();
        $card_image = isset($card_fields['card_image']) ? $card_fields['card_image'] : null;
        $card_content = isset($card_fields['card_content']) ? $card_fields['card_content'] : '';
        $card_cta = isset($card_fields['card_cta']) ? $card_fields['card_cta'] : array();
        $card_cta_link = isset($card_cta['cta_button_link']) ? $card_cta['cta_button_link'] : array();
        $card_cta_url = isset($card_cta_link['url']) ? $card_cta_link['url'] : '';
        $card_cta_title = isset($card_cta_link['title']) ? $card_cta_link['title'] : '';
        $card_cta_target = isset($card_cta_link['target']) ? $card_cta_link['target'] : '_self';
        $card_cta_color = isset($card_cta['cta_button_color']) ? $card_cta['cta_button_color'] : 'btn-primary';
      ?>
      <div class="col">
        <div class="card h-100">
          <?php if ($card_image) : ?>
          <img src="<?php echo esc_url($card_image['url']); ?>" alt="<?php echo esc_attr($card_image['alt']); ?>"
            class="card-img-top" />
          <?php endif; ?>
          <div class="card-body">
            <?php if ($card_content) : ?>
            <?php echo acf_esc_html($card_content); ?>
            <?php endif; ?>

            <?php if ($card_cta_url) : ?>
            <a href="<?php echo esc_url($card_cta_url); ?>" target="<?php echo esc_attr($card_cta_target); ?>"
              class="btn <?php echo esc_attr($card_cta_color); ?>">
              <?php echo esc_html($card_cta_title); ?>
            </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
      <?php endif; ?>

      <div class="col-lg-12">
        <div class="text-center mt-5">
          <?php if ($after_cards_content) : ?>
          <?php echo acf_esc_html($after_cards_content); ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>