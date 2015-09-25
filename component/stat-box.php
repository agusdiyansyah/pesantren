<?php  
    /**
    * STATUS BOX
    */
   function statbox($value = 150, $title = 'new order', $link = '#' , $link_name = 'More info',$icon = 'bag', $color = 'aqua', $id = '')
   {
        echo '
        <div class="small-box bg-'.$color.' '.$id.'">
            <div class="inner">
                <h3>'.$value.'</h3>
                <p>'.$title.'</p>
            </div>
            <div class="icon">
                <i class="ion ion-'.$icon.'"></i>
            </div>
            <a href="'.$link.'" class="small-box-footer">'.$link_name.' <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        ';
   }
?>