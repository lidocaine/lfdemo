<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<article <?php post_class( 'col-12 col-md-6 col-lg-4 team-member'); ?> id="post-<?php the_ID(); ?>">

    <header class="member-headshot">
	    <?php echo get_the_post_thumbnail( $post->ID, 'team-headshot-square' ); ?>
        <div class="entry-meta member-meta-contain">
            <div class="align-contain">
                <div class="member-meta-wrapper">
                    <h2 class="member-name"><?php the_field('team_name' ); ?></h2>
                    <span class="member-title"><?php the_field( 'team_title' ); ?></span>
                </div>
            </div>
        </div><!-- .entry-meta -->
    </header>


	<div class="entry-content member-data-contain">
        <div class="member-social-media">
            <?php austhnv_social_icons( get_field('social_media_icons') ); ?>
        </div>

        <div class="member-bio">
	        <?php the_field( 'team_bio' ); ?>
        </div>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
