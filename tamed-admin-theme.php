<?php
/*
Plugin Name: Tamed Admin Theme
Plugin URI:
Description: A basic, clean Wordpress admin theme
Version: 1.2
Author: Luc Awater
Author URI: http://lucawater.nl
Copyright: Luc Awater
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('tamed') ) {

  class tamed {

    /*
     * __construct
     *
     * Construct the plugin object
     */
    public function __construct() {
      // Render the settings template
      include_once('admin/settings.php');
      $tamed_settings = new tamed_settings();

      $plugin = plugin_basename(__FILE__);
      add_filter("plugin_action_links_$plugin", array( $this, 'plugin_settings_link' ));
    }

    /*
     * activate
     *
     * Activate the plugin
     */
    public static function activate() {
      // Do nothing
    }

    /*
     * deactivate
     *
     * Deactivate the plugin
     */
    public static function deactivate() {
      // Do nothing
    }

    // Add a settings link on the plugins page
    function plugin_settings_link($links) {
      $settings_link = '<a href="options-general.php?page=tamed-admin-theme">Settings</a>';
      array_unshift($links, $settings_link);
      return $links;
    }
  }
}


if( class_exists('tamed') ) {

  // Installation and uninstallation hooks
  register_activation_hook( __FILE__, array('tamed', 'activate') );
  register_deactivation_hook( __FILE__, array('tamed', 'deactivate') );

  // Add plugin base stylesheet
  function tamed_style() {
    wp_enqueue_style('tamed-admin-theme', plugins_url('css/tamed.css', __FILE__));
  }
  add_action('admin_enqueue_scripts', 'tamed_style');
  add_action('login_enqueue_scripts', 'tamed_style');

  // Add plugin chosen theme stylesheet
  function update_style() {
    $option_theme = get_option('tamed_theme');

    if( $option_theme ){
      wp_enqueue_style('tamed-admin-theme-' . $option_theme, plugins_url('css/tamed-' . $option_theme . '.css', __FILE__));
    }
  }
  add_action('admin_enqueue_scripts', 'update_style');
  add_action('login_enqueue_scripts', 'update_style');

  // Add plugin scripts
  function tamed_scripts() {
    wp_register_script('uploader', plugins_url('js/uploader.js', __FILE__));
    wp_enqueue_script('uploader');
    wp_enqueue_media();
  }
  add_action('admin_enqueue_scripts', 'tamed_scripts');

  // Change link value for login logo
  function my_login_logo_url() {
    return home_url();
  }
  add_filter( 'login_headerurl', 'my_login_logo_url' );

  // Add custom logo to login page
  function my_login_logo() { ?>
    <style type="text/css">
      .login #login h1 a {
        background-image: url(<?php echo get_option('tamed_logo'); ?>) !important;
      }
    </style>
  <?php }
  add_action( 'login_enqueue_scripts', 'my_login_logo' );

  // Instantiate the plugin class
  $tamed = new tamed();

}

?>
