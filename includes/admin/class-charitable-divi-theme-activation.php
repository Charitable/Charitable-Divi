<?php
/**
 * Activation handler for Charitable extensions.
 *
 * @package     Charitable/Activation Handler
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Charitable_Divi_Theme_Activation
 *
 * @since       1.0.0
 */
class Charitable_Divi_Theme_Activation {

    public $plugin_name, $plugin_path, $plugin_file, $has_divi, $charitable_base;

    /**
     * Setup the activation class
     *
     * @access      public
     * @since       1.0.0
     * @return      void
     */
    public function __construct( $plugin_path, $plugin_file ) {
        $this->has_divi = ( 'divi' == strtolower( wp_get_theme()->get_template() ) );
    }

    /**
     * Process plugin deactivation
     *
     * @return  void
     * @access  public
     * @since   1.0.0
     */
    public function run() {
        add_action( 'admin_notices', array( $this, 'missing_divi_notice' ) );
    }

    /**
     * Display notice if Charitable Stripe isn't installed
     *     
     * @return  string The notice to display
     * @access  public
     * @since   1.0.0
     */
    public function missing_charitable_notice() {
        if ( ! $this->has_divi ) {
            $url  = esc_url( wp_nonce_url( admin_url( 'plugins.php?action=activate&plugin=' . $this->charitable_base ), 'activate-plugin_' . $this->charitable_base ) );
            $link = '<a href="' . $url . '">' . __( 'activate it', 'charitable-divi' ) . '</a>';
        } else {
            $url  = esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=charitable' ), 'install-plugin_charitable' ) );
            $link = '<a href="' . $url . '">' . __( 'install it', 'charitable-divi' ) . '</a>';
        }
        
        echo '<div class="error"><p>' . sprintf( _x( '%s requires Divi! Please %s to continue!', 'Plugin requires Divi! Please install/activate it to continue!', 'charitable-divi' ), $this->plugin_name, $link ) . '</p></div>';
    }
}