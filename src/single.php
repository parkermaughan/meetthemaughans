<?php get_header(); ?>
	<main role="main">
	<!-- section -->
		<section>
			<h1>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			</h1>
			<span class="date">
				<time datetime="<?php the_time('Y-m-d'); ?> <?php the_time('H:i'); ?>">
					<?php the_date(); ?> <?php the_time(); ?>
				</time>
			</span>
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
	
<?php the_content(); // Dynamic Content ?>

			<?php get_footer(); ?>

			<p><?php _e( 'Categorised in: ', 'html5blank' ); the_category(', '); // Separated by commas ?></p>

			

		</article>
		<!-- /article -->



		<!-- article -->
		</section>
	<!-- /section -->
	</main>



