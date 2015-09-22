<?php  
    
    date_default_timezone_set("Asia/Jakarta");

    include 'conf.php';
    include fun.'duit.php';
    include component.'stat-box.php';


    $uri    = explode('/', $_SERVER['QUERY_STRING']);
?>

<!DOCTYPE html>
<html>
    <?php include part.'head.php'; ?>
    <body class="skin-black-light sidebar-mini sidebar-collapse">
        <div class="wrapper">
        
            <?php 

                /**
                MENU
                 */

                include part.'menu-top.php'; 
                include part.'menu-left.php';

            ?>
            <div class="content-wrapper">
                <!-- Main content -->
                <section class="content">
                    <!-- Small boxes (Stat box) -->
                    
                    <?php  

                        $page = $uri[0];
                        if (empty($uri[0])) {
                            $page = 'dashboard';
                        }

                        $link   = page.$page.'.php';
                        if (!is_file($link)) {
                            $link = page.'404.php';
                        }
                        require_once $link;
                    ?>

                </section><!-- /.content -->
                

            </div><!-- /.content-wrapper -->

          <?php include part.'cr.php'; ?>

          <div class="control-sidebar-bg"></div>
        </div>

        <?php include part.'script.php'; ?>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel"></h4>
                    </div>
                    <div class="modal-body">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i></button>
                        <button type="button" class="btn btn-primary ok-modal"><i class="fa fa-check"></i></button>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
