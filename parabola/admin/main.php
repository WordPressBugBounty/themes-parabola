<?php

// Frontend
require_once(get_template_directory() . "/admin/defaults.php");					// default options
require_once(get_template_directory() . "/admin/prototypes.php");				// prototype functions
require_once(get_template_directory() . "/includes/custom-styles.php");			// custom styling
require_once(get_template_directory() . "/admin/customizer.php");				// customizer hook

// Admin side
if( is_admin() ) {
	require_once(get_template_directory() . "/admin/settings.php");				// theme settings
	require_once(get_template_directory() . "/admin/sanitize.php");				// settings sanitizers
	include(get_template_directory() . "/admin/schemes.php");					// preset color schemes
}

/**
 * Import/export functionality is part of the companion Theme Settings plugin 
 */

// Get the theme options and make sure defaults are used if no values are set
function parabola_get_theme_options() {
	global $parabola_defaults;
	$optionsParabola = get_option( 'parabola_settings', $parabola_defaults );
	$optionsParabola = array_merge((array)$parabola_defaults, (array)$optionsParabola);
	$optionsParabola = parabola_maybe_migrate_options( $optionsParabola );
	return $optionsParabola;
}
$parabolas = parabola_get_theme_options();

//  Hooks/Filters
//add_action('admin_init', 'parabola_init_fn' ); // hooked by settings plugin
add_action('admin_menu', 'parabola_add_page_fn');
add_action('init', 'parabola_init');

// Graceful handling of options that change built-in values
function parabola_maybe_migrate_options($options_array) {
	// changes in 2.4.1
	foreach ( array( 'parabola_fonttitle', 'parabola_fontside', 'parabola_sitetitlefont', 'parabola_menufont', 'parabola_headingsfont' ) as $opt_id ) {
		if ($options_array[$opt_id] == 'General Font') $options_array[$opt_id] = 'font-general';
	}
	
	return $options_array;
} // parabola_maybe_migrate_options()

// Registering and enqueuing all scripts and styles for the init hook
function parabola_init() {
	load_theme_textdomain( 'parabola', get_template_directory_uri() . '/languages' );
}

// Creating the parabola subpage
function parabola_add_page_fn() {
$page = add_theme_page('Parabola Settings', 'Parabola Settings', 'edit_theme_options', 'parabola-page', 'parabola_page_fn');
	add_action( 'admin_print_styles-'.$page, 'parabola_admin_styles' );
	add_action( 'admin_print_scripts-'.$page, 'parabola_admin_scripts' );
}

// Adding the styles for the Parabola admin page used when parabola_add_page_fn() is launched
function parabola_admin_styles() {
	wp_enqueue_style( 'parabola-jquery-ui-style', get_template_directory_uri() . '/js/jqueryui/css/ui-lightness/jquery-ui-1.8.16.custom.css', NULL, _CRYOUT_THEME_VERSION );
	wp_enqueue_style( 'parabola-admin-style', get_template_directory_uri() . '/admin/css/admin.css', NULL, _CRYOUT_THEME_VERSION );
}

// Adding the styles for the Parabola admin page used when parabola_add_page_fn() is launched
function parabola_admin_scripts() {
	wp_enqueue_script('farbtastic');
	wp_enqueue_style( 'farbtastic' );
    wp_enqueue_script('jquery-ui-accordion');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('jquery-ui-tooltip');

	// For backwards compatibility where Parabola is installed on older versions of WP where the ui accordion and slider are not included
	if (!wp_script_is('jquery-ui-accordion',$list='registered')) {
		wp_enqueue_script('cryout_accordion', get_template_directory_uri() . '/admin/js/accordion-slider.js', array('jquery'), _CRYOUT_THEME_VERSION);
	}

	// For the WP uploader
    if(function_exists('wp_enqueue_media')) {
        wp_enqueue_media();
    } else {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');
    }

	// Scripts used in the admin
	wp_register_script('cryout-admin-js',get_template_directory_uri() . '/admin/js/admin.js', NULL, _CRYOUT_THEME_VERSION );
	wp_enqueue_script('cryout-admin-js');
}

