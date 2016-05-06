<?php
/**
 * The class responsible for adding & saving extra settings in the Charitable admin.
 *
 * @package     Charitable Divi Connect/Classes/Charitable_Divi_Admin
 * @version     1.0.0
 * @author      Eric Daams
 * @copyright   Copyright (c) 2015, Studio 164a
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License  
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Charitable_Divi_Admin' ) ) : 

/**
 * Charitable_Divi_Admin
 *
 * @since       1.0.0
 */
class Charitable_Divi_Admin {

    /**
     * @var     Charitable_Divi_Admin
     * @access  private
     * @static
     * @since   1.0.0
     */
    private static $instance = null;

    /**
     * Create class object. Private constructor. 
     * 
     * @access  private
     * @since   1.0.0
     */
    private function __construct() {
    }

    /**
     * Create and return the class object.
     *
     * @access  public
     * @static
     * @since   1.0.0
     */
    public static function get_instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new Charitable_Divi_Admin();            
        }

        return self::$instance;
    }    

    /**
     * Add custom links to the plugin actions. 
     *
     * @param   string[] $links
     * @return  string[]
     * @access  public
     * @since   1.0.0
     */
    // public function add_plugin_action_links( $links ) {
    //     $links[] = '<a href="' . admin_url( 'admin.php?page=charitable-settings&tab=extensions' ) . '">' . __( 'Settings', 'charitable-newsletter-connect' ) . '</a>';
    //     return $links;
    // }
}

endif; // End class_exists check