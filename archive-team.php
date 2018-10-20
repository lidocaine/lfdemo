<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>

<?php
$container   = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="archive-wrapper">

        <div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

            <div class="row">

                <main class="site-main col-12" id="main">

				    <?php if ( have_posts() ) : ?>

                        <div class="row">
                            <header class="page-header col-12">
		                        <?php
		                        the_archive_title( '<h1 class="page-title">', '&nbsp;Roster</h1>' );
		                        the_archive_description( '<div class="taxonomy-description">', '</div>' );
		                        ?>
                            </header><!-- .page-header -->
                        </div>

                        <div class="row team-members-contain">
	                        <?php /* Start the Loop */ ?>
	                        <?php while ( have_posts() ) : the_post(); ?>

		                        <?php get_template_part( 'loop-templates/content', 'team' ); ?>

	                        <?php endwhile; ?>
                        </div>

				    <?php else : ?>

					    <?php get_template_part( 'loop-templates/content', 'none' ); ?>

				    <?php endif; ?>

                </main><!-- #main -->

                <!-- The pagination component -->
			    <?php understrap_pagination( [],'justify-content-center' ); ?>

            </div> <!-- .row -->

        </div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
