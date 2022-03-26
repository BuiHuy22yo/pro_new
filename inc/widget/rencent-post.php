<?php
/*
* Author : DoBao
* Author URL : dovanbao.com
*/
class AHT_Widget_Recent_Posts extends WP_Widget
{
	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @var array
	 */
	protected $defaults;

	/**
	 * Constructor
	 *
	 * @return AHT_Widget_Recent_Posts
	 */
	function __construct()
	{
		$this->defaults = array(
			'title'         => '',
			'limit'         => 5,
			'excerpt'       => 0,
			'length'        => 10,
			'thumb'         => 1,
			'thumb_default' => 'http://placehold.it/80x80',
			'cat'           => '',
			'date'          => 1,
			'date_format'   => 'd/m/Y',
		);

		parent::__construct(
			'aht-recent-posts-widget',
			__( '[AHT] Recent Posts', 'aht' ),
			array(
				'classname'   => 'aht-recent-posts-widget',
				'description' => __( '[AHT] Rencent Posts.', 'aht' )
			)
		);
	}

	/**
	 * Display widget
	 *
	 * @param array $args     Sidebar configuration
	 * @param array $instance Widget settings
	 *
	 * @return void
	 */
	function widget( $args, $instance )
	{
		$instance = wp_parse_args( $instance, $this->defaults );
		extract( $instance );

		$query_args = array(
			'posts_per_page'      => $limit,
			'post_status'         => 'publish',
			'post_type'           => 'post',
			'ignore_sticky_posts' => true,
		);
		if ( ! empty( $cat ) && is_array( $cat ) )
			$query_args['category__in'] = $cat;

		$query = new WP_Query( $query_args );

		if ( ! $query->have_posts() )
			return;

		extract( $args );

		echo $before_widget;

		if ( $title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) )
			echo $before_title . $title . $after_title; ?>
		<ul class="list-post-ct">
			<?php while ( $query->have_posts() ) : $query->the_post();
				$class = $thumb ? '' : 'aht-list';
				$url_thumbnail = get_the_post_thumbnail_url();
				?>
				<li class="aht-recent-post <?php echo $class; ?>">
						<?php if ( $thumb ) {
							if ( has_post_thumbnail()) { ?>
								<div class="rencent-post-thumbnail">
									<a href="<?php the_permalink() ?>" class="pro_new-image-wrapper">
										<img src="<?php echo mr_image_resize($url_thumbnail, 69, 69, true, 'c', false); ?>"
											 alt="<?php the_title(); ?>">
									</a>
								</div>
							<?php } else {
								echo '<img alt="'.get_the_title() .'" src="'.$thumb_default.'" />';
							}
						} ?>
						<div class="aht-text">
							<h5 class="aht-title"><?php the_title(); ?></h5>
							<div class="date-detail">
								<?php
								if ( $date )
									echo '<span class="meta-post-wg"><i class="fa fa-calendar"></i><time class="hrm-date" datetime="' . get_the_time( 'c' ) . '">' . esc_html( get_the_time( $date_format ) ) . '</time></span>';
								if ( $excerpt )
								{
									echo '<div class="hrm-excerpt">' . wp_trim_words( get_the_content(), $length, '...') . '</div>';
								}
								?>
							</div>
						</div>
				</li>
			<?php
			endwhile; ?>
		</ul>
		<?php wp_reset_postdata();

