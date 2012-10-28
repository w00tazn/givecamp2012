<?php
/*
 Template Name: Static Front Page
*/
?>


<?php
get_header();
// get_sidebar(); 
?>

<div id="primary" class="one-col-content">

	<div id="hero-content">
		
		<div id="hero-image">						
			<img src="<?php the_field('hero_image'); ?>" alt="Hero image" />
		</div>
	
		<div id="accordion">
			
			<?php if(get_field('hero_content')): ?>
				<?php while(the_repeater_field('hero_content')) : ?>

					<h3><?php the_sub_field('entry_title')?></h3>
					<div>
						<p><?php the_sub_field('entry_details')?> <a href="<?php the_sub_field('target_url') ?>">more...</a></p>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>			

			
		</div><!-- #accordion -->
	<div style="clear: both"></div>
	
	</div><!-- #hero-content -->
	<?php get_template_part('inc', 'givecamp') ; ?>
</div><!-- #primary -->

<?php
get_footer(); 
?>