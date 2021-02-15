<!--Contact Information Start-->
<section id="contact_information" style="padding-top:30px;">
    <div class="container">
        <div class="row"> 
            <!--Left Form Part-->
            <div class="col-md-12 col-sm-12 col-xs-12"> 
            
                <!--Contact Information-->
                <div class="contact_information_left "> 
                    
                    <!-- HTML Form (wrapped in a .bootstrap-iso div) -->
                    <div class="booking_form">
                        <div class="container-fluid">
                            <div class="row">
                                <h4><?php echo $page_title;?></h4>
                                <table class="">
                                    <tbody>
                                    <?php 
                                    if (!empty ($enc)) {
                                        $pnt=0;
                                        $items = explode(",",$enc["items"]);
                                        $itemPrice  =explode(",",$enc["price"]);
                                        $technician = ($enc['technician_id'])?$this->user_m->getUser($enc['technician_id'],array('status'=>STATUS_TECHNICIAN)):false;
                                        ?>
                                        <tr><td style="text-align:left;"><strong>Customer</strong></td><td style="text-align:left;"><?php echo $enc['customer_name'];?></td></tr>
                                        <tr><td style="text-align:left;"><strong>Mobile</strong></td><td style="text-align:left;"><?php echo $enc['mobile'];?></td></tr>
                                        <tr><td style="text-align:left;"><strong>Address</strong></td><td style="text-align:left;"><?php echo $enc['address'];?></td></tr>
                                        <tr><td style="text-align:left;"><strong>Enquiry Date</strong></td><td style="text-align:left;"><?php echo date('d M Y H:i:s',$enc['enquiry_date']);?></td></tr>
                                        <tr><td style="text-align:left;"><strong>Technician</strong></td><td style="text-align:left;"><?php echo ($technician)?$technician['name']:'';?></td></tr>
                                        <tr>
                                        <td style="text-align:left;"><strong>Problem</strong></td>
                                        <td>
                                            <table class="table table-stripped">
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
                                                        <td data-label="Brand"><?php echo $brand['brand_name'];?></td>
                                                        <td data-label="Type"><?php echo $type['type_name'];?></td>
                                                        <td data-label="Issue"><?php echo $issue['issue_title'];?></td>
                                                        <td style="text-align:right;" data-label="Price"><?php echo $itemPrice[$pnt];?></td>
                                                        <?php
                                                        echo '</tr>';
                                                        $total +=$itemPrice[$pnt++];
                                                    }
                                                    ?>
                                                    <tr>
                                                    <td colspan="4" style="text-align:right;"><?php echo $total;?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        </tr>
                                        <tr><td style="text-align:left;"><strong>Job Status</strong></td><td style="text-align:left;"><?php if($enc['status']==2){echo 'Job Done';}else if($enc['status']==1){echo 'In Proccessing';}else{echo 'Pending';}?></td></tr>
                                        <?php
                                        if($this->session->userdata('id')!=STATUS_TECHNICIAN){
                                        ?>
                                        <tr><td style="text-align:left;"><strong>Job OTP</strong></td><td style="text-align:left;"><?php echo ($technician)?$enc['job_otp']:'';?></td></tr>
                                        <?php
                                        }
                                    }
                                    ?>
                                    <tr><td colspan="2" style="text-align:left;"><a href="<?php echo site_url("public/main/myBooking");?>" class="btn btn-danger btn-sm"><i class="fa fa-arrow-left"></i> Back</a></td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
