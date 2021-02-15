<?php
$user = $this->user_m->getUser($this->session->userdata('id'));
?>
<?php
if($this->session->userdata('status') != STATUS_SUPER){
	if($this->session->userdata('status') == STATUS_ADMIN){
	?>	
		<div class="col-sm-6 col-md-3">
			<div class="statbox widget box box-shadow">
				<div class="widget-content">
					<div class="visual yellow">
						<i class="icon-user"></i>
					</div>
					<?php
					$users = $this->user_m->getUser(false,array('status >'=>STATUS_ADMIN));
					?>
					<div class="title">Users</div>
					<div class="value"><?php echo count($users);?></div>
					<a class="more" href="<?php echo site_url("admin/user");?>">View More <i class="pull-right icon-angle-right"></i></a>
				</div>
			</div> <!-- /.smallstat -->
		</div> <!-- /.col-md-3 -->
	<!-- /Statboxes -->
	<?php
	}else if($this->session->userdata('status') == STATUS_CUSTOMER || $this->session->userdata('status') == STATUS_TECHNICIAN){
	?>
	<!--<div class="col-md-12 col-sm-12">
		<div class="col-sm-12 col-md-4">
			<div class="statbox widget box box-shadow">
				<div class="widget-content">
					<table class="table table-condensed table-bordered table-striped">
						<tr>
							<td><strong>User ID</strong></td><td> <?php echo $user['username'];?></td>
						</tr>
						<tr>
							<td><strong>Password</strong></td><td> <?php echo '-----';//$user['temp'];?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>-->
		<?php 
		if($this->session->userdata('status') == STATUS_TECHNICIAN){
			$leftTime = ($this->wallet_m->calculateLeftTime($this->session->userdata('id')));
			$tech_plan = $this->enquiry_m->get_technician_plan(false,$this->session->userdata('id'));
			$isactiveJob = $this->enquiry_m->get_enquiries(false,array('technician_id'=>$this->session->userdata('id'),'close_date'=>''));
			$leftTime=($leftTime*(60*60));
			?>
			<div class="col-sm-12 col-md-4">
				<div class="statbox widget box box-shadow">
					<div class="widget-content">
						<div class="value">
							<?php
							if($tech_plan[0]['plan_type']==1){
								if($isactiveJob){
								?>
								<div id="cntimer">
								<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path').'assets/js/countdown.js');?>"></script>
								<script language="javascript">
									var duration = '<?php echo ($leftTime);?>';
									// Function for submit form when time is over.	
									function countdownComplete(){
									}
									// === *** SHOW TIMER *** === //	
									
									var timer = new Countdown( {  
															time: duration , 
															rangeHi : 'day',
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
									$lfttm = explode(':',$this->default_m->hour2countdown($leftTime));
									echo '<span style="min-width:100px;padding:5px 5px 5px 5px;border:1px solid #999;background-color:#CCC;">'.$lfttm[0].'</span>'." : ";
									echo '<span style="min-width:100px;padding:5px 5px 5px 5px;border:1px solid #999;background-color:#CCC;">'.$lfttm[1].'</span>'." : ";
									echo '<span style="min-width:100px;padding:5px 5px 5px 5px;border:1px solid #999;background-color:#CCC;">'.$lfttm[2].'</span>';
								}
							}
						?>
						</div>
					</div>
				</div> <!-- /.smallstat -->
			</div> <!-- /.col-md-3 -->
			
			<?php
			}
		?>
	</div>
<?php
	}
}

if(isset($userinfo)){
	$usrinf = $this->user_m->getUser($userinfo);
	$str = 'User Name - '.$usrinf['name'].'\rUser Id - '.$usrinf['username'].'\rPassword - '.$usrinf['temp'];
	?>
	<script>alert('<?php echo $str;?>')</script>
	<?php
}
?>