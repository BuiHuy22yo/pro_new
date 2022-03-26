<?php
/**
 * Created by vagrant.
 * User: vagrant
 * Date: 3/29/2021
 * Time: 9:06 AM
 */

global $post;
?>

<article id="post-<?php esc_attr(the_ID()); ?>" <?php post_class(); ?>>
    <div class="single-post-thumbnail">
        <?php
        $url_thumbnail = get_the_post_thumbnail_url();
        ?>
        <img src="<?php echo mr_image_resize($url_thumbnail, 1133, 500, true, 'c', false); ?>"
             alt="<?php the_title(); ?>">
    </div>
    <div class="post-meta">
        <?php echo pro_new_single_author(); ?>
        <?php echo pro_new_single_date(); ?>
        <?php echo pro_new_generate_html_terms_list($post->ID, 'category'); ?>
    </div>
    <h2 class="title-single-post"><?php the_title() ?></h2>
    <div class="content-post">
        <?php pro_new_single_content(); ?>
    </div>
    <div class="post-footer-info">
        <?php echo pro_new_generate_html_terms_list($post->ID, 'post_tag'); ?>
        <?php //echo pro_new_single_comments(); ?>
    </div>
    <?php aht_social_share() ?>
    <?php //echo pro_new_single_section_author_info(); ?>
    <?php
    //		if (comments_open() || get_comments_number()) {
    //			comments_template();
    //		}
    ?>
</article>
