jQuery(document).ready(function(e){
	jQuery('#product-ajax-form').addClass('product-ajax-form'); //backward compatability
	jQuery(document).on('submit', '.product-ajax-form', function(e){
		e.preventDefault();
		var ajax_save_form = jQuery(this);
		var formaction = ajax_save_form.attr('action');
		jQuery('.successformdiv').html('');
		jQuery('.errormessageformdiv').html('');
		jQuery.ajax({
			enctype: 'multipart/form-data',
			url: formaction,
			data: new FormData(this),
			method:'post',
			dataType: 'json', 
			processData: false,
			contentType: false,
			cache: false,
			timeout: 600000,
			beforeSend: function() {
				jQuery('#_no_data').html('<span style="color:#ff0000;">Please wait while form is submitting... <img src="https://grad.hitbullseye.com/grad-scholarship/images/loading.gif"><span>');
						
			},
			success : function(response) {
				if(response.status) {
					jQuery('#_with_data').html(response.message);
					if(response.redirect_url)
						window.location.href=response.redirect_url;
					
						
				} else {
					jQuery('#_no_data').html(response.message);
				}
			}
		});
	});
	
});
	
