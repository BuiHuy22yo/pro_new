<?php
if (!defined('ABSPATH')) {
	return;
}

class pro_new_Theme_Include {
	private static $initialized	= false;

	public static function init() {
		if (self::$initialized) {
			return;
		} else {
			self::$initialized	= true;
		}

		// Load core theme
		require_once get_template_directory() . '/inc/core/core.php';

		// Load default menu
		require_once get_template_directory() . '/inc/menus.php';

		// Load helpers
		require_once get_template_directory() . '/inc/helpers.php';

		// Load hooks & Filters
		require_once get_template_directory() . '/inc/hooks.php';
		require_once get_template_directory() . '/inc/filters.php';

		// Load function modules
		require_once get_template_directory() . '/inc/modules/header.php';
		require_once get_template_directory() . '/inc/modules/footer.php';
		require_once get_template_directory() . '/inc/modules/blog.php';
		require_once get_template_directory() . '/inc/modules/post.php';
		require_once get_template_directory() . '/inc/modules/page_404.php';
		require_once get_template_directory() . '/inc/modules/related_post.php';
		require_once get_template_directory() . '/inc/modules/social_share.php';

		//widget
		require_once get_template_directory() . '/inc/widget/widgets.php';

		//load

		if ( class_exists( 'WooCommerce' ) ) {
			require_once get_template_directory() . '/inc/modules/product.php';
		}


		add_action('widgets_init', array(__CLASS__, '_register_sidebar'), 20);

		// only frontend
		if (! is_admin()) {
			add_action('wp_enqueue_scripts', array(__CLASS__, '_action_enqueue_scripts'), 20);
		}
	}

	public static function _register_sidebar() {
		require_once get_template_directory() . '/inc/sidebars.php';
	}

	public static function _action_enqueue_scripts() {
		// Load library & class
		require_once get_template_directory() . '/inc/static.php';
	}
}

pro_new_Theme_Include::init();
