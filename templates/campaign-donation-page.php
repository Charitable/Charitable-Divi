<?php
/**
 * Displays a donation page in Divi.
 *
 * Override this template by copying it to yourtheme/campaign-donation-page.php
 *
 * This template is based on single.php in Divi template.
 *
 * @author  Studio 164a
 * @package Charitable Divi/Templates/Donation Page
 * @since   0.2.0
 * @version 0.2.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

get_header();

?>
<div id="main-content">
	<div class="container">
		<div id="content-area" class="clearfix">   
			<div id="left-area">         
			<?php while ( have_posts() ) : the_post(); ?>				
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' ); ?>>    
					<div class="et_post_meta_wrapper">
						<h1 class="entry-title"><?php the_title() ?></h1>						
					</div> <!-- .et_post_meta_wrapper -->    
					<div class="entry-content">
						<?php
						do_action( 'et_before_content' );
						the_content();
						?>
					</div> <!-- .entry-content -->					
				</article> <!-- .et_pb_post -->                         
			<?php endwhile ?>
			</div> <!-- #left-area -->      
		</div> <!-- #content-area -->
	</div> <!-- .container -->
</div> <!-- #main-content -->

<?php

get_footer();
