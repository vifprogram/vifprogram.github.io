	<!-- Footer -->
	
    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-md-4">
                        <em>VIF International Education builds global education programs that prepare students for success in an interconnected world. For more than 25 years, educators have leveraged VIF’s professional development and curriculum, language acquisition and teacher exchange programs to generate engaging learning environments where students can excel in core curriculum as well as develop valuable critical and creative thinking skills.</em>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-4">
                                <strong>
                                    <a href="/">Home</a>
                                </strong>
                            </div>
                            <div class="col-md-4 ">
                                <strong>
                                    <a href="/about.html">About VIF</a>
                                </strong>
                                <p>
                                    <a href="/our-story.html">Our Story</a>
                                </p>
                                <p>
                                    <a href="/staff.html">Staff</a>
                                </p>
                                <p>
                                    <a href="/jobs.html">Jobs at VIF</a>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <strong>
                                    <a href="/press.html">Press</a>
                                </strong>
                                <p>
                                    <a href="/news.html">News</a>
                                </p>
                                <p>
                                    <a href="/blog/">Blog</a>
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Contact Us</strong>
                                <p>
                                    <span>
                                        <img src="images/glyphicons_social_30_facebook.png" />
                                    </span>
                                    <span>
                                        <img src="images/glyphicons_social_31_twitter.png" />
                                    </span>
                                    <span>
                                        <img src="images/glyphicons_social_22_youtube.png" />
                                    </span>
                                    <span>
                                        <img src="images/glyphicons_social_17_linked_in.png" />
                                    </span>

                                </p>
                            </div>
                            <div class="col-md-6" align="right">
                                <img style="width:66px;" src="images/b-corp.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <p class="muted corp">© 2014 VIF International Education</p>

                </div>
            </div>
        </div>
    </footer>
	<!-- End of Footer -->
	<!-- Scroll top -->
	<div class="scrolltotop">
		<i class="fa fa-chevron-up"></i>
	</div>
	<!-- End scroll top -->
			<!-- Bootstrap core JavaScript, plugin and custom scripts
			================================================== -->
			
			<script src="js/jquery-1.10.2.min.js" type="text/javascript"></script>
			<script src="js/bootstrap.js"></script>
			<script type="text/javascript" src="js/modernizr.js"></script>
			<script type="text/javascript" src="js/modernizr.custom.17475.js"></script>
			<script type="text/javascript" src="js/masonry.js"></script>
			<script type="text/javascript" src="js/jquery.scrollTo.min.js"></script>
			<script type="text/javascript" src="js/jquery.cslider.js"></script>
			<script type="text/javascript" src="js/jquery.mixitup.min.js"></script>
			<script type="text/javascript" src="js/classie.js"></script>
			<script type="text/javascript" src="js/imagesloaded.js"></script>
			<script type="text/javascript" src="js/jquery.parallax-1.1.3.js"></script>
			<script type="text/javascript" src="js/parallaxInit.js"></script>
			<script type="text/javascript" src="js/jquery.bxslider.js"></script>
            
			<script type="text/javascript" src="js/jquery.mousewheel.js"></script>
			<script type="text/javascript" src="js/perfect-scrollbar.js"></script>
			<script type="text/javascript" src="js/carousel-slider.js"></script>
			<script type="text/javascript" src="js/jquery.elastislide.js"></script>
			<script type="text/javascript" src="js/jquerypp.custom.js"></script>
			<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
			<script type="text/javascript" src="js/jquery.timeago.js"></script>
			<script type="text/javascript" src="js/jquery.placeholder.js"></script>
			<script type="text/javascript" src="js/scripts.js"></script>
			<script>
               

                
				jQuery(document).ready(function() {
					'use strict';				
						
						});
                
                $('.bxslider').bxSlider({
                      infiniteLoop: true,
                      hideControlOnEnd: false,
                        captions: true
                    });
                                    
                // integrate with the carousel previewer
				var current = 0,
					$preview = $( '#preview' ),
					$carouselEl = $( '#carousel' ),
					$carouselItems = $carouselEl.children(),
					carousel = $carouselEl.elastislide( {
						current : current,
						minItems : 4,
						onClick : function( el, pos, evt ) {
							changeImage( el, pos );
							evt.preventDefault();
						},
						onReady : function() {
							changeImage( $carouselItems.eq( current ), current );
							
						}
					} );
				function changeImage( el, pos ) {
					$preview.attr( 'src', el.data( 'preview' ) );
					$carouselItems.removeClass( 'current-img' );
					el.addClass( 'current-img' );
					carousel.setCurrent( pos );
				}
			
				
					
				var offsetHeight = 109;

		      	$('body').scrollspy({
			        'target':'#my-nav',
			        'offset': offsetHeight
		   		 });

				$(function() {
					$('#my-nav li a').bind('click', function(e) {
						e.preventDefault();
						target = this.hash;
						//$.scrollTo(target, 0,  {offset:-109, easing:'linear'});
						
						if ($(this).siblings(".sub").length > 0) {
							$('#my-nav .sub').each(function(){
								$(this).hide();
								//$(this).css('right','-999px;')
							});
							$(this).siblings(".sub").show();
							//$.easing.def = "easeOutBounce";
							//$(this).siblings(".sub").animate({ "right": "125px" }, {easing: "easeOutBounce"} );
							}
						});

					
				});
				

					jQuery(window).load(function(){
						$(".sub").hide();
					    jQuery('body').scrollspy('refresh');
                        
                        /*$('.flexslider').flexslider({
                            slideshow: false,
                            directionNav: true, 
                            animation : 'slide',
                            useCSS: true,
                            touch: true,
                            startAt: 1
                        });*/

					  });
			</script>
			
	</body>
</html>