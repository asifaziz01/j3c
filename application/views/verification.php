<div class="main">
	<div id="notificationMSG" class="row mbl col-md-8" style="position:absolute; margin:auto; z-index:1100;">
		<?php echo (validation_errors())? '<div class="alert alert-danger fade in">
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
    <div class="login-page" style="padding-top:0px; padding-bottom:0px;">
      <div class="form">
        <form class="moto-widget-contact_form-form" method="post" id="registrationForm" name="registrationForm" action="<?php echo site_url("login/verification/".$id);?>">
            <label>Enter Code</label>
            <input type="hidden" value="<?php echo $id;?>" class="" name="id">
            <input type="text" value="" placeholder="Enter verification code" name="vcode">
            <button>Verify Now</button>
            <br clear="all" />
            <a href="<?php echo site_url("login/forget_password");?>" style="font-size:14px;">Re-Send Code</a>
        </form>
    </div>
</div>
<script>
function submit(form){
	document.getElementById(form).submit();
}
</script>