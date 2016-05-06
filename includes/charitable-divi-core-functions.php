<?php 

/**
 * Charitable Divi Connect Core Functions. 
 *
 * General core functions.
 *
 * @author      Studio164a
 * @category    Core
 * @package     Charitable Divi Connect
 * @subpackage  Functions
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * This returns the original Charitable_Divi object. 
 *
 * Use this whenever you want to get an instance of the class. There is no
 * reason to instantiate a new object, though you can do so if you're stubborn :)
 *
 * @return  Charitable_Divi
 * @since   1.0.0
 */
function charitable_divi() {
    return Charitable_Divi::get_instance();
}

/**
 * Displays a template. 
 *
 * @param   string|string[] $template_name A single template name or an ordered array of template.
 * @param   mixed[] $args Optional array of arguments to pass to the view.
 * @return  Charitable_Divi_Template
 * @since   1.0.0
 */
function charitable_divi_template( $template_name, array $args = array() ) {
    if ( empty( $args ) ) {
        $template = new Charitable_Divi_Template( $template_name ); 
    }
    else {
        $template = new Charitable_Divi_Template( $template_name, false ); 
        $template->set_view_args( $args );
        $template->render();
    }

    return $template;
}