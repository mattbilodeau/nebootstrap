<?php get_header(); ?>
<main id="main" class="site-main" role="main">
    <?php
    if( have_rows('row_content_wrappers')):
        while( have_rows('row_content_wrappers')) : the_row();
            $background_color = get_sub_field('background_color');
            $background_image = get_sub_field('background_image');
            $background_positions  = get_sub_field('background_position');
            $padding = get_sub_field('padding');
            $content = get_sub_field('content');
            $font_color = get_sub_field('font_color');
                ?>
        <div style="<?php
            if ($background_image) { echo 'background-image: url(\'' . $background_image . '\'); '; }
            if ($background_positions) { echo 'background-position: ' . $background_positions . '); '; }
            if ($background_color) { echo 'background-color: ' . $background_color . '; '; }
            if ($font_color) { echo 'color: ' . $font_color . '; '; }
            if ($padding) { echo 'padding: '. $padding . ';';}
            ?>" class="row-bw">
            	<div class="container">
			<div class="row">
            <!-- content -->
            <?php echo $content; ?>
            <!-- end content -->
			</div>
            	</div>
        </div>
    <?php 	endwhile;
    endif;

    wp_reset_postdata();
    $the_content = get_the_content();
    if($the_content):
        $content_background = get_field('content_background'); ?>
        <div class="content-section" style="<?php
            if ($row_background_color) { echo 'background: ' . $row_background_color . ''; }
            if ($content_background) { echo 'url(\'' . $content_background . '\') repeat'; }  ?>">
                <!-- the_content -->
            	<?php the_content(); ?>
                <!-- end the_content -->
        </div>
    <?php endif; ?>
</main>
<?php get_footer(); ?>
