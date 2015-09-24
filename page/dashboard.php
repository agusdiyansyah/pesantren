<div class="row">
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <?php 
            statbox('0', 'Sisa Saldo', 'javascript:;', 'social-usd-outline', 'info', 'info-saldo');
            statbox('0', 'Pemasukkan', 'pemasukan', 'ios-download-outline', 'teal', 'info-debit');
            statbox('0', 'Pengeluaran', 'pengeluaran', 'ios-upload-outline', 'maroon', 'info-kredit'); 
        ?>
    </div>
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Last Action</h3>
            </div><!-- /.box-header -->
            <div class="box-body clearfix">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Aksi</th>
                            <th>Tanggal</th>
                            <th>Nama Item</th>
                            <th>Rp. </th>
                            <th>Memo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="border-left: 5px solid #D81B60">Kredit</td>
                            <td><?php echo date('d-m-Y H:m:s') ?></td>
                            <td>Lorem ipsum Ullamco ut quis Excepteur.</td>
                            <td><?php echo duit(1000) ?></td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td style="border-right: 5px solid #39CCCC">Debit</td>
                            <td><?php echo date('d-m-Y H:m:s') ?></td>
                            <td>Lorem ipsum Quis ut et dolore proident.</td>
                            <td><?php echo duit(1000) ?></td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td style="border-left: 5px solid #D81B60">Kredit</td>
                            <td><?php echo date('d-m-Y H:m:s') ?></td>
                            <td>Lorem ipsum Nostrud ut nostrud Duis aliqua nisi.</td>
                            <td><?php echo duit(1000) ?></td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td style="border-left: 5px solid #D81B60">Kredit</td>
                            <td><?php echo date('d-m-Y H:m:s') ?></td>
                            <td>Lorem ipsum Ut dolore sunt Duis.</td>
                            <td><?php echo duit(1000) ?></td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td style="border-left: 5px solid #D81B60">Kredit</td>
                            <td><?php echo date('d-m-Y H:m:s') ?></td>
                            <td>Lorem ipsum Eu minim pariatur ad.</td>
                            <td><?php echo duit(1000) ?></td>
                            <td>-</td>
                        </tr>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div>
    </div>
</div>
<?php  
	$js = "
	<script>
		// $('body').removeClass('sidebar-collapse');
        var debit = '".module."debit/ajax.php';
        var kredit = '".module."kredit/ajax.php';
        var saldo = '".module."home/ajax.php';
        var module = '".module."';
	</script>
    <script src='".module."home/global.js'></script>
    <script src='".module."home/index.js'></script>
	";
?>