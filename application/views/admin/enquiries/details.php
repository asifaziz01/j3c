<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-bordered table-hover table-checkable table-responsive">
                    <tbody>
                    <?php 
                    if (!empty ($enc)) {
                        $pnt=0;
                        $items = explode(",",$enc["items"]);
                        $itemPrice  =explode(",",$enc["price"]);
                        $technician = ($enc['technician_id'])?$this->user_m->getUser($enc['technician_id'],array('status'=>STATUS_TECHNICIAN)):false;
                        ?>
                        <tr><td><strong>Customer</strong></td><td><?php echo $enc['customer_name'];?></td></tr>
                        <tr><td><strong>Mobile</strong></td><td><?php echo $enc['mobile'];?></td></tr>
                        <tr><td><strong>Address</strong></td><td><?php echo $enc['address'];?></td></tr>
                        <tr><td><strong>Enquiry Date</strong></td><td><?php echo date('d M Y H:i:s',$enc['enquiry_date']);?></td></tr>
                        <tr><td><strong>Technician</strong></td><td><?php echo ($technician)?$technician['name']:'';?></td></tr>
                        <tr>
                        <td><strong>Problem</strong></td>
                        <td>
                            <table class="table table-bordered table-stripped">
                                <thead>
                                    <th>Brand</th><th>Type</th><th>Issue</th><th>Price</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $total=0;
                                    foreach($items as $item)
                                    {
                                        $item = explode("-",$item);
                                        $issue = $this->appliance_m->get_issues($enc['appliance_id'],$item[3]);
                                        $brand = $this->appliance_m->get_brands($enc['appliance_id'],$item[1]);
                                        $type = $this->appliance_m->get_appliance_types($enc['appliance_id'],$item[2]);
                                        echo '<tr>';
                                        ?>
                                        <td><?php echo $brand['brand_name'];?></td>
                                        <td><?php echo $type['type_name'];?></td>
                                        <td><?php echo $issue['issue_title'];?></td>
                                        <td align="right"><?php echo $itemPrice[$pnt];?></td>
                                        <?php
                                        echo '</tr>';
                                        $total +=$itemPrice[$pnt++];
                                    }
                                    ?>
                                    <tr>
                                    <td></td><td></td><td></td><td align="right"><?php echo $total;?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        </tr>
                        <tr><td><strong>Job Status</strong></td><td><?php if($enc['status']==2){echo 'Job Done';}else if($enc['status']==1){echo 'In Proccessing';}else{echo 'Pending';}?></td></tr>
                        <?php
                        if($this->session->userdata('id')!=STATUS_TECHNICIAN){
                        ?>
                        <tr><td><strong>Job OTP</strong></td><td><?php echo ($technician)?$enc['job_otp']:'';?></td></tr>
                        <?php
                        }
                    }
                    ?>
                    <tr><td colspan="2"><a href="<?php echo site_url("admin/enquiries/index");?>" class="btn btn-danger btn-sm"><i class="fa fa-arrow-left"></i> Back</a></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
