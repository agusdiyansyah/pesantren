$(document).ready(function() {

	total ('.total-debit', engine);

	$("#form_cari").submit(function(e) {
		e.preventDefault();

		var dtable = $(".list-debit").DataTable();
		dtable.draw();
	});

	$(".list-debit").DataTable({
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

	$('.form-debit').validate({
		ignore: [],
		errorClass: "error",
		rules:{
			name:{
				required:true
			},
			date:{
				required:true
			},
			time:{
				required:true
			},
			debit:{
				required:true,
				number: true
			}
		},
		messages:{
			name:{
				required: 'Item temasukkan dana tidak boleh kosong'
			},
			date:{
				required: 'Tanggal tidak boleh kosong'
			},
			time:{
				required: 'Waktu tidak boleh kosong'
			},
			debit:{
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
			var dtable = $(".list-debit").DataTable();
			$.ajax({
				url: engine,
				type: 'post',
				dataType: 'json',
				cache: false,
				data: $('.form-debit').serialize(),
				beforeSend: function () {
					$('.sub-btn').prop('disable', true);
				},
				success: function (json) {
					if (json.stat) {
						// window.location.href ="./pemasukan";
						dtable.draw();
						bersih();
						total ('.total-debit', engine);
						// $('.sub-btn').prop('disable', false);
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
		}
	});

	$('.list-debit').on('click', '.edit-debit', function(event) {
		event.preventDefault();

		var date = $(this).data('date');
		var time = $(this).data('time');
		var name = $(this).data('name');
		var debit = $(this).data('debit');
		var memo = $(this).data('memo');
		var id = $(this).data('id');

		$('.sub-btn').html('Update');
		$('.rm-btn').html('<button type="button" class="btn btn-dafault bersih"><i class="fa fa-times"></i></button>');

		$('.ac-debit').val('up');
		$('.id-debit').val(id);
		$('.date').val(date);
		$('.time').val(time);
		$('.name').val(name);
		$('.memo').val(memo);
		$('.debit').val(debit);
		$('.old-debit').val(debit);
	});

	$('.list-debit').on('click', '.delete-row', function(event) {
		event.preventDefault();

		var date = $(this).data('date');
		var name = $(this).data('name');
		var debit = $(this).data('debit');
		var memo = $(this).data('memo');
		var id = $(this).data('id');
		var no = $(this).data('not');

		$('.modal-body').load(module+'debit/modal.php', function () {

			$('.modal-title').html('Anda yakin akan menghapus data berikut !!!');

			$('.tabel-modal tbody').html(''+
				'<tr>'+
					'<td>'+no+'</td>'+
					'<td>'+date+'</td>'+
					'<td>'+name+'</td>'+
					'<td>'+debit+'</td>'+
					'<td>'+memo+'</td>'+
				'</tr>'
			+'');

			$('.ok-modal').click(function(event) {
				event.preventDefault();
				var dtable = $(".list-debit").DataTable();
				$.ajax({
					url: engine,
					type: 'post',
					dataType: 'json',
					data: {debit: debit, id: id, ac: 'del'},
					success: function (json) {
						if (json.stat) {
							$('#myModal').modal('hide');
							dtable.draw();
							bersih();
							total ('.total-debit', engine);
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
	});


	$('.rm-btn').on('click', '.bersih', function(event) {
		event.preventDefault();

		bersih();
	});


	$('.date').datetimepicker({pickTime:false});

});

function bersih () {
	$('.ac-debit').val('add');
	$('.id-debit').val('');

	$('.date').val('');
	$('.time').val('');
	$('.name').val('');
	$('.memo').val('');
	$('.debit').val('');
	$('.old-debit').val('');

	$('.bersih').remove();
	$('.sub-btn').html('Submit');
}