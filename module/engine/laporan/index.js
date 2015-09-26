$(document).ready(function() {
	var type 	= $('.type').val();
	var lap    	= render(date, '.box-body', type);

	$('.load-list').click(function(event) {
		event.preventDefault();
		var type 	= $('.type').val();
		render(date, '.box-body', type);
	});

	$('.load-img').click(function(event) {
		event.preventDefault();
		$('.tampil').val('img');
		render_img_all(date);
	});

	$('.form-date').submit(function(event) {
		event.preventDefault();
		var tampil = $('.tampil').val();
		if (tampil == 'list') {
			render($('.date').val(), '.box-body');			
		} else{
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
    	$('.type').val('');
    	$('.load-img').css('display', 'inline-block');
    	render(date, '.box-body');
    });

    $('.btn-debit').click(function(event) {
    	event.preventDefault();
    	$('.type').val(1);
    	$('.load-img').css('display', 'none');
    	render(date, '.box-body', 1);
    });

    $('.btn-kredit').click(function(event) {
    	event.preventDefault();
    	$('.type').val(2);
    	$('.load-img').css('display', 'inline-block');
    	render(date, '.box-body', 2);
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