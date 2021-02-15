<div class="row justify-content-center">
  <div class="col-md-12">
    <div class="widget box">
        <div class="widget-header">
          <h4 class="title">Update Plan</h4>
        </div>
        <?php echo form_open_multipart ('admin/plan/edit_plan/'.$id, array ('class'=>'form-horizontal')); ?>
          <div class="widget-content">
            <div class="form-group">
                <label class="col-md-4 col-sm-12 col-xs-12">Plan Type</label>
                <div class="col-md-8 col-sm-12 col-xs-12">
                  <select name="type" class="form-control">
                    <option value="1">Job Hour</option>
                    <option value="2">No. of Jobs</option>
                  </select>
                </div>
            </div>
        		<div class="form-group">
                <label class="col-md-4 col-sm-12 col-xs-12">Plan Title</label>
                <div class="col-md-8 col-sm-12 col-xs-12">
                  <input type="text" class="form-control required"  name="title" value="<?php echo $plan['title']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 col-sm-12 col-xs-12">Plan Amount</label>
                <div class="col-md-8 col-sm-12 col-xs-12">
                  <input type="text" class="form-control required"  name="amount" value="<?php echo $plan['amount']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 col-sm-12 col-xs-12">Hour/No. of Jobs</label>
                <div class="col-md-8 col-sm-12 col-xs-12">
                  <input type="text" class="form-control required"  name="hour" value="<?php echo $plan['hour']; ?>">
                </div>
              </div>
            <div class="form-actions">
              <input type="submit" class="btn btn-primary pull-right"  name="submit" value="Update Plan">
              <a class="btn btn-danger" href="<?php echo site_url('admin/plan/index');?>" >Cancel</a>
            </div>
        </div>
      </div>
    <?php echo form_close (); ?>
  </div>
</div>
