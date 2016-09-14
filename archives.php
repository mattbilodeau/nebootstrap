<?php
/*
Template Name: Archives
*/
?>
<?php get_header();?>
<style>.row img {padding-bottom:5px;padding-left: 5px;padding-right: 5px;}</style>
<div id="content" class="clearfix row">
	<div id="main" class="col col-lg-12 clearfix" role="main">
    	<div class="archives">
        	<div class="row">
            <?php
                $temp = $wp_query;
                $wp_query= null;
                $wp_query = new WP_Query();
                $wp_query->query($iQ2Theme->getPagedArchiveQuery());
            ?>
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
	
	
	<?php //reset to the old one
		$wp_query = null; $wp_query = $temp;
	?>
</div>
<?php get_sidebar(); ?>

<?php get_footer(); ?>
