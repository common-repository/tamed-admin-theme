<div class="wrap tamed-wrap">
  <h2>Tamed Admin Theme / settings</h2>
  <form method="post" action="options.php">
  <?php
    // This prints out all hidden setting fields
    settings_fields( 'tamed_options' );
    ?>
    <div class="tamed-box">
      <div class="tamed-box-header">
        <h2>Choose a layout</h2>
      </div>

      <div class="tamed-box-body">
        <input type="radio" id="theme_default" name="tamed_theme" value="default" <?php checked('default', get_option('tamed_theme'), true); ?>>
        <label for="theme_default">
          <img src="<?php echo plugins_url( 'assets/images/theme-default.svg', dirname(__FILE__) ); ?>">
          Default
        </label>

        <input type="radio" id="theme_light" name="tamed_theme" value="light" <?php checked('light', get_option('tamed_theme'), true); ?>>
        <label for="theme_light">
          <img src="<?php echo plugins_url( 'assets/images/theme-light.svg', dirname(__FILE__) ); ?>">
          Light
        </label>
      </div>
    </div>

    <div class="tamed-box">
      <div class="tamed-box-header">
        <h2>Custom login screen</h2>
        <p>Choose a logo and a background color/image to personalize your login screen</p>
      </div>

      <div class="tamed-box-body">
        <input id="upload_image" type="text" size="36" name="tamed_logo" value="<?php echo esc_url( get_option('tamed_logo') ); ?>" />
        <input id="upload_image_button" class="button" type="button" value="Choose logo" />

        <div id="tamed-logo-preview">
          <img style="max-width:100%;" src="<?php echo esc_url( get_option('tamed_logo') ); ?>" />
        </div>
      </div>
    </div>

    <?php
    submit_button();
  ?>
  </form>
</div>