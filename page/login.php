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
		        <form action="../../index2.html" method="post">
		          	<div class="form-group has-feedback">
			            <input type="Username" class="form-control" placeholder="Email">
			            <span class="glyphicon glyphicon-user form-control-feedback"></span>
		          	</div>
		          	<div class="form-group has-feedback">
			            <input type="password" class="form-control" placeholder="Password">
			            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
		          	</div>


		            <div class="text-right">
		              	<button type="submit" class="btn btn-primary btn-flat">Sign In</button>
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
	</script>
	";
?>