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
        <form method="post" id="registrationForm" name="registrationForm" action="<?php echo site_url("login/create_new_password/".$id);?>">
            <div class="sform-group">
                <label class="moto-widget-contact_form-label">New Password</label>
                <input type="hidden" value="<?php echo $id;?>" class="" name="id">
                <input type="password" value="" placeholder="New Password" name="password">
            </div>
            <div class="form-group">
                <label class="moto-widget-contact_form-label">Confirm Password</label>
                <input type="password" value="" placeholder="Confirm Password" name="re_password">
                <button>Create New Password</button>
            </div>
        </form>
      </div>
   	</div>
</div>
<script>
function submit(form){
	document.getElementById(form).submit();
}
</script>