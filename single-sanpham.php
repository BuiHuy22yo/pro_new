<?php
if (!defined('ABSPATH')) {
	return;
}
get_header();
?>
<div class="pro_new-single single-sanpham-posttype">
		<div class="container">
			<div class="inner">
                <div class="row">
                    <div class="col-lg-9">
                        <?php
                        while ( have_posts() ) {
                            the_post();
                            get_template_part('components/page-single-post-type');
                        }

                        wp_reset_postdata();
                        ?>
                    </div>
                </div>

			</div>
		</div>
</div>

<?php
get_footer();
