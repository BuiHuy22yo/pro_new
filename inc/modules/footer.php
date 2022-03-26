<?php
if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/**
 * Footer area
 */
if ( ! function_exists( 'pro_new_footer_area' ) ) {
	function pro_new_footer_area( $slug = '_en' ) {
		$logo_footer = pro_new_get_option( 'pro_new_footer_logo' ) ? pro_new_get_option( 'pro_new_footer_logo' ) : array( 'url' => '' );
		$background_footer_main = pro_new_get_option( 'pro_new_footer_background' ) ? pro_new_get_option( 'pro_new_footer_background' ) : "#000000";
		$text_footer_main = pro_new_get_option( 'pro_new_footer_about' ) ? pro_new_get_option( 'pro_new_footer_about' ) : "";

		$pro_new_footer_title_col_2 = pro_new_get_option( 'pro_new_footer_title_col_2' ) ? pro_new_get_option( 'pro_new_footer_title_col_2' ) : "";
		$pro_new_footer_select_menu_col_2 = pro_new_get_option( 'pro_new_footer_select_menu_col_2' ) ? pro_new_get_option( 'pro_new_footer_select_menu_col_2' ) : "footer-menu";

		$pro_new_footer_title_col_3 = pro_new_get_option( 'pro_new_footer_title_col_3' ) ? pro_new_get_option( 'pro_new_footer_title_col_3' ) : "";
		$pro_new_footer_editor_col_3 = pro_new_get_option( 'pro_new_footer_editor_col_3' ) ? pro_new_get_option( 'pro_new_footer_editor_col_3' ) : "footer-menu";

		$background_footer_absolute = pro_new_get_option( 'pro_new_footer_background_absolute' ) ? pro_new_get_option( 'pro_new_footer_background_absolute' ) : "#000000";
		$text_footer_absolute = pro_new_get_option( 'pro_new_footer_absolute' ) ? pro_new_get_option( 'pro_new_footer_absolute' ) : "";
		?>
		<footer style="background-color: <?php echo $background_footer_main; ?>">
			<div class="container footer-option">
				<div class="footer-main">
					<div class="row">
						<div class="col-md-4">
							<div class="inner">
								<div class="logo-fotoer">
									<a href="/">
										<img src="<?php echo $logo_footer['url']; ?>" alt="">
									</a>
								</div>
								<div class="text-about">
									<p>
										<?php echo $text_footer_main; ?>
									</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="inner">
								<div class="title">
									<h4><?php echo $pro_new_footer_title_col_2; ?></h4>
								</div>
								<nav class="footer-link" data-columns="2">
									<?php
									wp_nav_menu(array('menu_class'=>'columns','theme_location'=>$pro_new_footer_select_menu_col_2))
									?>
								</nav>
							</div>
						</div>
						<div class="col-md-4 top-post">
							<div class="title">
								<h4><?php echo $pro_new_footer_title_col_3; ?></h4>
							</div>
							<div class="text-post">
								<?php echo $pro_new_footer_editor_col_3; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-absolute" style="background-color: <?php echo $background_footer_absolute; ?>">
				<div class="container">
					<div class="inner">
						<?php echo $text_footer_absolute; ?>
					</div>
				</div>
			</div>
		</footer>

		<?php
	}
}
