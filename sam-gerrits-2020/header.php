<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>
		
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" >
		 
		<?php wp_head(); ?>
	
	</head>
	
	<body <?php body_class(); ?>>

		<?php 
		if ( function_exists( 'wp_body_open' ) ) {
			wp_body_open(); 
		}
		?>
	
		<div class="navigation">
		
			<div class="section-inner">
				
				<ul class="main-menu">
				
					<?php 
					
					if ( has_nav_menu( 'primary' ) ) {

						$nav_menu_args = array( 
							'container' 		=> '', 
							'items_wrap' 		=> '%3$s',
							'theme_location' 	=> 'primary', 
							'walker' 			=> new garfunkel_nav_walker
						);
																		
						wp_nav_menu( $nav_menu_args ); 
					
					} else {

						$list_pages_args = array(
							'container'	=> '',
							'title_li'	=> ''
						);
					
						wp_list_pages( $list_pages_args );
						
					} ?>
											
				</ul><!-- .main-menu -->
				
				<?php get_template_part( 'menu', 'social' ); ?>
			 
			<div class="clear"></div>
			 
			</div><!-- .section-inner -->
			
			<div class="mobile-menu-container">
			
				<ul class="mobile-menu">
					
					<?php 
					if ( has_nav_menu( 'primary' ) ) {					
						wp_nav_menu( $nav_menu_args); 
					} else {
						wp_list_pages( $list_pages_args );
					} ?>
				
				</ul><!-- .mobile-menu -->
				
				<?php get_template_part( 'menu', 'social' ); ?>
										
			</div><!-- .mobile-menu-container -->
				 			
		</div><!-- .navigation -->
		
		<div class="title-section">

			<?php $header_image_url = get_header_image() ? get_header_image() : get_template_directory_uri() . '/images/bg.jpg'; ?>
			
			<div class="bg-image master" style="background-image: url( <?php echo $header_image_url; ?> );"></div>
			
			<div class="bg-shader master"></div>
		
			<div class="section-inner">
			
				<div class="toggle-container">
			
					<button class="nav-toggle">
				
						<div class="bars">
						
							<div class="bar"></div>
							<div class="bar"></div>
							<div class="bar"></div>
							
							<div class="clear"></div>
						
						</div>
						
						<p>
							<span class="menu"><?php _e( 'Menu', 'garfunkel' ); ?></span>
							<span class="close"><?php _e( 'Close', 'garfunkel' ); ?></span>
						</p>
					
					</button>
				
				</div><!-- .toggle-container -->
		
				<?php if ( get_theme_mod( 'garfunkel_logo' ) ) : ?>
					
					<div class="blog-logo">
					
				        <a class="logo" href='<?php echo esc_url( home_url( '/' ) ); ?>' rel='home'>
				        	<img src='<?php echo esc_url( get_theme_mod( 'garfunkel_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>'>
				        </a>
			        
					</div>
			
				<?php elseif ( get_bloginfo( 'description' ) || get_bloginfo( 'title' ) ) : ?>
								
					<div class="blog-title-area">
						
						<h1 class="blog-title">
							<a href="<?php echo esc_url( home_url() ); ?>" rel="home"><?php echo esc_attr( get_bloginfo( 'title' ) ); ?></a>
						</h1>
						
						<?php if ( get_bloginfo( 'description' ) ) : ?>
						
							<h2 class="blog-subtitle"><?php echo esc_attr( get_bloginfo( 'description' ) ); ?></h2>
							
						<?php endif; ?>

					</div>
										
				<?php endif; ?>
			
			</div>
		
		</div>
