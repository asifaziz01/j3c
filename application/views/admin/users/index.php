<?php
$clause["status"] = STATUS_CUSTOMER;
//if($this->session->userdata("status")!=STATUS_SUPER){$clause["created_by"] = $this->session->userdata("login");}
$customers = $this->user_m->getUser(false, $clause);
//$downlines = $this->mlm->findDownlines($users, $user_id);
$clause["status"] = STATUS_STAFF;
//if($this->session->userdata("status")!=STATUS_SUPER){$clause["created_by"] = $this->session->userdata("login");}
$staffs = $this->user_m->getUser(false, $clause);
//$downlines = $this->mlm->findDownlines($users, $user_id);
$clause["status"] = STATUS_TECHNICIAN;
//if($this->session->userdata("status")!=STATUS_SUPER){$clause["created_by"] = $this->session->userdata("login");}
$technicians = $this->user_m->getUser(false, $clause);
//$downlines = $this->mlm->findDownlines($users, $user_id);
?>
<div class="row no-padding">
	<div class="tabbable tabbable-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#technician" data-toggle="tab">Technicians (<?php echo count($technicians);?>)</a></li>
			<li><a href="#customer" data-toggle="tab">Customer (<?php echo count($customers);?>)</a></li>
			<?php if($this->session->userdata('status')!=STATUS_STAFF){ ?>
			<li><a href="#staff" data-toggle="tab">Staff (<?php echo count($staffs);?>)</a></li>
			<?php } ?>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="technician">
				<table  class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
					<thead>
						<tr>
						<th data-class="expand">#</th>
						<th data-class="expand">Name</th>
						<th data-class="expand">Type</th>
						<th data-hide="phone">Mobile</th>
						<th data-hide="phone,tablet">Rank</th>
						<th data-hide="phone,tablet">Status</th>
						<th data-hide="phone,tablet">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if($technicians){
							$sr = 1;$tech_rank = 0;
							foreach($technicians as $technician){
								$userType = $this->settings_m->getUserType($technician['status']);
								$ranks = $this->user_m->getRank($technician['id']);
								if($ranks){
									$temp_rank=[];
									foreach($ranks as $rank){
										$temp_rank[] = $rank['rank'];
									}
									$tech_rank = (array_sum($temp_rank)/count($ranks));
									$tech_rank = ceil($tech_rank);
								}
								?>
								<tr>
									<td><?php echo $sr++;?></td>
									<td><?php echo $technician['name'];?></td>
									<td><?php echo $userType['title'];?></td>
									<td><?php echo $technician['phone'];?></td>
									<td>
									<?php 
									for($a=1;$a<6;$a++){
										?>
											<span class="icon-star <?php echo ($a<=$tech_rank)?'text-warning':'';?>"></span>
										<?php
									}
									?>
									</td>
									<td>
									<?php 
										echo ($technician['approved']=='1')?'<span class="label label-success label-sm">Verified</span>':'<span class="label label-danger label-sm">Not Verified</span>';
									?>
									</td>
									<td>
										<a href="<?php echo site_url("admin/user/user_detail/".$technician['id']);?>" class="btn btn-xs btn-primary" data-toggle="tooltip"  title="User Details"><i class="icon-user"></i></a>
										<?php
										if($this->session->userdata('status')<STATUS_STAFF || $this->session->userdata('login')==$technician['created_by']){
										?>
										<a href="<?php echo site_url("admin/user/edit_user/".$technician['id']);?>" data-toggle="tooltip"  class="btn btn-xs btn-success" title="Edit User"><i class="icon-pencil"></i></a>
										<?php
										}
										?>
										<a href="<?php echo site_url("admin/plan/recharge_plan/".$technician['id']);?>" data-toggle="tooltip"  class="btn btn-xs btn-success" title="Recharge Plan"><i class="icon-money"></i></a>
										<!--<a href="javascript:void(0);" onclick="showConfirm('<?php echo site_url("admin/user/delete_users/".$user['id']);?>','Are you sure want to delete user!')" class="btn btn-xs btn-danger" title="Delete User"><i class="icon-trash"></i></a>
										<a href="#" class="btn btn-xs btn-success" title="User Detail"><i class="fa fa-list"></i></a>-->
									</td>
								</tr>
								<?php
							}
						}
						?>
					</tbody>
				</table>
			</div>
			<div class="tab-pane" id="customer">
				<table  class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
					<thead>
						<tr>
						<th data-class="expand">#</th>
						<th data-class="expand">Name</th>
						<th data-class="expand">Type</th>
						<th data-hide="phone">Mobile</th>
						<th data-hide="phone,tablet">Status</th>
						<th data-hide="phone,tablet">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if($customers){
							$sr = 1;
							foreach($customers as $customer){
								$userType = $this->settings_m->getUserType($customer['status']);
								?>
								<tr>
									<td><?php echo $sr++;?></td>
									<td><?php echo $customer['name'];?></td>
									<td><?php echo $userType['title'];?></td>
									<td><?php echo $customer['phone'];?></td>
									<td><?php echo ($customer['activate']=='1')?'<span class="label label-success label-sm">Activate</span>':'<span class="label label-danger label-sm">Not Active</span>';?></td>
									<td>
										<a href="<?php echo site_url("admin/user/user_detail/".$customer['id']);?>" class="btn btn-xs btn-primary" data-toggle="tooltip"  title="User Details"><i class="icon-user"></i></a>
										<a href="<?php echo site_url("admin/user/edit_user/".$customer['id']);?>" data-toggle="tooltip"  class="btn btn-xs btn-success" title="Edit User"><i class="icon-pencil"></i></a>
										<!--<a href="javascript:void(0);" onclick="showConfirm('<?php echo site_url("admin/user/delete_users/".$user['id']);?>','Are you sure want to delete user!')" class="btn btn-xs btn-danger" title="Delete User"><i class="icon-trash"></i></a>
										<a href="#" class="btn btn-xs btn-success" title="User Detail"><i class="fa fa-list"></i></a>-->
									</td>
								</tr>
								<?php
							}
						}
						?>
					</tbody>
				</table>
			</div>
			<?php if($this->session->userdata('status')!=STATUS_STAFF){ ?>
			<div class="tab-pane" id="staff">
				<table  class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
					<thead>
						<tr>
						<th data-class="expand">#</th>
						<th data-class="expand">Name</th>
						<th data-class="expand">Type</th>
						<th data-hide="phone">Mobile</th>
						<th data-hide="phone,tablet">Status</th>
						<th data-hide="phone,tablet">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if($staffs){
							$sr = 1;
							foreach($staffs as $staff){
								$userType = $this->settings_m->getUserType($staff['status']);
								?>
								<tr>
									<td><?php echo $sr++;?></td>
									<td><?php echo $staff['name'];?></td>
									<td><?php echo $userType['title'];?></td>
									<td><?php echo $staff['phone'];?></td>
									<td><?php echo ($staff['activate']=='1')?'<span class="label label-success label-sm">Activate</span>':'<span class="label label-danger label-sm">Not Active</span>';?></td>
									<td>
										<a href="<?php echo site_url("admin/user/user_detail/".$staff['id']);?>" class="btn btn-xs btn-primary" data-toggle="tooltip"  title="User Details"><i class="icon-user"></i></a>
										<a href="<?php echo site_url("admin/user/edit_user/".$staff['id']);?>" data-toggle="tooltip"  class="btn btn-xs btn-success" title="Edit User"><i class="icon-pencil"></i></a>
										<!--<a href="javascript:void(0);" onclick="showConfirm('<?php echo site_url("admin/user/delete_users/".$staff['id']);?>','Are you sure want to delete user!')" class="btn btn-xs btn-danger" title="Delete User"><i class="icon-trash"></i></a>
										<a href="#" class="btn btn-xs btn-success" title="User Detail"><i class="fa fa-list"></i></a>-->
									</td>
								</tr>
								<?php
							}
						}
						?>
					</tbody>
				</table>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
<script>
function dispatchNow(e){
	var conf = window.confirm("Are you sure this item is dispatched.");
		if(conf){
			document.location.href='<?php echo site_url('admin/user/dispatchNow');?>/'+e.value;
		}
}
</script>