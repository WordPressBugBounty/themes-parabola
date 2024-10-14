<?php
/*
 * Styles and scripts registration and enqueuing
 *
 * @package parabola
 * @subpackage Functions
 */

function parabola_enqueue_styles() {
	global $parabolas;
	extract($parabolas);
	
	wp_enqueue_style( 'parabola-fonts', get_template_directory_uri() . '/fonts/fontfaces.css', NULL, _CRYOUT_THEME_VERSION ); // fontfaces.css
	
	/* Google fonts */
	$gfonts = array();
	if ( ( $parabola_fontfamily != 'font-custom' ) && !empty($parabola_googlefont) ) 				$gfonts[] = cryout_gfontclean( $parabola_googlefont );
	if ( ( $parabola_fonttitle != 'font-custom' ) && !empty($parabola_googlefonttitle) ) 			$gfonts[] = cryout_gfontclean( $parabola_googlefonttitle );
	if ( ( $parabola_fontside != 'font-custom' ) && !empty($parabola_googlefontside) ) 				$gfonts[] = cryout_gfontclean( $parabola_googlefontside );
	if ( ( $parabola_sitetitlefont != 'font-custom' ) && !empty($parabola_sitetitlegooglefont) )	$gfonts[] = cryout_gfontclean( $parabola_sitetitlegooglefont );
	if ( ( $parabola_menufont != 'font-custom' ) && !empty($parabola_menugooglefont) ) 				$gfonts[] = cryout_gfontclean( $parabola_menugooglefont );
	if ( ( $parabola_headingsfont != 'font-custom' ) && !empty($parabola_headingsgooglefont) )		$gfonts[] = cryout_gfontclean( $parabola_headingsgooglefont );

	// enqueue fonts with subsets separately
	foreach($gfonts as $i=>$gfont):
		if (strpos($gfont,"&") !== false):
			wp_enqueue_style( 'parabola-googlefont_'.$i, '//fonts.googleapis.com/css?family=' . $gfont );
			unset($gfonts[$i]);
		endif;
	endforeach;

	// merged google fonts
	if ( count($gfonts)>0 ):
		wp_enqueue_style( 'parabola-googlefonts', '//fonts.googleapis.com/css?family=' . implode( "|" , array_unique($gfonts) ), array(), null, 'screen' ); // google fonts
	endif;

	// Main theme style
	wp_enqueue_style( 'parabola-style', get_stylesheet_uri(), NULL, _CRYOUT_THEME_VERSION ); // main style.css
	
	// Options-based generated styling
 	wp_add_inline_style( 'parabola-style', preg_replace( "/[\n\r\t\s]+/", " ", parabola_custom_styles() ) ); // includes/custom-styles.php
	
	// Presentation Page options-based styling (only used when needed)
	if ( ($parabola_frontpage=="Enable") && is_front_page() && ('posts' == get_option( 'show_on_front' )) ) {
	    wp_add_inline_style( 'parabola-style', preg_replace("/[\n\r\t\s]+/", " ", parabola_presentation_css() ) ); // also in includes/custom-styles.php
	}
	
	// RTL support
	if ( is_rtl() ) wp_enqueue_style( 'parabola-rtl', get_template_directory_uri() . '/styles/rtl.css', 'parabola-style', _CRYOUT_THEME_VERSION );	
	
	// User supplied custom styling
	wp_add_inline_style( 'parabola-style', parabola_customcss() ); // also in includes/custom-styles.php   
	
	// Responsive styling (loaded last)
	if ( $parabola_mobile=="Enable" ) {
	    wp_enqueue_style( 'parabola-mobile', get_template_directory_uri() . '/styles/style-mobile.css', 'parabola-style', _CRYOUT_THEME_VERSION  );
	}

} // parabola_enqueue_styles()
add_action( 'wp_enqueue_scripts', 'parabola_enqueue_styles' );

// Custom JS
add_action( 'wp_footer', 'parabola_customjs', 35 ); // includes/custom-styles.php


// Scripts loading and hook into wp_enque_scripts
function parabola_scripts_method() {
	global $parabolas;

	wp_register_script('parabola-frontend', get_template_directory_uri() . '/js/frontend.js', array('jquery'), _CRYOUT_THEME_VERSION );
	wp_enqueue_script('parabola-frontend');
	
	// If parabola from page is enabled and the current page is home page - load the nivo slider js
	if ( ($parabolas['parabola_frontpage'] == "Enable") && is_front_page() ) {
		wp_register_script('parabola-nivoSlider', get_template_directory_uri() . '/js/nivo-slider.js', array('jquery'), _CRYOUT_THEME_VERSION);
		wp_enqueue_script('parabola-nivoSlider');
	}

	$magazine_layout = FALSE;
	if ($parabolas['parabola_magazinelayout'] == "Enable") {
		if (is_front_page()) {
			if ( ($parabolas['parabola_frontpage'] == "Enable") && (intval($parabolas['parabola_frontpostsperrow']) == 1) ) { /* no magazine layout */ }
																													   else { $magazine_layout = TRUE; }
		} else {
			$magazine_layout = TRUE;
		}
	}
	if ( is_front_page() && ($parabolas['parabola_frontpage'] == "Enable") && (intval($parabolas['parabola_frontpostsperrow']) == 2) ) { $magazine_layout = TRUE; }

	if ( $magazine_layout && $parabolas['parabola_masonry'] ) wp_enqueue_script('masonry');

	$js_options = array(
		'masonry' => (($parabolas['parabola_masonry'] && $magazine_layout)?1:0),
		'magazine' => ($magazine_layout?1:0),
		'mobile' => (($parabolas['parabola_mobile']=='Enable')?1:0),
		'fitvids' => $parabolas['parabola_fitvids'],
	);
	wp_localize_script( 'parabola-frontend', 'parabola_settings', $js_options );


	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
}
if( !is_admin() ) { add_action( 'wp_enqueue_scripts', 'parabola_scripts_method' ); }

// FIN