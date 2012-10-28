<?php

?>
					
					<div class="footerc">
						<center>
							<ul>
							<li>

							</li>	
						<li>
						</li>
						<li>

						</li>
						</center>
					</div>
					<div class="footerc">
						<center>
							<ul>
							<li>
							<a href="#">
								<img src="<?php bloginfo('template_directory'); ?>/images/cradle.png" alt="Early Childhood Education"/>
								<br/>
								Early Childhood Education
							</a>
							</li>	
						<li>
							<a href="#">
								<img src="<?php bloginfo('template_directory'); ?>/images/backpack.png" alt="4-12 Education"/>
								<br/>
								4-12 Education
							</a>
						</li>
						<li>
							<a href="#">
								<img src="<?php bloginfo('template_directory'); ?>/images/briefcase.png" alt="Higher Education / Workforce" />
								<br/>
								Higher Education / Workforce
							</a>
						</li>
						</center>
					</div>
</div>


			<footer>
				<br/>
				<center>
					<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container_class' => 'menu' ) ); ?>
				</center>
				<br/>
				<br/>
				<br/>


				<p class="footer-left">All Rights Reserved. 2012. Commit!</p>
				<p class="footer-right"><a href="http://maps.google.com/maps?q=3963+Maple+Ave+Suite+290+Dallas,+TX+75219&hnear=3963+Maple+Ave+%23290,+Dallas,+Texas+75219&gl=us&t=m&z=16">3963 Maple Ave<br/>
					Suite 290<br/>
					Dallas, TX 75219</a><br/>
					<a href="mailto:info@commit2dallas.org">info@commit2dallas.org</a>
				</p>
				<div style="clear:both;"></div>

			</footer>


		</div>
	<?php wp_footer(); ?>
					<script type='text/javascript' src='<?php echo get_template_directory_uri() ?>/js/jquery.hoverIntent.minified.js'></script>
					<script>
					//$(document).ready(function () {
					//	$("img").mouseover(function () {
					//	  $(this).fadeTo("fast",.5,function () {
					//	  	$(this).mouseout(function () {
					//	  		$(this).fadeTo("fast",1);
					//  		});
					//	  });
					//	});
					//});
					$(document).ready( function () {   
					    $('.footerc ul li').hoverIntent(function(){
					         $(this).removeClass('fade').siblings().animate({ opacity: 0.5 }, 300);
					    },function(){
					         $(this).siblings().andSelf().animate({ opacity: 1 }, 100);
					    });
					});
					</script>
					<script type='text/javascript'>
						$(function() {
						   	$('#accordion').accordion();
						});
					</script>
	</body>
</html>