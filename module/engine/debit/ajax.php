<?php  
	
	include '../../../core/db_class.php';
	include '../../function/duit.php';
	include '../../function/tgl-indo.php';

	if($_POST){
		switch (trim(strip_tags($_POST['ac']))) {

			case 'list':
				$conf = array(
					'id'		=> ' did ',
					'column' 	=> array('`name`', 'date', 'debit', 'memo'),
					'table' 	=> "debit",
					'select' 	=> " did, date, `name`, debit, memo ",
					'limit'		=> " ",
					'order'		=> " order by did desc ",
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


					$aksi	= "	<div class=\"actions-hover actions-fade\">
									<a href='#'
										data-date = '$row[date]'
										data-name = '$row[name]'
										data-memo = '$row[memo]'
										data-debit = '$row[debit]'
										data-id = '$row[did]'
										class='edit-debit'
									>Edit</a>&nbsp
							        <a href='#' 
							        	data-toggle='modal' 
							        	data-target='#myModal'

							        	data-date = '$row[date]'
										data-name = '$row[name]'
										data-memo = '$row[memo]'
										data-debit = '$row[debit]'
										data-id = '$row[did]'
										data-no = '$no'

							        	class='delete-row'
							        >Delete</a>
							    </div>";

					$posts 	= array(
						$no,
						$row['date'].$aksi,
						$row['name'],
						'Rp.'.duit($row['debit']),
						$row['memo'],
					);
					$output['data'][] = $posts;
					$no++;

				}

				echo json_encode($output);
			break;

			case 'add':
				$date	= @mysql_real_escape_string($_POST['date']);
				$name	= @mysql_real_escape_string($_POST['name']);
				$debit	= @mysql_real_escape_string($_POST['debit']);
				$memo	= @mysql_real_escape_string($_POST['memo']);

				$data = array(
					"date" => $date,
					"name" => $name,
					"debit" => $debit,
					"memo" => (empty($memo)) ? '-' : $memo,
				);
				$did = $sql -> db_Insert("debit", $data);
				if($did){
					$meta = $sql -> db_Update("meta", "`value`=`value`+$debit  WHERE `type`=1" );
					echo json_encode(array("stat"=>true,"msg"=>'Success',"did"=>$did));
				}else{
					echo json_encode(array("stat"=>false,"msg"=>"Aksi Gagal."));
				}
			break;

			case 'up':
				$date	= @mysql_real_escape_string($_POST['date']);
				$name	= @mysql_real_escape_string($_POST['name']);
				$debit	= @mysql_real_escape_string($_POST['debit']);
				$old	= @mysql_real_escape_string($_POST['old']);
				$memo	= @mysql_real_escape_string($_POST['memo']);
				$id		= @mysql_real_escape_string($_POST['id']);

				$did = $sql -> db_Update(
					"debit", 
					"	`date`='{$date}',
						`name`='{$name}',
						`debit`='{$debit}',
						`memo`='{$memo}' WHERE `did`='{$id}'	"
				);

				if($did){

					if ($debit > $old) {
						$total = $debit-$old;
						$meta = $sql -> db_Update("meta", "`value`=`value`+$total  WHERE `type`=1" );
					} elseif ($old > $debit) {
						$total = $old - $debit;
						$meta = $sql -> db_Update("meta", "`value`=`value`-$total  WHERE `type`=1" );
					}
					
					echo json_encode(array("stat"=>true,"msg"=>'Success',"did"=>$did));
				}else{
					echo json_encode(array("stat"=>false,"msg"=>"Aksi Gagal."));
				}
			break;

			case 'del':
				$debit	= @mysql_real_escape_string($_POST['debit']);
				$id		= @mysql_real_escape_string($_POST['id']);

				$del = $sql->db_Delete('debit',"did='$id'");
				if($del){
					$meta = $sql -> db_Update("meta", "`value`=`value`-$debit  WHERE `type`=1" );
					
					echo json_encode(array("stat"=>true,"msg"=>'Success'));
				}else{
					echo json_encode(array("stat"=>false,"msg"=>"Aksi Gagal."));
				}
			break;

		}
	}

	if ($_GET) {
		switch (trim(strip_tags($_GET['ac']))) {

			case 'total':
				$sql -> db_Select(
					'meta',
					'value',
					'where type = 1 limit 1'
				);
				$data = $sql->db_Fetch();
				if (!empty($data)) {
					echo json_encode(array('stat' => true, 'total' => duit($data['value'])));
				}
			break;

		}
	}

?>