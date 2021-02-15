<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path').'plugins/bootstrap-wysihtml5/wysihtml5.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path').'plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.min.js');?>"></script>

<div class="row">
  <div class="col-md-8">
      <div class="widget box">
        <div class="widget-header">
          <h4 class="title"><?php echo $page_title;?></h4>
        </div>
        <div class="widget-content">
          <?php echo form_open_multipart ('admin/services/edit_appliance/'.$cid.'/'.$appliance_id, array ('class'=>'form-horizontal')); ?>
          <div class="form-group">
            <label  class="col-md-4 col-sm-12 col-xs-12">Appliance Logo</label>
            <div class="col-md-5 col-sm-8 col-xs-8">
              <input type="file" class="form-control required"  name="logo" value="">
            </div>
            <div class="col-md-3 col-sm-4 col-xs-4">
              <img width="50px" src="<?php echo base_url($this->config->item('template_path').'images/'.$appliance['icon']);?>" />
            </div>
          </div>
          <div class="form-group">
            <label  class="col-md-4 col-sm-12 col-xs-12">Appliance Category</label>
            <div class="col-md-8 col-sm-12 col-xs-12">
              <?php
              echo '<select name="app_cat" class="form-control">';
              if($category){
                foreach($category as $cat){
                  $selected = ($cid==$cat['id'])?'selected="selected"':'';
                  echo '<option value="'.$cat['id'].'" '.$selected.'>'.$cat['title'].'</option>';
                }
              }
              echo '</select>';
              ?>
            </div>
          </div>
          <div class="form-group">
            <label  class="col-md-4 col-sm-12 col-xs-12">Appliance Name</label>
            <div class="col-md-8 col-sm-12 col-xs-12">
              <input type="text" class="form-control required"  name="appliance_name" value="<?php echo set_value ('appliance_name', $appliance['appliance_name']); ?>">
            </div>
          </div>
          <div class="form-group">
            <label  class="col-md-4 col-sm-12 col-xs-12">Service Type</label>
            <div class="col-md-8 col-sm-12 col-xs-12">
              <select name="service_type" class="form-control">
                <option value="1" <?php echo ($appliance['service_type']==1)?'selected="selected"':'';?> >Job Hour</option>
                <option value="2" <?php echo ($appliance['service_type']==2)?'selected="selected"':'';?> >No. of Jobs</option>
              </select>
            </div>
          </div>
          <!--<div class="form-group">
            <label  class="col-md-4 col-sm-12 col-xs-12">Content Heading</label>
            <div class="col-md-8 col-sm-12 col-xs-12">
              <input type="text" class="form-control" name="heading_content" value="<?php echo $appliance['head_content'];?>" />
            </div>
          </div>
          <div class="form-group">
            <label  class="col-md-4 col-sm-12 col-xs-12">Content Points</label>
            <div class="col-md-8 col-sm-12 col-xs-12">
              <textarea class="form-control wysiwyg" name="content" rows="8"><?php echo $appliance['content'];?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label  class="col-md-4 col-sm-12 col-xs-12">Body Content</label>
            <div class="col-md-8 col-sm-12 col-xs-12">
              <textarea class="form-control wysiwyg" name="body_content" rows="8"><?php echo $appliance['body_content'];?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label  class="col-md-4 col-sm-12 col-xs-12">Content Image</label>
            <div class="col-md-5 col-sm-8 col-xs-8">
              <input type="file" name="img" value="" />
            </div>
            <div class="col-md-3 col-sm-4 col-xs-4">
              <img width="50px" src="<?php echo base_url($this->config->item('filemanager').'content_image/'.$appliance['body_content_image']);?>" />
            </div>
          </div>-->
          <div class="form-actions">
              <a class="btn btn-danger" href="<?php echo site_url('admin/services/appliances');?>" >Cancel</a>
              <input type="submit" class="btn btn-primary pull-right"  name="submit" value="Update Details">
          </div>
          <?php echo form_close (); ?>
        </div>
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