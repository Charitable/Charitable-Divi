<?php 
/**
 * Displays the campaign featured image.
 *
 * Override this template by copying it to yourtheme/charitable/charitable-divi/campaign/featured-image.php
 * 
 * @author  Studio 164a
 * @since   0.1.0
 */

$width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );
$height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
$classtext = 'et_featured_image';
$titletext = get_the_title();
$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
$thumb = $thumbnail["thumb"];

?>
<div class="charitable-campaign-featured-image"><?php print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height ) ?></div>