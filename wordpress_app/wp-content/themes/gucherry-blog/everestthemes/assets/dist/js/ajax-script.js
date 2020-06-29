jQuery(function($){

	/*
	 * Load More
	 */
	$('body').on('click', '#gucherry_blog_loadmore', function(){

		$.ajax({
			url : gucherry_blog_obj.ajaxurl, // AJAX handler
			data : {
				'action': 'loadmore', // the parameter for admin-ajax.php
				'query': gucherry_blog_obj.posts, // loop parameters passed by wp_localize_script()
				'page' : gucherry_blog_obj.current_page, // current page
				'first_page' : gucherry_blog_obj.first_page
			},
			type : 'POST',
			beforeSend : function ( xhr ) {
				$('#gucherry_blog_loadmore').html('<span>Loading</span><i class="fa fa-refresh fa-spin"></i>'); // some type of preloader
			},
			success : function( data ){

					$('#gucherry_blog_loadmore').remove();
					$('#gucherry_blog_pagination').before(data).remove();
					gucherry_blog_obj.current_page++;


			}
		});
		return false;
	});

});
