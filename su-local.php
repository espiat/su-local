<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://gutenberg-wp.com
 * @since             1.0.0
 * @package           Su_Local
 *
 * @wordpress-plugin
 * Plugin Name:       Shortcode Ultimate local libaries
 * Plugin URI:        su-local
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            espiat
 * Author URI:        https://gutenberg-wp.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       su-local
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );
define( 'PLUG_PATH', plugin_dir_path( __FILE__ ) );
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-su-local-activator.php
 */
function activate_su_local() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-su-local-activator.php';
	Su_Local_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-su-local-deactivator.php
 */
function deactivate_su_local() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-su-local-deactivator.php';
	Su_Local_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_su_local' );
register_deactivation_hook( __FILE__, 'deactivate_su_local' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-su-local.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_su_local() {

	$plugin = new Su_Local();
	$plugin->run();

}
run_su_local();

// this is NEW 

	// if plugin shortcode ultimate is active and installed? If not deactivate
	add_action( 'admin_init', 'child_plugin_has_parent_plugin' );
			function child_plugin_has_parent_plugin() {
			    if ( is_admin() && current_user_can( 'activate_plugins' ) &&  !is_plugin_active( 'shortcodes-ultimate/shortcodes-ultimate.php' ) ) {
			        add_action( 'admin_notices', 'child_plugin_notice' );

			        deactivate_plugins( plugin_basename( __FILE__ ) ); 

			        if ( isset( $_GET['activate'] ) ) {
			            unset( $_GET['activate'] );
			        }
			    }
			}

	function child_plugin_notice(){
			    ?><div class="error"><p>Sorry, but this Plugin needs the SU Local Plugin requires the "Shortcode Ultimate" plugin to be installed and active.</p></div><?php
			}
	// deregister the parent font awesome


		// wp_register_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', false, '4.7.0', 'all' );


add_action( 'wp_head', 'font_awesome_stylesheet', 10 );
function font_awesome_stylesheet() {
    
     wp_deregister_style( 'font-awesome' );
    wp_dequeue_style( 'font-awesome' );
 
  
}

add_action( 'wp_enqueue_scripts', 'font_awesome_new_font', 10 );
function font_awesome_new_font() {
    

 
    //wp_register_style( 'new-fontawesome', PLUG_PATH . 'public/css/fontawesome.min.css', false, '5.0.13' ); 
 

    wp_register_style( 'font-awesome', PLUG_PATH . 'public/font-awesome-4.7.0/css/font-awesome.min.css', false, '4.7.0' ); 


    wp_enqueue_style( 'font-awesome' );
}

	// register script locally, happily - in love to franziska 





