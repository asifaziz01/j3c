	<div class="col-md-6">
    <div class="panel panel-default">
    	<div class="panel-heading" ><h4>Change Password</h4></div>
        <div class="panel-body">
		 <?php echo form_open("admin/user/change_password/", ['onsubmit'=>'return myFunction()', 'class'=>'form-horizontal']);?>
            <div class="col-md-3 corm_nmset">
                <div><strong class="right_sre"></strong></div>
            </div>
            <div style="clear: left;"></div>
            <div class="col-md-4 corm_nmset">
                Current Password
            </div>
            <div class="col-md-8 corm_nmset">
                <input type="password" name="old_password" value="" class="form-control" />
            </div>
                <div class="clearfix"></div>
                <hr style="margin:5px 0 5px 0;">
            <div class="col-md-4 corm_nmset">
                New Password
            </div>
            <div class="col-md-8 corm_nmset">
                <input type="password" name="new_password" value="" class="form-control" />
            </div>
                <div class="clearfix"></div>
                <hr style="margin:5px 0 5px 0;">
            <div class="col-md-4 corm_nmset">
                Confirm Password
            </div>
            <div class="col-md-8 corm_nmset">
                <input type="password" name="confirm_password" value="" class="form-control" />
            </div>
                <div class="clearfix"></div>
                <hr style="margin:5px 0 5px 0;">
            <div style="margin-left: 27%;">
                <?php 
                echo form_submit(['name'=>'submit','value'=>'Update Password', 'class'=>'btn btn-danger']); ?>
            </div>
            <div style="clear: left;"></div>
        </form>
        </div>
    </div>
	</div>
</div>