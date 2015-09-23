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
						bersih();
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
		var img;
		if (file != '') {
			img = 	'<a href="" class="thumbnail thumb-img" style="margin-bottom:0px !important; border-radius:0 !important" data-src="'+file+'" data-toggle="modal" data-target="#myModal">'+
						'<img style="width:100%" src="vendor/dist/file/syah_'+file+'">'+
					'</a>'+
					'<a href="" data-src="'+file+'" data-toggle="modal" data-target="#myModal" class="thumb-img btn bg-teal btn-flat" style="width:50%"><i class="fa fa-image"></i> &nbsp Lihat</a>'+
					'<a href="" class="btn bg-maroon btn-flat rm-img" style="width:50%"><i class="fa fa-times"></i> &nbsp Hapus</a>'+
					'<hr>';
		} else{
			img = 'No File';
		};
		var id = $(this).data('id');

		$('.sub-btn').html('Update');
		$('.rm-btn').html('<button type="button" class="btn btn-dafault bersih"><i class="fa fa-times"></i></button>');

		$('.ac-kredit').val('up');
		$('.id-kredit').val(id);
		$('.date').val(date);
		$('#inputJenis').val(meta);
		$('.name').val(name);
		$('.file-kredit').val(file);
		$('.img').html(img);
		$('.memo').val(memo);
		$('.kredit').val(kredit);
		$('.old-kredit').val(kredit);
	});

	$('.form-kredit').on('click', '.thumb-img', function(event) {
		event.preventDefault();
		var img = $('.form-kredit .thumbnail').data('src');
		$('.modal-body').html('<div class="thumbnail"><img src="vendor/dist/file/'+img+'"></div>');
		$('.ok-modal').css('display', 'none');
		$('.modal-title').html(img);
	});

	$('.form-kredit').on('click', '.rm-img', function(event) {
		event.preventDefault();
		$('.file-stat').val('0');
		$('.img').html('')
	});

	$('.rm-btn').on('click', '.bersih', function(event) {
		event.preventDefault();

		bersih();
	});

	$('.list-kredit').on('click', '.delete-row', function(event) {
		event.preventDefault();
		$('.ok-modal').css('display', 'inline-block');

		var no 		= $(this).data('no');
		var date 	= $(this).data('date');
		var jenis 	= $(this).data('jenis');
		var name 	= $(this).data('name');
		var kredit 	= $(this).data('kredit');
		var memo 	= $(this).data('memo');
		var file 	= $(this).data('file');
		var id 		= $(this).data('id');
		var img;
		if (file != '') {
			img = '<div class="thumbnail"><img src="vendor/dist/file/'+file+'" alt=""></div>';
		} else{
			img = '<div class="text-center" style="color:silver"><h3>No File</h3></div>';
		};

		bersih();

		$('.modal-title').html('Anda yakin akan menghapus data berikut !!!');

		$('.modal-body').html(''+
			'<table class="table table-hover">'+
				'<thead>'+
					'<tr>'+
						'<th>No</th>'+
						'<th>Tanggal</th>'+
						'<th>Jenis Pengeluaran</th>'+
						'<th>Item Pengeluaran Dana</th>'+
						'<th>Jumlah Pengeluaran</th>'+
						'<th>Memo</th>'+
					'</tr>'+
				'</thead>'+
				'<tr>'+
					'<td>'+no+'</td>'+
					'<td>'+date+'</td>'+
					'<td>'+jenis+'</td>'+
					'<td>'+name+'</td>'+
					'<td>Rp.'+kredit+'</td>'+
					'<td>'+memo+'</td>'+
				'</tr>'+
			'</table>'+img+
		'');

		$('.ok-modal').click(function(event) {
			event.preventDefault();
			var dtable = $(".list-kredit").DataTable();
			$.ajax({
				url: engine,
				type: 'post',
				dataType: 'json',
				data: {kredit: kredit, id: id, file: file, ac: 'del'},
				success: function (json) {
					if (json.stat) {
						$('#myModal').modal('hide');
						dtable.draw();
						bersih();
						total ('.total-kredit', engine);
					};
				}
			})
			.done(function() {
				console.log("success");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
		});
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
	$('.file-stat').val('1');
	$('.file-kredit').val('');
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
	$('.img').html('');
	$('.sub-btn').html('Submit');
}