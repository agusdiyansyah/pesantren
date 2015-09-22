<link rel="stylesheet" href="<?php echo vendor.'dist/css/dt.css' ?>">
<style>
	.kv-avatar .file-preview-frame,.kv-avatar .file-preview-frame:hover {
	    margin: 0;
	    padding: 0;
	    border: none;
	    box-shadow: none;
	    text-align: center;
	}
	.kv-avatar .file-input {
	    display: table-cell;
	    max-width: 220px;
	}
</style>


<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
		<div class="box box-solid">
            <div class="box-header with-border" style="padding: 17px 10px">
              	<h3 class="box-title">Tambah Data</h3>
            </div><!-- /.box-header -->
            <div class="box-body clearfix">
            	<form id='form-kredit' method="POST" role="form" class='form-kredit'>      
                    <input type="hidden" name="ac" value="add" class='ac-kredit'>  
                    <input type="hidden" name="id" value="" class='id-kredit'>  
                    <input type="hidden" name="old" value="" class='old-kredit'>  

                    <span class="img"></span>
					
					<div class="form-group">
            			<label for="">File</label>
            			<input type="file" class="form-control file" id="" required="required" name='file'>
            		</div>	

                    <label for="">Tanggal</label>
                    <div class="input-group">
                        <input type="text" class="form-control date" id="reservation" required="required" name='date' data-date-format="YYYY-MM-DD">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                    </div>
                    <br>
            		<div class="form-group">
            			<label for="">Jenis Pengeluaran</label>
            			<select name="jenis" id="inputJenis" class="form-control" required="required">
            				<option value=""></option>
            			</select>
            			<small><a href="">Tambah jenis baru</a></small>
            		</div>
            		<div class="form-group">
            			<label for="">Item Pengeluaran Dana</label>
            			<input type="text" class="form-control name" id="" required="required" name='name'>
            		</div>
            		<div class="form-group">
            			<label for="">Jumlah Pengeuaran</label>
            			<input type="text" class="form-control kredit" id="" required="required" name='kredit'>
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
            		<h3>Total Pengeluaran</h3>
            		<p class="total-kredit">
            			
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
				<table class="table table-hover table-striped mb-none list-kredit">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal</th>
							<th>Jenis Pengeluaran</th>
							<th>Item Pengeluaran Dana</th>
							<th>Jumlah Pengeluaran</th>
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
        var engine = "'.module.'kredit/ajax.php";
        var module = "'.module.'";
    </script>
    <script src="'.vendor.'plugins/jquery-validation/jquery.validate.min.js"></script>
	<script src="'.vendor.'plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="'.vendor.'dist/js/dt.js"></script>
	<script src="'.vendor.'dist/js/bs-dt.js"></script>


    <script src="'.module.'home/global.js"></script>
    <script src="'.module.'kredit/index.js"></script>
	';
?>