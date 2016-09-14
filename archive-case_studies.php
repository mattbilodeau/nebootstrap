<?php

/**

 * The template for displaying Row sction 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package zenAgency
 *
 * Template Name: Case Studies Archive
*/
get_header(); ?>
<div class="container" id="services" style="min-height: 350px;">
	<h1><?php the_title(); ?></h1>
	<ul class="nav nav-pills nav-justified" role="tablist">
<?php
	$case_studies = new WP_Query(array( 'post_type' => 'case_studies', 'posts_per_page' => -1, 'order'   => 'DSC', ) );
	while ( $case_studies->have_posts() ) : $case_studies->the_post(); $count++;?>
		<li role="presentation" class="<?php if ($count == 1) { echo "active"; }; ?>">
			<a href="#case<?php echo $count;?>" 
				aria-controls="case<?php echo $count; ?>" 
				class="btn btn-primary" role="tab" data-toggle="tab"><?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail(array(100, 100));
		} else {
			echo '<img width="100" height="100" src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/team-thumbnail.jpg" class="aligncenter wp-post-image" alt="" />';
		}
		?><h5><?php echo the_title(); ?></h5></a>	
		</li>
		<?php endwhile; wp_reset_postdata();?>
	</ul>
	<div class="tab-content"><?php
	$count = 0;
	$case_studies = new WP_Query(array( 'post_type' => 'case_studies', 'posts_per_page' => -1, 'order'   => 'DSC', ) );
	while ( $case_studies->have_posts() ) : $case_studies->the_post(); $count++;?>
		<div role="tabpanel" class="tab-pane<?php if ($count == 1) echo " active" ?>" id="case<?php echo $count;?>">
			<div class="row">
				<div class="col-md-8">
<p><?php echo the_excerpt(); ?></p>
				</div>
				<div class="col-md-4">
<h2><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></h2>
<a href="<?php echo the_permalink(); ?>" class="read-more">Project Details</a> 
				</div>
			</div>
		</div>
	<?php endwhile; ?>
	</div>
</div>
<?php get_footer(); ?>
