<?php
if ( ! defined( 'ABSPATH' ) ) {
	return;
}
/**
 ******************************************************************************************************************************
 *  SITE STYLE
 ******************************************************************************************************************************
 */
wp_enqueue_style( 'fontawesome-pro', get_template_directory_uri() . '/assets/src/library/fontawesome-pro/css/all.min.css', array(), false, "all" );
wp_enqueue_style( 'bootstrap-grid', get_template_directory_uri() . '/assets/src/library/bootstrap/bootstrap.min.css', array(), false, "all" );
wp_enqueue_style( 'dl-menu', get_template_directory_uri() . '/assets/build/library/dlmenu/component.css', array(), false, "all" );
wp_enqueue_style( 'pro_new-style', get_template_directory_uri() . '/assets/build/css/main.css', array(), false, "all" );
wp_enqueue_style( 'fa5', 'https://use.fontawesome.com/releases/v5.13.0/css/all.css', array(), '5.13.0', 'all' );
wp_enqueue_style( 'fa5-v4-shims', 'https://use.fontawesome.com/releases/v5.13.0/css/v4-shims.css', array(), '5.13.0', 'all' );
wp_enqueue_style( 'icon', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css', array(), '5.13.0', 'all' );

/**
 ******************************************************************************************************************************
 *  SITE SCRIPT
 ******************************************************************************************************************************
 */
if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
}
wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/build/library/dlmenu/modernizr.custom.js', array(), false, false );
wp_enqueue_script( 'dl-menu', get_template_directory_uri() . '/assets/build/library/dlmenu/jquery.dlmenu.js', array( 'jquery' ), false, true );
wp_enqueue_script( 'headeroom', get_template_directory_uri() . '/assets/build/library/headroom/headroom.min.js', array( 'jquery' ), false, true );
wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/build/library/bootstrap/bootstrap.min.js', array( 'jquery' ), false, true );
wp_enqueue_script( 'pro_new-script', get_template_directory_uri() . '/assets/build/js/main.js', array( 'jquery' ), false, true );

wp_localize_script( 'pro_new-script', 'pro_new_script', array(
	'ajax_url'      => admin_url( 'admin-ajax.php' ),
	'site_url'      => esc_url( home_url( '/' ) ),
	'is_rtl'        => is_rtl(),
) );