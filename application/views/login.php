<style>
@media screen 
  and (min-device-width: 1200px) 
  and (max-device-width: 1600px) 
  and (-webkit-min-device-pixel-ratio: 1) { 
	.login-box{
		background-color:#FFF;
		float:left;
		width:40%;
		border:1px solid #CCC;
		margin-bottom:25px;
		padding-top:0px;
		margin:0 auto 25px;
		border-radius: 10px;
	}
	.registor-box{
		background-color:#FFF;
		float:right;
		width:55%;
		border:1px solid #CCC;
		margin-bottom:25px;
		padding-top:0px;
		padding-bottom:25px;
		margin:0 auto 25px;
		border-radius: 10px;
	}
}
@media screen 
  and (min-device-width: 360px) 
  and (max-device-width: 640px)
  and (-webkit-min-device-pixel-ratio: 2) {
	.login-box{
		background-color:#FFF;
		width:95%;
		border:1px solid #CCC;
		padding-top:0px;
		padding-bottom:15px;
		margin:0 auto 25px;
		margin-bottom:50px;
		border-radius: 10px;
	}
	.registor-box{
		background-color:#FFF;
		width:95%;
		border:1px solid #CCC;
		margin-left:5px;
		margin-bottom:25px;
		padding-top:0px;
		padding-bottom:15px;
		margin:0 auto 25px;
		border-radius: 10px;
	}
}
.registor-box h2,.login-box h2{
	background-color:#E57624;
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
					<input type="hidden" name="auth_type" value="1">
					<h2>Login</h2>
					<div class="msg"></div>
					<div class="form-group">
						<div class="col-6 text-left pull-left">
							<label for="" class="label-control"><input checked type="radio" name="user_type" value="<?php echo STATUS_CUSTOMER;?>" /> Customer</label>
						</div>
						<div class="col-6 text-left pull-left">
							<label for="" class="label-control"><input type="radio" name="user_type" value="<?php echo STATUS_TECHNICIAN;?>" /> Technician</label>
						</div>
						<br clear="all"/>
					</div>
					<!--<div class="row align-items-center " style="border:1px solid">-->
					<div id="loginParent" class="col-md-11 form-group">
						<input type="text" class="form-control" id="login" name="login" placeholder="Mobile No">
					</div>
					<div id="otpParent" class="col-md-11 form-group hidden">
						<input type="text" class="form-control" id="lotp" name="otp" placeholder="OTP">
					</div>
					<div id="nxt" class="col-md-11 text-center">
						<button class="btn btn-primary btn-shadow btn-lg" onclick="sendOTP()" type="button" name="next">Next</button>
					</div>
					<div id="submit" class="col-md-11 hidden">
						<div class="col-md-4 col-sm-4 col-xs-4">
							<a id="bck" class="btn btn-lg btn-danger btn-shadow">Back</a>&nbsp;&nbsp;
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4">
							<a id="resend" class="btn btn-lg btn-warning btn-shadow">Resend</a>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4">
							<button class="btn btn-primary btn-shadow btn-lg pull-right" type="submit" disabled name="submit">Login</button>
						</div>
					</div>
						<!--<div class="col-md-6 text-left">
							<a href="javascript:void(0);" onclick="getData('<?php echo site_url("login/registration");?>','formDiv');" class="btn btn-danger pull-left">New Registration</a>
						</div>
						<div class="col-md-6 text-right">
							<a href="javascript:void(0);" class="btn btn-success pull-left">Forgot Password</a>
						</div>-->
					<!--</div>-->
					<!--<br clear="all" />
					<div class="form-footer">
						<p class="message">Not registered? <a href="#">Create an account</a></p>
						<br clear="all" />
						<p class="message"><a href="<?php echo site_url("login/forget_password");?>">Forgot Password</a></p>
					</div>-->
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
			$.get("<?php echo site_url('main/sendOTP');?>/"+mob+'/'+uname, function(data, status){
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
			$.get("<?php echo site_url('main/verifyOTP');?>/"+mob+'/'+otp, function(data, status){
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
<script>
  $('#login').on('input', function(e){
    var key = e.which || this.value.substr(-1).charCodeAt(0);
    if( key < 48 || key > 57){
      alert('Only numeric value allowed.');
      this.value='';
    }else{
      if(this.value.length==10){
          $('#loader').css("display","block");
		  if($('input[name=auth]').checked){
			$('input[name=mobile]').load('<?php echo site_url('main/sendOTP');?>/'+this.value, function(responseTxt, statusTxt, xhr){
				$('#loader').css("display","none");
				if(statusTxt == "success"){
					if(!responseTxt){
						this.value='';
						this.focus();
						alert('try again.');
					}else{
						//$('input[name=mobile]').attr("readonly",true);
						$('#loginParent').attr('class','col-md-11 form-group hidden');
						$('input[name=auth_type]').val('1');
						$('#authType').attr('class','col-md-11 form-group hidden');						
						$('#nxt').attr('class','col-md-11 form-group hidden');
						$('#submit').attr('class','col-md-11 form-group');
						$('#otpParent').attr('class','col-md-11 form-group');
						$('input[name=otp]').attr("disabled",false);
						$('input[name=otp]').focus();
					}
				}
				if(statusTxt == "error"){
				alert('Message Not Send. Please contact your service provider.');
				}
			});
		  }else{
			$('#loader').css("display","none");
			$('#loginParent').attr('class','col-md-11 form-group hidden');
			$('input[name=auth_type]').val('');
			$('#authType').attr('class','col-md-11 form-group hidden');
			$('#nxt').attr('class','col-md-11 form-group hidden');
			$('#submit').attr('class','col-md-11 form-group');
			$('#passText').attr('class','col-md-11 form-group');
			$('#passText').css('display','block');
			$('#passText').focus();
		  }
      }
    }
  });
  $('#lotp').on('input', function(e){
    if(this.value.length==6){
      $('#loader').css("display","block");
      $('input[name=otp]').load('<?php echo site_url('main/verifyOTP');?>/'+ $('#login').val() +'/'+ this.value, function(responseTxt, statusTxt, xhr){
		if(statusTxt == "success"){
			$('#loader').css("display","none");
			if(!responseTxt){
				alert('Invalid OTP, please enter valid OTP or resend OTP.');
            	this.focus();
			}else{
				$('.msg').html('<div class="alert alert-success">OTP verify!</div>');
      			$('button[name=submit]').prop('disabled',false);
				//$('input[name=make_payment]').attr('disabled',false);
			}
		}
		if(statusTxt == "error"){
			$('#loader').css("display","none");
			alert('Something wrong in Proccessing. Please contact your service provider.');
		}
	  });
    }
  });
  $('#bck').on('click',function(e){
	$('#loginParent').attr('class','col-md-11 form-group');
	$('#passText').attr('class','col-md-11 form-group hidden');
	$('#authType').attr('class','col-md-11 form-group');
	$('#nxt').attr('class','col-md-11 form-group');
	$('#submit').attr('class','col-md-11 form-group hidden');
	$('#otpParent').attr('class','col-md-11 form-group hidden');
  });
  $('#nxt').on('click',function(e){
	if($('input[name=auth]').checked==true){alert('ok')
		$('#otpParent').attr('class','col-md-11 form-group');
		$('input[name=otp]').attr("disabled",false);
		$('input[name=otp]').focus();		
		$('#passText').attr('class','col-md-11 form-group hidden');
		$('#authType').attr('class','col-md-11 form-group hidden');
	}else{
		$('#otpParent').attr('class','col-md-11 form-group hidden');
		$('#passText').attr('class','col-md-11 form-group ');
		$('#authType').attr('class','col-md-11 form-group hidden');
	}
	$('#loginParent').attr('class','col-md-11 form-group hidden');
	$('#nxt').attr('class','col-md-11 form-group hidden');
	$('#submit').attr('class','col-md-11 form-group');
  });
  $('#resend').on('click',function(e){
	$('#loader').css("display","block");
	$.get('<?php echo site_url('main/sendOTP');?>/'+$('#login').val(), function(responseTxt, statusTxt, xhr){
		$('#loader').css("display","none");
		if(statusTxt == "success"){
			if(!responseTxt){
				this.value='';
				this.focus();
				alert('try again.');
			}else{
				$('input[name=otp]').focus();
			}
		}
		if(statusTxt == "error"){
			alert('Message Not Send. Please contact your service provider.');
		}
	});
  });
</script>
