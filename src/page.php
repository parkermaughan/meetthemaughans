<?php get_header(); ?>
<?php if (is_front_page()) include_once "font-page.php";?>
	<main role="main">
		<!-- section -->
		<section>

			<h1><?php the_title(); ?></h1>

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php
  echo '<div class="slider-wrapper">';
  echo '<div id="slider">';

	global $post;
	$post_id= $post->ID;
	$i=1;
	while (((get_post_meta( $post->ID, 'slide_image' . '_' . $i, true)))) {
			$description = get_post_meta( $post_id, 'description' . '_' . $i, true);
			$title = get_post_meta( $post_id, 'title' . '_' . $i, true);
			$image = get_post_meta( $post_id, 'slide_image' . '_' . $i, true);
			$journal = get_post_meta( $post_id, 'journal', true);
	$i++;
  echo '<div class='."slide".$i.'>';
  echo '<h3 class="title">'.$title.'</h3>';
  echo '<p class="discription">'.$description.'</p>';
  echo '<img src='. $image .' class="buyproducts">';
 echo '</div>';//End Of Slide

}
 echo '</div>';//End of slider
echo '<div id="slider-direction-nav"></div>';
echo '<div id="slider-control-nav"></div>';
echo '</div>';//End Of slider-wrapper

	?>

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

