<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Cryout Creations
 * @subpackage parabola
 * @since parabola 1.5
 */
get_header(); ?>


		<section id="container" class="<?php echo parabola_get_layout_class(); ?>">

			<div id="content" role="main">
			<div id="mainwoo">
		

	<?php
		/**
		 * cryout_before_content_hook hook
		 */
		do_action( 'cryout_before_content_hook' );
	?>

		
	<?php woocommerce_breadcrumb(); ?>

	<?php woocommerce_content(); ?>

	<?php
		/**
		 * cryout_after_content_hook hook
		 */
		do_action( 'cryout_after_content_hook' );
	?>
			
			</div><!-- #mainwoo -->
			</div><!-- #content -->
			
			<?php parabola_get_sidebar(); ?>
			
		</section><!-- #container -->

	<?php 

get_footer();