<?php
/**
* @package      Qapuas 5.0
* @version      Dev : 5.0
* @author       Rosi Abimanyu Yusuf <bima@abimanyu.net>
* @license      http://creativecommons.org/licenses/by-nc/3.0/ CC BY-NC 3.0
* @copyright    2015
* @since        File available since Release 1.0
* @category     database_class
*/

$host		= '127.0.0.1';
$user		= 'root';
$password	= '';
$db			= 'pesantren';

$sql = new db;
$konek = $sql -> db_Connect($host, $user, $password, $db);
$sql -> db_SetErrorReporting(TRUE);

if ($konek == "wadoh_ga_bisa_konek"){ 
	die("GAK BISA CONNECT CUY!!"); 
	exit;
} elseif ($konek == "wadoh_db_nya_mana_yah"){
	die("BAH! GAK ADA DATABASE!!"); 
	exit;
}

/**

*/
class db{
	var $MySQLHost;
	var $MySQLUser;
	var $MySQLPasswd;
	var $MySQLDb;
	var $mySQLaccess;
	var $mySQLresult;
	var $mySQLrows;
	var $mySQLerror;
/**

*/
	function db_Connect($MySQLHost, $MySQLUser, $MySQLPasswd, $MySQLDb){
		$this->MySQLHost = $MySQLHost;
		$this->MySQLUser = $MySQLUser;
		$this->MySQLPasswd = $MySQLPasswd;
		$this->MySQLDb = $MySQLDb;
		$temp = $this->mySQLerror;
		$this->mySQLerror = FALSE;
		if(!$this->mySQL_access = @mysql_connect($this->MySQLHost, $this->MySQLUser, $this->MySQLPasswd)){
			return "wadoh_ga_bisa_konek";
		}else{
			if(!@mysql_select_db($this->MySQLDb)){
				return "wadoh_db_nya_mana_yah";
			}else{
				$this->dbError("dbConnect/SelectDB");
			}
		}
	}
/**

*/
	/*function db_Select($table, $fields="*", $arg="", $mode="default"){
		global $dbq;
		$dbq++;

		//mode statis (default)
		if($arg != ""){

			if($this->mySQLresult = @mysql_query("SELECT ".$fields." FROM ".$table." ".$arg)){
				$this->dbError("dbQuery");
				return $this->db_Rows();
			}else{
				$this->dbError("db_Select (SELECT $fields FROM "."$table $arg)");
				return FALSE;
			}
		}
		
		else{

			if($this->mySQLresult = @mysql_query("SELECT ".$fields." FROM ".$table)){
				$this->dbError("dbQuery");
				return $this->db_Rows();
			}else{
				$this->dbError("db_Select (SELECT $fields FROM "."$table)");
				return FALSE;
			}		
		}
	}*/
	function db_Select($table, $fields="*", $arg="", $mode=false){
		global $dbq;
		$dbq++;

		//mode statis (default)
		if($arg != ""){

			$query = "SELECT ".$fields." FROM ".$table." ".$arg;
			
		}
		
		else{

			$query = "SELECT ".$fields." FROM ".$table;		
		}

		if ($mode) {
			echo $query;
		} else {
			if($this->mySQLresult = @mysql_query($query)){
				$this->dbError("dbQuery");
				return $this->db_Rows();
			}else{
				$this->dbError("db_Select (".$query.")");
				return FALSE;
			}
		}
	}
/**

*/
	function arg($arg)
	{
		foreach ($arg as $key => $value)
        {
            $keys[] = "`$key`";
            if (strpos($value, '()') == true)
                $values[] = "$value";
            else
                $values[] = "'$value'";
        }
        return array('key' => $keys, 'values' => $values);
	}
/**
INSERT
*/
	/*
	Batasan masalah
	@ dapat melakukan insert dengan menggunakan array dengan ketentuan : 
	|___ nama dari array key sama dengan nama field
	|___ value dari masing masing array key adalah value untuk setiap field

	CONTOH :

		* table
		nim  | nama
		===========
		null | null
		-----------
		
		* db_class
		$sql = new db;
		$sql -> db_Insert( "nama_table" , "array data/ argumen");

		* implementasi
		$data = array(
			'nim'    => "3201216006", 
			'nama'   => "agus Diyansyah", 
		);
		
		$sql -> db_Insert( "jur" , $data );

		* result
		nim  		| nama
		=============================
		3201216006 	| agus Diyansyah
		-----------------------------

	*/
	function db_Insert($table, $arg, $debug = false){

		if (is_array($arg)) {

			$data = $this->arg($arg);
			
	        $sql = "INSERT INTO " . $table . " (" . implode(', ', $data['key']) . ") VALUES (" . implode(', ', $data['values']) . ");";

	        unset($data);

		} else {

			$sql = "INSERT INTO ".$table." VALUES (".$arg.")";

		}

		if ($debug == true) {
			echo $sql;
		} else {
			if($result = $this->mySQLresult = @mysql_query( $sql )){
				$tmp = mysql_insert_id();
				return $tmp;
			}else{
				$this->dbError("db_Insert");
				return FALSE;
			}
		}
		
	}
/**
ERROR
*/
	function dbError($from){
		if($error_message = @mysql_error()){
			if($this->mySQLerror == TRUE){
				echo $error_message . "<br>";
			}
		}
	}
/**

*/	
	/*
	$returnrow 	- > return affected_row hasil query. default : false
	$debug 		- > mode debug, return query update. default : false 
	*/
	function db_Update($table, $arg, $returnrow=false,$debug = false){
		global $dbq;
		$dbq++;

		$sql = "UPDATE ".$table." SET ".$arg;

		if ($debug) {
			echo $sql;
		} else {
			if($result = $this->mySQLresult = @mysql_query( $sql )){
				if($returnrow==TRUE){
					return mysql_affected_rows();
				}else{
					return $result;
				}
			}else{
				$this->dbError("db_Update ($arg)");
				return FALSE;
			}
		}
	}
/**

*/
	function db_Fetch($mode = "strip"){
		if($row = @mysql_fetch_array($this->mySQLresult)){
			if($mode == "strip"){
				while (list($key,$val) = each($row)){
					$row[$key] = stripslashes($val);
				}
			}
			$this->dbError("db_Fetch");
			return $row;
		}else{
			$this->dbError("db_Fetch");
			return FALSE;
		}
	}
/**

*/
	function db_Close(){
		mysql_close();
		$this->dbError("dbClose");
	}
/**

*/
	function db_Delete($table, $arg="", $returnrow=false){
		if(!$arg){
			if($result = $this->mySQLresult = @mysql_query("DELETE FROM ".$table)){
				return $result;
			}else{
				$this->dbError("db_Delete ($arg)");
				return FALSE;
			}
		}else{
			if($result = $this->mySQLresult = @mysql_query("DELETE FROM ".$table." WHERE ".$arg)){
				if($returnrow=TRUE){
					$tmp = mysql_affected_rows();
					return $tmp;
				}else{
					return $result;
				}
			}else{
				$this->dbError("db_Delete ($arg)");
				return FALSE;
			}
		}
	}
/**

*/
	function db_Rows(){
		$rows = $this->mySQLrows = @mysql_num_rows($this->mySQLresult);
		return $rows;
		$this->dbError("db_Rows");
	}
/**

*/
	function db_SetErrorReporting($mode){
		$this->mySQLerror = $mode;
	}
/**

*/
	function db_Select_gen($arg){
		global $dbq;
		$dbq++;
		//echo "\mysql_query($arg)";
		if($this->mySQLresult = @mysql_query($arg)){
			$this->dbError("db_Select_gen");
			return $this->db_Rows();
		}else{
			$this->dbError("dbQuery ($query)");
			return FALSE;
		}
	}
/**

*/
	function db_Fieldname($offset){

		$result = @mysql_field_name($this->mySQLresult, $offset);
		return $result;
	}
/**

*/
	function db_Num_fields(){
		$result = @mysql_num_fields($this->mySQLresult);
		return $result;
	}
}
?>