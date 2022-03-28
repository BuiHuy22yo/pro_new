<?php
/**
 * Created by vagrant.
 * User: vagrant
 * Date: 9/20/2019
 * Time: 3:50 PM
 */

global $post;

$size = 'full';


if (have_posts()) {
	while (have_posts()) :
		the_post();
		$url_thumbnail = get_the_post_thumbnail_url();
		?>
        <article class="col-lg-4 col-md-6 item " id="post-<?php esc_attr(the_ID()); ?>" <?php post_class(); ?>>
            <?php if (has_post_thumbnail()) : ?>
                <div class="entry-image">
                    <div class="post-thumbnail">
                        <a href="<?php the_permalink() ?>" class="pro_new-image-wrapper">
                            <img src="<?php echo mr_image_resize($url_thumbnail, 487, 300, true, 'c', false); ?>"
                                 alt="<?php the_title(); ?>">
                        </a>
                    </div>
                    <?php pro_new_blog_date(); ?>
                </div>
                <div class="entry-meta">
                    <?php pro_new_blog_author(); ?>
                    <?php echo pro_new_generate_html_terms_list($post->ID, 'category'); ?>
                </div>
            <?php endif; ?>
            <div class="entry-post-content">
                <?php pro_new_blog_title(); ?>
                <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>" class="entry-readmore">
                    <?php echo esc_html__('Continue Reading', 'pro_new'); ?>
                </a>
            </div>
        </article>
        <?php

	endwhile;
}



