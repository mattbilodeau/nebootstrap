<?php
/*
Template Name: Category-Landscapes
*/
?>
<?php get_header();?>
<style>.row img {padding-bottom:5px;padding-left: 5px;padding-right: 5px;}</style>
<div id="content" class="clearfix row">
	<div id="main" class="col col-lg-12 clearfix" role="main">
    	<div class="archives">
        	<div class="row">
				<?php while (have_posts()) : the_post(); 
					$themeta = get_post_meta($post->ID, 'photoQImageSizes' , true);
					$imgurl = $themeta['thumbnail']['imgUrl'];
					?>
           			 <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                        <a href="<?php the_permalink() ?>" title="Permanent Link to <?php the_title(); ?>">
                        	<img src="<?php echo $imgurl ?>" class="img-thumbnail" />
                            <?php //echo get_the_excerpt(); ?>
                	 	</a>
                     </div>
                <?php endwhile; ?>
            </div>
            
            <?php $iQ2Theme->showPagedNav(); ?>
        </div>
    </div>
</div>
<?php get_sidebar(); ?>

<?php get_footer(); ?>
