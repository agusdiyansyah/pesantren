$(document).ready(function() {
	var type 	= $('.type').val();
	var lap    	= render(date, '.box-body', type);

	$('.sel-type').css('display', 'none');

	$('.load-list').click(function(event) {
		event.preventDefault();
		var type 	= $('.type').val();
		$('.tampil').val('list');
		render(date, '.box-body', type);
	});

	$('.load-img').click(function(event) {
		event.preventDefault();
		$('.tampil').val('img');
		render_img_all(date);
	});

	$('.form-date').submit(function(event) {
		event.preventDefault();
		var tampil 	= $('.tampil').val();
		var type 	= $('.type').val();
		if (tampil == 'list') {
			render($('.date').val(), '.box-body', type);			
		} else if(tampil == 'img'){
			render_img_all($('.date').val());
		};
	});

	$('.date').datetimepicker({
        viewMode: 'years',
        format: 'YYYY-MM',
    });

    $('.btn-print').click(function(event) {
    	event.preventDefault();
    	var data = $('.box-body').html();
    	var url  = 'http://localhost/pesantren/module/engine/laporan/ajax.php?ac=cetak&vendor='+vendor+'&data='+data;
    	var win = window.open(url, '_blank');
		win.focus();
    });

    $('.btn-all').click(function(event) {
    	event.preventDefault();
    	$('.btn-transaksi').removeClass('bg-teal');
		$(this).addClass('bg-teal');
    	$('.type').val('');
    	$('.load-img').css('display', 'inline-block');
    	$('.sel-type').css('display', 'none');
    	render(date, '.box-body');
    });

    $('.btn-debit').click(function(event) {
    	event.preventDefault();
    	$('.btn-transaksi').removeClass('bg-teal');
		$(this).addClass('bg-teal');
    	$('.type').val(1);
    	$('.load-img').css('display', 'none');
    	$('.sel-type').css('display', 'none');
    	render(date, '.box-body', 1);
    });

    $('.btn-kredit').click(function(event) {
    	event.preventDefault();
    	$('.btn-transaksi').removeClass('bg-teal');
		$(this).addClass('bg-teal');
    	render_jenis('.sel-type');
    	$('.type').val(2);
    	$('.load-img').css('display', 'inline-block');
    	$('.sel-type').css('display', 'inline-block');
    	render(date, '.box-body', 2);
    });

    $('.sel-type').change(function(e) {
    	e.preventDefault();
    	var val = $(this).val();
    	alert(val);
    });
});

function render_img_all (tgl, type) {
	$.getJSON(engine, {ac: 'img', src: tgl, type: type}, function(json) {
		var tag = '';
		$.each(json, function(index, data) {
			tag += ''+
					'<img src="'+vendor+'dist/file/'+data+'" >'+
			'';
		});
		$('.box-body').html(tag);
	});
}

function render_jenis (tag) {
	$.getJSON(engine, {ac: 'jenis'}, function(json) {
		var html = '<option value=""></option>';
		$.each(json, function(index, data) {
			html += '<option value="'+data.id+'">'+data.val+'</option>';
		});
		$(tag).html(html);
	});
}