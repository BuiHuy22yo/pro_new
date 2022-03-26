<?php
if (!defined('ABSPATH')) {
	return;
}

get_header();

global $post;
?>
<div class="pro_new-page pro_new-tmp">
	<div class="pro_new-inner">
		<div class="pro_new-content">
			<div class="container">
				<?php
				while (have_posts()) {
					the_post();
					the_content();

					wp_link_pages(
						array(
							'before' 		=> '<nav class="pro_new-page-break pro_new-pagination">',
							'after'  		=> '</nav>',
							'link_before'	=> '<span class="current">',
							'link_after'	=> '</span>',
						)
					);

					do_action('pro_new_page_end');

					if (comments_open() || '0' != get_comments_number()) {
						comments_template('', true);
					}
				}
				?>
			</div>
		</div>
	</div>
</div>
<?php

get_footer();