// The settings sectoions. All the referenced functions are found in admin-functions.php
function parabola_init_fn(){

	register_setting('parabola_settings', 'parabola_settings', 'parabola_settings_validate');
	
	do_action('parabola_pre_settings_fields');

/**************
   sections
**************/

	add_settings_section('layout_section', __('Layout Settings','parabola'), 'cryout_section_layout_fn', 'parabola-page');
	add_settings_section('header_section', __('Header Settings','parabola'), 'cryout_section_header_fn', 'parabola-page');
	add_settings_section('presentation_section', __('Presentation Page','parabola'), 'cryout_section_presentation_fn', 'parabola-page');
	add_settings_section('text_section', __('Text Settings','parabola'), 'cryout_section_text_fn', 'parabola-page');
	add_settings_section('appereance_section',__('Color Settings','parabola') , 'cryout_section_appereance_fn', 'parabola-page');
	add_settings_section('graphics_section', __('Graphics Settings','parabola') , 'cryout_section_graphics_fn', 'parabola-page');
	add_settings_section('post_section', __('Post Information Settings','parabola') , 'cryout_section_post_fn', 'parabola-page');
	add_settings_section('excerpt_section', __('Post Excerpt Settings','parabola') , 'cryout_section_excerpt_fn', 'parabola-page');
	add_settings_section('featured_section', __('Featured Image Settings','parabola') , 'cryout_section_featured_fn', 'parabola-page');
	add_settings_section('socials_section', __('Social Media Settings','parabola') , 'cryout_section_social_fn', 'parabola-page');
	add_settings_section('misc_section', __('Miscellaneous Settings','parabola') , 'cryout_section_misc_fn', 'parabola-page');

/*** layout ***/
	add_settings_field('parabola_side', __('Main Layout','parabola') , 'cryout_setting_side_fn', 'parabola-page', 'layout_section');
	add_settings_field('parabola_sidewidth', __('Content / Sidebar Width','parabola') , 'cryout_setting_sidewidth_fn', 'parabola-page', 'layout_section');
	add_settings_field('parabola_magazinelayout', __('Magazine Layout','parabola') , 'cryout_setting_magazinelayout_fn', 'parabola-page', 'layout_section');
	add_settings_field('parabola_mobile', __('Responsiveness','parabola') , 'cryout_setting_mobile_fn', 'parabola-page', 'layout_section');

/*** presentation ***/
	add_settings_field('parabola_frontpage', __('Enable Presentation Page','parabola') , 'cryout_setting_frontpage_fn', 'parabola-page', 'presentation_section');
	add_settings_field('parabola_frontposts', __('Show Posts on Presentation Page','parabola') , 'cryout_setting_frontposts_fn', 'parabola-page', 'presentation_section');
	add_settings_field('parabola_frontslider', __('Slider Settings','parabola') , 'cryout_setting_frontslider_fn', 'parabola-page', 'presentation_section');
	add_settings_field('parabola_frontslider2', __('Slides','parabola') , 'cryout_setting_frontslider2_fn', 'parabola-page', 'presentation_section');
	add_settings_field('parabola_frontcolumns', __('Presentation Page Columns','parabola') , 'cryout_setting_frontcolumns_fn', 'parabola-page', 'presentation_section');
	add_settings_field('parabola_fronttext', __('Extras','parabola') , 'cryout_setting_fronttext_fn', 'parabola-page', 'presentation_section');

/*** header ***/
	add_settings_field('parabola_hheight', __('Header Height','parabola') , 'cryout_setting_hheight_fn', 'parabola-page', 'header_section');
	add_settings_field('parabola_himage', __('Header Image','parabola') , 'cryout_setting_himage_fn', 'parabola-page', 'header_section');
	add_settings_field('parabola_siteheader', __('Site Header','parabola') , 'cryout_setting_siteheader_fn', 'parabola-page', 'header_section');
	add_settings_field('parabola_logoupload', __('Custom Logo Upload','parabola') , 'cryout_setting_logoupload_fn', 'parabola-page', 'header_section');
	add_settings_field('parabola_headermargin', __('Header Content Spacing','parabola') , 'cryout_setting_headermargin_fn', 'parabola-page', 'header_section');
	// favicon functionality removed @parabola 2.4.0
	add_settings_field('parabola_headerwidgetwidth', __('Header Widget Width','parabola') , 'cryout_setting_headerwidgetwidth_fn', 'parabola-page', 'header_section');

/*** text ***/
	add_settings_field('parabola_fontfamily', __('General Font','parabola') , 'cryout_setting_fontfamily_fn', 'parabola-page', 'text_section');
	add_settings_field('parabola_fonttitle', __('Post Title Font ','parabola') , 'cryout_setting_fonttitle_fn', 'parabola-page', 'text_section');
	add_settings_field('parabola_fontside', __('Widget Title Font','parabola') , 'cryout_setting_fontside_fn', 'parabola-page', 'text_section');
	add_settings_field('parabola_sitetitlefont', __('Site Title Font','parabola') , 'cryout_setting_sitetitlefont_fn', 'parabola-page', 'text_section');
	add_settings_field('parabola_menufont', __('Main Menu Font','parabola') , 'cryout_setting_menufont_fn', 'parabola-page', 'text_section');
	add_settings_field('parabola_fontheadings', __('Headings Font','parabola') , 'cryout_setting_fontheadings_fn', 'parabola-page', 'text_section');
	add_settings_field('parabola_textalign', __('Force Text Align','parabola') , 'cryout_setting_textalign_fn', 'parabola-page', 'text_section');
	add_settings_field('parabola_paragraphspace', __('Paragraph spacing','parabola') , 'cryout_setting_paragraphspace_fn', 'parabola-page', 'text_section');
	add_settings_field('parabola_parindent', __('Paragraph Indent','parabola') , 'cryout_setting_parindent_fn', 'parabola-page', 'text_section');
	add_settings_field('parabola_headingsindent', __('Headings Indent','parabola') , 'cryout_setting_headingsindent_fn', 'parabola-page', 'text_section');
	add_settings_field('parabola_lineheight', __('Line Height','parabola') , 'cryout_setting_lineheight_fn', 'parabola-page', 'text_section');
	add_settings_field('parabola_wordspace', __('Word Spacing','parabola') , 'cryout_setting_wordspace_fn', 'parabola-page', 'text_section');
	add_settings_field('parabola_letterspace', __('Letter Spacing','parabola') , 'cryout_setting_letterspace_fn', 'parabola-page', 'text_section');
	add_settings_field('parabola_uppercasetext', __('Uppercase Text','parabola') , 'cryout_setting_uppercasetext_fn', 'parabola-page', 'text_section');

/*** appereance ***/

    add_settings_field('parabola_sitebackground', __('Background Image','parabola') , 'cryout_setting_sitebackground_fn', 'parabola-page', 'appereance_section');
	add_settings_field('parabola_generalcolors', __('General','parabola') , 'cryout_setting_generalcolors_fn', 'parabola-page', 'appereance_section');
	add_settings_field('parabola_accentcolors', __('Accents','parabola') , 'cryout_setting_accentcolors_fn', 'parabola-page', 'appereance_section');
	add_settings_field('parabola_titlecolors', __('Site Title','parabola') , 'cryout_setting_titlecolors_fn', 'parabola-page', 'appereance_section');

	add_settings_field('parabola_menucolors', __('Main Menu','parabola') , 'cryout_setting_menucolors_fn', 'parabola-page', 'appereance_section');
	add_settings_field('parabola_topmenucolors', __('Top Menu','parabola') , 'cryout_setting_topmenucolors_fn', 'parabola-page', 'appereance_section');

	add_settings_field('parabola_contentcolors', __('Content','parabola') , 'cryout_setting_contentcolors_fn', 'parabola-page', 'appereance_section');
	add_settings_field('parabola_frontpagecolors', __('Presentation Page','parabola') , 'cryout_setting_frontpagecolors_fn', 'parabola-page', 'appereance_section');
	add_settings_field('parabola_sidecolors', __('Sidebar Widgets','parabola') , 'cryout_setting_sidecolors_fn', 'parabola-page', 'appereance_section');
	add_settings_field('parabola_widgetcolors', __('Footer Widgets','parabola') , 'cryout_setting_widgetcolors_fn', 'parabola-page', 'appereance_section');
	add_settings_field('parabola_linkcolors', __('Links','parabola') , 'cryout_setting_linkcolors_fn', 'parabola-page', 'appereance_section');

	add_settings_field('parabola_caption', __('Caption Border','parabola') , 'cryout_setting_caption_fn', 'parabola-page', 'appereance_section');
	add_settings_field('parabola_metaback', __('Meta Area Background','parabola') , 'cryout_setting_metaback_fn', 'parabola-page', 'appereance_section');

/*** graphics ***/

	add_settings_field('parabola_breadcrumbs', __('Breadcrumbs','parabola') , 'cryout_setting_breadcrumbs_fn', 'parabola-page', 'graphics_section');
	add_settings_field('parabola_pagination', __('Pagination','parabola') , 'cryout_setting_pagination_fn', 'parabola-page', 'graphics_section');
	add_settings_field('parabola_menualign', __('Menu Alignment','parabola') , 'cryout_setting_menualign_fn', 'parabola-page', 'graphics_section');
	add_settings_field('parabola_triangles', __('Triangle Accents','parabola') , 'cryout_setting_triangles_fn', 'parabola-page', 'graphics_section');
	add_settings_field('parabola_image', __('Post Images Border','parabola') , 'cryout_setting_image_fn', 'parabola-page', 'graphics_section');
	add_settings_field('parabola_contentlist', __('Content List Bullets','parabola') , 'cryout_setting_contentlist_fn', 'parabola-page', 'graphics_section');
	add_settings_field('parabola_pagetitle', __('Page Titles','parabola') , 'cryout_setting_pagetitle_fn', 'parabola-page', 'graphics_section');
	add_settings_field('parabola_categetitle', __('Category Titles','parabola') , 'cryout_setting_categtitle_fn', 'parabola-page', 'graphics_section');
	add_settings_field('parabola_tables', __('Hide Tables','parabola') , 'cryout_setting_tables_fn', 'parabola-page', 'graphics_section');
	add_settings_field('parabola_backtop', __('Back to Top button','parabola') , 'cryout_setting_backtop_fn', 'parabola-page', 'graphics_section');
	add_settings_field('parabola_comtext', __('Text Under Comments','parabola') , 'cryout_setting_comtext_fn', 'parabola-page', 'graphics_section');
	add_settings_field('parabola_comclosed', __('Comments are closed text','parabola') , 'cryout_setting_comclosed_fn', 'parabola-page', 'graphics_section');
	add_settings_field('parabola_comoff', __('Comments off','parabola') , 'cryout_setting_comoff_fn', 'parabola-page', 'graphics_section');

/*** post metas***/
	add_settings_field('parabola_postmetas', __('Meta Bar','parabola') , 'cryout_setting_postmetas_fn', 'parabola-page', 'post_section');
	add_settings_field('parabola_postcomlink', __('Post Comments Link','parabola') , 'cryout_setting_postcomlink_fn', 'parabola-page', 'post_section');
	add_settings_field('parabola_postdatetime', __('Post Date/Time','parabola') , 'cryout_setting_postdatetime_fn', 'parabola-page', 'post_section');
	add_settings_field('parabola_postauthor', __('Post Author','parabola') , 'cryout_setting_postauthor_fn', 'parabola-page', 'post_section');
	add_settings_field('parabola_postcateg', __('Post Category','parabola') , 'cryout_setting_postcateg_fn', 'parabola-page', 'post_section');
	add_settings_field('parabola_posttag', __('Post Tags','parabola') , 'cryout_setting_posttag_fn', 'parabola-page', 'post_section');
	add_settings_field('parabola_postbook', __('Post Permalink','parabola') , 'cryout_setting_postbook_fn', 'parabola-page', 'post_section');

/*** post exceprts***/
	add_settings_field('parabola_excerpthome', __('Home Page','parabola') , 'cryout_setting_excerpthome_fn', 'parabola-page', 'excerpt_section');
	add_settings_field('parabola_excerptsticky', __('Sticky Posts','parabola') , 'cryout_setting_excerptsticky_fn', 'parabola-page', 'excerpt_section');
	add_settings_field('parabola_excerptarchive', __('Archive and Category Pages','parabola') , 'cryout_setting_excerptarchive_fn', 'parabola-page', 'excerpt_section');
	add_settings_field('parabola_excerptwords', __('Number of Words for Post Excerpts ','parabola') , 'cryout_setting_excerptwords_fn', 'parabola-page', 'excerpt_section');
	add_settings_field('parabola_excerptdots', __('Excerpt suffix','parabola') , 'cryout_setting_excerptdots_fn', 'parabola-page', 'excerpt_section');
	add_settings_field('parabola_excerptcont', __('Continue reading link text ','parabola') , 'cryout_setting_excerptcont_fn', 'parabola-page', 'excerpt_section');
	add_settings_field('parabola_excerpttags', __('HTML tags in Excerpts','parabola') , 'cryout_setting_excerpttags_fn', 'parabola-page', 'excerpt_section');

/*** featured ***/
	add_settings_field('parabola_fpost', __('Featured Images as POST Thumbnails ','parabola') , 'cryout_setting_fpost_fn', 'parabola-page', 'featured_section');
	add_settings_field('parabola_fauto', __('Auto Select Images From Posts ','parabola') , 'cryout_setting_fauto_fn', 'parabola-page', 'featured_section');
	add_settings_field('parabola_falign', __('Thumbnails Alignment ','parabola') , 'cryout_setting_falign_fn', 'parabola-page', 'featured_section');
	add_settings_field('parabola_fsize', __('Thumbnails Size ','parabola') , 'cryout_setting_fsize_fn', 'parabola-page', 'featured_section');
	add_settings_field('parabola_fheader', __('Featured Images as HEADER Images ','parabola') , 'cryout_setting_fheader_fn', 'parabola-page', 'featured_section');

/*** socials ***/
	add_settings_field('parabola_socials1', __('Link nr. 1','parabola') , 'cryout_setting_socials1_fn', 'parabola-page', 'socials_section');
	add_settings_field('parabola_socials2', __('Link nr. 2','parabola') , 'cryout_setting_socials2_fn', 'parabola-page', 'socials_section');
	add_settings_field('parabola_socials3', __('Link nr. 3','parabola') , 'cryout_setting_socials3_fn', 'parabola-page', 'socials_section');
	add_settings_field('parabola_socials4', __('Link nr. 4','parabola') , 'cryout_setting_socials4_fn', 'parabola-page', 'socials_section');
	add_settings_field('parabola_socials5', __('Link nr. 5','parabola') , 'cryout_setting_socials5_fn', 'parabola-page', 'socials_section');
	add_settings_field('parabola_socialshow', __('Socials display','parabola') , 'cryout_setting_socialsdisplay_fn', 'parabola-page', 'socials_section');

/*** misc ***/
	add_settings_field('parabola_iecompat', __('Internet Explorer Compatibility Tag','parabola') , 'cryout_setting_iecompat_fn', 'parabola-page', 'misc_section');
	add_settings_field('parabola_masonry', __('Masonry','parabola') , 'cryout_setting_masonry_fn', 'parabola-page', 'misc_section');
	add_settings_field('parabola_fitvids', __('FitVids','parabola') , 'cryout_setting_fitvids_fn', 'parabola-page', 'misc_section');
	add_settings_field('parabola_copyright', __('Custom Footer Text','parabola') , 'cryout_setting_copyright_fn', 'parabola-page', 'misc_section');
	add_settings_field('parabola_customcss', __('Custom CSS','parabola') , 'cryout_setting_customcss_fn', 'parabola-page', 'misc_section');
	add_settings_field('parabola_customjs', __('Custom JavaScript','parabola') , 'cryout_setting_customjs_fn', 'parabola-page', 'misc_section');
	
	do_action('parabola_post_settings_fields');

}

