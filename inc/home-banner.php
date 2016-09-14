<?php
/*
Zen Agency Home Page slider
*/
?>
<div class="home-banner">
<?php if ( is_active_sidebar( 'home-banner' )) : ?>
	<div id="home-banner">
		<?php dynamic_sidebar( 'home-banner' ); ?>
        </div>
<?php endif; ?>
</div>
