$(document).ready(function() {
	var type 	= $('.type').val();
	render($('.date').val(), '.box-body', type);

	$('.sel-type').css('display', 'none');

	$('.load-list').click(function(event) {
		event.preventDefault();
		$('.jenis').val('');
		$('.tampil').val('list');
		var type 	= $('.type').val();
		render($('.date').val(), '.box-body', type);
	});

	$('.load-img').click(function(event) {
		event.preventDefault();
		$('.tampil').val('img');
		var jenis = $('.jenis').val();
		render_img_all($('.date').val(), jenis);
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
        format: 'MM-YYYY',
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
    	$('.jenis').val('');
    	$('.btn-transaksi').removeClass('bg-teal');
		$(this).addClass('bg-teal');
    	$('.type').val('');
    	$('.load-img').css('display', 'inline-block');
    	$('.sel-type').css('display', 'none');
    	render($('.date').val(), '.box-body');
    });

    $('.btn-debit').click(function(event) {
    	event.preventDefault();
    	$('.jenis').val('');
    	$('.btn-transaksi').removeClass('bg-teal');
		$(this).addClass('bg-teal');
    	$('.type').val(1);
    	$('.load-img').css('display', 'none');
    	$('.sel-type').css('display', 'none');
    	render($('.date').val(), '.box-body', 1);
    });

    $('.btn-kredit').click(function(event) {
    	event.preventDefault();
    	$('.btn-transaksi').removeClass('bg-teal');
		$(this).addClass('bg-teal');
    	render_jenis('.sel-type');
    	$('.type').val(2);
    	$('.load-img').css('display', 'inline-block');
    	$('.sel-type').css('display', 'inline-block');
    	render($('.date').val(), '.box-body', 2);
    });

    $('.sel-type').change(function(e) {
    	e.preventDefault();
    	var val = $(this).val();
    	$('.jenis').val(val);
    	render ($('.date').val(), '.box-body', 2, val);
    });
});

function render_img_all (tgl, jenis) {
	$.getJSON(engine, {ac: 'img', src: tgl, jenis: jenis}, function(json) {
		var tag = '<ul style="'+
			'list-style-type: none;'+
			'display: -ms-flexbox;'+
	        'display: -webkit-flex;'+
	        'display: flex;'+
	        '-webkit-flex-direction: row;'+
	        '-ms-flex-direction: row;'+
	        'flex-direction: row;'+
	        '-webkit-flex-wrap: wrap;'+
	        '-ms-flex-wrap: wrap;'+
	        'flex-wrap: wrap;'+
	        '-webkit-justify-content: center;'+
	        '-ms-flex-pack: center;'+
	        'justify-content: center;'+
	        '-webkit-align-content: flex-start;'+
	        '-ms-flex-line-pack: start;'+
	        'align-content: flex-start;'+
	        '-webkit-align-items: flex-start;'+
	        '-ms-flex-align: start;'+
	        'align-items: flex-start;'+
		'">';
		$.each(json, function(index, data) {
			tag += ''+
					'<li style="'+
						'-webkit-order: 0;'+
					    '-ms-flex-order: 0;'+
					    'order: 0;'+
					    '-webkit-flex: 0 1 auto;'+
					    '-ms-flex: 0 1 auto;'+
					    'flex: 0 1 auto;'+
					    '-webkit-align-self: auto;'+
					    '-ms-flex-item-align: auto;'+
					    'align-self: auto;'+
					    'width: 500px;'+
					    'padding: 15px;'+
					'">'+
						'<img src="'+vendor+'dist/file/'+data.file+'" style="width: 100%"><br>'+
						data.name+
					'</li>'+
			'';
		});
		tag += '</ul>';
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