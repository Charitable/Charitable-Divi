<?php 
/**
 * Displays the percentage of its goal that the campaign has raised using a bar counter.
 *
 * This is based on Divi's Bar Counter module. 
 *
 * Override this template by copying it to yourtheme/charitable/charitable-divi/campaign/summary-percentage-raised-bar-counter.php
 * 
 * @author  Studio 164a
 * @since   1.0.0
 */

$campaign = $view_args[ 'campaign' ];

?>
<ul class="campaign-raised campaign-summary-item campaign-raised-bar-counter campaign-raised-counter et_pb_counters et-waypoint et_pb_module et_pb_bg_layout_light">
     <li class="et_pb_counter_0">
        <span class="et_pb_counter_container">
            <span class="et_pb_counter_amount" data-width="<?php echo esc_attr( $campaign->get_percent_donated() ) ?>">
                <span class="et_pb_counter_amount_number"><?php echo esc_html( $campaign->get_percent_donated() ) ?></span>
            </span>
        </span>
    </li>
</ul>