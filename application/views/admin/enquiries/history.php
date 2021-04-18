<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
                    <thead>
                        <th data-class="expand">#</th>
                        <th data-class="expand">Open</th>
                        <th data-class="expand">Close</th>
                        <th data-class="expand">Customer Name</th>
                        <!--<th data-hide="phone,tablet">Contact No.</th>
                        <th data-hide="phone,tablet">Address</th>-->
                        <th data-hide="phone,tablet">Appliance</th>
                        <!--<th data-hide="phone,tablet">Brand</th>
                        <th data-hide="phone,tablet">Type</th>-->
                        <th data-hide="phone,tablet">Issue</th>
                        <th data-hide="phone,tablet">Action</th>
                    </thead>
                    <tbody>
                    <?php 
                    if (!empty ($enquiries)) {
                        $sr=1;$strt=1;
                        $isOnJob = $this->enquiry_m->get_enquiries(false,array("technician_id"=>$this->session->userdata('id'),"status"=>"1"));
                        foreach ($enquiries as $enc) {
                            //if(in_array($enc['appliance_id'],$tech_appliance) && in_array($enc['location'],$tech_locations)){
                                //if(!$enc['status'] || ($enc['status'] && $enc['technician_id']==$this->session->userdata['id']))
                                //{
                                    $tid = $enc['customer_id'];
                                    //$appliance = $this->appliance_m->get_appliance($enc['appliance_id']);
                                    $items = explode(",",$enc["items"]);
                                    $appliance = $this->appliance_m->get_appliance($enc['appliance_id']);
                                    foreach($items as $item)
                                    {
                                        $item = explode("-",$item);
                                        $issue = $this->appliance_m->get_issues($enc['appliance_id'],$item[3]);
                                        $brand = $this->appliance_m->get_brands($enc['appliance_id'],$item[1]);
                                        $type = $this->appliance_m->get_appliance_types($enc['appliance_id'],$item[2]);
                                        echo '<tr>';
                                        ?>
                                        <td><?php echo $sr++;?></td>
                                        <td><?php echo date('d M Y H:i:s',$enc['enquiry_date']);?></td>
                                        <td></td>
                                        <td><?php echo $enc['customer_name'];?></td>
                                        <!--<td rowspan="<?php echo count($items);?>"><?php echo ($enc['status'])?(($enc['technician_id']==$this->session->userdata['id'])?$enc['mobile']:'---'):'<small class="text text-primary">After Accept</small>';?></td>
                                        <td rowspan="<?php echo count($items);?>"><?php echo $enc['address'];?></td>-->
                                        <td><?php echo $appliance['appliance_name'];?></td>
                                        <!--<td><?php echo $brand['brand_name'];?></td>
                                        <td><?php echo $type['type_name'];?></td>-->
                                        <td><?php echo $issue['issue_title'];?></td>
                                        <?php
                                        if($strt==1){                                
                                        ?>
                                        <td rowspan="7">
                                            <a href="<?php echo site_url("admin/enquiries/details/".$enc['id']);?>" class="btn btn-primary btn-xs" title="Details"><i class="icon-list"></i></a>
                                        </td>
                                        <?php
                                    }
                                    echo '</tr>';
                                    $strt++;
                                }
                                //}
                            //}
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
