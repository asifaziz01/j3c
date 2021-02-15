<div class="row">
  <div class="col-md-6">
      <div class="widget box">
        <div class="widget-header">
          <h4 class="title"><?php echo $page_title;?></h4>
        </div>
        <?php echo form_open_multipart ('admin/services/create_category', array ('class'=>'form-horizontal')); ?>
        <div class="widget-content">
          <input type="hidden" name="iconname" value="" />
          <div class="form-group">
                <label class="col-md-4 col-sm-12 col-xs-12">Title</label>
                <div class="col-md-8 col-sm-12 col-xs-12">
                  <input type="text" class="form-control required"  name="title" value="<?php //echo set_value ($_POST['title']); ?>">
                </div>
            </div>
		        <div class="form-group">
                <label class="col-md-4 col-sm-12 col-xs-12">Icon</label>
                <div class="col-md-8 col-sm-12 col-xs-12">
                  <input type="file" name="icon" onchange="getName(this)" class="required" accept="image/*" data-style="fileinput" data-inputsize="medium">
                  <p class="help-block">Images only (image/*)</p>
                  <label for="file1" class="has-error help-block" generated="true" style="display:none;"></label>
                </div>
            </div>
            <div class="form-actions">
                <a class="btn btn-danger" href="<?php echo site_url('admin/services/applianceCategory');?>" >Cancel</a>
                <input type="submit" class="btn btn-primary pull-right"  name="submit" value="Create New">
            </div>
        </div>
        <?php echo form_close (); ?>
      </div>
  </div>
</div>
<script>
$(document).ready(function() { 
    $('input[type="file"]').change(function(e) { 
        var filename = e.target.files[0].name; 
      $('input[name=iconname]').val(filename)
    }); 
}); 
</script>