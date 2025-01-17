<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Cryout Creations
 * @subpackage parabola
 * @since parabola 0.5
 */

get_header();?>

		<section id="container" class="<?php echo parabola_get_layout_class(); ?>">
			<div id="content" role="main">
			<?php cryout_before_content_hook(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php cryout_post_title_hook(); ?>
					<div class="entry-meta">
						<?php parabola_meta_before(); cryout_post_meta_hook(); ?>
					</div><!-- .entry-meta -->

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'parabola' ), 'after' => '</span></div>' ) ); ?>
					</div><!-- .entry-content -->

<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
					<div id="entry-author-info">
						<div id="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'parabola_author_bio_avatar_size', 60 ) ); ?>
						</div><!-- #author-avatar -->
						<div id="author-description">
							<h4><?php printf( esc_attr__( 'About %s', 'parabola' ), esc_attr( get_the_author() ) ); ?></h4>
							<?php the_author_meta( 'description' ); ?>
							<div id="author-link">
								<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
									<?php printf( __( 'View all posts by ','parabola').'%s <span class="meta-nav">&rarr;</span>', esc_attr( get_the_author() ) ); ?>
								</a>
							</div><!-- #author-link	-->
						</div><!-- #author-description -->
					</div><!-- #entry-author-info -->
<?php endif; ?>

					<div class="entry-utility">
						<?php parabola_posted_in(); ?>
						<?php edit_post_link( __( 'Edit', 'parabola' ), '<span class="edit-link">', '</span>' ); cryout_post_footer_hook(); ?>
					</div><!-- .entry-utility -->
				</div><!-- #post-## -->

				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">&laquo;</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">&raquo;</span>' ); ?></div>
				</div><!-- #nav-below -->

				<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>

			<?php cryout_after_content_hook(); ?>
			</div><!-- #content -->
	<?php parabola_get_sidebar(); ?>
		</section><!-- #container -->

<?php get_footer(); ?>
