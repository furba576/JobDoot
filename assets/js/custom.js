$(document).ready(function(){
	"use strict";

	if( $('#sidebar_filter').length > 0 ){

		$('#jl-filter-icon').click(function(){

			$('#sidebar_filter').css('transform','translateY(0)');
			$('body').css('overflow','hidden');

		});

		$('#sidebar_close').click( function(){
			$('#sidebar_filter').css('transform','translateY(100%)');
			$('body').css('overflow','scroll');
		});

	}

	
	// profile picture cropper
	if( $('.onjob-profile-pic').length > 0 ){

		profile_pic_upload();
	}


});


function profile_pic_upload() {
	var $uploadCrop;

	function readFile(input) {
			if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
				// $('.onjob-profile-pic').addClass('ready');
            	$uploadCrop.croppie('bind', {
            		url: e.target.result
            	}).then(function(){
            		console.log('jQuery bind complete');
            	});
            	
            }
            
            reader.readAsDataURL(input.files[0]);
        }
        else {
	        // alert("Sorry - you're browser doesn't support the FileReader API");
	    }
	}

	$uploadCrop = $('.onjob-profile-pic').croppie({
		viewport: {
			width: 250,
			height: 250
		},
		enableExif: true
	});

	$('#pro_pic_input').on('change', function () { 
		readFile(this); 
	});
	$('#upload_res').on('click', function (ev) {
		$uploadCrop.croppie('result', {
			type: 'canvas',
			size: 'viewport'
		}).then(function (resp) {
			
			$.ajax(
		        {
		            type:"post",
		            url: base_url()+"Profile/update_profile_image",
		            data:{ img:resp },
		            success:function(response)
		            {
		                console.log(response);
		                $('.jd_profile_pic').attr('src', response);
		                location.reload();
		            },
		            error: function() 
		            {
		                alert("Error Occured during image upload!");
		            }
		        }
		    );


		});
	});
}