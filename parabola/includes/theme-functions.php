<?php
/**
 * Misc functions breadcrumbs / pagination / transient data /back to top button
 *
 * @package parabola
 * @subpackage Functions
 */


 /**
 * Adds HTML5 tags for old IEs
 * Used in header.php
*/
function parabola_header_scripts() {
?>
<!--[if lt IE 9]>
<script>
document.createElement('header');
document.createElement('nav');
document.createElement('section');
document.createElement('article');
document.createElement('aside');
document.createElement('footer');
</script>
<![endif]-->
<?php
} // parabola_header_scripts()
add_action( 'wp_head', 'parabola_header_scripts', 100 );


 /**
 * Adds title and description to heaer
 * Used in header.php
*/
function parabola_title_and_description() {
	global $parabolas;
	// Header styling and image loading
	// Check if this is a post or page, if it has a thumbnail, and if it's a big one
	global $post;

	if ( get_header_image() != '') { $himgsrc= get_header_image(); }
	if ( is_singular() && has_post_thumbnail( $post->ID ) && $parabolas['parabola_fheader'] == "Enable" &&
		( $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'header' ) ) &&
		$image[1] >= $parabolas['parabola_totalSize'] ) : $himgsrc= esc_url( $image[0] );
	endif;


	if ( isset($himgsrc) && ($himgsrc != '')) : echo '<img id="bg_image" alt="' . esc_html( get_bloginfo( 'name' ) ) . '" title="' . esc_html( get_bloginfo( 'name' ) ) . '" src="' . esc_url( $himgsrc ) . '"  />';  endif;
?>
<div id="header-container">
<?php

	switch ($parabolas['parabola_siteheader']) {
		case 'Site Title and Description':
			echo '<div>';
			$heading_tag = ( ( is_home() || is_front_page() ) && !is_page() ) ? 'h1' : 'div';
			echo '<'.$heading_tag.' id="site-title">';
			echo '<span> <a href="' . esc_url( home_url( '/' ) ) . '" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">' . esc_html( get_bloginfo( 'name' ) ) . '</a> </span>';
			echo '</'.$heading_tag.'>';
			echo '<div id="site-description" >' . esc_html( get_bloginfo( 'description' ) ) . '</div></div>';
		break;

		case 'Clickable header image' :
			echo '<a href="' . esc_url( home_url( '/' ) ) . '" id="linky"></a>' ;
		break;

		case 'Custom Logo' :
			if ( isset($parabolas['parabola_logoupload']) && ($parabolas['parabola_logoupload'] != '') ) :
				echo '<div><a id="logo" href="' . esc_url( home_url( '/' ) ) . '" ><img title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ).'" src="' . esc_url( $parabolas['parabola_logoupload'] ) . '" /></a></div>';
			endif;
		break;

		case 'Empty' :
		break;
	}

	if ( $parabolas['parabola_socialsdisplay0'] ) parabola_header_socials();
	echo '</div>';
} // parabola_title_and_description()

add_action ('cryout_branding_hook','parabola_title_and_description');


 /**
 * Add social icons in header / undermneu left / undermenu right / footer / left browser side / right browser side
 * Used in header.php and footer.php
*/
function parabola_header_socials() {
	parabola_set_social_icons('sheader');
}

function parabola_smenul_socials() {
	parabola_set_social_icons('smenul');
}

function parabola_smenur_socials() {
	parabola_set_social_icons('smenur');
}

function parabola_footer_socials() {
	parabola_set_social_icons('sfooter');
}

function parabola_slefts_socials() {
	parabola_set_social_icons('slefts');
}

function parabola_srights_socials() {
	parabola_set_social_icons('srights');
}

// Adding socials to the footers
if ( $parabolas['parabola_socialsdisplay3'] ) add_action('cryout_footer_hook', 'parabola_footer_socials',13);
// Adding socials to the left and right browser sides
if ( $parabolas['parabola_socialsdisplay4'] ) add_action('cryout_wrapper_hook', 'parabola_slefts_socials',13);
if ( $parabolas['parabola_socialsdisplay5'] ) add_action('cryout_wrapper_hook', 'parabola_srights_socials',13);


if ( ! function_exists( 'parabola_set_social_icons' ) ) :
/**
 * Social icons function
 */
