<?php

/**

 * The template for displaying Row sction 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package zenAgency
 *
 * Template Name: Case Studies Archive Origional
*/
get_header(); ?>
<div class="container">
<?php
	$case_studies = new WP_Query(array( 'post_type' => 'case_studies', 'posts_per_page' => -1, 'order'   => 'DSC', ) );
	while ( $case_studies->have_posts() ) : $case_studies->the_post(); $count++; 
		$position_held = get_field('position_held');
		?>
    	<div class="col-md-6">
        	<div class="row">
            	<div class="col-sm-7">
		<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail('team-thumbnail', array('class' => 'alignleft'));
			} else {
				echo '<img width="300" height="300" src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/team-thumbnail.jpg" class="aligncenter wp-post-image" alt="Zen Agency Placeholder" />';
			}
		?>
				</div>
				<div class="col-sm-5" style="padding-top: 15px;">
                    <a href="<?php echo the_permalink(); ?>"><h4 class="team-title" title=" <?php the_title(); ?>"><?php the_title(); ?></h4></a>
                    <strong><?php echo  $position_held; ?></strong>
                    <p><?php echo the_excerpt(); ?></p>
                    <a href="<?php echo the_permalink(); ?>" class="read-more">READ MORE</a> 
                </div>
			</div>
		</div>
<?php	endwhile; wp_reset_postdata();?>
</div>
<?php get_footer(); ?>
