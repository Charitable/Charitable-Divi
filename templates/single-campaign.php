<?php 
/**
 * Displays a single campaign in Divi.
 *
 * Override this template by copying it to yourtheme/single-campaign.php
 *
 * This template is based on single.php in Divi template.
 *
 * @author  Studio 164a
 * @package Charitable Divi/Templates/Single Campaign
 * @since   1.0.0
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header();

$show_default_title = get_post_meta( get_the_ID(), '_et_pb_show_title', true );

/**
 * @var     Charitable_Campaign
 */
$campaign = charitable_get_current_campaign();

?>
<div id="main-content">
    <div class="container">
        <div id="content-area" class="clearfix">   
            <div id="left-area">         
            <?php while ( have_posts() ) : the_post(); ?>
                <?php if (et_get_option('divi_integration_single_top') <> '' && et_get_option('divi_integrate_singletop_enable') == 'on') echo(et_get_option('divi_integration_single_top')); ?>

                <?php
                    $et_pb_has_comments_module = has_shortcode( get_the_content(), 'et_pb_comments' );
                    $additional_class = $et_pb_has_comments_module ? ' et_pb_no_comments_section' : '';
                ?>                
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' . $additional_class ); ?>>    
                    <div class="et_post_meta_wrapper">
                        <h1 class="entry-title"><?php the_title() ?></h1>
                        <?php
                        
                        if ( ! post_password_required() ) :

                            do_action( 'charitable_campaign_content_before', $campaign );                            
                        
                        endif;
                        
                        ?>
                    </div> <!-- .et_post_meta_wrapper -->                    
                    <div class="entry-content">
                        <?php
                        do_action( 'et_before_content' );

                        the_content();

                        wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
                        ?>
                    </div> <!-- .entry-content -->
                    <?php 

                    if ( ! post_password_required() ) :
                        
                        do_action( 'charitable_campaign_content_after', $campaign );

                    endif;

                    ?>
                    <div class="et_post_meta_wrapper">                        
                        <?php if ( is_active_sidebar( 'charitable_campaign' ) ) : ?>

                            <div id="sidebar" class="charitable-campaign-after">
                                <?php dynamic_sidebar( 'charitable_campaign' ) ?>
                            </div><!-- #sidebar -->

                        <?php endif;
                                        
                        if ( ( comments_open() || get_comments_number() ) && 'on' == et_get_option( 'divi_show_postcomments', 'on' ) && ! $et_pb_has_comments_module ) :

                            comments_template( '', true );

                        endif;

                        ?>
                    </div> <!-- .et_post_meta_wrapper -->
                </article> <!-- .et_pb_post -->                         
            <?php endwhile ?>
            </div> <!-- #left-area -->      
        </div> <!-- #content-area -->
    </div> <!-- .container -->
</div> <!-- #main-content -->

<?php 

get_footer();