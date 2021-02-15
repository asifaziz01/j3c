<div class="alert alert-info">Go <a href="<?php echo site_url('admin/user/edit_user/'.$id);?>" style="color:blue;">Back to Technician</a> Profile.</div>
<div class="row justify-content-center">
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="widget box">
            <div class="widget-header">
                <h4 class="title">Select Plan</h4>
            </div>
            <div class="widget-content">
                <?php echo form_open ('admin/plan/recharge_plan/'.$id, array ('class'=>'row-border')); ?>
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <div class="form-group">
                        <?php
                        $plans = $this->plan_m->get_plan();
                        $tech_plan = $this->plan_m->get_technician_plan(false,$id);
                        $tech_plan_type = ($tech_plan && count($tech_plan)>0)?$tech_plan[0]['plan_type']:false;
                        ?>
                        <select class="form-control" name="plan">
                        <option value="">Select Plan</option>
                        <?php
                            if (! empty ($plans)) {
                                foreach ($plans as $plan) {
                                    $disabled = ($tech_plan_type)?(($tech_plan_type==$plan['type'])?false:'disabled="disabled"'):false;
                                    ?>
                                    <option value="<?php echo $plan['id']; ?>" <?php echo $disabled;?> ><?php echo $plan['title']; ?></option>
                                    <?php
                                }						
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <p>Technician : <?php echo $technician['name'];?> </p>
                    </div>
                    <div class="actions-group">
                        <!--<a href="<?php echo site_url('admin/technicians/index');?>" class="btn btn-danger">Cancel</a>-->
                        <input type="submit" class="btn btn-primary" value="Recharge Plan">
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12">
    <div class="widget box">
            <div class="widget-content">
                <table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
                    <thead>
                        <th data-class="expand">#</th>
                        <th data-class="expand">Plan</th>
                        <th data-class="expand">Amount</th>
                        <th data-hide="phone,tablet">Hour</th>
                        <th data-hide="phone,tablet">Date</th>
                        <th data-hide="phone,tablet">Status</th>
                    </thead>
                    <tbody>
                    <?php
                    $technician_plans = $this->plan_m->get_technician_plan(false,$id);
                    if($technician_plans){
                        $sr=1;
                        foreach($technician_plans as $tplan){
                            $plan = $this->plan_m->get_plan($tplan['plan_id']);
                        ?>
                        <tr>
                            <td><?php echo $sr++;?></td>
                            <td><?php echo $plan['title'];?> </td>
                            <td><?php echo $tplan['plan_amount'];?> </td>
                            <td><?php echo $tplan['plan_hour'];?> </td>
                            <td><?php echo date('d M Y H:i:s',strtotime($tplan['plan_date']));?></td>
                            <td></td>
                        </tr>
                        <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>