		echo $after_widget;

	}

	/**
	 * Update widget
	 *
	 * @param array $new_instance New widget settings
	 * @param array $old_instance Old widget settings
	 *
	 * @return array
	 */
	function update( $new_instance, $old_instance )
	{
		$instance                  = $old_instance;
		$instance['title']         = strip_tags( $new_instance['title'] );
		$instance['limit']         = (int) ( $new_instance['limit'] );
		$instance['cat']           = array_filter( $new_instance['cat'] );
		$instance['thumb']         = ! empty( $new_instance['thumb'] );
		$instance['thumb_default'] = $new_instance['thumb_default'];

		$instance['date']          = ! empty( $new_instance['date'] );
		$instance['date_format']   = strip_tags( $new_instance['date_format'] );
		$instance['excerpt']       = ! empty( $new_instance['excerpt'] );
		$instance['length']        = (int) ( $new_instance['length'] );

		return $instance;
	}

	/**
	 * Display widget settings
	 *
	 * @param array $instance Widget settings
	 *
	 * @return void
	 */
	function form( $instance )
	{
		$instance = wp_parse_args( $instance, $this->defaults );
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title', 'aht' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $instance['title']; ?>">
		</p>

		<div style="width: 280px; float: left; margin-right: 10px;">
			<p>
				<input id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>" type="text" size="2" value="<?php echo $instance['limit']; ?>">
				<label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"><?php _e( 'Number Of Posts', 'aht' ); ?></label>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat' ) ); ?>"><?php _e( 'Select Category: ', 'aht' ); ?></label>
				<select class="widefat" multiple="multiple" id="<?php echo esc_attr( $this->get_field_id( 'cat' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'cat' ) ); ?>[]">
					<option value=""<?php selected( empty( $instance['cat'] ) ); ?>><?php _e( 'All', 'aht' ); ?></option>
					<?php
					$categories = get_terms( array( 'taxonomy' => 'category', 'hide_empty' => false) );
					foreach ( $categories as $category )
					{
						printf(
							'<option value="%s"%s>%s</option>',
							$category->term_id,
							selected( in_array( $category->term_id, (array) $instance['cat'] ) ),
							$category->name
						);
					}
					?>
				</select>
			</p>
			<p>
				<input id="<?php echo esc_attr( $this->get_field_id( 'thumb' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'thumb' ) ); ?>" type="checkbox" value="1" <?php checked( $instance['thumb'] ); ?>>
				<label for="<?php echo esc_attr( $this->get_field_id( 'thumb' ) ); ?>"><?php _e( 'Show Thumbnail', 'aht' ); ?></label>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'thumb_default' ) ); ?>"><?php _e( 'Default Thumbnail', 'aht' ); ?></label>
				<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'thumb_default' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'thumb_default' ) ); ?>" value="<?php echo $instance['thumb_default']; ?>">

			</p>

			<p>
				<input id="<?php echo esc_attr( $this->get_field_id( 'date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'date' ) ); ?>" type="checkbox" value="1" <?php checked( $instance['date'] ); ?>>
				<label for="<?php echo esc_attr( $this->get_field_id( 'date' ) ); ?>"><?php _e( 'Show Date', 'aht' ); ?></label>
			</p>
			<p>
				<input size="6" id="<?php echo esc_attr( $this->get_field_id( 'date_format' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'date_format' ) ); ?>" type="text" value="<?php echo $instance['date_format']; ?>">
				<label for="<?php echo esc_attr( $this->get_field_id( 'date_format' ) ); ?>"><?php _e( 'Date Format', 'aht' ); ?></label>
				<a href="http://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">[?]</a>
			</p>
			<p>
				<input id="<?php echo esc_attr( $this->get_field_id( 'excerpt' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'excerpt' ) ); ?>" type="checkbox" value="1" <?php checked( $instance['excerpt'] ); ?>>
				<label for="<?php echo esc_attr( $this->get_field_id( 'excerpt' ) ); ?>"><?php _e( 'Show Excerpt', 'hrm' ); ?></label>
			</p>
			<p>
				<input id="<?php echo esc_attr( $this->get_field_id( 'length' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'length' ) ); ?>" type="text" size="2" value="<?php echo $instance['length']; ?>">
				<label for="<?php echo esc_attr( $this->get_field_id( 'length' ) ); ?>"><?php _e( 'Excerpt Length (words)', 'aht' ); ?></label>
			</p>
		</div>

		<div style="clear: both;"></div>
		<?php
	}

}
