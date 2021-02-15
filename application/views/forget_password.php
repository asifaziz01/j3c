<div class="main">
	<div id="notificationMSG" class="row mbl col-md-8" style="position:absolute; margin:auto; z-index:1100;">
		<?php echo (validation_errors())? '<div class="alert alert-danger fade in">
               <i class="icon-remove close" data-dismiss="alert"></i> '.validation_errors().'</div>' : '';
                
              // User generated messages
            
            $this->message->display();
        ?>
    </div>
    <div class="login-page" style="padding-top:0px; padding-bottom:0px;">
      <div class="form">
        <form class="moto-widget-contact_form-form" method="post" id="registrationForm" name="registrationForm" action="<?php echo site_url("login/forget_password");?>">
            <h3 class="title">Forget Password</h3>
            <label class="moto-widget-contact_form-label">Enter Your Login</label>
            <input type="text" value="" placeholder="Login Id" name="login">
            <button>Send Code</button>
        </form>
        </div>
    </div>
</div>
<script>
function submit(form){
	document.getElementById(form).submit();
}
</script>