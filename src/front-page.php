<?php get_header(); ?>

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

				<ul>
<?php
$args = array( 'posts_per_page' => 5, 'orderby' => 'rand' );
$rand_posts = get_posts( $args );
foreach ( $rand_posts as $post ) : 
  setup_postdata( $post ); ?>
	<li><?php the_title(); ?><a class="hvr-float-shadow" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?><ul class="hoverButton"><li class="magnify"></li><li class="flipPost"></li></ul></a></li>
<?php endforeach; 
wp_reset_postdata(); ?>
</ul>

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
