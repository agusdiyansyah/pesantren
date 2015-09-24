<?php  
	
	include '../../../core/db_class.php';
	include '../../class/upload.php';
	include '../../function/duit.php';
	include '../../function/id.php';
	include '../../function/tgl-indo.php';

	if($_POST){
		switch (trim(strip_tags($_POST['ac']))) {

			case 'list':
				$conf = array(
					'id'		=> ' kid ',
					'column' 	=> array('`name`', 'date', 'kredit', 'memo', 'file', 'value'),
					'table' 	=> "kredit
										left join meta on (meta.lid = kredit.jenis and type=3)
									",
					'select' 	=> " kid, date, `name`, kredit, memo, file, value, lid ",
					'limit'		=> " ",
					'order'		=> " order by kid desc ",
					'where'		=> " ",
					'filter'	=> " ",
				);
				extract($conf);

				if ( isset($_POST['start']) && $_POST['length'] != -1 ) {
				    $limit = " LIMIT ".intval($_POST['start']).", ".intval($_POST['length']);
				}

				// if ( isset($_POST['cari']) && $_POST['cari']!= '' ) {
				if ( !empty($_POST['cari']) ) {
					$str	= $_POST['cari'];
					$filter = " where (";
				    for ( $i = 0, $ien = count($column) ; $i < $ien ; $i++ ) {
				        $filter .= "".$column[$i]." LIKE '%".$str."%' OR ";
				    }
				    $filter = substr_replace( $filter, "", -3 );
				    $filter .= ")";
				}

				// FILTER USER
				// if(isset($_POST['filter_user']) && $_POST['filter_user']!='all'){
				// 	$user	= $_POST['filter_user'];
				// 	$filter .= " AND p.`UID`='".$user."' ";
				// }

				$sql->db_Select($table,'COUNT('.$id.') as total', $where.$filter);
				$rtot	= $sql->db_Fetch();
				$total	= $rtot['total'];

				$sql->db_Select($table,'COUNT('.$id.') as total', $where.$filter.$limit);
				$dbfiltot		= $sql->db_Fetch();
				$filtertotal	= $rtot['total'];

				//data
				$sql->db_Select($table,
					$select, 
					$where.$filter.$order.$limit);

				$output = array(
				    "draw" => intval($_POST['draw']),
				    "recordsTotal" => intval($total),
				    "recordsFiltered" => intval($filtertotal),
				    "data" => array()
				);

				$no = 1+$_POST['start'];

				while( $row = $sql->db_Fetch() ) { 

					$not = id($row['kid'], 6, 'KDT');

					$aksi	= "	<div class=\"actions-hover actions-fade\">
									<a href='#'
										data-date = '$row[date]'
										data-jenis = '$row[value]'
										data-meta = '$row[lid]'
										data-name = '$row[name]'
										data-memo = '$row[memo]'
										data-file = '$row[file]'
										data-kredit = '$row[kredit]'
										data-id = '$row[kid]'
										class='edit-kredit'
									>Edit</a>&nbsp
							        <a href='#' 
							        	data-toggle='modal' data-target='#myModal'

							        	data-date = '$row[date]'
							        	data-jenis = '$row[value]'
										data-name = '$row[name]'
										data-memo = '$row[memo]'
										data-kredit = '$row[kredit]'
										data-file = '$row[file]'
										data-id = '$row[kid]'
										data-not = '$not'

							        	class='delete-row'
							        >Delete</a>
							    </div>";

					$posts 	= array(
						$not,
						$row['date'].$aksi,
						(empty($row['value'])) ? '<span style="color:silver"><i>Uncategories</i></span>' : $row['value'],
						$row['name'],
						'Rp.'.duit($row['kredit']),
						$row['memo'],
					);
					$output['data'][] = $posts;
					$no++;

				}

				echo json_encode($output);
			break;

			case 'add':
				$date	= @mysql_real_escape_string($_POST['date']);
				$jenis	= @mysql_real_escape_string($_POST['jenis']);
				$name	= @mysql_real_escape_string($_POST['name']);
				$kredit	= @mysql_real_escape_string($_POST['kredit']);
				$memo	= @mysql_real_escape_string($_POST['memo']);

				$file = '';
				if (!empty($_FILES['file']['name'])) {
					$up = new up;
					$proses = $up->upload('file', '5', 'jpg|png|gif', '../../../vendor/dist/file/')->resize(200,200)->return_name;
					if ($proses) {
						$file = $proses;
					}
				}

				$data = array(
					"date" 		=> $date,
					"jenis" 	=> (empty($jenis)) ? 0 : $jenis,
					"name" 		=> $name,
					"kredit" 	=> $kredit,
					"memo" 		=> (empty($memo)) ? '-' : $memo,
					"file" 		=> $file,					
				);
				$kid = $sql -> db_Insert("kredit", $data);
				if($kid){
					$meta = $sql -> db_Update("meta", "`value`=`value`+$kredit  WHERE `type`=2" );
					echo json_encode(array("stat"=>true,"msg"=>'Success',"kid"=>$kid));
				}else{
					echo json_encode(array("stat"=>false,"msg"=>"Aksi Gagal."));
				}
			break;

			case 'up':
				$date		= @mysql_real_escape_string($_POST['date']);
				$jenis		= @mysql_real_escape_string($_POST['jenis']);
				$name		= @mysql_real_escape_string($_POST['name']);
				$kredit		= @mysql_real_escape_string($_POST['kredit']);
				$memo		= @mysql_real_escape_string($_POST['memo']);

				$id			= @mysql_real_escape_string($_POST['id']);
				$old		= @mysql_real_escape_string($_POST['old']);
				$stat_file	= @mysql_real_escape_string($_POST['stat_file']);
				$name_file	= @mysql_real_escape_string($_POST['name_file']);

				if ($stat_file == 0) {
					hapus_img($name_file);
					$name_file = '';

				}

				if (!empty($_FILES['file']['name'])) {
					hapus_img($name_file);
					$up = new up;
					$proses = $up->upload('file', '5', 'jpg|png|gif', '../../../vendor/dist/file/')->resize(200,200)->return_name;
					if ($proses) {
						$name_file = $proses;
					}
				}

				$jenis = (empty($jenis)) ? 0 : $jenis ;

				$did = $sql -> db_Update(
					"kredit", 
					"	`date`='{$date}',
						`name`='{$name}',
						`jenis`='{$jenis}',
						`kredit`='{$kredit}',
						`file`='{$name_file}',
						`memo`='{$memo}' WHERE `kid`='{$id}'	"
				);

				if($did){

					if ($kredit > $old) {
						$total = $kredit-$old;
						$meta = $sql -> db_Update("meta", "`value`=`value`+$total  WHERE `type`=2" );
					} elseif ($old > $kredit) {
						$total = $old - $kredit;
						$meta = $sql -> db_Update("meta", "`value`=`value`-$total  WHERE `type`=2" );
					}
					
					echo json_encode(array("stat"=>true,"msg"=>'Success',"did"=>$did));
				}else{
					echo json_encode(array("stat"=>false,"msg"=>"Aksi Gagal."));
				}
			break;

			case 'del':
				$kredit	= @mysql_real_escape_string($_POST['kredit']);
				$id		= @mysql_real_escape_string($_POST['id']);
				$file	= @mysql_real_escape_string($_POST['file']);

				if (!empty($file)) {
					hapus_img($file);
				}

				$del = $sql->db_Delete('kredit',"kid='$id'");
				if($del){
					$meta = $sql -> db_Update("meta", "`value`=`value`-$kredit  WHERE `type`=2" );
					
					echo json_encode(array("stat"=>true,"msg"=>'Success'));
				}else{
					echo json_encode(array("stat"=>false,"msg"=>"Aksi Gagal."));
				}
			break;

			case 'jenis':
				$jenis	= @mysql_real_escape_string($_POST['new']);
				$data = array(
					"type" => 3,
					"key" => "taxJenis",
					"value" => $jenis			
				);
				$id = $sql -> db_Insert("meta", $data);
				if($id){
					echo json_encode(array("stat"=>true,"msg"=>'Success',"id"=>$id, 'jenis' => $jenis));
				}else{
					echo json_encode(array("stat"=>false,"msg"=>"Aksi Gagal."));
				}
			break;

			case 'up_jenis':
				$jenis	= @mysql_real_escape_string($_POST['new']);
				$id	= @mysql_real_escape_string($_POST['id']);
				
				$id = $sql -> db_Update('meta', '`value`="'.$jenis.'" where type=3 and lid='.$id);
				if($id){
					echo json_encode(array("stat"=>true,"msg"=>'Success',"id"=>$id, 'jenis' => $jenis));
				}else{
					echo json_encode(array("stat"=>false,"msg"=>"Aksi Gagal."));
				}
			break;

			case 'del_jenis':
				$id	= @mysql_real_escape_string($_POST['id']);
				$del = $sql->db_Delete('meta',"lid='$id'");
				$sql->db_Update(
					'kredit',
					'jenis = 0 where jenis = '.$id
				);
				if($del){				
					echo json_encode(array("stat"=>true,"msg"=>'Success'));
				}else{
					echo json_encode(array("stat"=>false,"msg"=>"Aksi Gagal."));
				}
			break;

		}

	}

	if($_GET){
		switch (trim(strip_tags($_GET['ac']))) {

			case 'jenis':
				$sql->db_Select('meta',
					'lid, value', 
					'where type=3 order by lid desc');
				$jenis = array();
				while ($data = $sql->db_Fetch()) {
					$res = array(
						'id' => $data['lid'],
						'value' => $data['value'],
					);
					array_push($jenis, $res);
				}

				$parsing['item'] = $jenis;
				if (!empty($jenis)) {
					$parsing['stat'] = true;
				}

				echo json_encode($parsing);
			break;

			case 'total':
				$sql->db_Select('meta',
					'value',
					'where type = 2 limit 1');
				$data = $sql->db_Fetch();
				echo json_encode(array('stat' => true, 'total' => duit($data['value'])));
			break;

		}

	}

	function hapus_img($name_file)
	{
		$src = '../../../vendor/dist/file/';
		$ret = false;
					
		if (is_file($src.$name_file) && is_file($src.'syah_'.$name_file)) {
			
			if (unlink($src.$name_file) && unlink($src.'syah_'.$name_file)) {

				$ret = true;

			}

		}

		return $ret;
	}