<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">      

        <ul class="sidebar-menu">
            <li class='<?php echo (empty($uri[0])) ? 'active' : '' ; ?>'>
                <a href="<?php echo domain ?>">
                    <i style='font-size:14pt' class="ion ion-ios-home-outline"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class='<?php echo ($uri[0] == 'pemasukan') ? 'active' : '' ; ?>'>
                <a href="pemasukan">
                    <i style='font-size:14pt' class="ion ion-ios-download-outline"></i>
                    <span>Pemasukan</span> 
                </a>
            </li>
            <li class='<?php echo ($uri[0] == 'pengeluaran') ? 'active' : '' ; ?>'>
                <a href="pengeluaran">
                    <i style='font-size:14pt' class="ion ion-ios-upload-outline"></i>
                    <span>Pengeluaran</span> 
                </a>
            </li>
            <li class='<?php echo ($uri[0] == 'laporan') ? 'active' : '' ; ?>'>
                <a href="laporan">
                    <i style='font-size:14pt' class="ion ion-ios-list-outline"></i>
                    <span>Laporan</span> 
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>