<?php
/**
 * Created by vagrant.
 * User: vagrant
 * Date: 9/15/2019
 * Time: 10:33 PM
 */

require_once get_template_directory() . '/inc/core/resize.php';
require_once get_template_directory() . '/inc/core/breadcrumb.php';

/**
 * Get config from library
 */
if ( ! function_exists( 'pro_new_get_option' ) ) {
	function pro_new_get_option( $option_name = '', $default = '', $name = '_pro_new_options' ) {
		$options = get_option( $name );

		if ( ! empty( $option_name ) && ! empty( $options[ $option_name ] ) ) {
			return $options[ $option_name ];
		} else {
			return ( ! empty( $default ) ) ? $default : null;
		}

	}
}

/**
 * Get array value.
 */
if ( ! function_exists( 'pro_new_get_value_in_array' ) ) {
	function pro_new_get_value_in_array( $array, $key, $default = null ) {
		return isset( $array[ $key ] ) ? $array[ $key ] : $default;
	}
}

/**
 * Get registered sidebars
 */
if ( ! function_exists( 'pro_new_wp_registered_sidebars' ) ) {
	function pro_new_wp_registered_sidebars() {
		global $wp_registered_sidebars;

		$widgets = array();

		if ( ! empty( $wp_registered_sidebars ) ) {
			foreach ( $wp_registered_sidebars as $key => $value ) {
				$widgets[ $key ] = $value['name'];
			}
		}

		return array_reverse( $widgets );
	}
}

/**
 * Generate template for terms list
 */
if ( ! function_exists( 'pro_new_generate_html_terms_list' ) ) {
	function pro_new_generate_html_terms_list( $post_id, $taxonomy, $is_link = true, $space = ',' ) {
		$terms = wp_get_post_terms( $post_id, $taxonomy );

		$html     = '';
		$numItems = count( $terms );
		$i        = 0;

		if ( ! empty( $terms ) ) {
			$html .= '<div class="term-' . $taxonomy . '">';

			foreach ( $terms as $term ) {
				$s = ( ++ $i === $numItems ) ? '' : $space;

				$html .= $is_link ? '<a href="' . get_term_link( $term->slug, $taxonomy ) . '">' : '';
				$html .= $term->name;
				$html .= $is_link ? '</a>' : '';
				//$html .= $s;
			}

			$html .= '</div>';
		}

		return $html;
	}
}

/**
 * Create excerpt by post id
 */
if ( ! function_exists( 'pro_new_get_excerpt_by_id' ) ) {
	function pro_new_get_excerpt_by_id( $post_id, $length ) {
		$post    = get_post( $post_id );
		$content = $post->post_content;
		$excerpt = $post->post_excerpt;
		$excerpt = $excerpt ? $excerpt : $content;

		$excerpt = strip_tags( strip_shortcodes( $excerpt ) );
		$words   = explode( ' ', $excerpt, $length + 1 );

		if ( count( $words ) > $length ) {
			array_pop( $words );
			array_push( $words, '...' );
			$excerpt = implode( ' ', $words );
		}

		$excerpt = '<p>' . $excerpt . '</p>';

		return $excerpt;
	}
}

if ( ! function_exists( 'pro_new_get_menu_location' ) ) {
	function pro_new_get_menu_location( $menu_location, $title = false ) {
		$html = array();
		if ( $title ) {

		}
		ob_start();

		if ( has_nav_menu( $menu_location ) ) {
			$html[] = '<h4 class="title"><span>' . wp_get_nav_menu_name( $menu_location ) . '</span><i class="fa fa-chevron-down d-none d-sm-inline-block" aria-hidden="true"></i></h4>';
			wp_nav_menu( array(
				'theme_location' => $menu_location,
				'menu_class'     => 'main-' . $menu_location,
				'container'      => '',
				'link_before'    => '<span class="pro_new-link-inner">',
				'link_after'     => '</span>',
			) );
		}

		$html[] = ob_get_clean();

		return implode( "\n", $html );
	}
}

if ( ! function_exists( 'pro_new_get_language_location' ) ) {
	function pro_new_get_language_location() {
		$html = array();
		if ( function_exists( 'pll_current_language' ) ) {
			$all_languages = get_terms( 'term_language', array( 'hide_empty' => false ) );
			$isLang        = pll_current_language();
			$language_attr = pll_the_languages( array( 'raw' => 1 ) );

			$html[] = '<div class="language-choose">';
			$html[] = '<span class="txt">' . esc_html__( 'LANGUAGE' ) . ' <i class="fal fa-angle-down"></i></span>';
			if ( $all_languages ) {
				$html[] = '<ul class="language-list list-style-type pdm-0">';
				foreach ( $all_languages as $language ) {
					$slug      = str_replace( 'pll_', '', $language->slug );
					$valueURL  = ( $isLang == $slug ) ? '#' : $language_attr[ $slug ]['url'];
					$selected  = ( $isLang == $slug ) ? ' chose' : '';
					$iconChose = ( $isLang == $slug ) ? '<i class="icon fal fa-chevron-double-right"></i>' : '';

					$html[] = '<li class="option' . $selected . '"><a href="' . $valueURL . '">' . $iconChose . $language->name . '</a></li>';
				}
				$html[] = '</ul>';
			}
			$html[] = '</div>';
		}

		return implode( '', $html );
	}
}

if ( ! function_exists( 'pro_new_check_function_language' ) ) {
	function pro_new_check_function_language( $function_name = '' ) {
		$check = $function_name();
		if ( function_exists( 'pll_current_language' ) ) {
			$isLang = pll_current_language();
			$check  = ( $isLang == 'vi' ) ? $function_name( '_vi' ) : $function_name();
		}

		return $check;
	}
}

/**
 * Generate image class effect
 */
if (!function_exists('pro_new_generate_image_class_effect')) {
	function pro_new_generate_image_class_effect() {
		$image_effect = pro_new_get_option('image_effect', 'style-1');

		$class = array(
			'gssiacs-image',
			'imge-' . $image_effect
		);

		return implode(' ', $class);
	}
}