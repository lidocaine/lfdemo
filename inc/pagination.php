<?php
/**
 * Pagination layout.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists ( 'understrap_pagination' ) ) {

	function understrap_pagination( $args = array(), $class = '' ) {

        if ($GLOBALS['wp_query']->max_num_pages <= 1) return;

		$args = wp_parse_args( $args, array(
			'mid_size'           => 2,
			'prev_next'          => true,
			'prev_text'          => __('&laquo;', 'understrap'),
			'next_text'          => __('&raquo;', 'understrap'),
			'screen_reader_text' => __('Posts navigation', 'understrap'),
			'type'               => 'array',
			'current'            => max( 1, get_query_var('paged') ),
		) );

        $links = paginate_links($args);

        ?>

        <nav class="pagination-contain" aria-label="<?php echo $args['screen_reader_text']; ?>">

            <ul class="pagination <?php echo $class; ?>">

                <?php

                    foreach ( $links as $key => $link ) { ?>

                        <li class="page-item <?php echo strpos( $link, 'current' ) ? 'active' : '' ?>">

                            <?php echo str_replace( 'page-numbers', 'page-link', $link ); ?>

                        </li>

                <?php } ?>

            </ul>

        </nav>

        <?php
    }
}

?>
