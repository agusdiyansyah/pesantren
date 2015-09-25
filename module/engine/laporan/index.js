$(document).ready(function() {
	var tampil = $('.tampil').val();
	buka(tampil);
	render(date);

	$('.load-list').click(function(event) {
		event.preventDefault();
		$('.tampil').val('list');
		buka('list');
		render(date);
	});

	$('.load-img').click(function(event) {
		event.preventDefault();
		$('.tampil').val('img');
		$.getJSON(engine, {ac: 'img', src: date}, function(json) {
			var tag = '';
			$.each(json, function(index, data) {
				tag += ''+
						'<img src="'+vendor+'dist/file/'+data+'" >'+
				'';
			});
			$('.box-body').html(tag);
		});
	});

	$('.form-date').submit(function(event) {
		event.preventDefault();
		var tampil = $('.tampil').val();
		if (tampil == 'list') {
			render($('.date').val());			
		} else{
			$.getJSON(engine, {ac: 'img', src: $('.date').val()}, function(json) {
				var tag = '';
				$.each(json, function(index, data) {
					tag += ''+
							'<img src="'+vendor+'dist/file/'+data+'" >'+
					'';
				});
				$('.box-body').html(tag);
			});
		};
	});

	$('.date').datetimepicker({
        viewMode: 'years',
        format: 'YYYY-MM',
    });

    $('.btn-print').click(function(event) {
    	event.preventDefault();
    	var data = $('.box-body').html();
    	window.location.href = 'http://localhost/pesantren/module/engine/laporan/ajax.php?ac=cetak&vendor='+vendor+'&data='+data;
    });
});

function buka (page) {
	$('.box-body').load(module+'laporan/'+page+'.php');
}