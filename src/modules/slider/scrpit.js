jQuery(document).ready(function($) {
	var meta_image_frame;
	$('#product_meta').on('click','.meta-image-button',function(e) {
		e.preventDefault();
		img = $(e.target) || '';
		if (meta_image_frame) {
			meta_image_frame.open();
			return;
		}
		meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
			title: meta_image.title,
			button: {
				text: meta_image.button
			},
			library: {
				type: 'image'
			}
		});
		meta_image_frame.on('select', function() {
			var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
			img.prev().val(media_attachment.url);
		});
		meta_image_frame.open();
		
	});
	
	
	
	
	
	$('#product_meta').on('click','a.add-item',function(e){
		e.preventDefault();
		var $j = $(this).closest('.section').prev('.section').find('input[name="var-counter"]').val() || 1;
		var $i = +$('input[name="counter"]').last().val();
		    $i = $i + 1;
		var html = '<div class="section"><h4>Buy Option <span class="counter">'+ $i + '</span></h4><div class="col-1-2"><p><label>Title</label><input type="text" name="title-'+ $i + '" value=""></p><p><label>Price</label><input type="number" step="any" name="price-'+ $i + '" value=""></p><p><label>Quantity</label><input type="number" step="any" name="quantity-'+ $i + '" value=""></p><p><label>Shipping</label><input type="text" name="shipping-'+ $i + '" value=""></p><p><label>Bonus</label><input type="text" name="bonus-'+ $i + '" value=""></p><p><a href="#" class="add-variation-'+ $i + '">Add Variation</a>&nbsp;|&nbsp;<a href="#" class="remove-item-'+ $i + '">Remove Item</a></p></div><!--/col-1-2--><div class="col-2-2"><div class="var-section"><p><strong>Variation <span class="var-counter">'+ $j + '</span> | <a href="#" class="remove-variation-p'+$i+'-v'+$j+'">Remove Variation</a></strong></p><p><label>Flavor</label><input type="text" name="var-flavor-p'+ $i + '-v'+ $j + '" value=""></p><p><label>Item ID</label><input type="text" name="var-itemID-p'+ $i + '-v'+ $j + '" value=""></p><p><label for="meta-image" class="product-row-title">Image</label><input type="text" name="var-image-p'+ $i + '-v'+ $j + '" value=""><button class="meta-image-button button"></button></p><hr><input type="hidden" name="var-counter" value="'+ $j + '"></div><!--/var section--></div><!--/col-2-2--><input type="hidden" name="counter" value="'+ $i + '"></div>';
		
		$(this).closest('.section').before(html);
		return false;
	});
	
	$('#product_meta').on('click','[class^=remove-item-]',function(e){
		e.preventDefault();
		var itemCountVal = $('input[name=itemCount]').val();
		itemCountVal = parseInt(itemCountVal);
		('input[name=itemCount]').val(itemCountVal-1);
		
		var num = $(this).attr('class').match(/\d+/);
		num = parseInt(num);
				
		$(this).closest('.section').find('p > input').each(function() {
			$(this).attr('name','');
			$(this).attr('value','');
			$(this).closest('.section').fadeOut();

		});
		
		$(this).closest('.section').find('p > label').each(function() {
			$(this).attr('for','');
		});
		
		
		$
			});
	
	$('#product_meta').on('click','[class^=add-variation-]',function(e){
		e.preventDefault();
		
		$i = +$(this).closest('.section').find('.counter').text();
		$j = +$(this).closest('.section').find('.var-counter').last().text();
		$j = $j + 1;

		var html = '<div class="var-section"><p><strong>Variation <span class="var-counter">'+$j+'</span> | <a href="#" class="remove-variation-p'+$i+'-v'+$j+'">Remove Variation</a></strong></p><p><label>Flavor</label><input type="text" name="var-flavor-p' + $i + '-' + 'v' + $j + '" value=""></p><p><label>Item ID</label><input type="text" name="var-itemID-p' + $i + '-' + 'v' + $j + '" value=""></p><p><label for="meta-image" class="product-row-title">Image</label><input type="text" name="var-image-p' + $i + '-' + 'v' + $j + '" value=""><button class="meta-image-button button"></button></p><hr><input type="hidden" name="var-counter" value="'+$j+'"></div><!--/var section-->';
		$(this).closest('.section').find('.col-2-2').append(html);
		return false;
	});
	
	$('#product_meta').on('click','[class^=remove-variation-]',function(e){
		e.preventDefault();
		$(this).closest('.var-section').fadeOut(function(){
			$(this).remove();
		});
	});

	
	
});