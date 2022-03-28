<?php
if (!defined('ABSPATH')) {
	return;
}

/**
 * Theme Setup
 */
if (!function_exists('mbc_create_postype_sanpham')) {
    add_action('init', 'mbc_create_postype_sanpham');
    function mbc_create_postype_sanpham()
    {
        $args = array(
            'labels' => array(
                'name' => esc_html__('Sản Phẩm', 'mbc'),
                'singular_name' => esc_html__('Sản Phẩm', 'mbc'),
                'add_new_item' => esc_html__('Add Sản Phẩm', 'mbc'),
                'add_new' => esc_html__('Add Sản Phẩm', 'mbc'),
            ),
            'public' => true,
            'has_archive' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => true,
            'hierarchical' => false,
            'taxonomies' => array('category', 'post_tag'),
            'supports' => array('title', 'editor', 'thumbnail','author'),
            'menu_icon' => 'dashicons-products',
            'rewrite' => array(
                'slug' => 'sanpham',
                'with_front' => true,
                'feeds' => true,
                'pages' => true,
            ),
        );

        register_post_type('sanpham', $args);
    }
}
