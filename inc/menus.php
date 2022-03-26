<?php
if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/**
 * Register menu.
 */
register_nav_menus( array(
	'primary'       => esc_html__( 'Top primary menu', 'pro_new' ),
	'mobile-menu'   => esc_html__( 'Mobile menu', 'pro_new' ),
	'footer-menu'   => esc_html__( 'Footer menu', 'pro_new' ),
	'shop-menu'   => esc_html__( 'Shop menu', 'pro_new' ),
) );