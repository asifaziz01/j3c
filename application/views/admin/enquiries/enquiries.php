<?php
$technician_plan = $this->enquiry_m->get_technician_plan(false,$this->session->userdata('id'));
$tech_locations = $this->enquiry_m->getTechnicianLocations($this->session->userdata('id'));
$tech_appliance = $this->enquiry_m->getTechnicianAppliances($this->session->userdata('id'));
$tech_plan_type = ($technician_plan)?$technician_plan[0]['plan_type']:false;

$leftDuration=0; $planActive=false; $msgText='You have not any plan, please perchase a plan.';
$me = $this->user_m->getUser($this->session->userdata('id'),array('status'=>STATUS_TECHNICIAN));

if($tech_plan_type){
    if($tech_plan_type==1){
        $totalDuration=0;$userDuration=0;
        if($technician_plan){
            foreach($technician_plan as $techPlan){
                $totalDuration += $techPlan['plan_hour'];
            }
            $totalDuration = $this->default_m->hour2time($totalDuration);
        }

        if($enquiries){
            $timeArray=false;
            foreach($enquiries as $encr){
                if($encr['technician_id']==$this->session->userdata('id') && $encr['status']=='2'){
                    $timeArray[] = $encr['work_hour'];
                    //$userDuration +=$encr['work_hour'];
                }
            }
           $userDuration = (!$timeArray)?0:((count($timeArray)>1)?$this->default_m->sum_the_time($timeArray):$timeArray[0]);
           $userDuration = $this->default_m->hour2time($userDuration);
        }
        if($this->default_m->compare_time($totalDuration,$userDuration,'<')){
            $planActive=true;
        }else{
            $msgText='Exeed your limit! You need get a plan.';
        }
    }else{
        $plan = $this->plan_m->get_plan($technician_plan[(count($technician_plan)-1)]['plan_id']);
        if($enquiries){
            $no_of_job=0;
            foreach($enquiries as $encr){
                if($encr['technician_id']==$this->session->userdata('id') && date('d-m-Y',$encr['pick_date'])==date('d-m-Y')){
                    $no_of_job +=1;
                }
            }
        }

        if($no_of_job < $plan['hour']){
            $planActive=true;
        }else{
            $msgText='Exeed your limit! Try next Day.';
        }
    }
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4 class="title">Enquiries</h4>
            </div>
            <div class="widget-content">
            <table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable" style="width:100%;">
                    <thead>
                        <th data-class="expand">#</th>
                        <th data-class="expand">Date</th>
                        <th data-class="expand">Customer Name</th>
                        <!--<th data-hide="phone,tablet">Contact No.</th>
                        <th data-hide="phone,tablet">Address</th>-->
                        <th data-hide="phone,tablet">Appliance</th>
                        <!--<th data-hide="phone,tablet">Brand</th>
                        <th data-hide="phone,tablet">Type</th>-->
                        <th data-class="expand">Issue</th>
                        <th data-hide="phone,tablet">Action</th>
                    </thead>
                    <tbody>
                    <?php 
                    if (!empty ($enquiries)) {
                        $sr=1;
                        $isOnJob = $this->enquiry_m->get_enquiries(false,array("technician_id"=>$this->session->userdata('id'),"status"=>"1"));
                        foreach ($enquiries as $enc) {
                            $strt=1;$temp_itms=array();
                            if(in_array($this->session->userdata('status'),array(STATUS_ADMIN,STATUS_SUPER,STATUS_STAFF))){
                                $tid = $enc['customer_id'];$issues=[];
                                $items = explode(",",$enc["items"]);
                                foreach($items as $item)
                                {
                                    $item = explode("-",$item);
                                    $issue = $this->appliance_m->get_issues($enc['appliance_id'],$item[3]);
                                    $issues[] =$issue['issue_title'];
                                }
                                $issues = implode('<br />',$issues);
                                $appliance = $this->appliance_m->get_appliance($item[0]);
                                $brand = $this->appliance_m->get_brands($enc['appliance_id'],$item[1]);
                                $type = $this->appliance_m->get_appliance_types($enc['appliance_id'],$item[2]);
                                echo '<tr>';
                                ?>
                                <td><?php echo $sr++;?></td>
                                <td><?php echo date('d M Y H:i:s',$enc['enquiry_date']);?></td>
                                <td><?php echo $enc['customer_name'];?></td>
                                <td><?php echo $appliance['appliance_name'];?></td>
                                <!--<td rowspan="<?php echo count($items);?>"><?php echo ($enc['status'])?(($enc['technician_id']==$this->session->userdata['id'])?$enc['mobile']:'---'):'<small class="text text-primary">After Accept</small>';?></td>
                                <td rowspan="<?php echo count($items);?>"><?php echo $enc['address'];?></td>-->
                                <!--<td><?php echo $brand['brand_name'];?></td>
                                <td><?php echo $type['type_name'];?></td>-->
                                <td><?php echo $issues;?></td>
                                <td>
                                    <a href="<?php echo site_url("admin/enquiries/details/".$enc['id']);?>" class="btn btn-primary btn-xs" title="Details"><i class="icon-list"></i></a>
                                </td>
                                <?php
                                echo '</tr>';
                                $strt++;
                            }else if(($tech_appliance) && (in_array($enc['location'],$tech_locations))){
                                //if(!$enc['status'] || ($enc['status'] && $enc['technician_id']==$this->session->userdata['id']))
                                //{
                            
                                $items = explode(",",$enc["items"]);
                                /*foreach($items as $item){
                                    $item = explode("-",$item);
                                    $temp_itms[]=$item[0];
                                }*/
                                /*$diffaplnc = array_diff_assoc($enc['appliance_id'], $tech_appliance);*/
                                
                                if(in_array($enc['appliance_id'],$tech_appliance)){
                                    $tid = $enc['customer_id'];$issues=[];
                                    foreach($items as $item)
                                    {
                                        $item = explode("-",$item);
                                        $issue = $this->appliance_m->get_issues($enc['appliance_id'],$item[3]);
                                        $issues[] =$issue['issue_title'];
                                    }
                                    $issues = implode('<br />',$issues);
                                    $appliance = $this->appliance_m->get_appliance($item[0]);
                                    if($tech_plan_type==$appliance['service_type']){
                                        $brand = $this->appliance_m->get_brands($enc['appliance_id'],$item[1]);
                                        $type = $this->appliance_m->get_appliance_types($enc['appliance_id'],$item[2]);
                                        echo '<tr>';
                                        ?>
                                        <td><?php echo $sr++;?></td>
                                        <td><?php echo date('d M Y H:i:s',$enc['enquiry_date']);?></td>
                                        <td><?php echo $enc['customer_name'];?></td>
                                        <td><?php echo $appliance['appliance_name'];?></td>
                                        <!--<td rowspan="<?php echo count($items);?>"><?php echo ($enc['status'])?(($enc['technician_id']==$this->session->userdata['id'])?$enc['mobile']:'---'):'<small class="text text-primary">After Accept</small>';?></td>
                                        <td rowspan="<?php echo count($items);?>"><?php echo $enc['address'];?></td>-->
                                        <!--<td><?php echo $brand['brand_name'];?></td>
                                        <td><?php echo $type['type_name'];?></td>-->
                                        <td><?php echo $issues;?></td>
                                        <td>
                                            <?php 
                                            if($planActive){
                                                if(!$enc['status']){
                                                    if($isOnJob){
                                                    ?>
                                                        <a href="javascript:void(0);" onclick="alert('You have one active Job, First complete it.')" data-toggle="tooltips" title="Pick this service" class="btn btn-danger btn-xs"><i class="fa fa-ban"></i> New</a>
                                                    <?php
                                                    }else{
                                                    ?>
                                                        <a href="<?php echo site_url('admin/enquiries/servicePick/'.$enc['id']);?>" data-toggle="tooltips" title="Pick this service" class="btn btn-primary btn-xs"><i class="fa fa-thumbs-up"></i> Pick</a>
                                                    <?php
                                                    } 
                                                }else{ 
                                                    if($enc['status']==2){ ?>
                                                        <span class="label label-success label-sm">Done</span>
                                                    <?php }else{ 
                                                        if($tech_plan_type==1){
                                                        ?>
                                                            <a href="<?php echo site_url('admin/enquiries/jobClose/'.$enc['id']);?>" data-toggle="tooltips" title="Close Now" class="btn btn-warning btn-xs"><i class="fa fa-check"></i> Close</a>
                                                        <?php
                                                        }else{
                                                            if($enc['recieved']){
                                                               ?>
                                                                <a href="<?php echo site_url('admin/enquiries/jobDiliver/'.$enc['id']);?>" data-toggle="tooltips" title="Close Now" class="btn btn-warning btn-xs"><i class="fa fa-check"></i> Diliver</a>
                                                               <?php 
                                                            }else if(!$enc['recieved']){
                                                                ?>
                                                                <a href="<?php echo site_url('admin/enquiries/appRecieve/'.$enc['id']);?>" data-toggle="tooltips" title="Close Now" class="btn btn-warning btn-xs"><i class="fa fa-check"></i> Recieve</a>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        <a href="javascript:void(0);" onclick="showRouteDirection('<?php echo $me['map_location'];?>','<?php echo $enc['map_location'];?>')" data-toggle="modal" data-target="#maplocation" class="btn btn-primary btn-xs"><i class="icon-map-marker"></i> Track</a>
                                                    <?php
                                                    }
                                                    ?>
                                                        <a href="<?php echo site_url("admin/enquiries/details/".$enc['id']);?>" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Details"><i class="icon-list"></i></a>
                                                <?php 
                                                }
                                            }else{
                                                echo '<span class="label label-info label-sm">'.$msgText.'</span>';
                                            } 
                                            ?>
                                        </td>
                                        <?php
                                    echo '</tr>';
                                    $strt++;
                                    }
                                }
                            }
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