function parabola_theme_settings_placeholder() { 
	if (function_exists('parabola_theme_settings_restore') ):
			parabola_theme_settings_restore();
	else:
?>
   <div id="parabola-settings-placeholder">
		<h3>Where are the theme settings?</h3>
		<p>According to the <a href="https://make.wordpress.org/themes/2015/04/21/this-weeks-meeting-important-information-regarding-theme-options/" target="_blank">Wordpress Theme Review Guidelines</a>, starting with Parabola v1.6 we had to remove the settings page from the theme and transfer all the settings to the <a href="http://codex.wordpress.org/Appearance_Customize_Screen" target="_blank">Customizer</a> interface.</p>
		<p>However, we feel that the Customizer interface does not provide the right medium (in space of terms and usability) for our existing theme options. We've created our settings with a certain layout that is not really compatible with the Customizer interface.</p>
		<p>As an alternative solution that allows us to keep updating and improving our theme we have moved the settings functionality to the separate <a href="https://wordpress.org/plugins/cryout-theme-settings/" target="_blank">Cryout Serious Theme Settings</a> plugin. To restore the theme settings page to previous functionality, all you need to do is install this free plugin with a couple of clicks.</p>
		<h3>How do I restore the settings?</h3>
		<p><strong>Navigate <a href="themes.php?page=parabola-extra-plugins">to this page</a> to install and activate the Cryout Serious Theme Settings plugin, then return here to find the settings page in all its past glory.</strong></p>
		<p>The plugin is compatible with all our themes that are affected by this change and only needs to be installed once.</p>
   </div>
<?php
	endif;
} // parabola_theme_settings_placeholder()


 // Display the admin options page
