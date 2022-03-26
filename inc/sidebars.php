<?php
if (!defined('ABSPATH')) {
	return;
}

/**
 * Primary widget
 */
register_sidebar(array(
	'id'			=> 'primary-bar',
	'name'			=> esc_html__('Primary Bar', 'pro_new'),
	'description'	=> esc_html__('Drag widgets for all of pages sidebar', 'pro_new'),
	'before_widget'	=> '<div class="pro_new-widget %2$s">',
	'after_widget'	=> '<div class="clear"></div></div>',
	'before_title'	=> '<div class="pro_new-widget-title"><h4>',
	'after_title'	=> '</h4></div>',
));

/**
 * Footer Widget
 */
$footer_widgets	= pro_new_get_option('footer_widgets');

if ($footer_widgets ) {
	$length	= 0;

	switch ($footer_widgets) {
		case 5:
			$length	= 6;
			break;
		case 6:
		case 7:
		case 8:
			$length	= 3;
			break;
		case 9:
		case 10:
			$length	= 4;
			break;
		default:
			$length	= $footer_widgets;
			break;
	}

	for ($i = 0; $i < $length; $i++) {
		$num	= $i + 1;

		register_sidebar(array(
			'id'			=> 'footer-' . $num,
			'name'			=> sprintf(esc_html__('Footer Widgets %d', 'pro_new'), $num),
			'description'	=> esc_html__('Drag widgets for all of pages sidebar', 'pro_new'),
			'before_widget'	=> '<div class="pro_new-widget %2$s">',
			'after_widget'	=> '<div class="clear"></div></div>',
			'before_title'	=> '<div class="pro_new-widget-title"><h4>',
			'after_title'	=> '</h4></div>',
		));
	}
}

if (class_exists('WooCommerce')) {
	/**
	 * Shop widget
	 */
	register_sidebar(array(
		'id' => 'shop-bar',
		'name' => esc_html__('Shop Bar', 'pro_new'),
		'description' => esc_html__('Drag widgets for all of pages sidebar', 'pro_new'),
		'before_widget' => '<div class="pro_new-widget %2$s">',
		'after_widget' => '<div class="clear"></div></div>',
		'before_title' => '<div class="pro_new-widget-title"><h4>',
		'after_title' => '</h4></div>',
	));

	/**
	 * Product widget
	 */
	register_sidebar(array(
		'id' => 'product-bar',
		'name' => esc_html__('Product Bar', 'pro_new'),
		'description' => esc_html__('Drag widgets for all of pages sidebar', 'pro_new'),
		'before_widget' => '<div class="pro_new-widget %2$s">',
		'after_widget' => '<div class="clear"></div></div>',
		'before_title' => '<div class="pro_new-widget-title"><h4>',
		'after_title' => '</h4></div>',
	));
}