<?php
/*
*/?>

		<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar('Sidebar') ) : ?>
<div class="sidebar_wrap">

	<div class="sidebar-box">
	<h3>
	<img src="/wp-content/themes/commit-brand/images/learn-more-icon.png" alt="?" />
	<span>Learn More</span></h3>
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

	<div class="sidebar-box news-box">
		<h3>
		<img src="/wp-content/themes/commit-brand/images/news-icon.png" alt="!" />
		<span>News</span></h3>
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


