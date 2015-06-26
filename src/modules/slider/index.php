<?php

/*=============================================
=          Create Product Post Type           =
=============================================*/



/*-----  End of Section comment block  ------*/


/*=============================================
=           Create Custom Fields              =
=============================================*/

function product_custom_meta() {
	add_meta_box( 'product_meta', __( 'Product Options'), 'product_meta_callback', 'products' , 'normal', 'high');
}
add_action( 'add_meta_boxes', 'product_custom_meta' );

function underscore($string){
	$content = preg_replace('/\s+/', '_', $string);
	return strtolower($content);
}

function product_meta_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'product_nonce' );
	$cf_value = get_post_meta( $post->ID );

	$content  = '<div id="product_meta">';
	$content .= '<div class="grid">';
	$content .= '<h4>General Slide Information</h4>';

	
	

	
	$content .= '</div><!--/grid-->';

	$content .= '<div class="grid">';
	$i=1;
	while (((get_post_meta( $post->ID, 'title' . '_' . $i, true)) != '')||$i==1) {		
		
		$content .= '<div class="col-1-3">';
		$content .= '<h4>Slide Option ' . $i . '</h4>';

		$cf_name = 'title';
		$content .= '<p>';
		$content .= '<label>'.$cf_name.'</label>';
		$cf_name  = underscore($cf_name . '_' . $i);
		$content .= '<input type="text" step="any"' . 'name="'.$cf_name.'"' . 'value="';
		$content .= (isset( $cf_value[$cf_name]) ? $cf_value[$cf_name][0] : '') . '"/>';
		$content .= '</p>';

		$cf_name = 'description';
		$content .= '<p>';
		$content .= '<label>'.$cf_name.'</label>';
		$cf_name  = underscore($cf_name . '_' . $i);
		$content .= '<input type="text" step="any"' . 'name="'.$cf_name.'"' . 'value="';
		$content .= (isset( $cf_value[$cf_name]) ? $cf_value[$cf_name][0] : '') . '"/>';
		$content .= '</p>';

	
		$cf_name = 'slide image';		
		$content .= '<p>';
		$content .= '<label>'.$cf_name.'</label>';
		$cf_name  = underscore($cf_name . '_' . $i);
		$content .= '<input type="text" step="any"' . 'name="'.$cf_name.'"' . 'value="';
		$content .= (isset( $cf_value[$cf_name]) ? $cf_value[$cf_name][0] : '') . '"/>';
		$content .= '<button class="image-button"></button>';
		$content .= '</p>';
		

	
		$content .= '<p><a href="#" class="delete_buy_option">Delete Buy Option</a></p>';
		$content .= '</div><!-- /col-1-3 -->';
		$i++;
	}
	$content .= '</div><!-- /grid -->';	

	echo  $content;

	echo '<input type="hidden" name="counter" value="'.($i-1).'" />';
	echo '<input type="hidden" name="counterDel" value="'.($i).'" />';

	echo '<div class="grid last"><p><a href="#" class="add_buy_option">Add Buy Option</a></p></div>';

	echo '</div><!--/product_meta -->';

}

function product_meta_save( $post_id ) {
	// Run of the mill checks
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST[ 'product_nonce' ] ) && wp_verify_nonce( $_POST[ 'product_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

	// Exits script depending on save status
	if ( $is_autosave || $is_revision || !$is_valid_nonce ) { return; }

	// Checks for input and sanitizes/saves if needed
	$cf_value = get_post_meta( $post->ID );

	if( isset( $_POST[ 'retail_price' . $i ] ) ) {
		update_post_meta( $post_id, 'retail_price' . $i, sanitize_text_field( $_POST[ 'retail_price' . $i ] ) );
	}

	if( isset( $_POST[ 'in_stock' ] ) ) {
    	update_post_meta( $post_id, 'in_stock', 'yes' );
	} else {
    	update_post_meta( $post_id, 'in_stock', 'no' );
	}

	if( isset( $_POST[ 'official_site' ] ) ) {
    	update_post_meta( $post_id, 'official_site', 'yes' );
	} else {
    	update_post_meta( $post_id, 'official_site', 'no' );
	}

	update_post_meta( $post_id, 'itemCount', sanitize_text_field( $_POST[ 'itemCount'] ) );

	$i = 1;
	while(isset($_POST['title'. '_' .$i])) {

		if( isset( $_POST[ 'description' . '_' . $i ] ) ) {
			update_post_meta( $post_id, 'description' . '_' . $i, sanitize_text_field( $_POST[ 'description' . '_' . $i ] ) );
		}

		if( isset( $_POST[ 'title' . '_' . $i ] ) ) {
			update_post_meta( $post_id, 'title' . '_' . $i, sanitize_text_field( $_POST[ 'title' . '_' . $i ] ) );
		}

		if( isset( $_POST[ 'bonus' . '_' . $i ] ) ) {
			update_post_meta( $post_id, 'bonus' . '_' . $i, sanitize_text_field( $_POST[ 'bonus' . '_' . $i ] ) );
		}

		if( isset( $_POST[ 'ultracart_item_id' . '_' . $i ] ) ) {
			update_post_meta( $post_id, 'ultracart_item_id' . '_' . $i, sanitize_text_field( $_POST[ 'ultracart_item_id' . '_' . $i ] ) );
		}

		if( isset( $_POST[ 'slide_image' . '_' . $i ] ) ) {
			update_post_meta( $post_id, 'slide_image' . '_' . $i, sanitize_text_field( $_POST[ 'slide_image' . '_' . $i ] ) );
		}

		if( isset( $_POST[ 'free_shipping' . '_' . $i ] ) ) {
    		update_post_meta( $post_id, 'free_shipping' . '_' . $i, 'yes' );
		} else {
    		update_post_meta( $post_id, 'free_shipping' . '_' . $i, 'no' );
		}

		$i++;
	}

	while($i<=intval($_POST['counterDel'])) {
		delete_post_meta($post_id, 'description' . '_' . $i);
		delete_post_meta($post_id, 'our_price' . '_' . $i);
		delete_post_meta($post_id, 'bonus' . '_' . $i);
		delete_post_meta($post_id, 'ultra_cart_item_id' . '_' . $i);
		delete_post_meta($post_id, 'slide_image' . '_' . $i);
		delete_post_meta($post_id, 'free_shipping' . '_' . $i);
		$i++;
	}
}
add_action( 'save_post', 'product_meta_save' );

/*-----  End Custom Fields  ------*/


/*====================================
=            Load Scripts            =
====================================*/

function product_custom_fields_styles(){
	wp_register_style( 'product-integration', get_template_directory_uri() . '/modules/slider/style.css', array(), '', 'all' );
	wp_enqueue_style( 'product-integration' );
}
add_action( 'admin_enqueue_scripts', 'product_custom_fields_styles' );

//enqueue script for module and image loader
function product_image_enqueue() {
	global $typenow;
	if( $typenow == 'products' ) {
		wp_enqueue_media();

		wp_register_script( 'meta-box-image', get_template_directory_uri() . '/modules/slider/scrpit.js', array( 'jquery' ) );
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


/*-----  End of Load Scripts  ------*/