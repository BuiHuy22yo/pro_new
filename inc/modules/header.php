<?php
if (!defined('ABSPATH')) {
    return;
}
/**
 * Chosen header from option
 */
if (!function_exists('pro_new_header')) {
    function pro_new_header()
    {
        $header_layout = pro_new_get_option('header_layout', 'header-1');

        if (is_page()) {
            global $post;

            $page_meta = get_post_meta($post->ID, '_page_options', true);
            $header_layout = (pro_new_get_value_in_array($page_meta, 'header_page_setting') == 'custom') ? $page_meta['header_layout'] : $header_layout;
        }

        get_template_part('components/header/' . $header_layout);
    }
}

/**
 * Generate header params
 */
if (!function_exists('pro_new_header_general_params')) {
    function pro_new_header_general_params()
    {
        $header_fullwidth = (boolean)pro_new_get_option('header_fullwidth', false);
        $header_transparent = (boolean)pro_new_get_option('header_transparent', false);
        $header_sticky = (boolean)pro_new_get_option('header_sticky', false);
        if (is_page()) {
            global $post;

            $page_meta = get_post_meta($post->ID, '_page_options', true);
            $header_fullwidth = (pro_new_get_value_in_array($page_meta, 'header_page_setting') == 'custom') ? $page_meta['header_fullwidth'] : $header_fullwidth;
            $header_transparent = (pro_new_get_value_in_array($page_meta, 'header_page_setting') == 'custom') ? $page_meta['header_transparent'] : $header_transparent;
            $header_sticky = (pro_new_get_value_in_array($page_meta, 'header_page_setting') == 'custom') ? $page_meta['header_sticky'] : $header_sticky;
        }

        $params = array(
            'is_fullwidth' => $header_fullwidth,
            'is_transparent' => $header_transparent,
            'is_sticky' => $header_sticky
        );

        return $params;
    }
}

/**
 * General header class
 */
if (!function_exists('pro_new_header_generate_class')) {
    function pro_new_header_generate_class($custom_class)
    {
        $general_options = pro_new_header_general_params();
        $header_class = array(
            'pro_new-header',
            'header-sticky',
            $general_options['is_transparent'] ? 'header-transparent' : '',
            $general_options['is_sticky'] ? 'header-sticky' : '',
            $custom_class
        );

        $inner_class = $general_options['is_fullwidth'] ? 'container-fluid' : 'container';

        return array(
            'wrap' => implode(' ', $header_class),
            'inner' => $inner_class
        );
    }
}

/**
 * Render site logo.
 */
if (!function_exists('pro_new_logo')) {
    function pro_new_logo()
    {
        $home_url = esc_url(home_url('/'));
        $html = array();

        $logoDefault = get_field('logo_default', 'option') ? get_field('logo_default', 'option') : '';
        $logoMobile = get_field('logo_mobile', 'option') ? get_field('logo_mobile', 'option') : '';

        $alt = esc_attr(get_bloginfo('name'));

        $html[] = '<div id="pro_new-site-logo" class="pro_new-site-logo">';

        if ($logoDefault) {
            $html[] = '<a href="' . esc_url($home_url) . '">';
            $html[] = $logoDefault['url'] ? '<img class="pro_new-logo d-none d-md-block" src="' . esc_url($logoDefault['url']) . '" alt="' . $alt . '"/>' : '';
            $html[] = '</a>';
        } else {
            $html[] = '<h1 class="site-name"><a href="' . esc_url($home_url) . '">' . $alt . '</a></h1>';
        }

        $html[] = '</div>';

        return implode("\n", $html);
    }
}

/**
 * Render main navigation menu.
 */
if (!function_exists('pro_new_header_main_menu')) {
    function pro_new_header_main_menu()
    {
        $html = array();

        $html[] = '<nav id="dl-menu" class="pro_new-site-nav dl-menuwrapper d-flex justify-content-md-center justify-content-end">';
        $html[] = '<button class="dl-trigger"><i class="fal fa-bars"></i></button>';
        ob_start();

        if (has_nav_menu('primary')) {
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class' => 'main-nav dl-menu',
                'container' => '',
                'link_before' => '<span class="pro_new-link-inner">',
                'link_after' => '</span>',
            ));
        }

        $html[] = ob_get_clean();
        $html[] = '</nav>';

        return implode("\n", $html);
    }
}

/**
 * Generate header mobile menu
 */
if (!function_exists('pro_new_mobile_menu')) {
    function pro_new_mobile_menu()
    {
        $html = array();
        $html[] = '<div id="pro_new-navigation-mobile">';

        ob_start();

        if (has_nav_menu('mobile')) {
            wp_nav_menu(array(
                'theme_location' => 'mobile',
            ));
        } else {
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'mobile' => true,
            ));
        }

        $html[] = ob_get_clean();

        $html[] = '</div>';

        return implode("\n", $html);

    }
}

/**
 * Generate header mobile icon.
 */
//== [ Render action menu mobile ]
if (!function_exists('pro_new_header_menu_mobile_actions')) {
    function pro_new_header_menu_mobile_actions($custom)
    {
        $html = array();

        if (has_nav_menu('mobile-menu')) {
            $html[] = '<div class="hamburger-menu-mobile ' . $custom . '">';
            $html[] = '<a class="d-flex" href="#menu-mobile"><svg width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg"><line y1="14.5" x2="20" y2="14.5" stroke="black"></line><line y1="7.5" x2="20" y2="7.5" stroke="black"></line><line y1="0.5" x2="20" y2="0.5" stroke="black"></line></svg></a>';
            $html[] = '</div>';
        }

        return implode("\n", $html);
    }
}

/**
 * Render icon search.
 */
if (!function_exists('pro_new_header_icon_search')) {
    function pro_new_header_icon_search()
    {
        $html = '';

        $html .= '<div class="header-search d-flex justify-content-between">';
        $html .= '<input type="text" name="query" value=""  placeholder="Tìm kiếm sản phẩm..." class="input-group-field auto-search form-control " required="">';
        $html .= '<button type="button" class="btn btn-search" >';
        $html .= '<i class="fal fa-search"></i>';
        $html .= '</button>';
        $html .= '</div>';
        return $html;
    }
}

if (!function_exists('pro_new_customer_support')) {
    function pro_new_customer_support()
    {
        $html = '';
        $html .= '<div class="customer_support">';
        $html .= '<image src="https://bizweb.dktcdn.net/100/449/089/themes/853083/assets/phone-call.png?1648454961485"></image>';
        $html .= '<div class="customer_support_body">';
        $html .= '<p>Hỗ trợ khách hàng</p>';
        $html .= '<a class="font-weight-bold " href="tel:0901749128" title="0901749128">0901749128</a>';
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }
}
