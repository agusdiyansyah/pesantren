<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <?php 
            statbox('0', 'Sisa Saldo', 'laporan', 'Laporan', 'social-usd-outline', 'info', 'info-saldo');
            statbox('0', 'Pemasukkan', 'pemasukan', 'Data', 'ios-download-outline', 'teal', 'info-debit');
            statbox('0', 'Pengeluaran', 'pengeluaran', 'Data', 'ios-upload-outline', 'maroon', 'info-kredit'); 
        ?>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Transaksi Bulan Ini</h3>
            </div><!-- /.box-header -->
            <div class="box-body clearfix">
            
            </div><!-- /.box-body -->
        </div>
    </div>
</div>
<?php  
    $now = date('Y').'-'.date('m');
	$js = "
	<script>
		// $('body').removeClass('sidebar-collapse');
        var debit = '".module."debit/ajax.php';
        var kredit = '".module."kredit/ajax.php';
        var saldo = '".module."home/ajax.php';
        var engine = '".module."laporan/ajax.php';
        var module = '".module."';
        var date    = '".$now."';
	</script>
    <script src='".module."home/global.js'></script>
    <script src='".module."laporan/render.js'></script>
    <script src='".module."home/index.js'></script>
	";
?>