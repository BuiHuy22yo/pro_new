<?php
/**
 * Created by vagrant.
 * User: vagrant
 * Date: 9/28/2019
 * Time: 9:56 AM
 */
?>

<header class="<?php echo pro_new_header_generate_class('header-1')['wrap']; ?> ">
    <div class="header-main <?php echo pro_new_header_generate_class('header-1')['inner']; ?>">
        <div class="pro_new-inner row align-items-center">
            <div class="col-lg-2 col-xl-2">
                <div class="header-main-logo">
                    <?php echo pro_new_logo(); ?>
                </div>
            </div>
            <div class="col-lg-5 col-xl-5">
                <?php echo pro_new_header_icon_search(); ?>
            </div>
            <div class="col-lg-5 col-xl-5">
                <?php echo pro_new_customer_support(); ?>
            </div>

            <div class="col-12 d-none">
                <?php echo pro_new_header_main_menu(); ?>
            </div>

        </div>
    </div>
</header>
