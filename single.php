<?php get_header(); ?>
<div id="content" class="container">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="companylogoname pull-right" style="margin-left: 40px;">
		<?php the_post_thumbnail( 'wpbs-featured' ); ?><br />
		<h1><?php the_title(); ?></h1>
	</div>

	<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
	
		<header></header>		
		<section class="post_content clearfix" itemprop="articleBody">
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</section>			
		<footer>
		</footer> 			
	</article> 		
					
	<?php endwhile; ?>			
					
<?php else : ?>
					
	<article id="post-not-found">
		<header>
			<h1><?php _e("Not Found", "wpbootstrap"); ?></h1>
		</header>
		<section class="post_content">
			<p><?php _e("Sorry, but the requested resource was not found on this site.", "wpbootstrap"); ?></p>
		</section>
		<footer></footer>
	</article>
<?php endif; ?>		
</div>
<?php get_footer(); ?>