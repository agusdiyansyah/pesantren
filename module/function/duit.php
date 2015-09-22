<?php  
	function duit($xx) {
	    if (empty($xx)){ return $xx;}else {
		    $x = trim($xx);
		    $b = number_format($x, 0, ",", ".");
		    return $b;
	    }
	}
?>