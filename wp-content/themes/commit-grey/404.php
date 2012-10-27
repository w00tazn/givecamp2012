<?php
/**
 * The 404 template file.
 *
 * @package WPLOOK
 * @subpackage BlogoLife-Child-Grey
 * @since BlogoLife 1.0
*/
get_header(); ?>




	
<article id="post-0" class="post no-results not-found ">
	
	<div class="col2">
	
<div class="entry-content">
<h1><?php wplook_doctitle();?></h1>
<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'wplook' ); ?></p>
	<?php get_search_form(); ?>
	</div><!-- .entry-content -->
</article><!-- #post-0 -->
	<div class="clear"></div>
	

<?php 

	get_footer(); 
?>