<div class="post-container">

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<?php if ( has_post_thumbnail() ) : ?>
		
			<div class="featured-media">
			
				<a href="<?php the_permalink(); ?>" rel="bookmark">
					<span class="visuallyhidden"><?php echo sprintf( __( 'Link to %s', get_the_title( ) ) ); ?></span>
					<?php the_post_thumbnail( 'post-thumbnail' ); ?>
				</a>
						
			</div><!-- .featured-media -->
				
		<?php endif;
		
		if ( is_sticky() && DO_WRITE_STICKY ) : ?>
				
			<div class="is-sticky">
				<div class="genericon genericon-pinned"></div>
			</div>
		
		<?php endif; ?>
		
		<div class="post-inner">
		
			<?php if ( get_the_title() ) : ?>
		
				<div class="post-header">
					
				    <h2 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				    	    
				</div><!-- .post-header -->
			
			<?php endif; ?>

			<?php the_excerpt(); ?>
		
			<?php garfunkel_meta(); ?>
		
		</div><!-- .post-inner -->
	
	</div>

</div>
