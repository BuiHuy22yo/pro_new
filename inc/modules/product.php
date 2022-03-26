<?php
if ( ! function_exists( 'product_item_get_thumb' ) ) {
	function product_item_get_thumb() {
		global $product;

		$product_id        = $product->get_id();
		$product_name      = get_the_title( $product_id );
		$attach_id         = get_post_thumbnail_id( $product_id );
		$attachment_ids    = $product->get_gallery_image_ids();
		$thumbnail_cropped = get_query_var( 'thumbnail_cropped' );
		$thumbnail         = wp_get_attachment_image_src( $attach_id, 'woocommerce_medium' );
		$html              = array();

		//Thumnail default woocommerce
		if ( isset( $attachment_ids, $attachment_ids[0] ) ) {
			$thumbnail_hover = wp_get_attachment_image_src( $attachment_ids[0], 'woocommerce_medium' );
		} else {
			$thumbnail_hover = '';
		}

		if ( isset( $thumbnail[0] ) ) {
			if ( $thumbnail_cropped == '' || $thumbnail_cropped == 'cropped' ) {
				$thumb_url = $thumbnail[0];
				if ( isset( $thumbnail_hover[0] ) ) {
					$thumb_hover_url = $thumbnail_hover[0];
				}
			}
		}


		$html[] = '<div class="product-thumbnail">';
		$html[] = '<a href="' . esc_url( get_permalink( $product_id ) ) . '" title="' . esc_attr( $product_name ) . '">';
		$html[] = '<picture><img class="featured-thumbnail" src="' . esc_url( $thumb_url ) . '" alt="' . esc_attr( $product_name ) . '"></picture>';
		if ( ! empty( $attachment_ids[0] ) ) {
			$html[] = '<picture class="hover-image"><img class="featured-thumbnail" src="' . esc_url( $thumb_hover_url ) . '" alt="' . esc_attr( $product_name ) . '"></picture>';
		}
		$html[] = '</a>';
		$html[] = '</div>';

		return implode( '', $html );
	}
}

if ( ! function_exists( 'product_item_get_title' ) ) {
	function product_item_get_title() {
		global $product;

		$product_id = $product->get_id();

		return '<h4 class="product-title"><a href="' . esc_url( get_the_permalink( $product_id ) ) . '">' . get_the_title( $product_id ) . '</a></h4>';
	}
}

if ( ! function_exists( 'product_item_get_price' ) ) {
	function product_item_get_price() {
		return woocommerce_template_loop_price();
	}
}

if ( ! function_exists( 'action_find_showroom' ) ) {
	function action_find_showroom() {
		$product_showroom = pro_new_get_option( 'product_showroom', true );
		$enable_action    = pro_new_get_value_in_array( $product_showroom, 'enable_action' );
		$title            = pro_new_get_value_in_array( $product_showroom, 'title' );

		if ( ! $enable_action && $title == '' ) {
			return;
		}

		return '<button id="btn-find-sr" type="button" class="action-search-showroom"><i class="fa fa-map-marker" aria-hidden="true"></i> <span>' . $title . '</span></button>';
	}
}

if ( ! function_exists( 'get_product_policy' ) ) {
	function get_product_policy() {
		$product_policy = pro_new_get_option( 'product_policy' );
		$html           = array();

		if ( ! $product_policy ) {
			return;
		}
		$html[] = '<div class="product-policy">';
		$html[] = '<ul class="list-items">';
		foreach ( $product_policy as $policy ) {
			$title       = pro_new_get_value_in_array( $policy, 'title' );
			$description = pro_new_get_value_in_array( $policy, 'description' );

			$html[] = '<li class="item">';
			$html[] = '<span class="info">';
			$html[] = '<h5 class="title">' . $title . '</h5>';
			$html[] = '<span class="desc">' . $description . '</span>';
			$html[] = '</span>';
			$html[] = '</li>';
		}
		$html[] = '</ul>';
		$html[] = '</div>';

		echo implode( '', $html );
	}
}

