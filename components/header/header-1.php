<?php
/**
 * Created by vagrant.
 * User: vagrant
 * Date: 9/28/2019
 * Time: 9:56 AM
 */
?>

<header class="<?php echo pro_new_header_generate_class('header-1')['wrap']; ?>">
	<div class="header-main <?php echo pro_new_header_generate_class('header-1')['inner']; ?>">
		<div class="pro_new-inner row align-items-center">
			<div class="col-md-2 col-lg-2 col-xl-3">
				<div class="header-main-logo">
					<?php echo pro_new_logo(); ?>
				</div>
			</div>
			<div class="col-md-8 col-lg-8 col-xl-6 header-main-menu">
                <?php echo pro_new_header_main_menu(); ?>
			</div>
			<div class="col-md-2 col-lg-2 col-xl-3">
				<div class="header-main-optional d-flex align-items-center justify-content-end">
					<div class="header-search">

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                <i class="fal fa-search"></i>
                            </button>



					</div>
					<div class="header-user">
                        <?php $user_url = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ? get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) : '#';?>
						<a href="<?php echo $user_url?>"><i class="fal fa-user"></i></a>
					</div>
					<div class="header-cart">
						<?php echo pro_new_header_icon_cart(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
