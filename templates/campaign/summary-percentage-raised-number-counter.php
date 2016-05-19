<?php 
/**
 * Displays the percentage of its goal that the campaign has raised using a number counter.
 *
 * This is based on Divi's Number Counter module. 
 *
 * Override this template by copying it to yourtheme/charitable/charitable-divi/campaign/summary-percentage-raised-number-counter.php
 * 
 * @author  Studio 164a
 * @since   0.1.0
 */

$campaign = $view_args[ 'campaign' ];

$round = isset( $view_args[ 'round' ] ) && $view_args[ 'round' ];

$percent = $campaign->get_percent_donated_raw();
$value = $round ? round( $percent ) : number_format( $percent, 2 );

wp_enqueue_script( 'easypiechart' );

?>
<div class="campaign-raised campaign-summary-item campaign-raised-number-counter campaign-raised-counter et_pb_number_counter et_pb_module et_pb_bg_layout_light et_pb_number_counter_0" data-number-value="<?php echo esc_attr( $value ) ?>">
    <div class="percent" style="color: <?php echo charitable_get_option( 'highlight_colour', '#2ea3f2' ) ?>;"><p><span class="percent-value"><?php echo $percent ?></span>%</p></div>
    <span><?php _e( 'Raised', 'charitable-divi' ) ?></span>
</div>