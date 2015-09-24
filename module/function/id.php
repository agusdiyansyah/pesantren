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
	
	function id($number, $length, $prefix)
	{
		if (empty($length)) {
			$length = 5;
		}
		$zero = '';
		for ($i=0; $i < $length; $i++) { 
			$zero .= '0';
		}
		$num_len = strlen($number);
		$num = substr($zero, -($length-$num_len));
		$num = $num.$number;
		return $prefix.$num;
	}
	
	/* End of file id.php */
	/* Location: .//D/backup/WempServer/www/pesantren/module/function/id.php */
?>