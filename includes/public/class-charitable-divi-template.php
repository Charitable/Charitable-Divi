<?php
/**
 * Charitable Divi Connect template
 *
 * @version     1.0.0
 * @package     Charitable Divi Connect/Classes/Charitable_Divi_Template
 * @author      Eric Daams
 * @copyright   Copyright (c) 2015, Studio 164a
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License  
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Charitable_Divi_Template' ) ) : 

/**
 * Charitable_Divi_Template
 *
 * @since       1.0.0
 */
class Charitable_Divi_Template extends Charitable_Template {
    
    /**
     * Set theme template path. 
     *
     * @return  string
     * @access  public
     * @since   1.0.0
     */
    public function get_theme_template_path() {
        return trailingslashit( apply_filters( 'charitable_divi_theme_template_path', 'charitable/charitable-divi' ) );
    }

    /**
     * Return the base template path.
     *
     * @return  string
     * @access  public
     * @since   1.0.0
     */
    public function get_base_template_path() {
        return charitable_divi()->get_path( 'templates' );
    }

    /**
     * Return the theme template options for a specific template.
     *
     * @return  string[]
     * @access  protected
     * @since   1.0.0
     */
    protected function get_theme_template_options() {
        $options = array();

        foreach ( $this->template_names as $template_name ) {        
            $options[] = $this->theme_template_path . $template_name;
            $options[] = $template_name;
        }

        return $options;
    }    
}

endif;