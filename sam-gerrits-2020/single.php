<?php get_header(); ?>

<div class="wrapper">
										
	<div class="wrapper-inner section-inner thin">
	
		<div class="content">
												        
			<?php if ( have_posts() ) : while( have_posts() ) : the_post(); 
			
				$format = get_post_format();
				?>
						
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php if ( $format == 'video' ) : ?> 
					
						<div class="featured-media">
			
							<?php
								
							// Fetch post content
							$content = get_post_field( 'post_content', get_the_ID() );
							
							// Get content parts
							$content_parts = get_extended( $content );
							
							// oEmbed part before <!--more--> tag
							$embed_code = wp_oembed_get($content_parts['main']); 
							
							echo $embed_code;
							
							?>
						
						</div><!-- .featured-media -->
					
					<?php elseif ( $format == 'quote' ) : ?> 
											
						<div class="post-quote">
							
							<?php
								
							// Fetch post content
							$content = get_post_field( 'post_content', get_the_ID() );
							
							// Get content parts
							$content_parts = get_extended( $content );
							
							// Output part before <!--more--> tag
							echo $content_parts['main'];
							
							?>
						
						</div><!-- .post-quote -->
						
					<?php elseif ( $format == 'link' ) : ?> 
					
						<div class="post-link">
			
							<?php
								
							// Fetch post content
							$content = get_post_field( 'post_content', get_the_ID() );
							
							// Get content parts
							$content_parts = get_extended( $content );
							
							// Output part before <!--more--> tag
							echo $content_parts['main'];
							
							?>
						
						</div><!-- .post-link -->
						
					<?php elseif ( $format == 'gallery' ) : ?> 
					
						<div class="featured-media">

							<?php garfunkel_flexslider( 'post-image' ); ?>
											
						</div><!-- .featured-media -->
				
					<?php elseif ( has_post_thumbnail() ) : ?>
					
						<div class="featured-media">
						
							<?php 
								
							the_post_thumbnail( 'post-image' );

							$image_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
							
							if ( $image_caption ) : ?>
											
								<div class="media-caption-container">
								
									<p class="media-caption"><?php echo $image_caption; ?></p>
									
								</div>
								
							<?php endif; ?>
									
						</div><!-- .featured-media -->
					
					<?php endif; ?>
					
					<div class="post-inner">
					
						<div class="post-header">
						
							<p class="post-date"><?php the_time( get_option( 'date_format' ) ); ?><?php edit_post_link( __( 'Edit','garfunkel' ), '<span class="sep">/</span>' ); ?></p>
							
						    <?php the_title( '<h1 class="post-title">', '</h1>' ); ?>
						    
						</div><!-- .post-header -->
														                                    	    
						<div class="post-content">

							<?php 
							if ( $format == 'link' || $format == 'quote' || $format == 'video') { 
								$content = $content_parts['extended'];
								$content = apply_filters( 'the_content', $content );
								echo $content;
							} else {
								the_content();
							}
							?>
							
							<div class="clear"></div>
										        
						</div><!-- .post-content -->
						
						<?php 
						$args = array(
							'before'           => '<div class="clear"></div><p class="page-links"><span class="title">' . __( 'Pages:','garfunkel' ) . '</span>',
							'after'            => '</p>',
							'link_before'      => '<span>',
							'link_after'       => '</span>',
							'separator'        => '',
							'pagelink'         => '%',
							'echo'             => 1
						);
					
						wp_link_pages( $args ); 
						?>
						
					</div><!-- .post-inner -->
					            					
					<div class="post-meta bottom">
						
						<div class="post-meta-tabs">
						
							<div class="post-meta-tabs-inner">
								
								<div class="tab-post-meta tab">
								
									<ul class="post-info-items fright">
										<li>
											<div class="genericon genericon-time"></div>
											<a href="<?php the_permalink(); ?>">
												<?php the_date( get_option('date-format') ); ?>
											</a>
										</li>
										<li>
											<div class="genericon genericon-category"></div>
											<?php the_category(', '); ?>
										</li>
										<?php if ( has_tag() ) : ?>
											<li>
												<div class="genericon genericon-tag"></div>
												<?php the_tags('', ', '); ?>
											</li>
										<?php endif; ?>
									</ul>
								
									<div class="post-nav fleft">
									
										<?php
										$prev_post = get_previous_post();
										if ( ! empty( $prev_post ) ) : ?>
										
											<a class="post-nav-prev"  href="<?php echo get_permalink( $prev_post->ID ); ?>">
												<p><?php _e( 'Previous post', 'garfunkel' ); ?><br>
												<span class="posttitle"><?php echo get_the_title( $prev_post ); ?></span></p>
											</a>
									
										<?php endif;
										
										$next_post = get_next_post();
										if ( ! empty( $next_post ) ) : ?>
											
											<a class="post-nav-next" href="<?php echo get_permalink( $next_post->ID ); ?>">
												<p><?php _e( 'Next post', 'garfunkel' ); ?><br>
												<span class="posttitle"><?php echo get_the_title( $next_post ); ?></span></p>
											</a>
									
										<?php endif; ?>
									
									</div>
									
									<div class="clear"></div>
								
								</div><!-- .tab-post-meta -->
															
							</div><!-- .post-meta-tabs-inner -->
						
						</div><!-- .post-meta-tabs -->
							
					</div><!-- .post-meta.bottom -->
					
					<div class="post-nav-fixed">
								
						<?php
						$prev_post = get_previous_post();
						if ( ! empty( $prev_post ) ) : ?>
						
							<a class="post-nav-prev" href="<?php echo get_permalink( $prev_post->ID ); ?>">
								<span class="hidden"><?php _e( 'Previous post', 'garfunkel' ); ?></span>
								<span class="arrow">&laquo;</span>
							</a>
					
						<?php endif;
						
						$next_post = get_next_post();
						if ( ! empty( $next_post ) ) : ?>
							
							<a class="post-nav-next" href="<?php echo get_permalink( $next_post->ID ); ?>">
								<span class="hidden"><?php _e( 'Next post', 'garfunkel' ); ?></span>
								<span class="arrow">&raquo;</span>
							</a>
					
						<?php endif; ?>
															
						<div class="clear"></div>
					
					</div><!-- .post-nav -->
												                        
			   	<?php endwhile; else: ?>
			
					<p><?php _e( "We couldn't find any posts that matched your query. Please try again.", "garfunkel" ); ?></p>
				
				<?php endif; ?>    
				
				<?php get_sidebar(); ?>
						
			</div><!-- .post -->
		
		</div><!-- .content -->
		
		<div class="clear"></div>
		
	</div><!-- .wrapper-inner -->

</div><!-- .wrapper -->
		
<?php get_footer(); ?>
