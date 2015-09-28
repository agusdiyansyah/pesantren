<?php  
	
	include '../../../core/db_class.php';
	include '../../function/duit.php';
	include '../../function/id.php';
	include '../../function/tgl-indo.php';

	if($_GET){
		switch (trim(strip_tags($_GET['ac']))) {

			case 'load':
				$src = @mysql_real_escape_string($_GET['src']);
				$type = @mysql_real_escape_string($_GET['type']);
				$jenis = @mysql_real_escape_string($_GET['jenis']);

				$list['periode'] = tanggalIndo($src.'01', 'F Y');
				$src = explode('-', $src);
				$m = $src[1];
				$y = $src[0];

				$filter = ' ';
				$join   = ' ';
				if (!empty($type)) {
					$filter = ' and type='.$type.' ';
					$ikut = ' '; 
					if (!empty($jenis)) {
						$filter .= ' and jenis='.$jenis.' ';
						// $ikut    = ' and lid ='.$src.' ';
					}
					$join   = ' left join meta on( jenis = lid '.$ikut.' ) ';
				}

				$sql->db_Select(
					'transaksi '.$join,
					'id, type, date, `name`, jml, memo, jenis',
					'where DATE_FORMAT(date, "%Y") = '.$y.' and DATE_FORMAT(date, "%m") ='.$m.$filter.' order by date asc'
				);
				$d = 0;
				$k = 0;
				$s = 0;
				$tmp = 0;
				$item = array();
				while ($data = $sql->db_Fetch()) {
					$prefix = 'DBT';
					$memo = $data['memo'];
					if ($data['type'] == 2) {
						$json = json_decode($data['memo']);
						$memo = $json->memo;
						$prefix = 'KDT';
						$debit = 0;
						$kredit = $data['jml'];
						$s -= $kredit;
					}
					if ($data['type'] == 1) {
						$debit = $data['jml'];
						$kredit = 0;
						$s += $debit;
					}
					$d += $debit;
					$k += $kredit;
					$a = array(
						'id' => id($data['id'], 6, $prefix),
						'date' => tanggalIndo($data['date'], 'd F Y'),
						'name' => $data['name'],
						'jenis' => $data['jenis'],
						'd' => ($debit == 0) ? '' : 'Rp.'.duit($debit),
						'k' => ($kredit == 0) ? '' : 'Rp.'.duit($kredit),
						's' => 'Rp.'.duit($s)

					);
					
					array_push($item, $a);

				}

				$list['debit'] = 'Rp.'.duit($d);
				$list['kredit'] = 'Rp.'.duit($k);
				$list['saldo'] = 'Rp.'.duit($s);
				$list['item'] = $item;
				header('content-type: application/json');
				echo json_encode($list);
			break;

			case 'img':
				$src = @mysql_real_escape_string($_GET['src']);
				$src = explode('-', $src);
				$m = $src[1];
				$y = $src[0];

				$sql->db_Select(
					'transaksi',
					'memo',
					'where type=2 and DATE_FORMAT(date, "%Y") = '.$y.' AND DATE_FORMAT(date, "%m") = '.$m
				);
				$hasil = array();
				while ($data = $sql->db_Fetch()) {
					$json = json_decode($data['memo']);
					if (!empty($json->file)) {
						array_push($hasil, $json->file);
					}
				}
				header('content-type: application/json');
				echo json_encode($hasil);
			break;

			case 'cetak':
				include '../../class/mpdf/mpdf.php';
				$pdf = new mPDF('utf-8', 'A4', 0, '', 10, 10, 5, 1, 1, 1, '');
				$css = '<link href="'.$_GET['vendor'].'dist/css/jadwal_cetak.css" rel="stylesheet" type="text/css" />';
				$header = "<br><br><div class='header'>HEADER</div><br>";
				$pdf->WriteHTML($css.$header.$_GET['data']);
				$pdf->Output();
			break;

			case 'jenis':
				$sql->db_Select(
					'meta',
					'value, lid id',
					'where type = 3'
				);
				$meta = array();
				while ($data = $sql->db_Fetch()) {
					$res = array(
						'id'  => $data['id'],
						'val' => $data['value'],
					);
					array_push($meta, $res);
				}
				header('content-type: application/json');
				echo json_encode($meta);
			break;

		}
	}