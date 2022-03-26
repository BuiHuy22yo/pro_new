<?php
function aht_related_posts() {
    $posttype = get_post_type();
    if ( $posttype == 'post' ) {
        $categories = wp_get_post_categories(get_the_id(), array('orderby' => 'parent', ));
        $args = array(
            'cat'                 => $categories,
            'post__not_in'        => array(get_the_id()),
            'showposts'           => 3,
            'ignore_sticky_posts' => 1,
            'orderby'             => 'rand',
        );
    } else {
        $args = array(
            'post_type'           => $posttype,
            'post__not_in'        => array(get_the_id()),
            'showposts'           => 8,
            'ignore_sticky_posts' => 1,
            'orderby'             => 'rand',
        );

        $taxs = get_object_taxonomies( $posttype );

        if ( count($taxs) > 0 ) { /* if 1 */
            $terms_obj = wp_get_post_terms( get_the_id(), $taxs[0] );
            $terms = array();
            foreach ($terms_obj as $term_ob) {
                $terms[] = $term_ob->term_id;
            }
            if (count($terms) > 0) { /* if 2 */
                $args['tax_query'] =   array(
                    array(
                        'taxonomy'         => $taxs[0],
                        'field'            => 'id',
                        'terms'            => $terms,
                        'include_children' => true,
                    ),
                );
            } /* /.if 2 */
        } /* /.if 1 */
    } /* /.else post_type */
    $related_post = new wp_query($args);
    if( $related_post->have_posts() ){
        ?>
        <div class="related-title-block">
            <h3 class="related-title"><?php echo esc_html__('Related Posts','pro_new');?></h3>
        </div>
        <div class="show-related">
            <div class="row">
                <?php while ($related_post->have_posts()){
                    $related_post->the_post();
                    $url_thumbnail = get_the_post_thumbnail_url();
                    global $post;
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
               <?php } ?>

            </div>
        </div>
    <?php   }
    wp_reset_query();
}
