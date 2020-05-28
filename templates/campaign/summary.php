<?php
/**
 * Displays the campaign summary.
 *
 * Override this template by copying it to yourtheme/charitable/campaign/summary.php
 *
 * @author 	Studio 164a
 * @since 	1.0.0
 */

$campaign = $view_args[ 'campaign' ];

$classes = array( 'campaign-summary' );

if ( $campaign->has_goal() ) {
    $percentage_display_mode = charitable_get_option( 'percent_raised_display', 'bar-counter' );

    if ( $percentage_display_mode != 'hidden' ) {
        $classes[] = 'campaign-percentage-display-' . $percentage_display_mode;
    }
}

if ( ! $campaign->is_endless() ) {
    $time_left_display_mode = charitable_get_option( 'time_left_display', 'countdown' );

    if ( $time_left_display_mode != 'hidden' ) {
        $classes[] = 'campaign-time-left-display-' . $time_left_display_mode;
    }
}

$classes = implode( ' ', $classes );

$background_colour = charitable_get_option( 'campaign_block_background_colour', '#f8f8f8' );

?>
<div class="charitable-campaign-summary-wrapper" style="background-color: <?php echo $background_colour ?>;">

    <?php
    /**
     * @hook charitable_campaign_summary_before
     */
    do_action( 'charitable_campaign_summary_before', $campaign );

    ?>
    <div class="<?php echo $classes ?>">
        <?php

        /**
         * @hook charitable_campaign_summary
         */
        do_action( 'charitable_campaign_summary', $campaign );

        ?>
    </div>
    <?php

    /**
     * @hook charitable_campaign_summary_after
     */
    do_action( 'charitable_campaign_summary_after', $campaign );

    ?>
</div><!-- .charitable-campaign-summary-wrapper -->