<?php
    $leftTime = ceil($this->wallet_m->calculateLeftTime($this->session->userdata('id')));
    $isactiveJob = $this->enquiry_m->get_enquiries(false,array('technician_id'=>$this->session->userdata('id'),'close_date'=>''));
?>
<div class="row">
    <div class="col-md-4 col-sm-12 col-xs-12 pull-right">
        <script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path').'assets/js/countdown.js');?>"></script>
        <?php
        if($tech_plan[0]['plan_type']==1){
            if($isactiveJob){
            ?>
            <div id="cntimer">
            <script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path').'assets/js/countdown.js');?>"></script>
            <script language="javascript">
                var duration = '<?php echo ($leftTime*(60*60));?>'
                // Function for submit form when time is over.	
                function countdownComplete(){
                }
                // === *** SHOW TIMER *** === //	
                
                var timer = new Countdown( {  
                                        time: duration , 
                                        rangeHi : 'hour',
                                        width:200, 
                                        height:60,
                                        hideLine	: true,
                                        numbers		: 	{
                                            color	: "#000000",
                                            bkgd	: "#f5f5f5",
                                            rounded	: 0.15,				// percentage of size
                                        },											
                                        onComplete	: countdownComplete
                                    } );
                var CountdownImageFolder = "images/"; 
                var CountdownImageBasename = "flipper";
                var CountdownImageExt = "png";
                var CountdownImagePhysicalWidth = 41;
                var CountdownImagePhysicalHeight = 90;
                
            </script>
            </div>
            <?php
            }else{
                $lfttm = explode(':',$this->default_m->hour2time($leftTime));
                echo '<span style="min-width:100px;padding:5px 5px 5px 5px;border:1px solid #999;background-color:#CCC;"><strong>'.$lfttm[0].'</span>'." : </strong>";
                echo '<span style="min-width:100px;padding:5px 5px 5px 5px;border:1px solid #999;background-color:#CCC;"><strong>'.$lfttm[1].'</span>'." : </strong>";
                echo '<span style="min-width:100px;padding:5px 5px 5px 5px;border:1px solid #999;background-color:#CCC;"><strong>'.$lfttm[2].'</strong></span>';
            }
        }
        ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="widget box">
            <div class="widget-header">
                <h4 class="title"><?php echo $page_title;?></h4>
            </div>
            <div class="widget-content">
                <table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
                    <thead>
                        <th data-class="expand">#</th>
                        <th data-class="expand">Plan Title</th>
                        <th data-class="expand">Plan Amount</th>
                        <!--<th data-hide="phone,tablet">Contact No.</th>
                        <th data-hide="phone,tablet">Address</th>-->
                        <th data-hide="phone,tablet">Type</th>
                        <th data-hide="phone,tablet">Hour/Jobs</th>
                        <!--<th data-hide="phone,tablet">Brand</th>
                        <th data-hide="phone,tablet">Type</th>-->
                        <th data-class="expand">Status</th>
                    </thead>
                    <tbody>
                    <?php 
                    if (!empty ($tech_plan)) {
                        $sr=1;
                        foreach ($tech_plan as $tp) {
                            $plan = $this->plan_m->get_plan($tp['plan_id']);
                            echo '<tr>';
                            echo '<td>'.$sr.'</td>';
                            echo '<td>'.$plan['title'].'</td>';
                            echo '<td>'.$plan['amount'].'</td>';
                            echo '<td>'.(($plan['type']==1)?'Job Hour':'No. of Jobs').'</td>';
                            echo '<td>'.$plan['hour'].'</td>';
                            echo '<td>';
                                echo (!$tp['status'])?'<span class="label label-danger">Finish</span>':'<span class="label label-success">Working</span>';
                            echo '</td>';
                            echo '</tr>';
                            $sr++;
                        }
                    }
                    ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
var hours='<?php echo $leftTime;?>';
var mins=0;
var secs=0;


function h(obj) {
 	for(var i = 0; i < obj.length; i++) {
  		if(obj.substring(i, i + 1) == ":")
  		break;
 	}
 	return(obj.substring(0, i));
}

function m(obj) {
 	for(var i = 0; i < obj.length; i++) {
  		if(obj.substring(i, i + 1) == ":")
  		break;
 	}
 	return(obj.substring(0, i));
}

function s(obj) {
 	for(var i = 0; i < obj.length; i++) {
  		if(obj.substring(i, i + 1) == ":")
  		break;
 	}
 	return(obj.substring(i + 1, obj.length));
}

function dis(hours,mins,secs) {
 	var disp;
	if(hours==0 && mins==0 && secs==0){
		alert("Time Over");	
	}else{
		if(hours <= 9) {
			disp = " 0";
		} else {
			disp = " ";
		}
		disp += hours + ":";
		if(mins <= 9) {
			disp += "0" + mins;
		} else {
			disp += mins;
		}
		disp += ":";
		if(secs <= 9) {
			disp += "0" + secs;
		} else {
			disp += secs;
		}
		
		return(disp);
	}
}

function redo() {
 	secs--;
 	if(secs == -1) {
  		secs = 59;
  		mins--;
 	}
	if(mins == -1){
		mins = 59;
		hours--;	
	}
	
 	document.getElementById('cntimer').innerHTML = dis(hours,mins,secs); // setup additional displays here.
 	if((hours == 0) && (mins == 0) && (secs == 0)) {
  		window.alert("Time is up. Press OK to continue."); // change timeout message as required
  		// window.location = "yourpage.htm" // redirects to specified page once timer ends and ok button is pressed
 	} else {
 		cd = setTimeout("redo()",1000);
 	}
}

redo();
</script>