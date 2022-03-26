<?php
if (!defined('ABSPATH')) {
	return;
}

/**
 * Add custom classes to the aray of body classes
 */
if (!function_exists('pro_new_filter_body_classes')) {
	function pro_new_filter_body_classes($classes) {
		$general_options = pro_new_header_general_params();

		//header transparent
		$classes[] = $general_options['is_transparent'] ? 'pro_new-has-transparent' : '';

		//header sticky
		$classes[] = $general_options['is_sticky'] ? 'pro_new-has-sticky' : '';

		if(is_home() || is_front_page()){
		    $classes[] = 'is_home';
        }
		return $classes;
	}

	add_filter('body_class', 'pro_new_filter_body_classes');
}

/**
 * Ensure cart contents update when products are added to the cart via AJAX
 */
if (!function_exists('pro_new_header_add_to_cart_fragment')) {
	function pro_new_header_add_to_cart_fragment($fragments) {
		ob_start();
		$count = WC()->cart->cart_contents_count;

		?>
		<a class="pro_new-btn-cart" href="<?php echo esc_url(wc_get_cart_url()); ?>">
			<i class="fal fa-shopping-cart"></i>
			<span class="nm">
				<span class="cart-count"><?php echo esc_html($count . ' item'); ?></span>
			</span>
		</a>

		<?php
		$fragments['a.pro_new-btn-cart'] = ob_get_clean();

		return $fragments;
	}

	add_filter('woocommerce_add_to_cart_fragments', 'pro_new_header_add_to_cart_fragment');
}

/**
 * Mini Cart
 */
if (!function_exists('pro_new_header_mini_cart_fragment')) {
	function pro_new_header_mini_cart_fragment($fragments) {
		ob_start();

		woocommerce_mini_cart();
		$mini_cart = ob_get_clean();

		?>
		<div class="pro_new-cart-content"><?php echo json_decode(json_encode($mini_cart)); ?></div>

		<?php
		$fragments['.pro_new-cart-content'] = ob_get_clean();

		return $fragments;
	}

	add_filter('woocommerce_add_to_cart_fragments', 'pro_new_header_mini_cart_fragment');
}

/**
 * Menu Mobile
 */
function pro_new_nav_menu_submenu_css_class( $classes ) {
	$classes[] = 'dl-submenu';
	return $classes;
}
add_filter( 'nav_menu_submenu_css_class', 'pro_new_nav_menu_submenu_css_class' );

/**
 * Remove title page shop woocommerce
 */
add_filter('woocommerce_show_page_title', function () {
	return false;
});