function parabola_page_fn() {
 // Load the import form page if the import button has been pressed
	if (isset($_POST['parabola_import'])) {
		parabola_import_form();
		return;
	}
 // Load the import form  page after upload button has been pressed
	if (isset($_POST['parabola_import_confirmed'])) {
		parabola_import_file();
		return;
	}

 // Load the presets  page after presets button has been pressed
	if (isset($_POST['parabola_presets'])) {
		parabola_init_fn();
		parabola_presets();
		return;
	}


 if (!current_user_can('edit_theme_options'))  {
    wp_die( __('Sorry, but you do not have sufficient permissions to access this page.','parabola') );
  }?>


<div class="wrap cryout-admin"><!-- Admin wrap page -->
<h2 id="empty-placeholder-heading-for-wp441-notice-forced-move"></h2>
<?php
if ( isset( $_GET['settings-updated'] ) ) {
    echo "<div class='updated fade' style='clear:left;'><p>";
	echo _e('Parabola settings updated successfully.','parabola');
	echo "</p></div>";
}
?>

<div id="lefty"><!-- Left side of page - the options area -->
<div>
	<div id="admin_header"><img src="<?php echo esc_url( get_template_directory_uri() ) . '/admin/images/parabola-logo.png' ?>" /> </div>
	<div id="admin_links">
		<a target="_blank" href="https://www.cryoutcreations.eu/wordpress-themes/parabola">Parabola Homepage</a>
		<a target="_blank" href="https://www.cryoutcreations.eu/forum">Support</a>
		<a target="_blank" href="https://www.cryoutcreations.eu">Cryout Creations</a>
	</div>
	<div style="clear: both;"></div>
</div>
	<div id="main-options">
		<?php
		parabola_theme_settings_placeholder();
		$parabola_theme_data = get_transient( 'parabola_theme_info'); ?>
		<span id="version">
			Parabola v<?php echo _CRYOUT_THEME_VERSION; ?> by <a href="https://www.cryoutcreations.eu" target="_blank">Cryout Creations</a>
		</span>
	</div><!-- main-options -->
</div><!--lefty -->


<div id="righty" ><!-- Right side of page - Coffee, RSS tips and others -->

	<?php do_action('parabola_before_righty') ?>

	<div class="postbox donate">
		<h3 class="hndle"> Coffee Break </h3>
		<div class="inside"><?php echo "<p>Great power comes with great responsibility. We have complete faith that you will only use Parabola for good. You will not use it to destroy worlds, but to create them. You will not use it to control minds, but to expand them. You will not use it to enslave your peers but you will introduce them to Parabola so that they may one day become your equals. We *know* our theme won't be crippled in your hands, you'll nourish it and use it to its full potential.</p>
		<p>But if you feel the dark forces are somehow taking over, if you sense Parabola is not serving its true, original purpose... buy us a coffee and we'll stay up all night to restore the balance. We know the dark forces very well ;)</p> "; ?>
			<div style="display:block;float:none;margin:0 auto;text-align:center;">
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
					<input type="hidden" name="cmd" value="_donations">
					<input type="hidden" name="business" value="KYL26KAN4PJC8">
					<input type="hidden" name="item_name" value="Cryout Creations / Parabola Theme donation">
					<input type="hidden" name="currency_code" value="EUR">
					<input type="hidden" name="bn" value="PP-DonationsBF:btn_donate_SM.gif:NonHosted">
					<input type="image" src="<?php echo esc_url( get_template_directory_uri() ) . '/admin/images/coffee.png' ?>" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
					<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
				</form>
			</div>
		</div><!-- inside -->
	</div><!-- donate -->
	
	<?php do_action('parabola_after_righty') ?>

</div><!--  righty -->
</div><!--  wrap -->

<script type="text/javascript">
var reset_confirmation = '<?php echo esc_html(__('Reset Parabola Settings to Defaults?','parabola')); ?>';

function tooltip_terain() {
	jQuery('#accordion small').parent('div').append('<a class="tooltip"><img src="<?php echo esc_url( get_template_directory_uri() ) ?>/images/icon-tooltip.png" /></a>').
		each(function() {
			var tooltip_info = jQuery(this).children('small').html();
			jQuery(this).children('.tooltip').tooltip({content : tooltip_info});
			jQuery(this).children('.tooltip').tooltip( "option", "items", "a" );
			jQuery(this).children('.tooltip').tooltip( "option", "hide", "false");
			jQuery(this).children('small').remove();
			if (!jQuery(this).hasClass('slmini') && !jQuery(this).hasClass('slidercontent') && !jQuery(this).hasClass('slideDivs')) jQuery(this).addClass('tooltip_div');
		});
}

/* jQuery confim window on reset to defaults */
jQuery('#parabola_defaults').on( 'click', function() {
		if (!confirm(reset_confirmation)) { return false;}
});

/* jQuery confim window on loading a color scheme */
jQuery('#load-color-scheme').on( 'click', function() {
		if (!confirm(scheme_confirmation)) { return false;}
});

jQuery(document).ready(function(){
	if (vercomp(jQuery.ui.version,"1.9.0")) {
		tooltip_terain();
		jQuery('.colorthingy').each(function(){
			id = "#"+jQuery(this).attr('id');
			startfarb(id,id+'2');
		});
	} else {
		jQuery("#main-options").addClass('oldwp');
		setTimeout(function(){jQuery('#parabola_slideType').trigger('click')},1000);
		jQuery('.colorthingy').each(function(){
			id = "#"+jQuery(this).attr('id');
			jQuery(this).on('keyup',function(){coloursel(this)});
			coloursel(this);
		});
	}
});
</script>

<?php } // parabola_page_fn()

// FIN
