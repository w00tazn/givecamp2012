<?php
/*  The default template for displaying content */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<div class="col2 page">
<header><h1 class="entry-title entry-header"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wplook' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1></header>
		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
<div class="entry-content"><?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php elseif ( is_single() ): ?>	
				<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wplook' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="clear"></div><div class="page-link"><span>' . __( 'Pages:', 'wplook' ) . '</span>', 'after' => '</div>' ) ); ?>
		<!-- .entry-content -->
		<div class="clear"></div>	
			<div class="entry-utility">
				<div class="category"><b><?php _e('Category:', 'wplook'); ?></b> <?php the_category(', ') ?><div class="end"></div></div>
				<?php if ( get_the_tag_list( '', ', ' ) ) { ?><div class="tag"> <b><?php _e('Tag:', 'wplook'); ?></b> <?php echo get_the_tag_list('',', ',''); ?>
					<div class="end"></div></div>
				<?php } ?>
			</div><div class="clear"></div></div>
		<?php else : ?>	
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wplook' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'wplook' ) . '</span>', 'after' => '</div>' ) ); ?>
		<div class="clear"></div>
		</div><!-- .entry-content -->
		<?php endif; ?>	
			
		</div>
		<div class="clear"></div>
	</div>	