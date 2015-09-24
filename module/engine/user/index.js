$(document).ready(function() {

	$('.form-user').validate({
		ignore: [],
	
		errorClass: "error",
		rules:{
			user:{
				required:true
			},
			pw:{
				required:true
			}
		},
		messages:{
			user:{
				required: 'Username tidak boleh kosong'
			},
			pw:{
				required: 'Password tidak boleh kosong'
			}
		},
		errorPlacement: function (error, element) {
	        //error.appendTo( element.parent("div"));
	        error.insertAfter(element);
	    },
	    highlight: function (element, validClass) {
	        $(element).parent().addClass('has-error');
	    },
	    unhighlight: function (element, validClass) {
	        $(element).parent().removeClass('has-error');
	    },
		submitHandler: function(form) {
			$.ajax({
				url: engine,
				type: 'post',
				dataType: 'json',
				data: $('.form-user').serialize(),
				success: function (json) {
					if (json.stat) {
						window.location.href = domain;
					};
				}
			});
			
		}
	});

});