<?php
/**
 * Plugin Name: Test Plugin
 * Description: This plugin allows user to download woocommerce order details in pdf version.
 * Version: 1.0.1
 * Author: Jitendra
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */



register_activation_hook(__FILE__, 'testplugin_activate');

function testplugin_activate()
{   

    if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
    include_once( ABSPATH . '/wp-admin/includes/plugin.php' );
  }
  if ( current_user_can( 'activate_plugins' ) && ! class_exists( 'WooCommerce' ) ) {
    // Deactivate the plugin.
    deactivate_plugins( plugin_basename( __FILE__ ) );
    // Throw an error in the WordPress admin console.
    $error_message = '<p style="font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Oxygen-Sans,Ubuntu,Cantarell,\'Helvetica Neue\',sans-serif;font-size: 13px;line-height: 1.5;color:#444;">' . esc_html__( 'This plugin requires ', 'tstp' ) . '<a href="' . esc_url( 'https://wordpress.org/plugins/woocommerce/' ) . '">WooCommerce</a>' . esc_html__( ' plugin to be active.', 'tstp' ) . '</p>';
    die( $error_message ); // WPCS: XSS ok.
  } else {

    set_transient( 'plugin_activation_message', true, 5 );
  }
} 

add_action( 'admin_notices', 'plugin_activation_message_notice' );

function plugin_activation_message_notice(){


    if( get_transient( 'plugin_activation_message' ) ){
        ?>
        <div class="updated notice is-dismissible">
            <p>Thank you for using this plugin! <strong>Please check woocommerce order table</strong>.</p>
        </div>
        <?php
        delete_transient( 'plugin_activation_message' );
    }
}



define('TSTP', plugin_dir_path(__FILE__));
require_once(TSTP . 'functions.php');