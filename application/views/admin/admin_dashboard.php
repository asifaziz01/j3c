<?php
$user_detail = $this->user_m->getUser($this->session->userdata("id"));
$user = $user_detail;
$profilePic = $this->user_m->getProfilePic($this->session->userdata("id"));
?>
<!--=== Page Header ===-->
<div class="page-header">
	<div class="page-title">
		<h3><?php echo $user['name'];?></h3>
		<span><?php echo $user['address'];?></span>
	</div>
</div>
<!-- /Page Header -->
<!--=== Page Content ===-->
<!--=== Statboxes ===-->
<div class="row row-bg"> <!-- .row-bg -->

	<div class="col-sm-6 col-md-3 hidden-xs">
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
				<a class="more" href="<?php echo site_url("admin/users");?>">View More <i class="pull-right icon-angle-right"></i></a>
			</div>
		</div> <!-- /.smallstat -->
	</div> <!-- /.col-md-3 -->

	<div class="col-sm-6 col-md-3 hidden-xs">
		<div class="statbox widget box box-shadow">
			<div class="widget-content">
				<div class="visual red">
					<i class="icon-cogs"></i>
				</div>
				<div class="title">SETTINGS</div>
				<div class="value">&nbsp;</div>
				<a class="more" href="<?php echo site_url("admin/settings");?>">View More <i class="pull-right icon-angle-right"></i></a>
			</div>
		</div> <!-- /.smallstat -->
	</div> <!-- /.col-md-3 -->
</div> <!-- /.row -->
<!-- /Statboxes -->
