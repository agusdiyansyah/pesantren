function render (tgl, id, type, src) {
	$.getJSON(engine, {ac: 'load', src: tgl, type: type, jenis: src}, function(json) {
        var th;
        var td;
        if (type==1) {
            th = '<th>Debit</th>';
        } else if(type==2){
            th = '<th>Jenis</th> <th>Kredit</th>';
        } else{
            th = '<th>Debit</th>'+
                 '<th>Kredit</th>'+
                 '<th>Saldo</th>';
        };
		var tag = ''+
            '<table class="table table-hover">'+
                '<thead>'+
                    '<tr>'+
                        '<th>No Transaksi</th>'+
                        '<th>Tanggal</th>'+
                        '<th>Item</th>'+
                        th+
                    '</tr>'+
                '</thead>'+
                '<tbody class="item-lap">'+
        '';
		$.each(json.item, function(index, data) {
            if (type==1) {
                td = '<th>'+data.d+'</th>';
            } else if(type==2){
                td = '<th>'+data.jenis_val+'</th> <th>'+data.k+'</th>';
            } else{
                td = '<th>'+data.d+'</th>'+
                     '<th>'+data.k+'</th>'+
                     '<td>'+data.s+'</td>';
            };
			tag += ''+
				'<tr>'+
        			'<td>'+data.id+'</td>'+
        			'<td>'+data.date+'</td>'+
        			'<td>'+data.name+'</td>'+
        			td+
        		'</tr>'+
			'';
		});
        if (type==1) {
            tag+=''+
                        '<tr>'+
                            '<td colspan="3"><b>Total Debit</b></td>'+
                            '<td><b>'+json.debit+'</b></td>'+
                        '</tr>'+
                    '</tbody>'+
                '</table>'+
            '';
        } else if(type==2){
            if (src) {
                tag+=''+
                            '<tr>'+
                                '<td colspan="4"><b>Total Pemasukkan</td>'+
                                '<td><b>'+json.d_tot+'</b></td>'+
                            '</tr>'+
                            '<tr>'+
                                '<td colspan="4"><b>Total Kredit Pada Jenis Pengeluaran '+json.jenis+'</b></td>'+
                                '<td><b>'+json.kredit+'</b></td>'+
                            '</tr>'+
                            '<tr>'+
                                '<td colspan="4"><b>Sisa saldo</b></td>'+
                                '<td><b>'+json.saldo+'</b></td>'+
                            '</tr>'+
                        '</tbody>'+
                    '</table>'+
                '';
            } else{
                tag+=''+
                            '<tr>'+
                                '<td colspan="4"><b>Total Kredit</b></td>'+
                                '<td><b>'+json.kredit+'</b></td>'+
                            '</tr>'+
                        '</tbody>'+
                    '</table>'+
                '';
            };
        } else{
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
                '</tbody>'+
                '</table>'+
    		'';
        };
		$(id).html(tag);
	});
    return type;
}