<?php
/*
Template Name: Homepage
*/
?>
<?php get_header(); ?>
<!-- Jumbotron -->
<div id="hj" class="jumbotron">
  <div class="text-center">
    <div class="row">
      <div class="col-md-8 col-md-push-2 hidden-xs">
        <h1 class="title">WE CAN MEET ALL OF YOUR INFORMATION TECHNOLOGY SYSTEM'S NEEDS FOR ANY SIZE COMPANY</h1>
      </div>
      <div class="visible-xs">
        <h1 class="title-xs">WE CAN MEET ALL OF YOUR INFORMATION TECHNOLOGY SYSTEM'S NEEDS FOR ANY SIZE COMPANY</h1>
      </div>
    </div>
    <div class="well well-sm hidden-xs services">DESIGN / ENGINEERING / INSTALLATION / SALES / SUPPORT</div>
    <div class="visible-xs services-xs">DESIGN / ENGINEERING / INSTALLATION / SALES / SUPPORT</div>
    <div class="row text-center hidden-xs">
      <div class="col-md-4 col-md-push-1 hjbutton">
        <a href="/Enterprise/" class="btn btn-outline-inverse btn-lg">Enterprise IT Solutions</a>
      </div>
      <div class="col-md-4 col-md-push-2 col-md-pull-1 hjbutton">
        <a href="/Small-business/" class="btn btn-outline-inverse btn-lg">Small Business IT Solutions</a>
      </div>
    </div>
    <div class="row visible-xs hjbutton">
        <a href="/Enterprise/" class="btn btn-outline-inverse">Enterprise IT Solutions</a>
        <a href="/Small-business/" class="btn btn-outline-inverse">Small Business IT Solutions</a>
    </div>
    <div class="row">
      <div class="col-md-10 col-md-push-1 hidden-xs">
        <h2 class="choose">CHOOSE A SOLUTION THATS BEST FOR YOU.</h2>
      </div>
      <div class="visible-xs">
        <h2 class="choose-xs">CHOOSE A SOLUTION THATS BEST FOR YOU.</h2>
      </div>

    </div>
  </div>
</div>
<!-- End Jumbotron -->
<!-- service icon -->
<div class="container" id="services">
	<?php echo get_field('service_tab_title', 'option'); ?>
	<div class="row" role="tablist">
		<?php
		if( have_rows('service_tab_repeater', 'option')): $i = -1;
			while( have_rows('service_tab_repeater', 'option')) : the_row(); $i++;
				$title = get_sub_field('title');
				$content = get_sub_field('content');
				$icon  = get_sub_field('icon'); ?>


		<div class="col-md-2 text-center">
			<a href="#service<?php echo $i;?>" style="border: 0px;"  aria-controls="service<?php echo $i; ?>" class="thumbnail" role="tab" data-toggle="tab">			
			<img class="hidden-xs" src="<?php echo $icon ?>" />
			<div class="caption text-center">
				<h5><?php echo $title;?></h5>
			</div>
			</a>
		</div>

<?php 
      endwhile; 
    endif; 
    wp_reset_postdata();?>
  <div class="tab-content">
    <?php
    if( have_rows('service_tab_repeater', 'option')): $i = -1;
	while( have_rows('service_tab_repeater', 'option')) : the_row(); $i++;
	  $title = get_sub_field('title');
	  $content = get_sub_field('content');
	  $eurl = get_sub_field('enterprise_link');
	  $surl = get_sub_field('small_business_link');
	  $icon  = get_sub_field('icon'); ?>
    <div role="tabpanel" class="tab-pane<?php if ($i ==0) echo " active" ?>" id="service<?php echo $i;?>">
      <div class="row">
        <div class="col-md-6 link valign-wrapper valign">
		<h1 style="margin: 0px;"><?php echo $title; ?></h1>
		<?php echo $content;?>
	</div>
	  <div class="col col-md-3 link valign-wrapper border-right valign">
	    <a href="<?php echo $eurl; ?>"><strong>Enterprise</strong>click here<i class="material-icons">&#xE5C5;</i></a>
	  </div>
    	  <div class="col col-md-3 link valign-wrapper valign">
	    <a href="<?php echo $surl; ?>"><strong>small business</strong>click here<i class="material-icons">&#xE5C5;</i></a>
	  </div>
	</div>
     </div>
 <?php endwhile; endif; wp_reset_postdata();?>
    </div>
    <div class="clear"></div>
  </div>
</div>
<!-- end service icons -->
<?php get_footer(); ?>
