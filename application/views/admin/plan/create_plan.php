<div class="row">
  <div class="col-md-12">
      <div class="widget box">
        <div class="widget-header">
          <h4 class="title">Create New Plan</h4>
        </div>
        <?php echo form_open_multipart ('admin/plan/create_plan', array ('class'=>'form-horizontal')); ?>
          <div class="widget-content">
            <div class="form-group">
                <label class="level-control col-md-3 col-sm-12 col-xs-12">Plan Type</label>
                <div class="col-md-9 col-sm-12 col-xs-12">
                  <select name="type" class="form-control">
                    <option value="1">Job Hour</option>
                    <option value="2">No. of Jobs</option>
                  </select>
                </div>
            </div>
		        <div class="form-group">
                <label class="level-control col-md-3 col-sm-12 col-xs-12">Plan Title</label>
                <div class="col-md-9 col-sm-12 col-xs-12">
                  <input type="text" class="form-control required"  name="title" value="<?php //echo set_value ($_POST['title']); ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="level-control col-md-3 col-sm-12 col-xs-12">Plan Amount</label>
                <div class="col-md-9 col-sm-12 col-xs-12">
                  <input type="text" class="form-control required"  name="amount" value="<?php //echo set_value ($_POST['amount']); ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="level-control col-md-3 col-sm-12 col-xs-12">Hour/No. of Jobs</label>
                <div class="col-md-9 col-sm-12 col-xs-12">
                  <input type="text" class="form-control required"  name="hour" value="<?php //echo set_value ($_POST['hour']); ?>">
                </div>
            </div>
            <div class="form-actions">
              <input type="submit" class="btn btn-primary pull-right"  name="submit" value="Create">
              <a class="btn btn-danger" href="<?php echo site_url('admin/plan/index');?>" >Cancel</a>
            </div>
          </div>
        <?php echo form_close (); ?>
      </div>
  </div>
</div>
