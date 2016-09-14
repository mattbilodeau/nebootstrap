<?php
$selected = get_field('partners_section_enabler');

if ($selected != "") { 
	if( in_array('yes', $selected) ) {
		echo partners_func();
	}
}
echo case_studies_slider_func();
echo certifications_func();

if ($post->post_parent == 8 || $post->post_parent == 10) more_services_func_thumbnail($post->post_parent);


function year_shortcode() {
  $year = date('Y');
  return $year;
}
add_shortcode('year', 'year_shortcode');

$site_info_footer_left = get_field('site_info_footer_left', 'option');
$site_info_footer_right = get_field('site_info_footer_right', 'option');

if($site_info_footer_left && $site_info_footer_right):

?>
<footer class="footer">
	<div class="container">
		<div class="row">
        		<div class="col-md-6">
				<?php echo $site_info_footer_left; ?>
			</div>
            		<div class="col-md-6">
				<?php echo $site_info_footer_right; ?>
			</div>
		</div>
	</div>
</footer>        
        
	<!--[if lt IE 7 ]>
<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
	<![endif]-->

	<?php wp_footer(); // js scripts are inserted using this function ?>
	
 <?php endif; ?>
</body>
</html>
