<div class="row">
  <div class="col-md-6 col-sm-12 col-xs-12">
      <div class="widget box">
        <div class="widget-header">
          <h4 class="title"><?php echo 'Create Brand';?></h4>
        </div>
        <div class="widget-content">
          <?php echo form_open_multipart ('admin/services/brand/'.$bid.'/'.$appid, array ('class'=>'form-horizontal')); ?>
          <div class="form-group">
            <label  class="col-md-4 col-sm-12 col-xs-12">Appliance Category</label>
            <div class="col-md-8 col-sm-12 col-xs-12">
              <select name="app_cat" class="form-control" onchange="get_appliances(this.value)" >
              <?php
              if($category){
                echo '<option value="">Select category</option>';
                foreach($category as $cat){
                  $selected = ($appid && $appliance['category_id']==$cat['id'])?'selected="selected"':'';
                  echo '<option value="'.$cat['id'].'" '.$selected.'>'.$cat['title'].'</option>';
                }
              }
              ?>
              </select>            
            </div>
          </div>
          <div class="form-group">
            <label  class="col-md-4 col-sm-12 col-xs-12">Appliances</label>
            <div class="col-md-8 col-sm-12 col-xs-12">
              <select name="appliance" class="form-control">
              <?php
              if($appliance){
                $appliances = $this->appliance_m->get_appliances($appliance['category_id']);
                echo '<option value=""> Select Appliance</option>';
                foreach($appliances as $aplnc){
                  $selected = ($appid==$aplnc['appliance_id'])?'selected="selected"':'';
                  echo '<option value="'.$aplnc['appliance_id'].'" '.$selected.'> '.$aplnc['appliance_name'].'</option>';
                }
              }
              ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label  class="col-md-4 col-sm-12 col-xs-12">Brand</label>
            <div class="col-md-8 col-sm-12 col-xs-12">
              <input type="text" name="brand" class="form-control" value="<?php echo ($brand)?$brand['brand_name']:'';?>">
            </div>
          </div>
          <div class="form-actions">
              <a class="btn btn-danger" href="<?php echo site_url('admin/services/appliances');?>" >Cancel</a>
              <input type="submit" class="btn btn-primary pull-right"  name="submit" value="<?php echo ($bid)?'Update':'Create New';?>">
          </div>
          <?php echo form_close (); ?>
        </div>
      </div>
  </div>
  <?php
  $allbrands = $this->appliance_m->get_brands();
  ?>
  <div class="col-md-6 col-sm-12 col-xs-12">
    <div class="widget box">
      <div class="widget-content">
        <table  class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
          <thead>
            <tr>
            <th data-class="expand">#</th>
            <th data-class="expand">Brand</th>
            <th data-hide="phone,tablet">Category</th>
            <th data-class="expand">Appliance</th>
            <th data-hide="phone,tablet">Action</th>
            </tr>
          </thead>
          <tbody>
          <?php
          if($allbrands){
            foreach($allbrands as $brand){
              $app = $this->appliance_m->get_appliance($brand['appliance_id']);
              $cat = $this->appliance_m->get_categories($app['category_id']);
              echo '<tr>';
              echo '<td></td>';
              echo '<td>'.$brand['brand_name'].'</td>';
              echo '<td>'.$cat['title'].'</td>';
              echo '<td>'.$app['appliance_name'].'</td>';
              echo '<td><a href="'.site_url('admin/services/brand/'.$brand['brand_id'].'/'.$brand['appliance_id']).'" class="btn btn-xs btn-success"><i class="icon-pencil"></i></a></td>';
              echo '</tr>';
            }
          }
          ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
function get_appliances(cat){
  $.get('<?php echo site_url('admin/services/appliances_options/');?>'+cat,function(data,status){
    if(status=='success'){
      $('select[name=appliance]').html(data)
    }else{
      alert('error in file loading!!!!')
    }
  })
}
</script>