function parabola_set_social_icons($id) {
	$cryout_special_keys = array('Mail', 'Skype', 'Phone');
	global $parabolas;
	echo '<div class="socials" id="'.$id.'">';
	for ($i=1; $i<=9; $i+=2) {
		$j=$i+1;
		if ( $parabolas["parabola_social$j"] ) {
			if (in_array($parabolas["parabola_social$i"],$cryout_special_keys)) :
				$cryout_current_social = esc_html( $parabolas["parabola_social$j"] );
			else :
				$cryout_current_social = esc_url( $parabolas["parabola_social$j"] );
			endif;	?>

			<a <?php if ($parabolas['parabola_social_target'.$i]) {echo ' target="_blank" ';} ?> rel="nofollow" href="<?php echo $cryout_current_social; ?>"
			class="socialicons social-<?php echo esc_attr($parabolas["parabola_social$i"]); ?>" title="<?php echo $parabolas["parabola_social_title$i"] !="" ? esc_attr($parabolas["parabola_social_title$i"]) : esc_attr($parabolas["parabola_social$i"]); ?>">
				<img alt="<?php echo esc_attr($parabolas["parabola_social$i"]); ?>" src="<?php echo esc_url( get_template_directory_uri() ) . '/images/socials/' . $parabolas["parabola_social$i"].'.png'; ?>" />
			</a><?php
		}
	}
	echo '</div>';
} // parabola_set_social_icons()
endif;


/**
 * Parabola back to top button
 * Creates div for js
*/
function parabola_back_top() {
	echo '<div id="toTop"> </div>';
} // parabola_back_top()

if ($parabolas['parabola_backtop'] == "Enable") add_action ( 'cryout_body_hook', 'parabola_back_top' );


/**
 * Creates breadcrumns with page sublevels and category sublevels.
 */
if ( ! function_exists( 'parabola_breadcrumbs' ) ) :
function parabola_breadcrumbs() {

	global $parabolas;
	
	$showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$separator = ' &raquo; '; // separator between crumbs
	$home = '<a href="' . esc_url( home_url() ) . '">' . __('Home','parabola') . '</a>'; // text for the 'Home' link
	$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	$before = '<span class="current">'; // tag before the current crumb
	$after = '</span>'; // tag after the current crumb

	if ( is_front_page() && ($parabolas['parabola_frontpage']=="Enable") ) { return; }
	
	// integrate layout class and microdata in wrapper_pre
	$wrapper_pre = '<div class="breadcrumbs">' . $home . $separator . ' ';
	$wrapper_post = '</div><!--breadcrumbs-->';
	
	global $post;
	$homeLink = esc_url( home_url() );

	// woocommerce sections display their own breadcrumbs	
	if ( function_exists('woocommerce_breadcrumb') && is_woocommerce() ){
		$args = array(
			'delimiter' => $separator,
			'wrap_before' => $wrapper_pre . ' ',
			'wrap_after' => $wrapper_post,
			'before' => '',
			'after' => '',
			'home' => false,
		);
		woocommerce_breadcrumb( $args );
		return;
	};	
	
	if ( is_front_page() && is_home() ) {
		// default homepage

		if ($parabolas['parabola_frontpage']=="Enable") { return; }
		if ($showOnHome == 1) echo '<div class="breadcrumbs"><a href="' . $homeLink . '">' .  __('Home Page','parabola') . '</a></div>';

	} elseif ( is_front_page()){
		// static homepage

		if ($parabolas['parabola_frontpage']=="Enable") { return; }

	} elseif ( is_home() ){
		// blog page

		echo '<div class="breadcrumbs">' . $home . $separator . $before . get_the_title( get_option('page_for_posts', true) ) . $after .  '</div>';

	} else {
		// everything else
	
		echo $wrapper_pre;

		if ( is_category() ) {
			// category
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $separator . ' ');
			echo $before . __('Category','parabola').' "' . single_cat_title('', false) . '"' . $after;

		} elseif ( is_search() ) {
			// search
			echo $before . __('Search results for','parabola').' "' . get_search_query() . '"' . $after;

		} elseif ( is_day() ) {
			// daily archive
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $separator . ' ';
			echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $separator . ' ';
			echo $before . get_the_time('d') . $after;

		} elseif ( is_month() ) {
			// montly archive
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $separator . ' ';
			echo $before . get_the_time('F') . $after;

		} elseif ( is_year() ) {
			// yearly archive
			echo $before . get_the_time('Y') . $after;

		} elseif ( is_single() && !is_attachment() ) {
			// single post/page
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
				if ($showCurrent == 1) echo ' ' . $separator . ' ' . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category();
				if (isset($cat[0])) {
						$cat = $cat[0];
				} else {
						$cat = false;
				}
				if ($cat) {
						$cats = get_category_parents($cat, TRUE, ' ' . $separator . ' ');
				} else {
						$cats=false;
				}
				if ($showCurrent == 0 && $cats) $cats = preg_replace("#^(.+)\s$separator\s$#", "$1", $cats);
				echo $cats;
				if ($showCurrent == 1) echo $before . get_the_title() . $after;
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			// some other single item
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;

		} elseif ( is_attachment() ) {
			// attachment
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID);
			if (isset($cat[0])) {
					$cat = $cat[0];
			} else {
					$cat=false;
			}
			if ($cat) echo get_category_parents($cat, TRUE, ' ' . $separator . ' ');
			echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
			if ($showCurrent == 1) echo ' ' . $separator . ' ' . $before . get_the_title() . $after;

		} elseif ( is_page() && !$post->post_parent ) {
			// parent page
			if ($showCurrent == 1) echo $before . get_the_title() . $after;
		} elseif ( is_page() && $post->post_parent ) {
			// child page
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				echo $breadcrumbs[$i];
				if ($i != count($breadcrumbs)-1) echo ' ' . $separator . ' ';
			}
			if ($showCurrent == 1) echo ' ' . $separator . ' ' . $before . get_the_title() . $after;

		} elseif ( is_tag() ) {
			// tag archive
			echo $before . __('Posts tagged','parabola').' "' . single_tag_title('', false) . '"' . $after;

		} elseif ( is_author() ) {
			// author archive
			global $author;
			$userdata = get_userdata($author);
			echo $before . __('Articles by','parabola'). ' ' . $userdata->display_name . $after;

		} elseif ( is_404() ) {
			// 404
			echo $before . __('Error 404','parabola') . $after;
		} elseif ( get_post_format() ) {
			// post format
			echo $before . '"' . ucwords( get_post_format() ) . '" ' . __( 'Post format', 'parabola' ) . $after;
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo __('Page','parabola') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}
		echo $wrapper_post;
	}
} // parabola breadcrumbs()
endif;

