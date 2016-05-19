<?php 
/**
 * Charitable Divi Template Hooks. 
 *
 * Action/filter hooks used for Charitable Divi functions/templates
 * 
 * @package     Charitable Divi/Functions/Templates
 * @version     0.1.0
 * @author      Eric Daams
 * @copyright   Copyright (c) 2015, Studio 164a
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License  
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Add elements before the main campaign content block.
 *
 * @see     et_divi_post_meta 
 * @see     charitable_divi_template_campaign_summary
 */
add_action( 'charitable_campaign_content_before', 'et_divi_post_meta', 1 );
add_action( 'charitable_campaign_content_before', 'charitable_divi_template_campaign_summary', 6 );

/**
 * Overwrite the default display of the campaign summary items.
 *
 * @see     charitable_divi_template_campaign_featured_image
 * @see     charitable_divi_template_campaign_percentage_raised
 * @see     charitable_divi_template_campaign_time_left
 */
add_action( 'charitable_campaign_summary_before', 'charitable_divi_template_campaign_featured_image', 4 );
add_action( 'charitable_campaign_summary', 'charitable_divi_template_campaign_percentage_raised', 4 );
add_action( 'charitable_campaign_summary', 'charitable_divi_template_campaign_time_left', 10 );

/**
 * Overwrite the default display of the campaign grid fundraising stats.
 *
 * @see     charitable_divi_template_campaign_loop_donation_stats
 */
add_action( 'charitable_campaign_content_loop_after', 'charitable_divi_template_campaign_loop_donation_stats', 14 );