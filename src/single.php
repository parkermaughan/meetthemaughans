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
 echo '</div>';

}
 echo '</div>';
echo '<div id="slider-direction-nav"></div>';
echo '<div id="slider-control-nav"></div>';
echo '</div>';

	?>
	
	
<?php the_content(); // Dynamic Content ?>

			<?php get_footer(); ?>

			<p><?php _e( 'Categorised in: ', 'html5blank' ); the_category(', '); // Separated by commas ?></p>

			

		</article>
		<!-- /article -->



		<!-- article -->
		</section>
	<!-- /section -->
	</main>


 <script type="text/javascript">
    $(document).ready(function() {
        var slider = $('#slider').leanSlider({
            directionNav: '#slider-direction-nav',
            controlNav: '#slider-control-nav'
        });
    });
    </script>

