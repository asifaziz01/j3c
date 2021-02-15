<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
	<div class="widget box">
		<div class="widget-header">
			<h4 class="title"><?php echo $page_title;?></h4>
			<div class="toolbar no-padding">
				<div class="btn-group">
					<a href="<?php echo site_url("admin/user/");?>" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Back"><i class="icon-arrow-left"></i></a>
				</div>
			</div>
		</div>
		<div class="widget-content">
			<table class="table table-striped table-bordered">
				<?php 
				$total = 0;
				if($user){
					$profilePic = $this->user_m->getProfilePic($user['id']);
					$profilePic = ($profilePic)? base_url($this->config->item("filemanager")."profile_pic/".$profilePic['filename']):base_url($this->config->item("filemanager")."profile_pic/no-profile.png");

					?>
					<tr>
						<td></td>
						<td>
							<img src="<?php echo $profilePic;?>" class="img-responsive center-block" style="width:150px;">
						</td>
					</tr>
					<tr>
						<td><strong>Name</strong></td><td><?php echo $user['name'];?></td>
					</tr>
					<tr>
						<td><strong>Father Name</strong></td><td><?php echo $user['father'];?></td>
					</tr>
					<tr>
						<td><strong>Gender</strong></td><td><?php echo ($user['gender']==1)?"Male":($user['gender']==2)?"Female":"";?></td>
					</tr>
					<tr>
						<td><strong>DOB</strong></td><td><?php echo $user['dob'];?></td>
					</tr>
					<tr>
						<td><strong>Mobile</strong></td><td><?php echo $user['phone'];?></td>
					</tr>
					<tr>
						<td><strong>Email</strong></td><td><?php echo $user['email'];?></td>
					</tr>
					<tr>
						<td><strong>Address</strong></td><td><?php echo $user['address'];?></td>
					</tr>
					<tr>
						<td><strong>PAN</strong></td><td><?php echo $user['pan'];?></td>
					</tr>
					<tr>
						<td><strong>Adhaar</strong></td><td><?php echo $user['adhaar'];?></td>
					</tr>
				<?php
				} 
				
				if($total){
					?>
					<tr><td colspan="2" class="text-right"><strong>Total</strong></td><td><?php echo $total;?></td><td></td></tr>
					<?php	
				}
				?>
			</table>
		</div>
	</div>
</div>