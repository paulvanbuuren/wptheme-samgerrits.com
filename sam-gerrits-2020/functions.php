<?php
//* Start the engine

//========================================================================================================

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Sam Gerrits 2020' );
define( 'CHILD_THEME_URL', 'https://github.com/paulvanbuuren/Sam-Gerrits-WP-theme--2019-/' );
define( 'CHILD_THEME_VERSION', '2.0.4' );
define( 'CHILD_THEME_VERSION_DESCR', 'Nieuw logo toegevoegd.' );

define( 'DO_WRITE_STICKY', false );


if ( ! defined( 'WBVB_SG_WIDGET_SOKMET_ID' ) ) {
  define( 'WBVB_SG_WIDGET_SOKMET_ID', 'social-media-widget' );
}
if ( ! defined( 'WBVB_SG_WIDGET_SOKMET_NAME' ) ) {
  define( 'WBVB_SG_WIDGET_SOKMET_NAME', 'Social media widget' );  // slug for custom taxonomy 'timeslot'
}
if ( ! defined( 'WBVB_SG_WIDGETAREA_ID' ) ) {
  define( 'WBVB_SG_WIDGETAREA_ID', 'footer-widget-area' );  // slug for custom taxonomy 'timeslot'
}

require_once( get_stylesheet_directory() . '/includes/socialmedia-widget.php' );


//========================================================================================================

// Load translation files from your child theme instead of the parent theme
function wbvb_samg_add_translations() {

    load_child_theme_textdomain( 'garfunkel', get_stylesheet_directory() . '/languages' );

}

add_action( 'after_setup_theme', 'wbvb_samg_add_translations' );

//========================================================================================================

/* ---------------------------------------------------------------------------------------------
   ENQUEUE STYLES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'garfunkel_load_style' ) ) :

	function garfunkel_load_style() {

		if ( ! is_admin() ) {

			$dependencies = array();

			/**
			 * Translators: If there are characters in your language that are not
			 * supported by the theme fonts, translate this to 'off'. Do not translate
			 * into your own language.
			 */
			$google_fonts = _x( 'on', 'Google Fonts: on or off', 'garfunkel' );

			if ( 'off' !== $google_fonts ) {

				wp_register_style( 'samgerrits_googleFonts', '//fonts.googleapis.com/css?family=Fira+Sans:400,500,700,400italic,700italic|Crimson+Text:700,400italic,700italic,400' );

				
				$dependencies[] = 'samgerrits_googleFonts';

			}

			// deregister default CSS
			wp_dequeue_style( 'sam-gerrits-2020' );
			wp_deregister_style( 'sam-gerrits-2020' );
			
			// do not load CSS from plugins
			wp_deregister_style( 'yarppWidgetCss' );
			wp_deregister_style( 'contact-form-7' );


			wp_register_style( 'typekit-font', 'https://use.typekit.net/ixb8iju.css' );

			// get genericons from parent theme
			wp_register_style( 'samgerrits_genericons', get_template_directory_uri() . '/genericons/genericons.css' );
			$dependencies[] = 'samgerrits_genericons';

			// load this child's CSS
			wp_enqueue_style( sanitize_title( CHILD_THEME_NAME ), get_stylesheet_directory_uri() . '/style.css', $dependencies, CHILD_THEME_VERSION );

		}

	}
	add_action( 'wp_print_styles', 'garfunkel_load_style' );

endif;

//========================================================================================================

/* ---------------------------------------------------------------------------------------------
   ADD EDITOR STYLES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'garfunkel_add_editor_styles' ) ) :

	function garfunkel_add_editor_styles() {

		add_editor_style( 'garfunkel-editor-style.css' );

		/**
		 * Translators: If there are characters in your language that are not
		 * supported by the theme fonts, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		$google_fonts = _x( 'on', 'Google Fonts: on or off', 'garfunkel' );

		if ( 'off' !== $google_fonts ) {

			$font_url = '//fonts.googleapis.com/css?family=Fira+Sans:400,500,700,400italic,700italic|Playfair+Display:400,900|Crimson+Text:700,400italic,700italic,400';
			add_editor_style( str_replace( ',', '%2C', $font_url ) );

		}

	}
	add_action( 'init', 'garfunkel_add_editor_styles' );

endif;

//========================================================================================================

/* ---------------------------------------------------------------------------------------------
   ENQUEUE SCRIPTS
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'garfunkel_load_javascript_files' ) ) :

	function garfunkel_load_javascript_files() {

		if ( ! is_admin() ) {
			wp_register_script( 'garfunkel_flexslider', get_template_directory_uri() . '/js/flexslider.js', array(), '', true );

			wp_enqueue_script( 'garfunkel_global', get_stylesheet_directory_uri() . '/js/min/global-min.js', array( 'jquery', 'imagesloaded', 'masonry', 'garfunkel_flexslider' ), CHILD_THEME_VERSION, true );
			
			if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'garfunkel_load_javascript_files' );

endif;

//========================================================================================================

/**
 * Add a sidebar.
 */

if ( ! function_exists( 'garfunkel_sidebar_registration' ) ) :

	function garfunkel_sidebar_registration() {
	    register_sidebar( array(
	        'name'          => __( 'Main Sidebar', 'textdomain' ),
	        'id'            => WBVB_SG_WIDGETAREA_ID,
	        'description'   => __( 'Widgets in the footer. Will be shown on all posts and pages.', 'textdomain' ),
	        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	        'after_widget'  => '</div>',
	        'before_title'  => '<h2 class="widgettitle">',
	        'after_title'   => '</h2>',
	    ) );
	
	
//		unregister_sidebar( 'footer-a' );    
//		unregister_sidebar( 'footer-b' );    
//		unregister_sidebar( 'footer-c' );    
		    
	}

	add_action( 'widgets_init', 'garfunkel_sidebar_registration' ); 

endif;

//========================================================================================================

/* ---------------------------------------------------------------------------------------------
   GARFUNKEL META FUNCTION
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'garfunkel_meta' ) ) :

	function garfunkel_meta() { ?>

		<div class="post-meta">
			
			<div class="genericon genericon-time"></div>
			<?php the_time( get_option( 'date_format' ) ); ?>
			<?php
			$countertje = 0;
			$categories = get_the_terms( get_the_id(), 'category' );
			foreach( $categories as $category ) {
				$countertje++;
				if ( 1 === $countertje ) {
					echo '<div class="genericon genericon-tag"></div>&nbsp;';
					echo $category->name;
				}
				else {
					echo ', ' . $category->name;
				}
			}
			?>
			<div class="clear"></div>
			
		</div><!-- .post-meta -->
		
		<?php
	}

endif;


//========================================================================================================



