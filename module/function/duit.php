<?php  
	/**
	* @package      Dyn 5.0
	* @version      Dev : 5.0
	* @author       agus Diyansyah
	* @license      http://creativecommons.org/licenses/by-nc/3.0/ CC BY-NC 3.0
	* @copyright    2015
	* @since        File available since 5.0
	* @category     duit.php
	*/
	
	function duit($xx) {
	    if (empty($xx)){ return $xx;}else {
		    $x = trim($xx);
		    $b = number_format($x, 0, ",", ".");
		    return $b;
	    }
	}
	
	/* End of file duit.php */
	/* Location: .//D/backup/WempServer/www/pesantren/module/function/duit.php */
?>