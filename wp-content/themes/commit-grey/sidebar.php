<?php
/*
*/?>

		<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar('Sidebar') ) : ?>
<div class="sidebar_wrap">

	<div class="sidebar-box">
		<h3><span>Learn More</span></h3>
		<a href="/wp-content/pdf/Commit_Presentation_Apr_2012.pdf" target="_blank">
	  		<img src="/wp-content/themes/commit-grey/images/download-presentation-blue.jpg" alt="download Commit! presentation" />
	  	</a>
	  	<br/><br/>
	  	<a href="/about-us">
	  		<img src="/wp-content/themes/commit-grey/images/watch-presentation.jpg" alt="watch Commit! presentation" />
	  	</a>
	  	
	  	
	  	
	</div>

	<div class="sidebar-box news-box">
		<h3><span>News</span></h3>
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

<div class="clear"></div>
</div>	
	<?php wp_reset_query(); ?>

	<?php endif; ?>


