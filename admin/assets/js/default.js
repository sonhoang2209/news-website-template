(function($){
	if(typeof THEME == "undefined" ){
		THEME = {};
	}
	
	THEME.preview_avatar = function(){
		$('.preview_avatar').find('input[type="file"]').change(function(){ 
            const file = this.files[0]; 
			var allowed = ['image/jpeg', 'image/jpg', 'image/png', 'images/x-png'];
			if( allowed.includes(file.type) ){
				if ( file ){ 
					let reader = new FileReader(); 
					reader.onload = function( event ){ 
						$('.preview_avatar').find('img').attr('src', event.target.result);
					} 
					reader.readAsDataURL(file);
				}
			} else {
				$('input[type="file"]').value = '';
				alert('Your file is not a valid type. Please choose a jpg or png image to upload.');
			}
        }); 
	};// preview_avatar

	THEME.alert_timeout = function( ){
		setTimeout(function(){
			$(".alert").fadeOut(1000);
		}
		,3000);
	};// alert_timeout

	THEME.upload_image = function( ){
		$(".submit-user-info").on( "click", function( e ) {
			//e.preventDefault();
			var fd = new FormData();
			if( $('input[name="input-avatar"]')[0].files[0] ) {
				fd.append( 'file', $('input[name="input-avatar"]')[0].files[0] );
				fd.append( 'id', $('input[name="user_id"]').val() );
				$.ajax({
					url: '../ajax.php',
					data: fd,
					processData: false,
					contentType: false,
					type: 'POST',
					success: function(data){
						console.log(data);
					}
				});
			}
			//$( ".submit-user-info" ).submit();
		});
	};

	THEME.upload_post_image = function( ){
		$(".btn_upd_product").on( "click", function( e ) {
			//e.preventDefault();
			var fd = new FormData();
			if( $('input[name="visual_image"]')[0].files[0] ) {
				fd.append( 'file', $('input[name="visual_image"]')[0].files[0] );
				fd.append( 'id', $('input[name="post_id"]').val() );
				$.ajax({
					url: 'controllers/upd_post_img.php',
					data: fd,
					processData: false,
					contentType: false,
					type: 'POST',
					success: function(data){
						console.log(data);
					}
				});
			}
			//$( ".submit-user-info" ).submit();
		});
	};

	THEME.add_product = function( ){
		$(".btn_add_product").on( "click", function( e ) {
			e.preventDefault();
			var fd = new FormData();
			if(  $('input[name="visual_image"]')[0].files[0] ) {
				fd.append( 'visual_image', $('input[name="visual_image"]')[0].files[0] );
				$.ajax({
					url: 'controllers/ctrl_image.php',
					data: fd,
					processData: false,
					contentType: false,
					type: 'POST',
					success: function(data){
						console.log(data);
					}
				});
			}
			$('.btn_add_product').unbind('submit').submit();
		});
		
	};

	THEME.alert_timeout = function( ){
		setTimeout(function(){
			$(".alert").fadeOut(1000);
		}
		,3000);
	};// alert_timeout

	THEME.DataTable = function( ){
		$('.datatable').DataTable({
			"language": {
				"lengthMenu": 'Display <br>' +
					'<select  style="width: 150px" > ' +
							'<option value="5">5</option>' +
							'<option value="10">10</option>' +
							'<option value="-1">All</option>' +
					'</select>',
				"zeroRecords": "Nothing found",
				"info": "",
				"infoEmpty": "No records available",
				"paginate": {
					"previous": "prev",
					"next": "next"
				}
			}
		});
	};// data table

	THEME.delete_user = function( ){
		$('.delete').on('click', function() {
			var id = $(this).attr('delete_id');
			if( confirm('Sure to delete user?') ) {
				$.ajax({
					url: 'controllers/delete_user.php',
					data: {
						"id"    : id
					},
					type: 'POST',
					success: function(data){
						alert(data);
					}
				});
			}
		});
	};// alert_timeout

	THEME.delete_product = function( ){
		$('.delete_product').on('click', function() {
			var id = $(this).attr('delete_id');
			if( confirm('Sure to delete product?') ) {
				$.ajax({
					url: 'controllers/delete_product.php',
					data: {
						"id"    : id
					},
					type: 'POST',
					success: function(data){
						alert(data);
					}
				});
			}
		});
	};// alert_timeout
	
	THEME.change_password = function( ){
		var inputpass = $('input[type="password"]');
			re_pass = $('input[name="re_password"]');
		re_pass.change( function() {
			console.log(inputpass.val());
		});
	};// alert_timeout

	$(document).ready(function(){
		THEME.preview_avatar();
		THEME.alert_timeout();
		THEME.upload_image();
		THEME.DataTable();

		THEME.upload_post_image();

		THEME.delete_user();
		THEME.delete_product();

		THEME.change_password();
		
		THEME.add_product();
	});
})(jQuery);