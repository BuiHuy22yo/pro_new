<?php
if (!defined('ABSPATH')) {
	return;
}

/**
 * Social List
 */
if (! function_exists('pro_new_generate_html_social_list')) {
	function pro_new_generate_html_social_list() {
		$social_list = pro_new_get_option('_social_list');

		$html = '<div class="pro_new-social-list"><ul>';

		if (!empty($social_list)) {
			foreach ($social_list as $social) {
				$html .= '<li><a href="' . esc_url(pro_new_get_value_in_array($social, 'link')) . '" class="' . esc_attr(pro_new_get_value_in_array($social, 'icon')) . '"></a></li>';
			}
		}

		$html .= '</ul></div>';

		return $html;
	}
}


/**
 * Show Menu by ID
 */
if (! function_exists('pro_new_generate_html_menu_by_id')) {
	function pro_new_generate_html_menu_by_id($slug) {
		$menu = wp_get_nav_menu_items($slug);

		$html  = '<div class="pro_new-menu">';
		$html .= '<ul class="menu">';

		if (!empty($menu)) {
			foreach ($menu as $item) {
				$html .= '<li class="menu-item">';
				$html .= '<a href="' . esc_url($item->url) . '">' . esc_attr($item->title) . '</a>';
				$html .= '</li>';
			}
		}

		$html .= '</ul></div>';

		return $html;
	}
}
/**
 * Render pagination.
 */
if (!function_exists('pro_new_pagination')) {
    function pro_new_pagination() {
        if( is_singular() )
            return;
        global $wp_query;

        if( $wp_query->max_num_pages <= 1 )
            return;
        $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
        $max = intval( $wp_query->max_num_pages );


        if ( $paged >= 1 )
            $links[] = $paged;

        if ( $paged >= 3 ) {
            $links[] = $paged - 1;
            $links[] = $paged - 2;
        }

        if ( ( $paged + 2 ) <= $max ) {
            $links[] = $paged + 2;
            $links[] = $paged + 1;
        }


        echo '<ul class="pro_new-pagination">' . "\n";

        if ( get_previous_posts_link() == NULL){
            echo '<li><i class="fal fa-long-arrow-left"></i></li>';
        }
        else{
            printf( '<li>%s</li>' . "\n", get_previous_posts_link('<i class="fal fa-long-arrow-left"></i>') );
        }



        if ( ! in_array( 1, $links ) ) {
            $class = 1 == $paged ? ' class="active"' : '';
            printf( '<li %s><a rel="nofollow" class="page larger" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
            if ( ! in_array( 2, $links ) )
                echo '<li>…</li>';
        }


        sort( $links );
        foreach ( (array) $links as $link ) {
            $class = $paged == $link ? ' class="active"' : '';
            printf( '<li%s><span class="page larger">%s</span></li>' . "\n", $class, $link );
        }


        if ( ! in_array( $max, $links ) ) {
            if ( ! in_array( $max - 1, $links ) )
                echo '<li>…</li>' . "\n";
            $class = $paged == $max ? ' class="active"' : '';
            printf( '<li%s><a rel="nofollow" class="page larger" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
        }


        if(get_next_posts_link() == NULL){
            echo '<li><i class="fal fa-long-arrow-right"></i></li>';
        }
        else{
            printf( '<li>%s</li>' . "\n", get_next_posts_link('<i class="fal fa-long-arrow-right"></i>') );
            echo '</ul>' . "\n";
        }

    }
}

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title' 	=> 'Theme General Settings',
        'menu_title'	=> 'Theme Settings',
        'menu_slug' 	=> 'theme-general-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme Header Settings',
        'menu_title'	=> 'Header',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme Footer Settings',
        'menu_title'	=> 'Footer',
        'parent_slug'	=> 'theme-general-settings',
    ));

}