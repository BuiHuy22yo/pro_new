<?php
/**
 * Created by vagrant.
 * User: vagrant
 * Date: 9/15/2019
 * Time: 10:28 PM
 */

global $wp_query;

$blog_layout 		= pro_new_get_option('blog_layout', 'list');
$blog_sidebar		= pro_new_get_option('blog_sidebar', 'right');
$widget				= pro_new_get_option('blog_sidebar_type', 'primary-bar');

$blog_layout		= isset($_GET['layout']) ? $_GET['layout'] : $blog_layout;
$blog_sidebar		= isset($_GET['sidebar']) ? $_GET['sidebar'] : $blog_sidebar;

$class				= ($blog_sidebar != 'full' && is_active_sidebar($widget)) ? 'pro_new-has-bar pro_new-bar-' . $blog_sidebar : 'pro_new-full';
$name				= ($blog_layout == 'list') ? 'list' : 'grid';

if ($blog_layout == 'masonry') {
	wp_enqueue_script('imagesloaded');
	wp_enqueue_script('isotope');
}

?>

<div class="pro_new-archive pro_new-tmp">
	<div class="pro_new-inner">
		<div class="container">
			<div class="pro_new-archive-<?php echo esc_attr($blog_sidebar); ?> <?php echo esc_attr($class); ?>">
				<div class="pro_new-content pro_new-archive-content">
					<div class="pro_new-<?php echo esc_attr($name); ?>">
						<div class="blog-<?php echo esc_attr($name); ?>">
							<div class="row">
								<?php get_template_part('components/archives/' . $name); ?>
							</div>

						</div>
						<?php
							if (pro_new_get_option('blog_pagination') != 'hide') {
								pro_new_pagination();
							}

							wp_reset_postdata();
						?>
					</div>
				</div>

<!--				--><?php //if ($blog_sidebar != 'full') : ?>
<!--					--><?php //get_sidebar(); ?>
<!--				--><?php //endif; ?>
			</div>
		</div>

	</div>
</div>

