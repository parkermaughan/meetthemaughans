<?php
global $post;
$post_id= $post->ID;
$i=1;
echo '<div class="slider-wrapper">';
	echo '<div id="slider">';
	while (get_post_meta($post->ID, "slide_image" . "_" . $i, true) != '') {
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
	echo '<div id="slider-direction-nav">
<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	</div>';
	echo '<div id="slider-control-nav"></div>';
echo '</div>';//End Of slider-wrapper


	?>