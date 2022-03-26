<?php
require_once get_template_directory() . '/inc/widget/rencent-post.php';


/**
 * Register widgets
 *
 * @return void
 * @since 1.0
 */
add_action( 'widgets_init', 'aht_register_widgets' );
function aht_register_widgets()
{
	register_widget( 'AHT_Widget_Recent_Posts' );

}