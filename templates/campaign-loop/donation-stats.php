<?php 
/**
 * Displays the campaign donation stats.
 *
 * @author  Studio 164a
 * @since   0.1.0
 * @version 0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$campaign = $view_args[ 'campaign' ];

$display_mode = charitable_get_option( 'percent_raised_display_grid', 'bar-counter' );

$classes = array( 'campaign-donation-stats' );

if ( $display_mode != 'hidden' ) {
    $classes[] = 'campaign-percentage-display-' . $display_mode;
}

$classes = implode( ' ', $classes );

?>
<div class="<?php echo $classes ?>">  
    <?php if ( 'text' != $display_mode ) : 
        charitable_divi_template( 'campaign/summary-percentage-raised-' . $display_mode . '.php', array( 'campaign' => $campaign, 'round' => true ) );
    endif; 
    ?>
    <p><?php echo $campaign->get_donation_summary() ?></p>
</div>