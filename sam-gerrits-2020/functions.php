<?php
//* Start the engine

//========================================================================================================

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Sam Gerrits 2020' );
define( 'CHILD_THEME_URL', 'https://github.com/paulvanbuuren/Sam-Gerrits-WP-theme--2019-/' );
define( 'CHILD_THEME_VERSION', '2.0.0' );
define( 'CHILD_THEME_VERSION_DESCR', 'Base theme is Garfunkel' );

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

				// Register Google Fonts
				wp_register_style( 'samgerrits_googleFonts', '//fonts.googleapis.com/css?family=Fira+Sans:400,500,700,400italic,700italic|Playfair+Display:400,900|Crimson+Text:700,400italic,700italic,400' );
				$dependencies[] = 'samgerrits_googleFonts';

			}

			// deregister default CSS
			wp_dequeue_style( 'sam-gerrits-2020' );
			wp_deregister_style( 'sam-gerrits-2020' );
			
			// do not load CSS from plugins
			wp_deregister_style( 'yarppWidgetCss' );
			wp_deregister_style( 'contact-form-7' );

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