if ( ! function_exists( 'get_product_tabs_summary' ) ) {
	function get_product_tabs_summary() {
		global $post;
		$specifications_img  = get_post_meta( $post->ID, 'specifications_img', true );
		$specifications_list = get_post_meta( $post->ID, 'specifications_list', true );
		$specifications_img  = pro_new_get_value_in_array( $specifications_img, 'url' );
		$specifications_list = $specifications_list ? $specifications_list : array();

		$html        = array();
//		if ( ( get_post()->post_content == '' ) && ! $specifications_img && ! $specifications_list ) {
//			return;
//		}

		$html[] = '<div class="product-tabs-summary-bot product-detail-tabs">';
		$html[] = '<ul class="tab-list">';
		if ( '' !== get_post()->post_content ) {
			$html[] = '<li class="item active"><a href="#tsb1">' . esc_html__( 'Product Description', 'pro_new' ) . '</a></li>';
		}
//		if ( $specifications_list || $specifications_img ) {
		$html[] = '<li class="item"><a href="#tsb1">' . esc_html__( 'Detail', 'pro_new' ) . '</a></li>';
//		}
		$html[] = '</ul>';
		$html[] = '<div class="tab-content">';
		if ( '' !== get_post()->post_content ) {
			$html[] = '<div id="tsb1" class="tab-pane active"><div class="product-description">' . wpautop( get_the_content() ) . '</div></div>';
		}
		if ( $specifications_list || $specifications_img ) {
			$html[] = '<div id="tsb2" class="tab-pane"><div class="main-details">';

			$html[] = '<div class="col-6 pd-0">';
			$html[] = '<ul class="detail-list">';
			foreach ( $specifications_list as $specifications ) {
				$title       = pro_new_get_value_in_array( $specifications, 'title' );
				$description = pro_new_get_value_in_array( $specifications, 'description' );

				$html[] = '<li class="item">';
				$html[] = '<span class="name">' . $title . ':</span>';
				$html[] = '<span class="value">' . $description . '</span>';
				$html[] = '</li>';
			}
			$html[] = '</ul>';
			$html[] = '</div>';

			$html[] = '<div class="col-6 pd-0">';
			$html[] = '<img class="img-responsive" src="' . $specifications_img . '" alt="' . woocommerce_template_single_title() . '">';
			$html[] = '</div>';

			$html[] = '</div></div>';
		}
		$html[] = '</div>';

		$html[] = '</div>';

		echo implode( '', $html );
	}
}

if ( ! function_exists( 'get_product_tabs_policy' ) ) {
	function get_product_tabs_policy() {
		$product_policy_tab_1 = pro_new_get_option( 'product_policy_tab_1' );
		$product_policy_tab_2 = pro_new_get_option( 'product_policy_tab_2' );
		$tab1_title           = pro_new_get_value_in_array( $product_policy_tab_1, 'title' );
		$tab1_content         = pro_new_get_value_in_array( $product_policy_tab_1, 'content' );
		$tab2_title           = pro_new_get_value_in_array( $product_policy_tab_2, 'title' );
		$tab2_list_item       = pro_new_get_value_in_array( $product_policy_tab_2, 'list_item' );
		$active_t1            = $active_t2 = '';
		$html                 = array();

		if ( ! $product_policy_tab_1 && ! $product_policy_tab_2 ) {
			return;
		}

		if ( ( $product_policy_tab_1 && $product_policy_tab_2 ) || ( $product_policy_tab_1 && ! $product_policy_tab_2 ) ) {
			$active_t1 = ' active';
		} elseif ( ! $product_policy_tab_1 && $product_policy_tab_2 ) {
			$active_t2 = ' active';
		}

		$html[] = '<div class="product-tabs-policy product-detail-tabs">';
		$html[] = '<ul class="tab-list">';
		$html[] = $tab1_title ? '<li class="item' . $active_t1 . '"><a href="#tsp1">' . esc_attr( $tab1_title ) . '</a></li>' : '';
		$html[] = $tab2_title ? '<li class="item' . $active_t2 . '"><a href="#tsp2">' . esc_attr( $tab2_title ) . '</a></li>' : '';
		$html[] = '</ul>';

		$html[] = '<div class="tab-content">';
		if ( $tab1_title && $tab1_content ) {
			$html[] = '<div id="tsp1" class="tab-pane' . $active_t1 . '"><br>' . wpautop( $tab1_content ) . '</div>';
		}
		if ( $tab2_title && $tab2_list_item ) {
			$html[] = '<div id="tsp2" class="tab-pane' . $active_t2 . '"><div class="main-details">';

			$html[] = '<div class="product-description">';
			foreach ( $tab2_list_item as $item ) {
				$title = pro_new_get_value_in_array( $item, 'title' );
				$url   = pro_new_get_value_in_array( $item, 'url' );

				$html[] = '<p>';
				if ( $url ) {
					$html[] = '<a href="' . $url . '" target="_blank" rel="noopener noreferrer" title="' . $title . '">' . $title . '</a>';
				} else {
					$html[] = '<span>' . $title . '</span>';
				}
				$html[] = '</p>';
			}
			$html[] = '</div';

			$html[] = '</div></div>';
		}
		$html[] = '</div>';

		$html[] = '</div>';

		echo implode( '', $html );
	}
}
