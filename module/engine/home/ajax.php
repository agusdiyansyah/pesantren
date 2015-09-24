<?php  
	/**
	* @package      Dyn 5.0
	* @version      Dev : 5.0
	* @author       agus Diyansyah
	* @license      http://creativecommons.org/licenses/by-nc/3.0/ CC BY-NC 3.0
	* @copyright    2015
	* @since        File available since 5.0
	* @category     ajax.php
	*/
	
	include '../../../core/db_class.php';
	include '../../function/duit.php';
	include '../../function/tgl-indo.php';

	if($_GET){
		switch (trim(strip_tags($_GET['ac']))) {

			case 'total':
				$sql->db_Select(
					'meta m
						left join meta j on (j.type = 2)',
					'm.value d, j.value k',
					'where m.type = 1 limit 1'
				);

				$saldo = $sql->db_Fetch();
				$sisa = $saldo['d']-$saldo['k'];

				header('content-type: application/json');
				echo json_encode(array('stat' => true,'total' => duit($sisa)));
			break;

		}

	}

	/* End of file ajax.php */
	/* Location: .//D/backup/WempServer/www/pesantren/module/engine/home/ajax.php */