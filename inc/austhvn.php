<?php
/**
 * Created by PhpStorm.
 * User: Lidocaine
 * Date: 10/20/18
 * Time: 12:32 AM
 *
 * Code required to setup the environment for the Lightning Fruit coding exercise.
 * I'm parsing through the social_media_icons ACF values as I don't have a license for a Repeater Field,
 * which would probably be the ideal solution in this case.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Add "team" post type
register_post_type( 'team', [
	'label'              => __( 'Team' ),
	'description'        => __( 'A few familiar faces...' ),
	'public'             => true,
	'menu_icon'          => 'dashicons-businessman',
	'supports'           => [ 'title', 'revisions', 'page-attributes', 'thumbnail', 'custom-fields' ],
	'menu_position'      => 5,
	'has_archive'        => true,
]);

function austhvn_enqueue() {
	wp_enqueue_style( 'ionicons', 'https://unpkg.com/ionicons@4.4.6/dist/css/ionicons.min.css' );
	wp_enqueue_style( 'austhvn-style', get_stylesheet_directory_uri() . '/css/austhvn.css', filemtime(get_template_directory() . '/css/austhvn.css' ) );
	wp_enqueue_script( 'austhvn-scripts', get_template_directory_uri() . '/js/austhvn.js', array( 'jquery' ), filemtime(get_template_directory() . '/js/austhvn.js' ), true );
}
add_action( 'wp_enqueue_scripts', 'austhvn_enqueue' );

function austhnv_social_icons( $links, $echo = true ) {
	if ( ! empty( $links ) ) {
		$parsed     = [];
		$link_array = explode( PHP_EOL, $links );
		foreach ( $link_array as $link ) {
			array_push( $parsed, austhvn_do_icon( $link, 'team-social-ico' ) );
		}

		if ( ! $echo ) {
			return $parsed;
		}
		else {
			echo implode( '', $parsed );
		}
	}
	else {
		if ( ! $echo ) return '';
		else echo __( 'No Social Media Found' );;
	}
}

function austhvn_do_icon( $url, $additional_classes = '' ) {
	// Should check if $url and $host are valid
	$host = parse_url( $url, PHP_URL_HOST );
	switch( $host ):
		case 'instagram.com':
		case 'www.instagram.com':
			$service = 'instagram';
			break;
		case 'twitter.com':
		case 'www.twitter.com':
			$service = 'twitter';
			break;
		case 'facebook.com':
		case 'www.facebook.com':
			$service = 'facebook';
			break;
		// Should have a default case as this is nowhere near exhaustive, but this is just a demo anyway.
	endswitch;

	return '<a href="' . $url . '" target="_blank"><i class="icon ion-logo-' . $service . ' ' . $additional_classes . '"></i></a>';
}

function austhvn_adjust_archive_title( $title ) {
	if ( is_post_type_archive( 'team' ) ) {
		$title = post_type_archive_title( '', false );
	}

	return $title;
}
add_filter( 'get_the_archive_title', 'austhvn_adjust_archive_title' );

function austhvn_setup_theme() {
	// Add a custom square crop for headshot images
	// Apparently the default Medium image size is 300x300, but that can't be relied on as it can be changed from the
	// admin panel.
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'team-headshot-square', 200, 200, true );
	add_filter( 'image_size_names_choose', 'austhvn_custom_img_sizes' );
	function austhvn_custom_img_sizes( $sizes ) {
		return array_merge( $sizes, array(
			'team-headshot-square' => __( 'Team Member Headshot (Sq)' ),
		) );
	}
}

add_action( 'after_setup_theme', 'austhvn_setup_theme' );
