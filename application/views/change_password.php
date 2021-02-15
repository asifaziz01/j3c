<div class="col-md-6">
    <div class="block push-bit">
        <form action="<?php echo site_url("login/change_password");?>" method="post" id="form-login" class="form-horizontal">
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                        <input type="password" id="login-password" name="old_password" class="form-control input-lg" placeholder="Old Password">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                        <input type="password" id="login-password" name="new_password" class="form-control input-lg" placeholder="New Password">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                        <input type="password" id="login-password" name="confirm_password" class="form-control input-lg" placeholder="Confirm Password">
                    </div>
                </div>
            </div>
            <div class="form-group form-actions">
                <div class="col-xs-8 text-right">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Change Password</button>
                </div>
            </div>
            <!--<div class="form-group">
                <div class="col-xs-12 text-center">
                    <a href="javascript:void(0)" id="link-reminder-login"><small>Forgot password?</small></a> -
                    <a href="javascript:void(0)" id="link-register-login"><small>Create a new account</small></a>
                </div>
            </div>-->
        </form>
    </div>
</div>
