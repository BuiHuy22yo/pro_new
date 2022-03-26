<?php
if (!defined('ABSPATH')) {
	return;
}

$sidebar = 'primary-bar';

?>

<?php if (is_active_sidebar($sidebar)) : ?>
	<div class="pro_new-sidebar col-lg-3">
		<aside id="sidebar">
			<?php dynamic_sidebar($sidebar); ?>
		</aside>
	</div>
<?php endif; ?>
