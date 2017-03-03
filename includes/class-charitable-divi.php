<?php
/**
 * The main Charitable Divi Connect class.
 *
 * The responsibility of this class is to load all the plugin's functionality.
 *
 * @package     Charitable Divi Connect
 * @copyright   Copyright (c) 2015, Eric Daams
 * @license     http://opensource.org/licenses/gpl-1.0.0.php GNU Public License
 * @since       0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if ( ! class_exists( 'Charitable_Divi' ) ) :

	/**
	 * Charitable_Divi
	 *
	 * @since   0.1.0
	 * @final
	 */
	final class Charitable_Divi {

		/**
		 * @var string
		 */
		const VERSION = '0.2.1';

		/**
		 * @var string  A date in the format: YYYYMMDD
		 */
		const DB_VERSION = '20151021';

		/**
		 * @var string The product name.
		 */
		const NAME = 'Charitable Divi Connect';

		/**
		 * @var string The product author.
		 */
		const AUTHOR = 'Studio 164a';

		/**
		 * @var Charitable_Divi
		 */
		private static $instance = null;

		/**
		 * The root file of the plugin.
		 *
		 * @var     string
		 * @access  private
		 */
		private $plugin_file;

		/**
		 * The root directory of the plugin.
		 *
		 * @var     string
		 * @access  private
		 */
		private $directory_path;

		/**
		 * The root directory of the plugin as a URL.
		 *
		 * @var     string
		 * @access  private
		 */
		private $directory_url;

		/**
		 * Create class instance.
		 *
		 * @return  void
		 * @since   0.1.0
		 */
		public function __construct( $plugin_file ) {
			$this->plugin_file      = $plugin_file;
			$this->directory_path   = plugin_dir_path( $plugin_file );
			$this->directory_url    = plugin_dir_url( $plugin_file );

			add_action( 'charitable_start', array( $this, 'start' ), 6 );
		}

		/**
		 * Returns the original instance of this class.
		 *
		 * @return  Charitable
		 * @since   0.1.0
		 */
		public static function get_instance() {
			return self::$instance;
		}

		/**
		 * Run the startup sequence on the charitable_start hook.
		 *
		 * This is only ever executed once.
		 *
		 * @return  void
		 * @access  public
		 * @since   0.1.0
		 */
		public function start() {
			// If we've already started (i.e. run this function once before), do not pass go.
			if ( $this->started() ) {
				return;
			}

			// Set static instance
			self::$instance = $this;

			$this->load_dependencies();

			$this->maybe_upgrade();

			$this->maybe_start_public();

			$this->maybe_start_admin();

			$this->setup_licensing();

			$this->setup_i18n();

			$this->attach_hooks_and_filters();

			// Hook in here to do something when the plugin is first loaded.
			do_action( 'charitable_divi_start', $this );
		}

		/**
		 * Include necessary files.
		 *
		 * @return  void
		 * @access  private
		 * @since   0.1.0
		 */
		private function load_dependencies() {
			$includes_path = $this->get_path( 'includes' );

			require_once( $includes_path . 'charitable-divi-core-functions.php' );
			require_once( $includes_path . 'admin/customizer/class-charitable-divi-customizer.php' );
		}

		/**
		 * Load the admin-only functionality.
		 *
		 * @return  void
		 * @access  private
		 * @since   0.1.0
		 */
		private function maybe_start_admin() {
			if ( ! is_admin() ) {
				return;
			}

			require_once( $this->get_path( 'includes' ) . 'admin/class-charitable-divi-admin.php' );
			require_once( $this->get_path( 'includes' ) . 'admin/charitable-divi-admin-hooks.php' );
		}

		/**
		 * Load the public-only functionality.
		 *
		 * @return  void
		 * @access  private
		 * @since   0.1.0
		 */
		private function maybe_start_public() {
			if ( is_admin() ) {
				return;
			}

			require_once( $this->get_path( 'includes' ) . 'public/class-charitable-divi-public.php' );
			require_once( $this->get_path( 'includes' ) . 'public/class-charitable-divi-template.php' );

			Charitable_Divi_Public::get_instance();
		}

		/**
		 * Set up licensing for the extension.
		 *
		 * @return  void
		 * @access  private
		 * @since   0.1.0
		 */
		private function setup_licensing() {
			charitable_get_helper( 'licenses' )->register_licensed_product(
				Charitable_Divi::NAME,
				Charitable_Divi::AUTHOR,
				Charitable_Divi::VERSION,
				$this->plugin_file
			);
		}

		/**
		 * Set up the internationalisation for the plugin.
		 *
		 * @return  void
		 * @access  private
		 * @since   0.1.0
		 */
		private function setup_i18n() {
			if ( class_exists( 'Charitable_i18n' ) ) {

				require_once( $this->get_path( 'includes' ) . 'i18n/class-charitable-divi-i18n.php' );

				Charitable_Divi_i18n::get_instance();
			}
		}

		/**
		 * Perform upgrade routine if necessary.
		 *
		 * @return  void
		 * @access  private
		 * @since   0.1.0
		 */
		private function maybe_upgrade() {
			$db_version = get_option( 'charitable_divi_version' );

			if ( self::VERSION !== $db_version ) {

				require_once( charitable()->get_path( 'admin' ) . 'upgrades/class-charitable-upgrade.php' );
				require_once( $this->get_path( 'includes' ) . 'admin/upgrades/class-charitable-divi-upgrade.php' );

				Charitable_Divi_Upgrade::upgrade_from( $db_version, self::VERSION );
			}
		}

		/**
		 * Set up callbacks for hooks & filters.
		 *
		 * @return  void
		 * @access  private
		 * @since   0.1.0
		 */
		private function attach_hooks_and_filters() {
			add_filter( 'charitable_customizer_fields', array( Charitable_Divi_Customizer::get_instance(), 'add_customizer_settings' ) );
			add_filter( 'charitable_default_highlight_colour', array( $this, 'set_divi_highlight_colour' ) );
			// add_action( 'et_builder_ready', array( $this, 'load_divi_modules' ) );
			add_action( 'widgets_init', array( $this, 'register_widget_area' ) );
		}

		/**
		 * Set the highlight colour used by Charitable to be the Divi accent colour.
		 *
		 * @return  string
		 * @access  public
		 * @since   0.1.0
		 */
		public function set_divi_highlight_colour() {
			return et_get_option( 'accent_color', '#2ea3f2' );
		}

		/**
		 * Load our custom Divi Builder modules.
		 *
		 * @return  void
		 * @access  public
		 * @since   0.1.0
		 */
		public function load_divi_modules() {
			// require_once( $this->get_path( 'includes' ) . 'modules/class-charitable-divi-campaigns-module.php' );
			// require_once( $this->get_path( 'includes' ) . 'modules/class-charitable-divi-campaign-stats-module.php' );

			// Instantiate all of the modules
			// new Charitable_Divi_Campaigns_Module();
		}

		/**
		 * Register a widget area to be displayed at the end of campaign pages.
		 *
		 * @return  void
		 * @access  public
		 * @since   0.1.0
		 */
		public function register_widget_area() {
			register_sidebar( array(
				'id'            => 'charitable_campaign',
				'name'          => __( 'Campaign After Content', 'charitable-divi' ),
				'description'   => __( 'Displayed below the campaign\'s content, but above the comment section.', 'charitable-divi' ),
				'before_widget' => '<aside id="%1$s" class="et_pb_widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h4 class="widgettitle">',
				'after_title'   => '</h4>',
			));
		}

		/**
		 * Returns whether we are currently in the start phase of the plugin.
		 *
		 * @return  bool
		 * @access  public
		 * @since   0.1.0
		 */
		public function is_start() {
			return current_filter() == 'charitable_divi_start';
		}

		/**
		 * Returns whether the plugin has already started.
		 *
		 * @return  bool
		 * @access  public
		 * @since   0.1.0
		 */
		public function started() {
			return did_action( 'charitable_divi_start' ) || current_filter() == 'charitable_divi_start';
		}

		/**
		 * Returns the plugin's version number.
		 *
		 * @return  string
		 * @access  public
		 * @since   0.1.0
		 */
		public function get_version() {
			return self::VERSION;
		}

		/**
		 * Returns plugin paths.
		 *
		 * @param   string $path            // If empty, returns the path to the plugin.
		 * @param   bool $absolute_path     // If true, returns the file system path. If false, returns it as a URL.
		 * @return  string
		 * @since   0.1.0
		 */
		public function get_path( $type = '', $absolute_path = true ) {
			$base = $absolute_path ? $this->directory_path : $this->directory_url;

			switch ( $type ) {
				case 'includes' :
					$path = $base . 'includes/';
					break;

				case 'templates' :
					$path = $base . 'templates/';
					break;

				case 'assets' :
					$path = $base . 'assets/';
					break;

				case 'directory' :
					$path = $base;
					break;

				default :
					$path = $this->plugin_file;
			}

			return $path;
		}

		/**
		 * Throw error on object clone.
		 *
		 * This class is specifically designed to be instantiated once. You can retrieve the instance using charitable()
		 *
		 * @since   0.1.0
		 * @access  public
		 * @return  void
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'charitable-divi' ), '1.0.0' );
		}

		/**
		 * Disable unserializing of the class.
		 *
		 * @since   0.1.0
		 * @access  public
		 * @return  void
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'charitable-divi' ), '1.0.0' );
		}
	}

endif; // End if class_exists check