if ( $parabolas['parabola_breadcrumbs'] == "Enable" )  add_action ( 'cryout_breadcrumbs_hook', 'parabola_breadcrumbs' );


if ( ! function_exists( 'parabola_pagination' ) ) :
/**
 * Creates pagination for blog pages.
 */
function parabola_pagination($pages = '', $range = 2, $prefix ='')
{
     $showitems = ($range * 2)+1;

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }

     if(1 != $pages)
     {
		echo "<div class='pagination_container'><nav class='pagination'>";
         if ($prefix) {echo "<span id='paginationPrefix'>$prefix </span>";}
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</nav></div>\n";
     }
} // parabola_pagination()
endif;

/**
 * Site info
 */
function parabola_site_info() {
	?>
	<div style="text-align:center;padding:5px 0 2px;text-transform:uppercase;font-size:12px;margin:1em auto 0;">
	<?php _e('Powered by','parabola')?> <a target="_blank" href="<?php echo 'http://www.cryoutcreations.eu';?>" title="<?php echo 'Parabola Theme by '.
			'Cryout Creations';?>"><?php echo 'Parabola' ?></a> &amp; <a target="_blank" href="<?php echo 'http://wordpress.org/'; ?>"
			title="<?php esc_attr_e('Semantic Personal Publishing Platform', 'parabola'); ?>"> <?php printf(' %s.', 'WordPress' ); ?>
		</a>
	</div><!-- #site-info -->
	<?php
} // parabola_site_info()

add_action('cryout_footer_hook', 'parabola_site_info', 12);


/**
 * Copyright text
 */
function parabola_copyright() {
	global $parabolas;
	echo '<div id="site-copyright">' . do_shortcode( wp_kses_post( $parabolas['parabola_copyright'] ) ) . '</div>';
} // parabola_copyright()


if ( $parabolas['parabola_copyright'] != '' ) add_action( 'cryout_footer_hook', 'parabola_copyright', 11 );

add_action( 'wp_ajax_nopriv_do_ajax', 'parabola_ajax_function' );
add_action( 'wp_ajax_do_ajax', 'parabola_ajax_function' );

