<?php
/**
 * The template for displaying paging style navigation
 *
 * @package WordPress
 * @subpackage hitron
 * @since hitron 1.0
 */
global $wp_query, $wp_rewrite;
$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
$pagenum_link = html_entity_decode( get_pagenum_link() );
$query_args   = array();
$url_parts    = explode( '?', $pagenum_link );

if ( isset( $url_parts[1] ) ) {
	wp_parse_str( $url_parts[1], $query_args );
}

$pagenum_link = esc_url( remove_query_arg( array_keys( $query_args ), $pagenum_link ) );
$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

$format = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

$pagi_size = bingo_get_customize_option( 'pagi_size', 'medium' );

$nav_class = array(
	'paging-navigation',
	$pagi_size,
	'clearfix',
);
$nav_class = array_filter( $nav_class );
?>
<div class="<?php echo implode( ' ', $nav_class ); ?>">
	<?php echo paginate_links( array(
		'base'      => $pagenum_link,
		'format'    => $format,
		'total'     => $wp_query->max_num_pages,
		'current'   => $paged,
		'mid_size'  => 1,
		'add_args'  => array_map( 'urlencode', $query_args ),
		'prev_text' => '<span>Prev</span>',
		'next_text' => '<span>Next</span>',
	) ); ?>
</div>