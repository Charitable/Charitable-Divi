<?php
/**
 * Plugin Name: 		Charitable - Divi Connect
 * Plugin URI:          https://github.com/Charitable/Charitable-Divi/
 * Description:         Customize the campaign template in Divi.
 * Version: 			0.3.0
 * Author: 				WP Charitable
 * Author URI: 			https://www.wpcharitable.com
 * Requires at least: 	5.4.1
 * Tested up to: 		5.4.1
 *
 * Text Domain: 		charitable-divi
 * Domain Path: 		/languages/
 *
 * @package 			Charitable Divi Connect
 * @category 			Core
 * @author 				Studio164a
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

/**
 * Load plugin class, but only if Charitable is found and activated.
 *
 * @return 	void
 * @since 	0.1.0
 */
function charitable_divi_load() {

	/* Check for Charitable */
	if ( ! class_exists( 'Charitable' ) ) {

		if ( ! class_exists( 'Charitable_Extension_Activation' ) ) {

			require_once 'includes/class-charitable-extension-activation.php';

		}

		$activation = new Charitable_Extension_Activation( plugin_dir_path( __FILE__ ), basename( __FILE__ ) );
		$activation = $activation->run();

	} elseif ( 'divi' != strtolower( wp_get_theme()->get_template() ) ) {

		// require_once 'includes/admin/class-divi-theme-activation.php';

		// $activation = new Charitable_Divi_Theme_Activation( plugin_dir_path( __FILE__ ), basename( __FILE__ ) );
		// $activation = $activation->run();

		// Do nothing
		return;

	} else {

		require_once( 'includes/class-charitable-divi.php' );

		new Charitable_Divi( __FILE__ );

	}
}

add_action( 'plugins_loaded', 'charitable_divi_load', 1 );
