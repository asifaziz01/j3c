<div class="row">
  <div class="col-md-6">
      <div class="widget box">
        <div class="widget-header">
          <h4 class="title"><?php echo $page_title;?></h4>
        </div>
        <div class="widget-content">
          <?php echo form_open_multipart ('admin/services/add_appliance', array ('class'=>'form-horizontal')); ?>
          <div class="form-group">
            <label  class="col-md-4 col-sm-12 col-xs-12">Appliance Logo</label>
            <div class="col-md-8 col-sm-12 col-xs-12">
              <input type="file" class="form-control required"  name="logo" value="">
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
              <input type="text" class="form-control required"  name="appliance_name" value="<?php echo ($_POST)?$_POST['appliance_name']:'';?>">
            </div>
          </div>
          <div class="form-group">
            <label  class="col-md-4 col-sm-12 col-xs-12">Service Type</label>
            <div class="col-md-8 col-sm-12 col-xs-12">
              <select name="service_type" class="form-control">
                <option value="1" >Job Hour</option>
                <option value="2" >No. of Jobs</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label  class="col-md-4 col-sm-12 col-xs-12">Slider Content</label>
            <div class="col-md-8 col-sm-12 col-xs-12">
              <textarea class="form-control editor" name="content" rows="8"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label  class="col-md-4 col-sm-12 col-xs-12">Heading</label>
            <div class="col-md-8 col-sm-12 col-xs-12">
              <input type="text" class="form-control" name="heading_content" value="" />
            </div>
          </div>
          <div class="form-group">
            <label  class="col-md-4 col-sm-12 col-xs-12">Body Content</label>
            <div class="col-md-8 col-sm-12 col-xs-12">
              <textarea class="form-control editor" name="body_content" rows="8"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label  class="col-md-4 col-sm-12 col-xs-12">Content Image</label>
            <div class="col-md-5 col-sm-8 col-xs-8">
              <input type="file" name="img" value="" />
              <small>Image size should max-height = 594, max-width = 365</small>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-4">
              <img width="50px" src="<?php echo '';?>" />
            </div>
          </div>
          <div class="form-actions">
              <a class="btn btn-danger" href="<?php echo site_url('admin/services/appliances');?>" >Cancel</a>
              <input type="submit" class="btn btn-primary pull-right"  name="submit" value="Create New">
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
<script type="text/javascript" src="<?php echo site_url($this->config->item('backend_path').'assets/js/tinymce.min.js');?>"></script>
<script>
tinymce.init({
    selector:'.editor',
    menubar: false,
    statusbar: false,
    plugins: 'autoresize anchor autolink charmap code codesample directionality fullpage help hr image imagetools insertdatetime link lists media nonbreaking pagebreak preview print searchreplace table template textpattern toc visualblocks visualchars',
    toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | removeformat help fullscreen ',
    skin: 'bootstrap',
    toolbar_drawer: 'floating',
    min_height: 150,           
    max_height: 300,           
    autoresize_bottom_margin: 16,
    setup: (editor) => {
        editor.on('init', () => {
            editor.getContainer().style.transition="border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out"
        });
        editor.on('focus', () => {
            editor.getContainer().style.boxShadow="0 0 0 .2rem rgba(0, 123, 255, .25)",
            editor.getContainer().style.borderColor="#80bdff"
        });
        editor.on('blur', () => {
            editor.getContainer().style.boxShadow="",
            editor.getContainer().style.borderColor=""
        });
    }
});
</script>