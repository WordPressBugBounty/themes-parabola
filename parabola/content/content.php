<?php
/**
 * The default template for displaying content
 *
 * @package Cryout Creations
 * @subpackage Parabola
 * @since Parabola 1.0
 */

$parabolas = parabola_get_theme_options();
?>
<?php cryout_before_article_hook(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php parabola_comments_on(); ?>
		<header class="entry-header">			
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'parabola' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>
			<?php cryout_post_title_hook(); 
			?><?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php parabola_meta_before(); 
					cryout_post_meta_hook();  ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>

		
		</header><!-- .entry-header -->
			<?php cryout_post_before_content_hook(); ?>  
			<?php if ( is_archive() || is_search() || is_page() ) : // Display excerpts for archives, search and page templates ?>
			
						<?php if ( $parabolas['parabola_excerptarchive'] != "Full Post" ) { ?>
						<div class="entry-summary">
						<?php parabola_set_featured_thumb(); ?>
						<?php the_excerpt(); ?>
						</div><!-- .entry-summary -->
						<?php } else { ?>
						<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'parabola' ) . '</span>', 'after' => '</div>' ) ); ?>
						</div><!-- .entry-content --> 
						<?php }   ?>
			
		<?php else : 
				if ( is_sticky() && ($parabolas['parabola_excerptsticky'] == "Full Post") )  $sticky_test=1; else $sticky_test=0;
				if ( ($parabolas['parabola_excerpthome'] != "Full Post") && ($sticky_test==0) ){ ?>
					
					
						<div class="entry-summary">
						<?php parabola_set_featured_thumb(); ?>
						<?php the_excerpt(); ?>
						</div><!-- .entry-summary --> 
						<?php } else { ?>
						<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'parabola' ) . '</span>', 'after' => '</div>' ) ); ?>
						</div><!-- .entry-content --> 
						<?php }  

			endif; 
		 cryout_post_after_content_hook();  ?>

	</article><!-- #post-<?php the_ID(); ?> -->
	
	
<?php cryout_after_article_hook(); ?>