( function ($) {
'use strict';
jQuery(document).ready(function() {
	

	

	//Collapse navigation on click (Bootstrap 3 is missing it)
	$('.nav a').on('click', function () {
		$('#my-nav').removeClass('in').addClass('collapse');
	});

	



	// Minify the Nav Bar
	$(document).scroll(function () {
		var position = $(document).scrollTop();
		var headerHeight = $('#header').outerHeight();
		if (position >= headerHeight - 100){
				$('.navbar').addClass('minified');
		} 


		// Parallax effect on #Header
		$(".banner .container").css({
			'opacity' : (1 - position/500)
		});


		// Show "Back to Top" button
		if (position >= headerHeight - 100){
			$('.scrolltotop').addClass('show-to-top');
		} else {
			$('.scrolltotop').removeClass('show-to-top');
		}

		

	

	});


	// Nice scroll to DIVs


	$('.navbar-nav li a').click(function(evt){
		var place = $(this).attr('href');
		$('html, body').animate({
			scrollTop: $(place).offset().top - 110
			}, 1200, 'easeInOutCubic');
		pde(evt);
	});


	// Scroll down from Header
	$('#header p a').click(function(evt) {
		var place = $(this).attr('href');
		$('html, body').animate({scrollTop: $(place).offset().top}, 1200, 'easeInOutCubic');
		pde(evt);
	});


	// Scroll on Top
	$('.scrolltotop, .navbar-brand').click(function(evt) {
		$('html, body').animate({scrollTop: '0'}, 1200, 'easeInOutCubic');
		$('.sub').hide();
		pde(evt);
	});

	
	
	//masonry block
	// var container = document.querySelector('#our-service-container');
	// var msnry = new Masonry( container, {
	// // options
	// itemSelector: '.our-service'
	// });
	

	//time line scrollbar
	$('#default').perfectScrollbar({wheelPropagation:true});

	
	//Portfolio filterable grid
 $('#portfolio-grid').mixitup({
	targetSelector: '.portfolio-mix',
	});
	
	
	
	//show hide portfolio category
	$('#showhidetarget').hide();
        $('a#showhidetrigger').click(function () {
		$('#showhidetarget').toggle(400);
    });
	
	
	//Function to prevent Default Events
	function pde(e){
		if(e.preventDefault)
			e.preventDefault();
		else
			e.returnValue = false;
	}
	
});

//Window load function
$(window).load(function() {
	//preloader
	//$("#status").fadeOut();
	$("#preloader").delay(350).fadeOut("slow");
	

});
  



//header Parallax image
(function($){
	 var Picture = (function(){
		 var parent = {};
		 var _window,_picture;
		 parent.init = function(){
			_window = $(window);
			_picture = $(".picture");
			parent.delegate();
		}
		parent.delegate = function(){
			_window.on("scroll",parent.scrollPos);
			_window.on("resize",parent.scrollPos);
		}
		parent.scrollPos = function(){
			if($(window).width()>754){
				var scroll = Math.max(0,_window.scrollTop()-200);
				scroll = Math.min(1,scroll/($(window).height()-200));
				scroll = 1 - scroll;
				_picture.css({
					backgroundPosition: "50% "+(scroll*100)+"%"
				});
			}else{
				_picture.css("background-position","");
			}
		}
		return parent;
	})();
	$(document).ready(Picture.init);
	})(jQuery)
//end	.

//post slider initialization
jQuery(document).ready(function($){$('#post-slider').carousel({slider:'.slider',slide:'.slide',addPagination:false,addNav:false,speed:800,nextSlide:'.post-next',prevSlide:'.post-prev'});});(jQuery);
	
//team slider initialization
jQuery(document).ready(function($){$('#team-slider').carousel({slider:'.slider',slide:'.slide',addPagination:false,addNav:false,speed:800,nextSlide:'.team-next',prevSlide:'.team-prev'});});(jQuery);

//splash slider initialization
jQuery(document).ready(function($){$('#splash-slider').carousel({slider:'.slider',slide:'.slide',addPagination:false,addNav:false,speed:800,nextSlide:'.splash-next',prevSlide:'.splash-prev'});});(jQuery);

//passport slider initialization
jQuery(document).ready(function($){$('#passport-slider').carousel({slider:'.slider',slide:'.slide',addPagination:false,addNav:false,speed:800,nextSlide:'.passport-next',prevSlide:'.passport-prev'});});(jQuery);

//exchange slider initialization
jQuery(document).ready(function($){$('#exchange-slider').carousel({slider:'.slider',slide:'.slide',addPagination:false,addNav:false,speed:800,nextSlide:'.exchange-next',prevSlide:'.exchange-prev'});});(jQuery);

//about slider initialization
jQuery(document).ready(function($){$('#about-slider').carousel({slider:'.slider',slide:'.slide',addPagination:false,addNav:false,speed:800,nextSlide:'.about-next',prevSlide:'.about-prev'});});(jQuery);

//brain popovers
$('.brain').popover();
$('.exchange').popover();


 //placeholder support
 $(function() {
	// Invoke the plugin
	$('input, textarea').placeholder();
});
			
}( jQuery ));