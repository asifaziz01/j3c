<br clear="all" />
<style>
@media screen 
  and (min-device-width: 1200px) 
  and (max-device-width: 1600px) 
  and (-webkit-min-device-pixel-ratio: 1) { 
	.login-box{
		width:40%;
		border:1px solid #CCC;
		margin-bottom:25px;
		margin:0 auto 25px;
	}
	.login-box h2{
		background-color:#000;
		color:#fff;
	}
}
@media screen 
  and (device-width: 360px) 
  and (device-height: 640px) 
  and (-webkit-device-pixel-ratio: 2) { 
	.login-box{
		width:90%;
		border:1px solid #CCC;
		margin-bottom:25px;
		padding-top:0px;
		margin:0 auto 25px;
	}
	.login-box h2{
		background-color:#000;
		color:#fff;
	}
}
</style>
<div id="notificationMSG" class="row mbl col-md-12" style="position:absolute; margin:auto; z-index:1100;">
	<?php echo (validation_errors())? '<div class="alert alert-danger fade in"><button class="close" aria-hidden="true" data-dismiss="alert" type="button"><i class="fa fa-times-circle"></i></button>
		<i class="icon-remove close" data-dismiss="alert"></i> '.validation_errors().'</div>' : '';
			
		// User generated messages
		
		$this->message->display();
	?>
</div>
<script>
	setTimeout(function() {
	$('#notificationMSG').fadeOut('fast');
	}, 8000);
</script>
<section class="service">
	<div class="container text-center">
		<div class="row">
			<div class="login-box">
				<h2><i class="fa fa-lock"></i> <?php echo $page_title;?></h2>
				<form class="form_horizontal" method="post" action="<?php echo site_url("login/admin_login_user/".STATUS_ADMIN);?>">
					<!--<div class="row align-items-center " style="border:1px solid">-->
					<div class="col-md-11 form-group">
							<input type="text" class="form-control" id="name" name="login" placeholder="User ID">
						</div>
						<div class="col-md-11 form-group">
							<input type="password" class="form-control" id="password" name="password" placeholder="Password">
						</div>
						<div class="col-md-11 text-center">
							<button class="btn btn-primary btn-shadow btn-lg" type="submit" name="submit">Login</button>
						</div>
						<!--<div class="col-md-6 text-left">
							<a href="javascript:void(0);" onclick="getData('<?php echo site_url("login/registration");?>','formDiv');" class="btn btn-danger pull-left">New Registration</a>
						</div>
						<div class="col-md-6 text-right">
							<a href="javascript:void(0);" class="btn btn-success pull-left">Forgot Password</a>
						</div>-->
					<!--</div>-->
					<br clear="all" />
					<div class="form-footer">
						<p class="message">Not registered? <a href="#">Create an account</a></p>
						<br clear="all" />
						<p class="message"><a href="<?php echo site_url("login/forget_password");?>">Forgot Password</a></p>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function submit(form){
		document.getElementById(form).submit();	
	}
	$('.message a').click(function(){
	   $('.anim').animate({height: "toggle", opacity: "toggle"}, "slow");
	});
</script>