function render (tgl) {
	$.getJSON(engine, {ac: 'load', src: tgl}, function(json) {
		var tag = '';
		$.each(json.item, function(index, data) {
			tag += ''+
				'<tr>'+
        			'<td>'+data.id+'</td>'+
        			'<td>'+data.date+'</td>'+
        			'<td>'+data.name+'</td>'+
        			'<td>'+data.d+'</td>'+
        			'<td>'+data.k+'</td>'+
        			'<td>'+data.s+'</td>'+
        		'</tr>'+
			'';
		});
		tag+=''+
			'<tr>'+
    			'<td colspan="3"><b>Total Debit</b></td>'+
    			'<td><b>'+json.debit+'</b></td>'+
    			'<td></td>'+
    			'<td></td>'+
    		'</tr>'+
    		'<tr>'+
    			'<td colspan="4"><b>Total Kredit</b></td>'+
    			'<td><b>'+json.kredit+'</b></td>'+
    			'<td></td>'+
    		'</tr>'+
    		'<tr>'+
    			'<td colspan="5"><b>Saldo Periode '+json.periode+'</b></td>'+
    			'<td><b>'+json.saldo+'</b></td>'+
    		'</tr>'+
		'';
		$('.item-lap').html(tag);
	});
}