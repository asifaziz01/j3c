<div class="row">
  <div class="col-md-6 col-sm-12 col-xs-12">
      <div class="widget box">
        <div class="widget-header">
          <h4 class="title"><?php echo 'Create Brand';?></h4>
        </div>
        <div class="widget-content">
          <?php echo form_open_multipart ('admin/services/appliance_issue/'.$isid.'/'.$appid, array ('class'=>'form-horizontal')); ?>
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
            <label  class="col-md-4 col-sm-12 col-xs-12">Appliance Issue</label>
            <div class="col-md-8 col-sm-12 col-xs-12">
              <input type="text" name="issue" class="form-control" value="<?php echo ($issue)?$issue['issue_title']:'';?>">
            </div>
          </div>
          <div class="form-group">
            <label  class="col-md-4 col-sm-12 col-xs-12">Appliance Price</label>
            <div class="col-md-8 col-sm-12 col-xs-12">
              <input type="text" name="price" class="form-control" value="<?php echo ($issue)?$issue['price']:'';?>">
            </div>
          </div>
          <div class="form-group">
            <label  class="col-md-4 col-sm-12 col-xs-12">Appliance Offer</label>
            <div class="col-md-8 col-sm-12 col-xs-12">
              <input type="text" name="offer_price" class="form-control" value="<?php echo ($issue)?$issue['offer_price']:'';?>">
            </div>
          </div>
          <div class="form-group">
            <label  class="col-md-4 col-sm-12 col-xs-12">Appliance Description</label>
            <div class="col-md-8 col-sm-12 col-xs-12">
              <textarea name="issue_description" class="form-control"><?php echo ($issue)?$issue['description']:'';?></textarea>
            </div>
          </div>
          <div class="form-actions">
              <a class="btn btn-danger" href="<?php echo site_url('admin/services/appliances');?>" >Cancel</a>
              <input type="submit" class="btn btn-primary pull-right"  name="submit" value="<?php echo ($isid)?'Update':'Create New';?>">
          </div>
          <?php echo form_close (); ?>
        </div>
      </div>
  </div>
  <?php
  $allissues = $this->appliance_m->get_issues();
  ?>
  <div class="col-md-6 col-sm-12 col-xs-12">
    <div class="widget box">
      <div class="widget-content">
        <table  class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
          <thead>
            <tr>
            <th data-class="expand">#</th>
            <th data-class="expand">Issue</th>
            <th data-hide="phone,tablet">Category</th>
            <th data-class="expand">Appliance</th>
            <th data-hide="phone,tablet">Action</th>
            </tr>
          </thead>
          <tbody>
          <?php
          if($allissues){
            foreach($allissues as $issue){
              $app = $this->appliance_m->get_appliance($issue['appliance_id']);
              $cat = $this->appliance_m->get_categories($app['category_id']);
              echo '<tr>';
              echo '<td></td>';
              echo '<td>'.$issue['issue_title'].'</td>';
              echo '<td>'.$cat['title'].'</td>';
              echo '<td>'.$app['appliance_name'].'</td>';
              echo '<td><a href="'.site_url('admin/services/appliance_issue/'.$issue['issue_id'].'/'.$issue['appliance_id']).'" class="btn btn-xs btn-success"><i class="icon-pencil"></i></a></td>';
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