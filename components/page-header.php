<?php
/**
 * Created by vagrant.
 * User: vagrant
 * Date: 10/8/2019
 * Time: 3:20 PM
 */

global $post;

$post_id	= isset($post) ? $post->ID : false;
$post_id	= is_home() ? get_option('page_for_posts') : $post_id;
//$post_id	= pro_new_is_woocommerce_page() ? wc_get_page_id('shop') : $post_id;

if (is_front_page()) {
	return;
}

$bg_type	= pro_new_get_option('page_header_background_type', 'image');
$paralalx	= pro_new_get_option('page_header_parallax');
$align		= pro_new_get_option('page_header_content_align', 'center');
$overlay	= pro_new_get_option('page_header_overlay_color');

$mp4		= pro_new_get_option('page_header_mp4');
$ogv		= pro_new_get_option('page_header_ogv');
$webm		= pro_new_get_option('page_header_webm');

if (is_page()) {
	$page_options 	= get_post_meta($post_id, '_page_options', true);
	$type			= pro_new_get_value_in_array($page_options, 'page_header_type');

	if ($type == 'custom') {
		$bg_type	= pro_new_get_value_in_array($page_options,'page_header_background_type', 'image');
		$paralalx	= pro_new_get_value_in_array($page_options,'page_header_parallax');
		$align		= pro_new_get_value_in_array($page_options,'page_header_content_align', 'center');
		$overlay	= pro_new_get_value_in_array($page_options,'page_header_overlay_color');

		$mp4		= pro_new_get_value_in_array($page_options,'page_header_mp4');
		$ogv		= pro_new_get_value_in_array($page_options,'page_header_ogv');
		$webm		= pro_new_get_value_in_array($page_options,'page_header_webm');
	} else if ($type == 'disable') {
		return;
	}
}

if (is_search()) {
	$page_title = esc_html__('Search: ', 'pro_new') . esc_attr($_GET['s']);
} else if (is_category()) {
	$page_title = esc_html__('Category Archives: ', 'pro_new') . single_cat_title('', false);
} else if (is_author()) {
	$page_title = esc_html__('Author Archives: ', 'pro_new') . get_the_author();
} else if (is_404()) {
	$page_title = esc_html__('Page not found: ', 'pro_new');
} else if (is_day()) {
	$page_title = esc_html__('Daily Archives: ', 'pro_new') . get_the_date();
} else if (is_month()) {
	$page_title = esc_html__('Monthly Archives: ', 'pro_new') . get_the_date('F Y');
} else if (is_year()) {
	$page_title = esc_html__('Yearly Archives: ', 'pro_new') . get_the_date('Y');
} else if (is_tag()) {
	$page_title = esc_html__('Tags Archives: ', 'pro_new') . single_tag_title('', false);
} else {
	$page_title = get_the_title($post_id);
}

if (class_exists('WooCommerce')) {
	if (is_shop()) {
		$page_title = esc_html__('Shop', 'pro_new');
	}
}

if ($paralalx) {
	wp_enqueue_script('simpleParallax');
	wp_enqueue_script('pro_new-parallax');

	$bg				= pro_new_get_option('page_header_background');
	$image			= pro_new_get_value_in_array($bg, 'background-image');
	$url			= pro_new_get_value_in_array($image, 'url');
}
?>

<div class="pro_new-page-header text-<?php echo esc_attr($align); ?>">
	<?php if ($paralalx) : ?>
		<div class="pro_new-bg-parallax">
			<img src="<?php echo esc_url($url); ?>" class="pro_new-img-parallax" data-orientation="up" data-scale="1.2" data-delay="0.6" data-transition="cubic-bezier(0,0,0,1)" />
		</div>
	<?php endif; ?>

	<?php if ($overlay) : ?>
		<div class="pro_new-section-overlay"></div>
	<?php endif; ?>

	<div class="pro_new-section-content">
		<div class="section-title">
			<div class="container">
				<h1>
					<span>
						<?php echo esc_attr($page_title); ?>
					</span>
				</h1>
			</div>
		</div>
		<div class="section-breadcrumb">
			<div class="container">
				<?php echo pro_new_breadcrumb(); ?>
			</div>
		</div>
	</div>

	<?php if ($bg_type == 'video' && ($mp4 || $ogv || $webm)) : ?>
		<div class="pro_new-section-video-wrapper">
			<div class="pro_new-video-wrapper">
				<video width="1920" height="1080" poster="" autoplay>
					<?php if ($mp4) : ?>
						<source type="video/mp4" src="<?php echo esc_url($mp4); ?>" />
					<?php endif; ?>

					<?php if ($ogv) : ?>
						<source type="video/ogv" src="<?php echo esc_url($ogv); ?>" />
					<?php endif; ?>

					<?php if ($webm) : ?>
						<source type="video/webm" src="<?php echo esc_url($webm); ?>" />
					<?php endif; ?>
				</video>
			</div>
		</div>
	<?php endif; ?>
</div>
