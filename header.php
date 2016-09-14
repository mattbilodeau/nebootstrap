<!doctype html>  

<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php wp_title( '|', true, 'right' ); ?></title>	
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- media-queries.js (fallback) -->
		<!--[if lt IE 9]>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>			
		<![endif]-->

		<!-- html5.js -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

  		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">	

		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->

	</head>

<body <?php body_class(); ?>>
	<header role="banner">
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>

				<a class="navbar-brand hidden-xs" title="<?php echo get_bloginfo('description'); ?>" href="<?php echo home_url(); ?>">
					<img height="55" class="img-response" src="/wp-content/uploads/2016/07/NortheastData-logo-800.png" />
				</a>
				<a class="navbar-brand visible-xs" title="<?php echo get_bloginfo('description'); ?>" href="<?php echo home_url(); ?>">
                                        <img height="25" class="img-response" src="/wp-content/uploads/2016/07/NortheastData-logo-800.png" />
                                </a>
			</div>
			<div class="pull-right">
				<div class="pull-right needhelp hidden-xs">Need Help?  <span class="">Lets Talk</span> <a href="tel:8664353816">866.435.3816</a></div>
					<div class="collapse navbar-collapse navbar-responsive-collapse">    
						<?php wp_bootstrap_main_nav(); // Adjust using Menus in Wordpress Admin ?>
					</div>
				</div>
			</div>
		</nav>
	</header>

<?php
if (!is_front_page()) {
	$parent_title = get_the_title($post->post_parent);
	$my_title = get_the_title($post->post_ID);
	$header_background_image = get_field('header_background_image');
	if ($header_background_image) { $bgurl = $header_background_image;
	} else $bgurl = '/wp-content/uploads/2016/03/Home-background.jpg';
?>
<div id="pageheader-jumbotron" class="jumbotron" style="background: url('<?php echo $bgurl ?>') no-repeat center bottom">
	<div class="pageheader">
		<?php
		//if ($parent_title != "" && $parent_title != $my_title) echo $parent_title . ": ";
		echo $my_title;
		?>
	</div>
	<div class="pageheaderbanner">
		<div class="pull-right hidden-xs pageheaderbanner-icon">
        		<?php
			$banner_content = get_field('banner_content');	
			if ($banner_content) {
				$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $banner_content, $matches);
				$first_img = $matches [1] [0];
				?><img src="<?php echo $first_img ?>" alt="" /><?php
			} else {
				?><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" alt="Northeast Data Inc" /><?php
			}
			?>
        	</div> 
        	<div class="row">
    			<h3><?php echo $my_title ?></h3>
			<?php
			$bmh = get_field('select_banner_type');
			if ($bmh == "banner_menu") {
				wp_bootstrap_banner_nav();
			}
			?>
        	</div>
	</div>
</div>
<?php } ?>

