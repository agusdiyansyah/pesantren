<style type="text/css">
	.login{
		float: none !important;
		margin: 0 auto !important
	}
</style>
<br>
<br>
<div class="container">
	<div class="row text-center">
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 login">
			<div class="login-logo">
		        <b>Login</b> admin
		    </div>
		    <div class="login-box-body">
		        <p class="login-box-msg">Sign in to start your session</p>

		        <form class='form-user' method="post">
		        	<input type="hidden" name="ac" value="login">
		          	<div class="form-group has-feedback">
			            <input name='user' type="Username" class="form-control" placeholder="Username">
			            <span class="glyphicon glyphicon-user form-control-feedback"></span>
		          	</div>
		          	<div class="form-group has-feedback">
			            <input name='pw' type="password" class="form-control" placeholder="Password">
			            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
		          	</div>


		            <div class="text-right">
		              	<button type="submit" class="btn btn-primary btn-flat">Login</button>
		            </div><!-- /.col -->
		        </form>

		        
		    </div>
		</div>
	</div>
</div>
<?php  
	$js = "
	<script>
		$('body').addClass('sidebar-collapse');
		$('.sidebar-toggle').remove();
		$('.sidebar-menu li span').remove();
		var engine = '".module."user/ajax.php';
        var module = '".module."';
        var domain = '".domain."';
	</script>
	<script src='".vendor."plugins/jquery-validation/jquery.validate.min.js'></script>

    <script src='".module."user/index.js'></script>
	";
?>