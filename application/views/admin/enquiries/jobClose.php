<?php
$issues=[];
$applicance = $this->appliance_m->get_appliance($enquiry['appliance_id']);
$items = explode(",",$enquiry["items"]);
foreach($items as $item)
{
    $item = explode("-",$item);
    $issue = $this->appliance_m->get_issues($enquiry['appliance_id'],$item[3]);
    $issues[] =$issue['issue_title'];
}
$issues = implode(', ',$issues);
//$issue = $this->appliance_m->get_issues(false,$issue_id);
?>
<div class="row">
    <div class="col-md-5 col-sm-12 col-xs-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><?php echo $page_title;?></h4>
            </div>
            <div class="widget-content">
                <form class="form-horizontal" action="" method="post">
                    <input type="hidden" name="eid" value="<?php echo $enquiry['id'];?>">
                    <table class="table table-responsive table-striped table-bordered table-condenced">
                    <tr>
                        <td>Enquiry Date</td>
                            <td><?php echo date('d M Y H:i:s',$enquiry['enquiry_date']);?></td>
                        </tr>
                        <td>Pick Date</td>
                            <td><?php echo date('d M Y H:i:s',$enquiry['pick_date']);?></td>
                        </tr>
                        <td>Customer Name</td>
                            <td><?php echo $enquiry['customer_name'];?></td>
                        </tr>
                        <td>Mobile</td>
                            <td><?php echo $enquiry['mobile'];?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td><?php echo $enquiry['address'];?></td>
                        </tr>
                        <tr>
                            <td>Appliance Name</td>
                            <td><?php echo $applicance['appliance_name'];?></td>
                        </tr>
                        <tr>
                            <td>Issues</td>
                            <td><?php echo $issues;?></td>
                        </tr>
                        <tr>
                            <td>Issue Charges</td>
                            <td><?php echo 'Rs.'. $enquiry['price'];?></td>
                        </tr>
                        <tr>
                            <td>OTP</td>
                            <td>
                            <input type="text" class="form-control" name="otp" id="" value="">
                            </td>
                        </tr>
                    </table>
                    <div class="form-actions">
                        <input type="submit" value="Job Close" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>