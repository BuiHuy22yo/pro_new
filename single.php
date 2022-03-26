<?php
if (!defined('ABSPATH')) {
	return;
}
get_header();
?>

<div class="pro_new-single pro_new-tmp">
	<div class="pro_new-inner">
		<div class="container">
			<div class="pro_new-post">
                <div class="row">
                    <div class="pro_new-content pro_new-post-content col-lg-9">
                        <?php
                        while ( have_posts() ) {
                            the_post();
                            get_template_part('components/page-single');
                        }

                        wp_reset_postdata();
                        ?>

                    </div>
                    <?php get_sidebar(); ?>
                </div>
                <div class="related-post">
                    <?php aht_related_posts() ?>
                </div>
			</div>
			<?php do_action('pro_new_single_post_after_content'); ?>
		</div>

	</div>
</div>

<?php
get_footer();
