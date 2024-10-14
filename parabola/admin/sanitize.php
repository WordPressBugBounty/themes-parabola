<?php

/*
 *
 * Settings arrays
 *
 */

/* Font family arrays */
$parabola_colorschemes_array = array(
// color scheme presets are defined via schemes.php
);

$parabola_fonts = array(

	'Theme Fonts' => array(
					"Open Sans",
					"Open Sans Light",
					"Bebas Neue",
					"Oswald",
					"Oswald Light",
					"Oswald Stencil",
					"Yanone Kaffeesatz Regular",
					"Yanone Kaffeesatz Light",
					"SquareFont",
					"PROPAGANDA"
	),
	
	'Sans-Serif' => array(
					"Segoe UI, Arial, sans-serif",
					"Verdana, Geneva, sans-serif",
					"Geneva, sans-serif",
					"Helvetica Neue, Arial, Helvetica, sans-serif",
					"Helvetica, sans-serif",
					"Century Gothic, AppleGothic, sans-serif",
				    "Futura, Century Gothic, AppleGothic, sans-serif",
					"Calibri, Arian, sans-serif",
				    "Myriad Pro, Myriad,Arial, sans-serif",
					"Trebuchet MS, Arial, Helvetica, sans-serif",
					"Gill Sans, Calibri, Trebuchet MS, sans-serif",
					"Impact, Haettenschweiler, Arial Narrow Bold, sans-serif",
					"Tahoma, Geneva, sans-serif",
					"Arial, Helvetica, sans-serif",
					"Arial Black, Gadget, sans-serif",
					"Lucida Sans Unicode, Lucida Grande, sans-serif"
	),
	
	'Serif' => array("Georgia, Times New Roman, Times, serif",
					"Times New Roman, Times, serif",
					"Cambria, Georgia, Times, Times New Roman, serif",
					"Palatino Linotype, Book Antiqua, Palatino, serif",
					"Book Antiqua, Palatino, serif",
					"Palatino, serif",
				    "Baskerville, Times New Roman, Times, serif",
 					"Bodoni MT, serif",
					"Copperplate Light, Copperplate Gothic Light, serif",
					"Garamond, Times New Roman, Times, serif"
	),

	'MonoSpace' => array( 
					"Courier New, Courier, monospace",
					"Lucida Console, Monaco, monospace",
					"Consolas, Lucida Console, Monaco, monospace",
					"Monaco, monospace"
	),

	'Cursive' => array(  
					"Lucida Casual, Comic Sans MS, cursive",
				    "Brush Script MT,Phyllis,Lucida Handwriting,cursive",
					"Phyllis,Lucida Handwriting,cursive",
					"Lucida Handwriting,cursive",
					"Comic Sans MS, cursive"
	),
	
); // fonts


/* Social media links */
$parabola_socialNetworks = array (
		"AboutMe", "AIM", "Amazon", "Contact", "Delicious", "DeviantArt", 
		"Digg", "Discord", "Dribbble", "Etsy", "Facebook", "Flickr",
		"FriendFeed", "Github", "GoodReads", "GooglePlus", "IMDb", "Instagram",
		"LastFM", "LinkedIn", "Mail", "MindVox", "MySpace", "Newsvine", "Patreon", 
		"PayPal", "Phone", "Picasa", "Pinterest", "Reddit", "RSS", "ShareThis",  
		"Skype", "Steam", "Steam-old", "SoundCloud", "StumbleUpon", "Technorati", 
		"TripAdvisor", "Tumblr",  "Twitch", "Twitter", "Twitter-old", "Vimeo", "VK",
		"WordPress", "Yahoo", "Yelp", "YouTube", "YouTube-old", "Xing",
);

/*
 * Validate user data
 */