if ( ! function_exists( 'parabola_ajax_function' ) ) :
function parabola_ajax_function(){
	ob_clean();

   // the first part is a SWTICHBOARD that fires specific functions
   // according to the value of Query Var 'fn'

	switch($_REQUEST['fn']){
		case 'get_latest_posts':
			$output = parabola_ajax_get_latest_posts($_REQUEST['count'],$_REQUEST['categName']);
		break;
		default:
			$output = 'No function specified, check your jQuery.ajax() call';
		break;
	}

	// at this point, $output contains some sort of valuable data!
	// Now, convert $output to JSON and echo it to the browser
	// That way, we can recapture it with jQuery and run our success function

	$output=json_encode($output);
	if(is_array($output)) { print_r($output); }
	                 else { echo $output; }
	die;
} // parabola_ajax_function()
endif;

if ( ! function_exists( 'parabola_ajax_get_latest_posts' ) ) :
function parabola_ajax_get_latest_posts( $count, $categName ){
	$testVar='';
	// The Query
	query_posts( 'category_name=' . $categName);
	// The Loop
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
			$testVar .= the_title( "<option>", "</option>", 0 );
		endwhile;
	else:
	endif;
	// Reset Query
	wp_reset_query();
	return $testVar;
} // parabola_ajax_get_latest_posts()
endif;


function parabola_get_sidebar() {
	global $parabolas;
	
	switch ($parabolas['parabola_side']) {

		case '2cSl':
			get_sidebar('left');
		break;

		case '2cSr':
			get_sidebar('right');
		break;

		case '3cSl' : case '3cSr' : case '3cSs' :
			get_sidebar('left');
			get_sidebar('right');
		break;

		default:
		break;
	}
} // parabola_get_sidebar()

function parabola_get_layout_class() {
	global $parabolas;
	switch ($parabolas['parabola_side']) {
		case '2cSl': return "two-columns-left"; break;
		case '2cSr': return "two-columns-right"; break;
		case '3cSl': return "three-columns-left"; break;
		case '3cSr' : return "three-columns-right"; break;
		case '3cSs' : return "three-columns-sided"; break;
		case '1c':
		default: return "one-column"; break;
	}
} // parabola_get_layout_class()

/**
 *
 */
if ( ! function_exists( 'parabola_nextpage_links' ) ) :
function parabola_nextpage_links( $defaults ) {
	$args = array(
		'link_before'      => '<em>',
		'link_after'       => '</em>',
	);
	return wp_parse_args( $args, $defaults );
} // parabola_nextpage_links()
endif;
add_filter( 'wp_link_pages_args', 'parabola_nextpage_links' );


/**
* Retrieves the IDs for images in a gallery.
* @since parabola 1.0.3
* @return array List of image IDs from the post gallery.
*/
function parabola_get_gallery_images() {
       $images = array();

       if ( function_exists( 'get_post_galleries' ) ) {
               $galleries = get_post_galleries( get_the_ID(), false );
               if ( isset( $galleries[0]['ids'] ) )
                       $images = explode( ',', $galleries[0]['ids'] );
       } else {
               $pattern = get_shortcode_regex();
               preg_match( "/$pattern/s", get_the_content(), $match );
               $atts = shortcode_parse_atts( $match[3] );
               if ( isset( $atts['ids'] ) )
                       $images = explode( ',', $atts['ids'] );
       }

       if ( ! $images ) {
               $images = get_posts( array(
                       'fields'         => 'ids',
                       'numberposts'    => 999,
                       'order'          => 'ASC',
                       'orderby'        => 'none',
                       'post_mime_type' => 'image',
                       'post_parent'    => get_the_ID(),
                       'post_type'      => 'attachment',
               ) );
       }

       return $images;
} // parabola_get_gallery_images()


/**
* Checks the browser agent string for mobile ids and adds "mobile" class to body if true
* @since parabola 1.2.3
* @return array list of classes.
*/
function parabola_mobile_body_class($classes){
	global $parabolas;
    if ( $parabolas['parabola_mobile']=="Enable" ):
		$browser = (isset($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:'');
		$keys = 'mobile|android|mobi|tablet|ipad|opera mini|series 60|s60|blackberry';
		if (preg_match("/($keys)/i",$browser)): $classes[] = 'pa-mobile'; endif; // mobile browser detected
	endif;
	return $classes;
}

add_filter('body_class', 'parabola_mobile_body_class');


/**
* WordPress 5.2+ wp_body_open() support
*/
function parabola_wp_body_open() {
	do_action( 'wp_body_open' );
}
add_action( 'cryout_body_hook', 'parabola_wp_body_open', 5 );

// FIN