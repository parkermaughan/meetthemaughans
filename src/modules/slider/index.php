<?php

function product_custom_meta() {
	add_meta_box( 'product_meta', __( 'Product Buy Options', 'post-textdomain' ), 'post_meta_callback', 'post' );
}
add_action( 'add_meta_boxes', 'post_custom_meta' );



//Outputs the content of the meta box
function product_meta_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'product_nonce' );
	$product_stored_meta = get_post_meta( $post->ID );

	$content  = '<div id="product_meta">';
	$content .= '<h4>General Product Information</h4>';
	$content .= '<p>';
	$content .= '<label>Retail</label>';
	$content .= '<input type="number" step="any"' . 'name="retail"' . 'value="';
	$content .= (isset( $product_stored_meta['retail']) ? $product_stored_meta['retail'][0] : '') . '"';
	$content .= '/></p>';
	
	$content .= '<p>';
	$content .= '<label>Servings</label>';
	$content .= '<input type="number" step="any"' . 'name="servings"' . 'value="';
	$content .= (isset( $product_stored_meta['servings']) ? $product_stored_meta['servings'][0] : '') . '"';
	$content .= '/></p>';
	
	$content .= '<p>';
	$content .= '<label>Category Tagline</label>';
	$content .= '<input type="text" step="any"' . 'name="cat-tag"' . 'value="';
	$content .= (isset( $product_stored_meta['cat-tag']) ? $product_stored_meta['cat-tag'][0] : '') . '"';
	$content .= '/></p>';
	
	$content .= '<p>';
	$content .= '<label>Supplement Facts</label>';
	$content .= '<input type="text" step="any"' . 'name="supplement-facts"' . 'value="';
	$content .= (isset( $product_stored_meta['supplement-facts']) ? $product_stored_meta['supplement-facts'][0] : '') . '"';
	$content .= '/>';
	$content .= '<button class="meta-image-button button"></button>';
	$content .= '</p>';
	
	echo $content;


	$i = 1;
	$content = '';
	while (((get_post_meta($post->ID, 'price-'.$i, true)) != '')||$i==1) {
		$content = '<div class="section">';
		$content .= '<h4>Buy Option ';
		$content .= '<span class="counter">' . $i . '</span>';
		$content .= '</h4>';

		$content .= '<div class="col-1-2">';

		$content .= '<p>';
		$content .= '<label>Title</label>';
		$content .= '<input type="text"' . 'name="title-' . $i . '"' . 'value="';
		$content .= (isset( $product_stored_meta['title-' . $i]) ? $product_stored_meta['title-' . $i][0] : '') . '"';
		$content .= '/></p>';

		$content .= '<p>';
		$content .= '<label>Price</label>';
		$content .= '<input type="number" step="any"' . 'name="price-' . $i . '"' . 'value="';
		$content .= (isset( $product_stored_meta['price-' . $i]) ? $product_stored_meta['price-' . $i][0] : '') . '"';
		$content .= '/></p>';

		$content .= '<p>';
		$content .= '<label>Quantity</label>';
		$content .= '<input type="number" step="any"' . 'name="quantity-' . $i . '"' . 'value="';
		$content .= (isset( $product_stored_meta['quantity-' . $i]) ? $product_stored_meta['quantity-' . $i][0] : '') . '"';
		$content .= '/></p>';
		
		/*$freeShip = get_post_meta($post->ID, 'free-shipping'.$i, true);
		$content .= '<p>';
		$content .= '<label>Free Shipping?</label>';
		$content .= '<input style="width:0px;" type="checkbox" name="free-shipping'.$i.'"';
			if($freeShip=='yes') echo ' checked="checked"';
		$content .= '</p>';*/
		
		$content .= '<p>';
		$content .= '<label>Shipping</label>';
		$content .= '<input type="text"' . 'name="shipping-' . $i . '"' . 'value="';
		$content .= (isset( $product_stored_meta['shipping-' . $i]) ? $product_stored_meta['shipping-' . $i][0] : '') . '"';
		$content .= '/></p>';

		$content .= '<p>';
		$content .= '<label>Bonus</label>';
		$content .= '<input type="text"' . 'name="bonus-' . $i . '"' . 'value="';
		$content .= (isset( $product_stored_meta['bonus-' . $i]) ? $product_stored_meta['bonus-' . $i][0] : '') . '"';
		$content .= '/></p>';
		
		

		$content .= '<p><a href="#" class="add-variation-'.$i.'">Add Variation</a>&nbsp;|&nbsp;<a href="#" class="remove-item-'.$i.'">Remove Item</a></p>';
		$content .= '</div><!--/col-1-2-->';
		$content .= '<div class="col-2-2">';
		$j = 1;
		$variation ='';
		while ($product_stored_meta['var-flavor-p' . $i . '-v' . $j] != '' || $j==1){
			$variation .= '<div class="var-section">';
			$variation .= '<p><strong>Variation <span class="var-counter">'.$j.'</span> | <a href="#" class="remove-variation-p'.$i.'-v'.$j.'">Remove Variation</a></strong></p>';
			$variation .= '<p>';
			$variation .= '<label>Flavor</label>';
			$variation .= '<input type="text"' . 'name="var-flavor-p' . $i . '-v' . $j . '"' . 'value="';
			$variation .= (isset( $product_stored_meta['var-flavor-p' . $i . '-v' . $j]) ? $product_stored_meta['var-flavor-p' . $i . '-v' . $j][0] : '') . '"';
			$variation .= '/></p>';
			$variation .= '<p>';
			$variation .= '<label>Item ID</label>';
			$variation .= '<input type="text"' . 'name="var-itemID-p' . $i . '-v' . $j . '"' . 'value="';
			$variation .= (isset( $product_stored_meta['var-itemID-p' . $i . '-v' . $j]) ? $product_stored_meta['var-itemID-p' . $i . '-v' . $j][0] : '') . '"';
			$variation .= '/></p>';
			$variation .= '<p>';
			$variation .= '<label for="meta-image" class="product-row-title">Image</label>';
			$variation .= '<input type="text"' . 'name="var-image-p' . $i . '-v' . $j . '"' . 'value="';
			$variation .= (isset( $product_stored_meta['var-image-p' . $i . '-v' . $j]) ? $product_stored_meta['var-image-p' . $i . '-v' . $j][0] : '') . '"/>';
			$variation .= '<button class="meta-image-button button"></button>';
			$variation .= '</p>';
			$variation .= '<hr>';
			$variation .= '</div><!--/var section-->';
			$j++;

		}
		$variation .= '<input type="hidden" name="var-counter-'.$i.'" value="'.($j-1).'" />';
		$content .= $variation . '</div><!--/col-2-2-->';
		$content .= '</div><!--/section-->';
		$i++;
		echo $content;
	}
	echo '<input type="hidden" name="counter" value="'.($i-1).'" />';
	echo '<input type="hidden" ' . 'name="itemCount"' . 'value="' . ($i-1) . '"' . '/>';
	echo '<div class="section"><p><a href="#" class="add-item">Add Item +</a></p></div>';
	echo  '</div><!--/product-meta-->';

}
//saves the custom meta input
function product_meta_save( $post_id ) {
	// Checks save status
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST[ 'product_nonce' ] ) && wp_verify_nonce( $_POST[ 'product_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

	// Exits script depending on save status
	if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
		return;
	}

	// Checks for input and sanitizes/saves if needed

	$product_stored_meta = get_post_meta( $post->ID );

	if( isset( $_POST[ 'retail' . $i ] ) ) {
		update_post_meta( $post_id, 'retail' . $i, sanitize_text_field( $_POST[ 'retail' . $i ] ) );
	}
	if( isset( $_POST[ 'servings' . $i ] ) ) {
		update_post_meta( $post_id, 'servings' . $i, sanitize_text_field( $_POST[ 'servings' . $i ] ) );
	}
	if( isset( $_POST[ 'cat-tag' . $i ] ) ) {
		update_post_meta( $post_id, 'cat-tag' . $i, sanitize_text_field( $_POST[ 'cat-tag' . $i ] ) );
	}
	if( isset( $_POST[ 'supplement-facts' . $i ] ) ) {
		update_post_meta( $post_id, 'supplement-facts' . $i, sanitize_text_field( $_POST[ 'supplement-facts' . $i ] ) );
	}
	update_post_meta( $post_id, 'itemCount', sanitize_text_field( $_POST[ 'itemCount'] ) );

	$i = 1;
	while(isset($_POST["price-".$i])) {

		if( isset( $_POST[ 'title-' . $i ] ) ) {
			update_post_meta( $post_id, 'title-' . $i, sanitize_text_field( $_POST[ 'title-' . $i ] ) );
		}
		if( isset( $_POST[ 'price-' . $i ] ) ) {
			update_post_meta( $post_id, 'price-' . $i, sanitize_text_field( $_POST[ 'price-' . $i ] ) );
		}
		if( isset( $_POST[ 'quantity-' . $i ] ) ) {
			update_post_meta( $post_id, 'quantity-' . $i, sanitize_text_field( $_POST[ 'quantity-' . $i ] ) );
		}
		if( isset( $_POST[ 'shipping-' . $i ] ) ) {
			update_post_meta( $post_id, 'shipping-' . $i, sanitize_text_field( $_POST[ 'shipping-' . $i ] ) );
		}
		if( isset( $_POST[ 'bonus-' . $i ] ) ) {
			update_post_meta( $post_id, 'bonus-' . $i, sanitize_text_field( $_POST[ 'bonus-' . $i ] ) );
		}
		$j = 1;
		while(isset($_POST['var-flavor-p' . $i . '-v' . $j])) {
			if( isset( $_POST['var-flavor-p' . $i . '-v' . $j] ) ) {
				update_post_meta( $post_id, 'var-flavor-p' . $i . '-v' . $j, sanitize_text_field( $_POST[ 'var-flavor-p' . $i . '-v' . $j ] ) );
			}
			if( isset( $_POST[ 'var-itemID-p' . $i . '-v' . $j ] ) ) {
				update_post_meta( $post_id, 'var-itemID-p' . $i . '-v' . $j, sanitize_text_field( $_POST[ 'var-itemID-p' . $i . '-v' . $j ] ) );
			}
			if( isset( $_POST[ 'var-image-p' . $i . '-v' . $j ] ) ) {
				update_post_meta( $post_id, 'var-image-p' . $i . '-v' . $j , $_POST[ 'var-image-p' . $i . '-v' . $j  ] );
			}
			$j++;
		}
		while($j<=intval($_POST['var-counter-' . $i])) {
			delete_post_meta($post_id, 'var-flavor-p' . $i . '-v' . $j);
			delete_post_meta($post_id, 'var-itemID-p' . $i . '-v' . $j);
			delete_post_meta($post_id, 'var-image-p' . $i . '-v' . $j);
			$j++;
		}
		$i++;
	}



	while($i<=intval($_POST['counter'])) {
		delete_post_meta($post_id, 'title-' . $i);
		delete_post_meta($post_id, 'price-' . $i);
		delete_post_meta($post_id, 'quantity-' . $i);
		delete_post_meta($post_id, 'free-shipping' . $i);
		delete_post_meta($post_id, 'shipping-' . $i);
		delete_post_meta($post_id, 'bonus-' . $i);
		$j = 1;
		while($j<=intval($_POST['var-counter-' . $i])) {
			delete_post_meta($post_id, 'var-flavor-p' . $i . '-v' . $j);
			delete_post_meta($post_id, 'var-itemID-p' . $i . '-v' . $j);
			delete_post_meta($post_id, 'var-image-p' . $i . '-v' . $j);
			$j++;
		}
		$i++;
	}


}
add_action( 'save_post', 'product_meta_save' );



//Load scripts and styles
function product_image_enqueue() {
	global $typenow;
	if( $typenow == 'products' ) {
		wp_enqueue_media();

		wp_register_script( 'meta-box-image', get_template_directory_uri() . '/packages/product-custom-fields/script.js', array( 'jquery' ) );
		wp_localize_script( 'meta-box-image', 'meta_image',
			array(
				'title' => __( 'Choose or Upload an Image', 'product-textdomain' ),
				'button' => __( 'Use this image', 'product-textdomain' ),
			)
		);
		wp_enqueue_script( 'meta-box-image' );
	}
}
add_action( 'admin_enqueue_scripts', 'product_image_enqueue' );


function product_custom_fields_styles(){
	wp_register_style( 'product-custom-fields', get_template_directory_uri() . '/packages/product-custom-fields/style.css', array(), '', 'all' );
	wp_enqueue_style( 'product-custom-fields' );
}
add_action( 'admin_enqueue_scripts', 'product_custom_fields_styles' );
