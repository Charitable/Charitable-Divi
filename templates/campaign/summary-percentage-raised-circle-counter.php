<?php 
/**
 * Displays the percentage of its goal that the campaign has raised using a circle counter.
 *
 * This is based on Divi's Circle Counter module. 
 *
 * Override this template by copying it to yourtheme/charitable/charitable-divi/campaign/summary-percentage-raised-circle-counter.php
 * 
 * @author  Studio 164a
 * @since   1.0.0
 */

$campaign = $view_args[ 'campaign' ];
$round = isset( $view_args[ 'round' ] ) && $view_args[ 'round' ];
$percent = $campaign->get_percent_donated_raw();
$value = $round ? round( $percent ) : number_format( $percent, 2 );

wp_enqueue_script( 'easypiechart' );

?>
<div class="campaign-raised campaign-summary-item campaign-raised-circle-counter campaign-raised-counter et_pb_circle_counter container-width-change-notify et_pb_module et_pb_bg_layout_light et_pb_circle_counter_0" data-number-value="<?php echo esc_attr( $value ) ?>" data-bar-bg-color="<?php echo charitable_get_option( 'highlight_colour', '#2ea3f2' ) ?>">
    <div class="percent"><p><span class="percent-value"></span>%</p></div>    
</div>