if ( !function_exists ('parabola_settings_validate') ):
function parabola_settings_validate($input) {
	global $parabola_defaults;
	global $parabolas;
	global $parabola_colorschemes_array;

	$colorSchemes = ( !empty($input['parabola_colorschemes']) && ( !empty( $input['parabola_schemessubmit']) ? true : false ) ) && ( !empty($parabola_colorschemes_array[$input['parabola_colorschemes']]) );

	if ( !empty( $input['parabola_schemessubmit']) ) {
		if ($colorSchemes) {
			$input = wp_parse_args( json_decode( "{" . $parabola_colorschemes_array[esc_html($input['parabola_colorschemes'])] . "}", true ), $parabolas );
			return $input;
		} else { 
			return false;
		}
	};

/*** generic checks, based on datatypes and on field names ***/
    foreach ($input as $name => $value):
	if (preg_match("/^parabola_.*/i",$name)): // only process theme settings
		if (is_array($value)):
			$input[$name] = cryout_proto_arrsan($value); // array
		else:
		switch($value):
			// colour field
			case (preg_match("/^(#[0-9a-f]{3}|#?[0-9a-f]{6})$/i", trim(wp_kses_data($value))) ? $value : !$value):
				$input[$name] = cryout_color_sanitize(trim(wp_kses_data($input[$name])));
			break;	
			// numeric field
			case (preg_match("/^[0-9]+$/i", trim(wp_kses_data($value))) ? $value : !$value):
				$input[$name] = intval(wp_kses_data($input[$name]));
			break;
			default:
				switch($name):
					// long content fields
					case (preg_match("/.*(copyright|excerpt|customcss|customjs|text).*/i",trim($name)) ? $name: !$name):
						$input[$name] = trim(wp_kses_post($input[$name]));
						break;
					// url fields
					case (preg_match("/.*(logoupload|sliderlink|url).*/i",trim($name)) ? $name: !$name):
						$input[$name] = esc_url_raw($input[$name]);
						break;
					// generic sanitization for the rest
					default:
						$input[$name] = trim(wp_kses_data($input[$name]));
				endswitch;
		endswitch;
		endif; // if array	

	endif;
	endforeach;

/*** more specific checks that should be kept (for now) ***/

/*** 1 ***/
	if ( isset($input['parabola_sidewidth']) && is_numeric($input['parabola_sidewidth']) && $input['parabola_sidewidth']>=500 && $input['parabola_sidewidth'] <=1760) { /* value is valid */ } else { $input['parabola_sidewidth'] = $parabola_defaults['parabola_sidewidth']; }
	if ( isset($input['parabola_sidebar']) && is_numeric($input['parabola_sidebar']) && $input['parabola_sidebar']>=220 && $input['parabola_sidebar'] <=800) { /* value is valid */ } else { $input['parabola_sidebar'] = $parabola_defaults['parabola_sidebar']; }

	$input['parabola_hheight'] =  intval(wp_kses_data($input['parabola_hheight']));
	$input['parabola_frontpostscount'] =  intval(wp_kses_data($input['parabola_frontpostscount']));
	$input['parabola_excerptwords'] =  intval(wp_kses_data($input['parabola_excerptwords']));
	$input['parabola_fwidth'] =  intval(wp_kses_data($input['parabola_fwidth']));
	$input['parabola_fheight'] =  intval(wp_kses_data($input['parabola_fheight']));
	$input['parabola_headermargintop'] =  intval(wp_kses_data($input['parabola_headermargintop']));
	$input['parabola_headermarginleft'] =  intval(wp_kses_data($input['parabola_headermarginleft']));
	$input['parabola_slideNumber'] =  intval(wp_kses_data($input['parabola_slideNumber']));
	$input['parabola_fpsliderwidth'] =  intval(wp_kses_data($input['parabola_fpsliderwidth']));
	$input['parabola_fpsliderheight'] = intval(wp_kses_data($input['parabola_fpsliderheight']));

/*** 2 ***/
	$cryout_special_terms = array('mailto:', 'callto://', 'tel:');
	$cryout_special_keys = array('Mail', 'Skype', 'Phone');
	for ($i=1;$i<10;$i+=2) {
		if (!isset($input['parabola_social_target'.$i])) {$input['parabola_social_target'.$i] = "0";}
		$input['parabola_social_title'.$i] = wp_kses_data(trim($input['parabola_social_title'.$i]));
		$j=$i+1;
		if (in_array($input['parabola_social'.$i],$cryout_special_keys)) :
			$input['parabola_social'.$j]	= wp_kses_data(str_replace($cryout_special_terms,'',$input['parabola_social'.$j]));
			if (in_array($input['parabola_social'.$i],$cryout_special_keys)):
				$prefix = $cryout_special_terms[array_search($input['parabola_social'.$i],$cryout_special_keys)];
				$input['parabola_social'.$j] = $prefix.$input['parabola_social'.$j];
			endif;
		else :
			$input['parabola_social'.$j] = esc_url_raw($input['parabola_social'.$j]);
		endif;
	}
	for ($i=0;$i<=5;$i++) {
		if (!isset($input['parabola_socialsdisplay'.$i])) {$input['parabola_socialsdisplay'.$i] = "0";}
	}

/** 3 ***/
	$input['parabola_sliderimg1'] =  wp_kses_data($input['parabola_sliderimg1']);
	$input['parabola_slidertitle1'] =  wp_kses_data($input['parabola_slidertitle1']);
	$input['parabola_slidertext1'] =  wp_kses_post($input['parabola_slidertext1']);
	$input['parabola_sliderlink1'] =  esc_url_raw($input['parabola_sliderlink1']);
	$input['parabola_sliderimg2'] =  wp_kses_data($input['parabola_sliderimg2']);
	$input['parabola_slidertitle2'] =  wp_kses_data($input['parabola_slidertitle2']);
	$input['parabola_slidertext2'] =  wp_kses_post($input['parabola_slidertext2']);
	$input['parabola_sliderlink2'] =  esc_url_raw($input['parabola_sliderlink2']);
	$input['parabola_sliderimg3'] =  wp_kses_data($input['parabola_sliderimg3']);
	$input['parabola_slidertitle3'] =  wp_kses_data($input['parabola_slidertitle3']);
	$input['parabola_slidertext3'] =  wp_kses_post($input['parabola_slidertext3']);
	$input['parabola_sliderlink3'] =  esc_url_raw($input['parabola_sliderlink3']);
	$input['parabola_sliderimg4'] =  wp_kses_data($input['parabola_sliderimg4']);
	$input['parabola_slidertitle4'] =  wp_kses_data($input['parabola_slidertitle4']);
	$input['parabola_slidertext4'] =  wp_kses_post($input['parabola_slidertext4']);
	$input['parabola_sliderlink4'] =  esc_url_raw($input['parabola_sliderlink4']);
	$input['parabola_sliderimg5'] =  wp_kses_data($input['parabola_sliderimg5']);
	$input['parabola_slidertitle5'] =  wp_kses_data($input['parabola_slidertitle5']);
	$input['parabola_slidertext5'] =  wp_kses_post($input['parabola_slidertext5']);
	$input['parabola_sliderlink5'] =  esc_url_raw($input['parabola_sliderlink5']);
	
	$input['parabola_colimageheight'] = intval(wp_kses_data($input['parabola_colimageheight']));
	
/** 4 **/

	// make sure all options have values, even blank
	foreach ( $parabola_defaults as $key => $value ) {
		if ( is_array($value) ) foreach ( $value as $subkey => $subvalue ) {
			if ( !isset($input[$key][$subkey]) ) $input[$key] = array( $subkey => '' );
		}
		if ( !isset($input[$key]) ) $input[$key] = '';
	}

	// handle settings reset
	$resetDefault = ( ! empty( $input['parabola_defaults']) ? true : false );
	if ($resetDefault) { $input = $parabola_defaults; }

	return $input; // return validated input	

}

endif;

// FIN