<?php /* Template Name: Home Carousel Template */ ?>

<?php get_header(); ?>


	
	<div class="one-col-content">
		
	 
    
    <?php if(get_field('home_carousel')): ?>
	 
	<div id="slider">
		<?php while(the_repeater_field('home_carousel')): ?>
			<?php $image = wp_get_attachment_image_src(get_sub_field('image'), 'full'); ?>
			<div style="background: url(<?php echo $image[0]; ?>);" class="carousel-slide">
			<h1><?php the_sub_field('headline'); ?></h1>
			<span class="main-text"><?php the_sub_field('main_text') ?></span>
			<span class="yellow_question"><?php the_sub_field('yellow_question'); ?></span><Br/>
			<a href="<?php the_sub_field('link'); ?>" class="carousel-cta"><?php the_sub_field('cta'); ?></a>
			</div>
	    <?php endwhile; ?>
	</div>
	
	<?php endif; ?>
	
	 <?php if(get_field('home_carousel')): ?>
	<div class="middle-blocks-wrap">
        <?php get_template_part('inc', 'indexloop' ) ; ?>

        <!--
		<?php while(the_repeater_field('middle_blocks')): ?>
		<div class="mid-block">
			<h2><?php the_sub_field('headline'); ?></h2>
			<span class="block-text"><?php the_sub_field('text') ?></span>
			<?php $image = wp_get_attachment_image_src(get_sub_field('image'), 'full'); ?>
			
			<?php if($image[0]): ?>
			<a href="<?php the_sub_field('link');?>">
			<img src="<?php echo $image[0]; ?>" alt="<?php the_sub_field('headline'); ?>" />
			</a>
			<? endif; ?>
			 <?php if(get_sub_field('link')): ?>	
			 	<?php $link = get_sub_field('link');?>
			 	<?php $linktext = get_sub_field('link_text');?>
			<a href="<?php echo $link; ?>" class="mid-block-more"><?php echo $linktext; ?></a>
				<?php endif; ?> -->
		</div>
	<?php endwhile; ?>
	<div class="clear"></div>
	</div>
	<?php endif; ?>

	<div class="home-boxes-wrap">
	
	<div class="home-box">
		<h3>
		<img src="/wp-content/themes/commit-brand/images/learn-more-icon.png" alt="?" />
		<span>Learn More</span>
		
		</h3>
		<a href="/wp-content/pdf/2011_WI_Feature_Kania.pdf" target="_blank" />
			<img src="/wp-content/themes/commit/images/new-approach-thumb.jpg" alt=""  class="learn-more-thumb" />
		</a>	
		<a href="/wp-content/pdf/2011_WI_Feature_Kania.pdf" target="_blank" class="blue-button" />
			Discover a New Approach
		</a>
		
		<a href="/wp-content/pdf/Commit_Presentation_July_2012.pdf" target="_blank">
	  		<img src="/wp-content/themes/commit/images/download-presentation-thumb.jpg" alt="download Commit! presentation" class="learn-more-thumb" />
	  	</a>
	  	<a href="/wp-content/pdf/Commit_Presentation_July_2012.pdf" target="_blank" class="blue-button">
	  		Download the Presentation
	  	</a>
	  	
	  	<a href="/about-us#presentation">
	  		<img src="/wp-content/themes/commit/images/watch-presentation-thumb.jpg" alt="watch Commit! presentation" class="learn-more-thumb" />
	  	</a>
	  <a href="/about-us#presentation" class="blue-button">
	  		Watch the Presentation
	  </a>
	</div>


	

	<div class="home-box news-box">
		<h3>
		<img src="/wp-content/themes/commit-brand/images/news-icon.png" alt="!" />
		<span>News & Blog</span>
		
		</h3>
		<ul class="news-feed">
		<?php
  $args=array(
    'showposts'=>5
  );
 $my_query = new WP_Query($args);
  if( $my_query->have_posts() ) {
    while ($my_query->have_posts()) : $my_query->the_post(); ?>
      <li><span class="feed-post-date"> <?php the_time('m.d.y') ?></span> 
      <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
    <?php
    endwhile;
  }
?>
		</ul>
		
	</div>
	
	<div class="home-box">
	<h3>
	<img src="/wp-content/themes/commit-brand/images/fb-icon.png" alt="" />

	<span>Facebook</span>
		</h3>
	<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FCommit%2F321638557862608&amp;width=240&amp;height=395&amp;colorscheme=light&show_faces=true&amp;border_color=%239DB0C8&amp;stream=true&amp;header=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:240px; height:565px;" allowTransparency="true"></iframe>
	</div>
	
	

	<div class="clear"></div>
	</div>	
	</div>
	

	

<?php get_footer(); ?>	


<!-- Jquery initializations-->
	<script>
		// DOM Ready
		$(function(){
			$('#slider').anythingSlider({
			autoPlay: true,
			delay: 6000,
			resumeDelay: 10000,
			autoPlayLocked: true, 
			buildStartStop: false,
			navigationFormatter : function(index, panel){ // Format navigation labels with text
    return ['', '', '', '', ''][index - 1];}
			});
			
		});
	</script>