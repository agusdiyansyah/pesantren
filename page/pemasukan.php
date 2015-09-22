<link rel="stylesheet" href="<?php echo vendor.'dist/css/dt.css' ?>">

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
		<div class="box box-solid">
            <div class="box-header with-border" style="padding: 17px 10px">
              	<h3 class="box-title">Tambah Data</h3>
            </div><!-- /.box-header -->
            <div class="box-body clearfix">
            	<form action="" method="POST" role="form" class='form-debit'>      
                    <input type="hidden" name="ac" value="add" class='ac-debit'>  
                    <input type="hidden" name="id" value="" class='id-debit'>  
                    <input type="hidden" name="old" value="" class='old-debit'>  

                    <label for="">Tanggal dan waktu</label>
                    <div class="input-group">
                        <input type="text" class="form-control date" id="reservation" required="required" name='date' data-date-format="YYYY-MM-DD">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                    </div>
                    <br>
            		<div class="form-group">
            			<label for="">Item Pemasukkan Dana</label>
            			<input type="text" class="form-control name" id="" required="required" name='name'>
            		</div>
            		<div class="form-group">
            			<label for="">Jumlah Pemasukan</label>
            			<input type="text" class="form-control debit" id="" required="required" name='debit'>
            		</div>
            		<div class="form-group">
            			<label for="">Memo</label>
            			<textarea id="input" class="form-control memo" rows="3" name='memo'></textarea>
            		</div>
            	
            		
            	
            		<button type="submit" class="btn btn-info sub-btn">Submit</button>
                    <span class='rm-btn'></span>
            	</form>
            	<hr>
            	<blockquote>
            		<h3>Total Pemasukkan</h3>
            		<p class="total-debit">
            			
            		</p>
            	</blockquote>
            </div><!-- /.box-body -->
        </div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
		<div class="box box-solid">
            <div class="box-header with-border text-left">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xs-push-6 col-sm-push-6 col-md-push-6 col-lg-push-6">
                    <form action="" method="POST" id="form_cari" name="form_cari" class="search">
                        <div class="input-group input-search">
                            <input type="text" class="form-control" name="q" id="q" placeholder="Cari...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body clearfix">
            	<table class="table table-hover table-striped mb-none list-debit">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal</th>
							<th>Item Pemasukkan Dana</th>
							<th>Jumlah Pemasukan</th>
							<th>Memo</th>
						</tr>
					</thead>
				</table>
            </div><!-- /.box-body -->
        </div>
	</div>
</div>

<?php  
	$js = '
    <script>
        var engine = "'.module.'debit/ajax.php";
        var module = "'.module.'";
    </script>
    <script src="'.vendor.'plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="'.vendor.'dist/js/dt.js"></script>
	<script src="'.vendor.'dist/js/bs-dt.js"></script>

    <script src="'.module.'home/global.js"></script>
    <script src="'.module.'debit/index.js"></script>
	';
?>