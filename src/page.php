<?php get_header(); ?>
	<main role="main">
		<?php if (have_posts()): while (have_posts()): the_post();?>
		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php 
			if (strlen(get_post_meta($post->ID, "slide_image_1", true)) > 0) 
			{
				include "modules/banner/slider.php";
			}	
			else{
				include "modules/banner/generic.php";
			}												
			?>
			<div class="wrapper">
			<section>
			<?php the_content(); ?>
			<?php edit_post_link(); ?>
		</article>
		<!-- /article -->
		<?php endwhile; ?>
		<?php else: ?>
		<!-- article -->
		<article>
			<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
		</article>
		<!-- /article -->
		<?php endif; ?>
			</section>
		<!-- /section -->
	</main>
<?php get_footer(); ?>