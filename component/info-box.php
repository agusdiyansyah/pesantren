<?php  
	function infobox($value = 410, $title = 'book', $icon = 'flag', $color = 'green', $id = '')
	{
		echo '
		<div class="info-box '.$id.'">
			<span class="info-box-icon bg-'.$color.'"><i class="ion ion-'.$icon.'"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">'.$title.'</span>
				<span class="info-box-number">'.$value.'</span>
			</div><!-- /.info-box-content -->
		</div>
		';
	}
?>