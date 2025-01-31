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
                                <table class="responsive">
                                    <thead>
                                        <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Customer Name</th>
                                        <!--<th data-hide="phone,tablet">Contact No.</th>
                                        <th data-hide="phone,tablet">Address</th>-->
                                        <th>Appliance</th>
                                        <!--<th data-hide="phone,tablet">Brand</th>
                                        <th data-hide="phone,tablet">Type</th>-->
                                        <th>Issue</th>
                                        <th>Action</th>
                                        </tr>
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
                                                    $tid = $enc['customer_id'];$flg=false;
                                                    //$appliance = $this->appliance_m->get_appliance($enc['appliance_id']);
                                                    $items = explode(",",$enc["items"]);
                                                    $appliance = $this->appliance_m->get_appliance($enc['appliance_id']);
                                                    $issue=[];$brand='';$type='';$tmp=[];
                                                    foreach($items as $item)
                                                    {
                                                        $item = explode("-",$item);
                                                        $tmp = $this->appliance_m->get_issues($enc['appliance_id'],$item[3]);
                                                        $brand = $this->appliance_m->get_brands($enc['appliance_id'],$item[1]);
                                                        $type = $this->appliance_m->get_appliance_types($enc['appliance_id'],$item[2]);
                                                        $issue[] = $brand['brand_name'].' -> '.$type['type_name'].'-'.$tmp['issue_title'];
                                                        $flg=true;
                                                    }
                                                    if($flg){$issue = implode('<br />',$issue);}else{$issue='';}
                                                    echo '<tr>';
                                                    ?>
                                                        <td data-label="#"><?php echo $sr++;?></td>
                                                        <td data-label="Date"><?php echo date('d M Y H:i:s',$enc['enquiry_date']);?></td>
                                                        <td data-label="Customer Name"><?php echo $enc['customer_name'];?></td>
                                                        <!--<td rowspan="<?php echo count($items);?>"><?php echo ($enc['status'])?(($enc['technician_id']==$this->session->userdata['id'])?$enc['mobile']:'---'):'<small class="text text-primary">After Accept</small>';?></td>
                                                        <td rowspan="<?php echo count($items);?>"><?php echo $enc['address'];?></td>-->
                                                        <td data-label="Appliance"><?php echo $appliance['appliance_name'];?></td>
                                                        <!--<td><?php echo $brand['brand_name'];?></td>
                                                        <td><?php echo $type['type_name'];?></td>-->
                                                        <td data-label="Issue"><?php echo $issue;?></td>
                                                        <td data-label="Action">
                                                            <a href="<?php echo site_url("public/main/details/".$enc['id']);?>" class="btn btn-primary btn-xs" data-toggle='tooltip' title="Details"><i class="fa fa-list"></i></a>
                                                            <a href="<?php echo site_url("public/main/add_feedback/".$enc['id']);?>" class="btn btn-success btn-xs" data-toggle='tooltip' title="Review"><i class="fa fa-pencil"></i></a>
                                                            <?php
                                                            if($enc['status']==2){?>
                                                            <a href="javascript:void(0);" onclick="getRank(<?php echo $enc['id'];?>);" class="btn btn-default btn-xs" title="Rank" data-toggle="modal" data-target="#myModal"><i class="fa fa-star" style="color:orange;"></i></a>
                                                            <?php } ?>
                                                        </td>
                                                        <?php
                                                    echo '</tr>';
                                                    $strt++;
                                                //}
                                                //}
                                            //}
                                        }
                                    }else{
                                        echo '<tr><td colspan="6">No enquiry found.</td></tr>';
                                    }
                                    ?>
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
<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Rank</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <div id='modal-msg'></div>
            <div id='encForm'></div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  <script>
  function getRank(eid){
    $.get('<?php echo site_url('public/main/getRank/');?>'+eid,function(data,status){
        if(status=='success'){
            $('#encForm').html(data);
        }
    })
  }
  function saveRank(rank,tid){
    $.get('<?php echo site_url('public/main/saveRank/');?>'+rank+'/'+tid,function(data,status){
        if(status=='success'){
            $('#modal-msg').html('<div class="alert alert-success">Rank Save Succesfully!</div>');
        }
    })
  }
  </script>