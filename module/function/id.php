<?php
	/**
	* @package      Dyn 5.0
	* @version      Dev : 5.0
	* @author       agus Diyansyah
	* @license      http://creativecommons.org/licenses/by-nc/3.0/ CC BY-NC 3.0
	* @copyright    2015
	* @since        File available since 5.0
	* @category     id.php
	*/
	
	function id($data, $len = 5, $prefix = '')
	{
		$y = $len - strlen($data);
		$x = "";
		while(strlen($x) < $y) {
			$x .= "0";
		}
		return $prefix . $x . $data;
	}
	
	/* End of file id.php */
	/* Location: .//D/backup/WempServer/www/pesantren/module/function/id.php */
?>