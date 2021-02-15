<style>
@media screen 
  and (min-device-width: 1200px) 
  and (max-device-width: 1600px) 
  and (-webkit-min-device-pixel-ratio: 1) { 
	.login-box{
		float:left;
		width:40%;
		border:1px solid #080D22;
		margin-bottom:25px;
		padding-top:0px;
		margin:0 auto 25px;
		border-radius: 10px;
	}
	.registor-box{
		float:right;
		width:55%;
		border:1px solid #080D22;
		margin-bottom:25px;
		padding-top:0px;
		padding-bottom:25px;
		margin:0 auto 25px;
		border-radius: 10px;
	}
}
@media screen 
  and (device-width: 360px) 
  and (device-height: 640px) 
  and (-webkit-device-pixel-ratio: 2) {
	.login-box{
		width:90%;
		border:1px solid #286090;
		padding-top:25px;
		margin:0 auto 25px;
		margin-bottom:50px;
		border-radius: 10px;
	}
	.registor-box{
		width:90%;
		border:1px solid #286090;
		margin-left:5px;
		margin-bottom:25px;
		padding-top:25px;
		margin:0 auto 25px;
		border-radius: 10px;
	}
}
.registor-box h2,.login-box h2{
	background-color:#080D22;
	color:#fff;
	margin-top:0px;
	margin-bottom:40px;
	padding:8px 0 8px 0;
	text-transform:uppercase;
	border-radius: 10px 10px 0 0;
}
</style>
<section class="service" style="padding-top:50px;">
	<div class="container text-center">
		<div class="row">
			<div id="notificationMSG" class="col-md-12 col-sm-12 col-xs-12" style="position:absolute; margin:auto; z-index:1100;">
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
			<div class="login-box">
				<form class="form_horizontal" method="post" action="<?php echo site_url("login/login_user");?>">
					<h2>Login</h2>
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
			<div class="registor-box">
				<form class="form_horizontal" method="post" action="<?php echo site_url("login/register_tech");?>">
					<h2>Register For Technician</h2>
					<!--<div class="row align-items-center " style="border:1px solid">-->
						<div class="col-md-11 form-group">
							<?php
							$tech_categories = $this->login_m->get_technician_categories ();
							?>
							<select name="category" id="" class="form-control">
							<option value="0">Select Category</option>
							<?php
								if (! empty ($tech_categories)) {
									foreach ($tech_categories as $cat) {
										?>
										<option value="<?php echo $cat['id']; ?>" ><?php echo $cat['title']; ?></option>
										<?php
									}						
								}
							?>
							</select>
						</div>
						<div class="col-md-11 form-group">
							<input type="text" class="form-control" id="uname" name="uname" placeholder="User Name">
						</div>
						<div class="col-md-11 form-group">
							<input type="text" class="form-control" id="mobile" name="mobile" placeholder="User Mobile">
						</div>
						<div class="col-md-11 form-group">
							<input type="text" class="form-control" id="otp" name="otp" placeholder="OTP" style="display:none;">
						</div>
						<div class="col-md-11 text-center">
						<button class="btn btn-primary btn-shadow btn-lg" type="button" name="next" onclick="sendOTP()">Next >></button>
						<button class="btn btn-primary btn-shadow btn-lg" type="button" name="verify" onclick="verifyOTP()" style="display:none;">OTP Verify</button>
						<button class="btn btn-primary btn-shadow btn-lg" type="submit" name="register" style="display:none;">Register</button>
						</div>
						<!--<div class="col-md-6 text-left">
							<a href="javascript:void(0);" onclick="getData('<?php echo site_url("login/registration");?>','formDiv');" class="btn btn-danger pull-left">New Registration</a>
						</div>
						<div class="col-md-6 text-right">
							<a href="javascript:void(0);" class="btn btn-success pull-left">Forgot Password</a>
						</div>-->
					<!--</div>-->
				</form>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	function submit(form){
		document.getElementById(form).submit();	
	}
	$('.message a').click(function(){
	   $('.anim').animate({height: "toggle", opacity: "toggle"}, "slow");
	});
	function sendOTP(){
		var mob = $('#mobile').val()
		var uname = $('#uname').val()
		if(mob){
			$.get("<?php echo site_url('customer/services_actions/sendOTP');?>/"+mob+'/'+uname, function(data, status){
				if(status=='success'){
					$('#otp').css('display','block');
					$('#mobile').attr('readonly',true);
					$('button[name=verify]').css('display','block');
					$('button[name=next]').css('display','none');
				}
			});
		}
	}
	function verifyOTP(){
		var mob = $('#mobile').val()
		var otp = $('#otp').val()
		if(mob && otp){
			$.get("<?php echo site_url('customer/services_actions/verifyOTP');?>/"+mob+'/'+otp, function(data, status){
				if(status=='success'){
					if(!data){
						alert('Invalid OTP, please enter valid OTP or resend OTP.');
            			$('#otp').focus();
					}else{
						$('#otp').attr('readonly',true);
						$('#mobile').attr('readonly',true);
						$('button[name=verify]').css('display','none');
						$('button[name=register]').css('display','block');
						$('button[name=register]').click();
					}
				}
			});
		}
	}
</script>