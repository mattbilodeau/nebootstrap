jQuery(document).ready(function($) { 
  	$('.casestudies-slider').bxSlider({
		auto: true,
		
	});
	  $('.parallax').parallax();
	  
/*   var className = $('.menu-item-has-children').attr('class');
var id = parseFloat(className.match(/-*[0-9]+/));
$('.menu-item' + id).find('.sub-menu').attr( "id", function() {
    return 'sub-menu' + id;
	
  });
$('.menu-item' + id).attr( "data-activates", function() {
    return 'sub-menu' + id;
  });

$('.menu-item-has-children').dropdown();*/
/**
	* Toggle expanded UI
	*/
	$('.toggle-button').click(function(e){
		e.preventDefault();

		// Cache selector
		var button = $(this);

		// Rotate this button
		if( button.is(':not(".no-animation")') ){
			button.addClass( 'rotate animated' );			
		}

		// Get target ID
		var target_id 		= button.attr( 'data-target-id' );
		var sliding_content = $('#'+target_id).find('.sliding-content');
		var direction		= sliding_content.attr( 'data-direction' );

		// Display target ID
		if( $('#'+target_id).is(':visible') ){
			$('#'+target_id).fadeOut(function(){
				// Remove rotation
				button.removeClass( 'rotate animated' );
			});

			if( 'left' == direction ){
				sliding_content.animate({ 'left' : '-100%' });
			}

			if( 'bottom' == direction ){
				sliding_content.animate({ 'top' : '100%' });
			}
		} else {
			$('#'+target_id).fadeIn(function(){
				// Remove rotation
				button.removeClass( 'rotate animated' );
			});

			if( 'left' == direction ){
				sliding_content.animate({ 'left' : '0' });
			}

			if( 'bottom' == direction ){
				sliding_content.animate({ 'top' : '0' });
			}
		}

		// Mark body
		$('body').toggleClass( target_id + '-expanded' );
	});
});



(function($){
	
	
	if( $( document ).scrollTop() > 0){
		$( '.site-header' ).addClass( 'fixed' );			
	}

	// Add opacity class to site header
	$( document ).on('scroll', function(){

		if ( $( document ).scrollTop() > 0 ){
			$( '.site-header' ).addClass( 'fixed' );			

		} else {
			$( '.site-header' ).removeClass( 'fixed' );			
		}

	});

  $(function(){
    $('.button-collapse').sideNav();
    $('.parallax').parallax();
	$(".primarynav").dropdown();
  });
	function equalHeight(group) {
				   tallest = 0;
				   group.each(function() {
					  thisHeight = jQuery(this).height();
					  if(thisHeight > tallest) {
						 tallest = thisHeight;
					  }
				   });
			   		group.height(tallest);
				}
			jQuery(window).load(function($) { 	
		   		equalHeight(jQuery(".service-tab-content .valign-wrapper"));
				equalHeight(jQuery(".site-info .valign-wrapper"));
				equalHeight(jQuery(".team-wrap .col"));
			});

jQuery(window).load(function($) { 	
jQuery('.indicator').append( '<i class="material-icons">&#xE5C5;</i>');
  });
  
  
  

})(jQuery); // end of jQuery name space

jQuery(function( $ ){

	$(window).resize(function(){
		if(window.innerWidth > 1023) {
			$("#nav-mobile .sub-menu").removeAttr("style");
			$("#nav-mobile .menu-item").removeClass("menu-open");
		}
	});

	$("#nav-mobile .menu-item").click(function(event){
		if (event.target !== this)
		return;
			$(this).find(".sub-menu:first").slideToggle(function() {
			$(this).parent().toggleClass("menu-open");
		});
	});

});