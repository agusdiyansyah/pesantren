<?php  
	
	include '../../../core/db_class.php';

	if($_POST){
		switch (trim(strip_tags($_POST['ac']))) {

			case 'login':
				$user	= @mysql_real_escape_string($_POST['user']);
				$pw		= @mysql_real_escape_string($_POST['pw']);
				if ($user == 'admin' && $pw == '1') {
					session_start();
					$_SESSION['login'] = true;
					echo json_encode(array('stat' => true));
				} else {
					echo json_encode(array('stat' => false));
				}
			break;

			case 'off':
				session_start();
				$_SESSION['login'] = false;
				echo json_encode(array('stat' => true));
			break;

		}

	}