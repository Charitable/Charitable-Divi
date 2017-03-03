<?php
/**
 * Charitable Divi Public class.
 *
 * @package     Charitable Divi/Classes/Charitable_Divi_Public
 * @version     0.1.0
 * @author      Eric Daams
 * @copyright   Copyright (c) 2015, Studio 164a
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if ( ! class_exists( 'Charitable_Divi_Public' ) ) :

	/**
	 * Charitable Public class.
	 *
	 * @final
	 * @since       0.1.0
	 */
	final class Charitable_Divi_Public {

		/**
		 * The single instance of this class.
		 *
		 * @var     Charitable_Divi_Public|null
		 * @access  private
		 * @static
		 */
		private static $instance = null;

		/**
		 * Returns and/or create the single instance of this class.
		 *
		 * @return  Charitable_Divi_Public
		 * @access  public
		 * @since   0.1.0
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new Charitable_Divi_Public();
			}

			return self::$instance;
		}

		/**
		 * Set up the class.
		 *
		 * @access  private
		 * @since   0.1.0
		 */
		private function __construct() {
			add_filter( 'template_include', array( $this, 'load_default_campaign_template' ), 20 );
			add_filter( 'body_class', array( $this, 'set_campaign_body_class' ), 20 );
			add_action( 'after_setup_theme', array( $this, 'load_dependencies' ) );
			add_action( 'after_setup_theme', array( $this, 'unhook_default_templates' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'register_styles' ) );

			remove_action( 'charitable_campaign_summary', 'charitable_template_campaign_percentage_raised', 4 );
			remove_action( 'charitable_campaign_summary', 'charitable_template_campaign_time_left', 10 );
		}

		/**
		 * Load the default campaign template.
		 *
		 * Themes should be override this template simply by creating a single-campaign.php
		 * template in their root directory.
		 *
		 * @return  string $template
		 * @access  public
		 * @since   0.1.0
		 */
		public function load_default_campaign_template( $template ) {
			if ( ! is_singular( Charitable::CAMPAIGN_POST_TYPE ) ) {
				return $template;
			}

			if ( charitable_is_page( 'campaign_donation_page', array( 'strict' => true ) ) ) {
				$template_name = 'campaign-donation-page.php';
			} else {
				$template_name = 'single-campaign.php';
			}

			$divi_template = new Charitable_Divi_Template( $template_name, false );
			$divi_template = $divi_template->locate_template();

			if ( is_readable( $divi_template ) ) {
				$template = $divi_template;
			}

			return $template;
		}

		/**
		 * Set the campaign body class.
		 *
		 * @param   array $classes
		 * @return  array $classes
		 * @access  public
		 * @since   0.1.0
		 */
		public function set_campaign_body_class( $classes ) {
			if ( ! is_singular( Charitable::CAMPAIGN_POST_TYPE ) ) {
				return $classes;
			}

			foreach ( array( 'et_right_sidebar', 'et_left_sidebar', 'et_full_width_page' ) as $layout_class ) {
				$idx = array_search( $layout_class, $classes );

				if ( $idx ) {
					unset( $classes[ $idx ] );
				}
			}

			$layout = charitable_get_option( 'campaign_layout', 'full-width' );

			switch ( $layout ) {

				case 'right-sidebar' :
					$classes[] = 'et_right_sidebar';
					break;

				case 'left-sidebar' :
					$classes[] = 'et_left_sidebar';
					break;

				default :
					$classes[] = 'et_full_width_page';

			}

			return $classes;
		}

		/**
		 * Load dependencies once the theme has been loaded.
		 *
		 * @return  void
		 * @access  public
		 * @since   0.1.0
		 */
		public function load_dependencies() {

			$includes_path = charitable_divi()->get_path( 'includes' ) . 'public/';

			require_once( $includes_path . 'charitable-divi-template-functions.php' );
			require_once( $includes_path . 'charitable-divi-template-hooks.php' );
		}

		/**
		 * Remove default Charitable templates.
		 *
		 * @return  void
		 * @access  public
		 * @since   0.1.0
		 */
		public function unhook_default_templates() {
			add_filter( 'charitable_use_campaign_template', '__return_false' );

			remove_action( 'charitable_campaign_content_before', 'charitable_template_campaign_summary', 6 );
			remove_action( 'charitable_campaign_summary', 'charitable_template_campaign_percentage_raised', 4 );
			remove_action( 'charitable_campaign_summary', 'charitable_template_campaign_time_left', 10 );

			remove_action( 'charitable_campaign_content_loop_after', 'charitable_template_campaign_progress_bar', 6 );
			remove_action( 'charitable_campaign_content_loop_after', 'charitable_template_campaign_loop_donation_stats', 8 );
		}

		/**
		 * Loads public facing scripts and stylesheets.
		 *
		 * @return  void
		 * @access  public
		 * @since   0.1.0
		 */
		public function register_styles() {

			list( $suffix, $version ) = $this->get_asset_versions();

			$assets_dir = charitable_divi()->get_path( 'assets', false );

			wp_register_style( 'charitable-divi-styles', $assets_dir . 'css/charitable-divi' . $suffix . '.css', array( 'charitable-styles' ), $version );
			wp_enqueue_style( 'charitable-divi-styles' );
		}

		/**
		 * Return the asset versions.
		 *
		 * @return  array
		 * @access  private
		 * @since   0.1.0
		 */
		private function get_asset_versions() {

			/* In debug mode, we use the unminified scripts & the timestamp as the version, to avoid cache. */

			if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
				return array(
					'',
					time(),
				);
			}

			return array(
				'.min',
				charitable_divi()->get_version(),
			);
		}
	}

endif;
