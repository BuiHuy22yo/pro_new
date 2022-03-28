<?php
if (!defined('ABSPATH')) {
	return;
}

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<?php pro_new_header(); ?>
       <?php
       if ( is_404() ) {
           $title = __( 'Not Found', 'hrm' );
       }
       elseif ( is_archive() && (get_post_type() == 'post') ) {
           $title = single_cat_title('', false);
       }
       elseif ( is_single() || is_page()) {
           $title = get_the_title();
       }
       elseif ( is_search() ) {
           $title = sprintf( __( 'Search Results for: %s', 'hrm' ),  get_search_query() );
       }
       elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {
           $post_type = get_post_type_object(get_post_type());
           $title = $post_type->labels->singular_name;
       }
        if(!is_home()&& !is_front_page()){ ?>
            <section class="page-title-bar">
                <?php echo pro_new_breadcrumb() ?>
            </section>
       <?php }  ?>
