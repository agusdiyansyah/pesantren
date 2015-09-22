$(document).ready(function() {

	getJenis();
	total('.total-kredit', engine);

	$(".list-kredit").DataTable({
		"ajax": {
	    	"url": engine,
	    	"method":"POST",
	    	"data": function ( d ) {
                d.cari = $('#q').val();
                // d.filter_user = $('#filteruser').val();
                d.ac="list";
            }
	    },
	    "pageLength": 10,
	    "deferRender": true,
	    "serverSide":true,
	    "processing":true,
		"filter":false,
		"ordering":false,
	});
	
	$('.form-kredit').validate({
		ignore: [],
		errorClass: "error",
		rules:{
			name:{
				required:true
			},
			file:{
				required:true,
				accept: 'image/*'
			},
			date:{
				required:true
			},
			jenis:{
				required:true
			},
			time:{
				required:true
			},
			kredit:{
				required:true,
				number: true
			}
		},
		messages:{
			name:{
				required: 'Item pemasukkan dana tidak boleh kosong'
			},
			file:{
				required: 'file tidak boleh kosong',
				accept: 'file harus berupa gambar'
			},
			date:{
				required: 'Tanggal tidak boleh kosong'
			},
			jenis:{
				required: 'Jenis pengeluaran tidak boleh kosong'
			},
			time:{
				required: 'Waktu tidak boleh kosong'
			},
			kredit:{
				required: 'Jumlah Pemasukkan tidak boleh kosong',
				number: 'Input harus berupa angka'
			}
		},
		errorPlacement: function (error, element) {
	        error.insertAfter(element);
	    },
	    highlight: function (element, validClass) {
	        $(element).parent().addClass('has-error');
	    },
	    unhighlight: function (element, validClass) {
	        $(element).parent().removeClass('has-error');
	    },
		submitHandler: function(form) {
			var dtable = $(".list-kredit").DataTable();
			var formData = new FormData(document.getElementById("form-kredit"));
			$.ajax({
				url: engine,
				type: 'post',
				dataType: 'json',
				cache:false,
				data:formData,
				mimeType:'multipart/form-data',
				contentType: false,
				processData:false,
				data: formData,
				beforeSend: function () {
					$('.sub-btn').prop('disable', true);
				},
				success: function (json) {
					if (json.stat) {
						dtable.draw();
						// bersih();
						total('.total-kredit', engine);
						// $('.sub-btn').prop('disable', false);
					};
				}
			});
			return false;
		}
	});

	$('.list-kredit').on('click', '.edit-kredit', function(event) {
		event.preventDefault();

		var date = $(this).data('date');
		var time = $(this).data('time');
		var name = $(this).data('name');
		var file = $(this).data('file');
		var meta = $(this).data('meta');
		var kredit = $(this).data('kredit');
		var memo = $(this).data('memo');
		var img = '<a href="" class="thumbnail" data-src="'+file+'" data-toggle="modal" data-target="#myModal"><img src="vendor/dist/file/syah_'+file+'"></a>';
		var id = $(this).data('id');

		$('.sub-btn').html('Update');
		$('.rm-btn').html('<button type="button" class="btn btn-dafault bersih"><i class="fa fa-times"></i></button>');

		$('.ac-kredit').val('up');
		$('.id-kredit').val(id);
		$('.date').val(date);
		$('#inputJenis').val(meta);
		$('.name').val(name);
		$('.img').html(img);
		$('.memo').val(memo);
		$('.kredit').val(kredit);
		$('.old-kredit').val(kredit);
	});

	$('.form-kredit').on('click', '.thumbnail', function(event) {
		event.preventDefault();
		var img = $('.thumbnail').data('src');
		$('.modal-body').html('<div class="thumbnail"><img src="vendor/dist/file/'+img+'"></div>');
		$('.ok-modal').remove();
	});

	$('.rm-btn').on('click', '.bersih', function(event) {
		event.preventDefault();

		bersih();
	});



	$('.date').datetimepicker({pickTime:false});

});

function getJenis () {
	$.getJSON(engine, {ac: 'jenis'}, function(json) {
		var html = '<option value=""></option>';
		if (json.stat) {
			$.each(json.item, function(data, val) {
				html += '<option value="'+val.id+'">'+val.value+'</option>';
			});
			$('#inputJenis').html(html);
		};
	});
}

function bersih () {
	$('.ac-kredit').val('add');
	$('.id-kredit').val('');

	$('.date').val('');
	$('#inputJenis').val('');
	$('.file').val('');
	$('.time').val('');
	$('.name').val('');
	$('.memo').val('');
	$('.kredit').val('');
	$('.old-kredit').val('');

	$('.bersih').remove();
	$('.thumbnail').remove();
	$('.sub-btn').html('Submit');
}