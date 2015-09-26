<div class="nav-tabs-custom">
    <ul class="nav nav-tabs pull-right">
    	<li>
            <div class="form-group" style="display:inline-block; width:300px;margin-bottom: 0px;margin-right: 5px;">
                <form class='form-date'>
                    <div class='input-group'>
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default btn-print">
                                <i class="ion ion-ios-printer-outline"></i>
                            </button>
                        </span>

                        <span class="input-group-addon">
                            <i class="ion ion-ios-calendar-outline"></i>
                            </span>
                        </span>

                        <input type='text' class="form-control date" name="src"/>

                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
            </div>
            
        </li>
        <li>
            <div class="form-group" style="display:inline-block; width:280px;margin-bottom: 0px;margin-right: 5px;">
                <div class='input-group'>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default btn-all">
                            <i class="ion ion-social-usd-outline"></i> &nbspSemua transaksi
                        </button>
                        <button type="submit" class="btn btn-default btn-debit">
                            <i class="ion ion-ios-download-outline"></i> &nbspDebit
                        </button>
                        <button type="submit" class="btn btn-default btn-kredit">
                            <i class="ion ion-ios-upload-outline"></i> &nbspKredit
                        </button>
                    </span>
                </div>
            </div>
            
        </li>
      	<li class="pull-left">
            <div class="form-group" style="display:inline-block; width:300px;margin-bottom: 0px;margin-left: 5px;">
                <div class='input-group'>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default load-list"><i class="ion ion-ios-list-outline"></i></button>
                        <button type="submit" class="btn btn-default load-img"><i class="ion ion-image"></i></button>
                    </span>
                </div>
            </div>
        </li>
    </ul>

    <input type="hidden" name="type" value="" class='type'>

    <div class="box-body">
    	
    </div>
</div>
<?php  
    $now = date('Y').'-'.date('m');
	$js = "
	<script>
		// $('body').removeClass('sidebar-collapse');
        var engine   = '".module."laporan/ajax.php';
        var module  = '".module."';
        var vendor  = '".vendor."';
        var date    = '".$now."';
	</script>
    <script src='".vendor."plugins/jquery-validation/jquery.validate.min.js'></script>
    <script src='".module."laporan/render.js'></script>
    <script src='".module."laporan/index.js'></script>
	";
?>