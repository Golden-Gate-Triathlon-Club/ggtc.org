<?php
/**
 * Restricted Content Component
 * Displays a message when content is restricted to logged-in users only
 */
?>

<div class="login-required">
  <p>This content is restricted to members only. Please <a href="<?php echo wp_login_url(get_permalink()); ?>">log
      in</a> to view details.</p>
</div>