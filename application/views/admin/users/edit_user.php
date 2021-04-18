<?php
$user = $this->user_m->getUser($id);
$profilePic = $this->user_m->getProfilePic($id);
$user_type = $this->settings_m->getUserType($user['status']);
?>
<div class="col-md-4 col-sm-12 no-padding">
	<div class="widget box">
		<div class="widget-header">
			<h4><i class="icon-picture"></i> Profile Picture</h4>
		</div>
		<div class="widget-content">
			<div class="list-group">
				<li class="list-group-item no-padding">
					<?php
					$img = ($profilePic)?$profilePic['filename']:'no-profile.png';
					?>
					<img id="imgprd" src="<?php echo base_url($this->config->item('filemanager').'/profile_pic/'.$img);?>" alt="">
				</li>
				<a href="javascript:void(0);" class="list-group-item text-center" data-toggle="modal" data-target="#profileImg"><i class="icon-pencil"></i> Select Image</a>
			</div>
		</div>
	</div>
	<div class="widget box">
		<div class="widget-header">
			<h4><i class="icon-key"></i> Change Password</h4>
		</div>
		<div class="widget-content">
			<form class="form-horizontal" action="<?php echo site_url("admin/user/changeUserPassword/".$id);?>" method="post" >
			  <input type="hidden" value="<?php echo $id;?>" name="id" />
				<div class="form-group">
					<div class="col-md-3">Current Password</div>
					<div class="col-md-9"><strong><?php echo $user['temp'];?></strong></div>
				</div>
				<div class="form-group">
					<div class="col-md-3">New Password</div>
					<div class="col-md-9">
						<input type="password" name="password" class="form-control" value=""/>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-3">Re-Type Password</div>
					<div class="col-md-9">
						<input type="password" name="repassword" class="form-control" value=""/>
					</div>
				</div>
				<div class="action-group">
					<div class="col-md-12"><br>
					  <button type="submit" name="submit" class="btn btn-primary pull-right">Save New Password</button>
					</div>
				</div>
				<br clear="all" />
			</form>
		</div>
	</div>
</div>
<div class="col-md-8 col-sm-12 no-padding">
<div class="row">
		<div class="widget box">
			<div class="widget-header">
				<h4><i class="icon-user"></i> Edit Personal User</h4>
			</div>
			<div class="widget-content">
				<form class="form-horizontal" id="registration" action="<?php echo site_url("admin/user/edit_user/".$id);?>" method="post" >
				<input type="hidden" value="" name="profile_pic" id="cropImg" />
				<div class="form-group">
					<div class="col-md-3">Login ID</div>
					<div class="col-md-9"><strong><?php echo $user['phone'];?></strong></div>
				</div>
				<div class="form-group">
					<div class="col-md-3">User Type</div>
					<div class="col-md-9"><strong><?php echo $user_type['title'];?></strong></div>
				</div>
				<div class="form-group">
					<div class="col-md-3">Name</div>
					<div class="col-md-9">
					<input type="text" name="uname" class="form-control" value="<?php echo $user['name'];?>" placeholder="name" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-3">Father Name</div>
					<div class="col-md-9">
					<input type="text" name="father" class="form-control" value="<?php echo $user['father'];?>" placeholder="Father" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-3">Email</div>
					<div class="col-md-9">
					<input type="email" name="email" class="form-control" value="<?php echo $user['email'];?>" placeholder="email" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-3">Gender</div>
					<div class="col-md-9">
					<div class="form-check" align="left">
						<label class="form-check-label" style="font-size:14px;">
							<input class="form-check-input" type="radio" name="gender" value="1" <?php echo ($user['gender']==1)?'checked':'';?> > Male
						</label>&nbsp;&nbsp;&nbsp;&nbsp;
						<label class="form-check-label" style="font-size:14px;">
							<input class="form-check-input" type="radio" name="gender" value="2" <?php echo ($user['gender']==2)?'checked':''; ?> > Female
						</label>
					</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-3">Mobile</div>
					<div class="col-md-9">
					<input type="text" name="mobile" class="form-control" value="<?php echo $user['phone'];?>" placeholder="Mobile No" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-3">Address</div>
					<div class="col-md-9">
					<textarea name="address" class="form-control" value="" placeholder="Address" ><?php echo $user['address'];?></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-3">Adhaar</div>
					<div class="col-md-9">
					<input type="text" name="adhaar" class="form-control" value="<?php echo $user['adhaar'];?>" placeholder="Adhaar No" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-3">Pan</div>
					<div class="col-md-9">
					<input type="text" name="pan" class="form-control" value="<?php echo $user['pan'];?>" placeholder="Pan No" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-3">GST NO.</div>
					<div class="col-md-9">
					<input type="text" name="gst" class="form-control" value="<?php echo $user['gst'];?>" placeholder="GST No" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-3">Company Name</div>
					<div class="col-md-9">
					<input type="text" name="company" class="form-control" value="<?php echo $user['company'];?>" placeholder="Company Name" />
					</div>
				</div>
				<div class="action-group">
					<div class="col-md-12"><br>
					<button type="submit" name="submit" class="btn btn-primary pull-right">Update Details</button>
					</div>
				</div>
				<br clear="all" />
				</form>
			</div>
		</div>
	</div>
	<?php
	if($user['status']==STATUS_TECHNICIAN){
		$technician_plan = $this->plan_m->get_technician_plan(false,$user['id']);
		$tech_plan_type = ($technician_plan)?$technician_plan[0]['plan_type']:false;
		$tech_categories = $this->user_m->get_technician_categories ();
		$skills = $this->user_m->get_skills ($user['id']);
	?>
	<div class="row">
		<div class="widget box">
			<div class="widget-header">
				<h4><i class="icon-user"></i> Technician Category</h4>
				<div class="toolbar no-padding">
					<div class="btn-group">
						<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
					</div>
				</div>
			</div>
			<div class="widget-content">
				<form class="form-horizontal" action="<?php echo site_url("admin/user/updateServiceDetail/".$id);?>" method="post" >
					<div class="form-group" id="category_div">
					<?php
					if(!$tech_plan_type){
						echo '<div class="alert alert-danger">Please <a href="'.site_url('admin/plan/recharge_plan/'.$user['id']).'" style="color:blue;">Recharge your plan</a> for make your service appliance visible.</div>';
					}else{
					?>
						<label class="col-md-3" for="title">Technician Category</label>
						<div class="col-md-9">
							<select class="form-control" id="tech_cat" name="category">
							<option value="0">Select Category</option>
							<?php
								if (! empty ($tech_categories)) {
								foreach ($tech_categories as $cat) {
									?>
									<option value="<?php echo $cat['id']; ?>" <?php if ($user['category_id'] == $cat['id']) echo 'selected="selected"'; ?>><?php echo $cat['title']; ?></option>
									<?php
								}						
								}
							?>
							</select>
						</div>
					<?php
					}
					?>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="widget box">
			<div class="widget-header">
				<h4><i class="icon-desktop"></i> Appliances</h4>
				<div class="toolbar no-padding">
					<div class="btn-group">
						<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
					</div>
				</div>
			</div>
			<div class="widget-content">
				<form class="form-horizontal" action="" method="post" >
					<div class="form-group" id="appliance_div">
					<?php
					if(!$tech_plan_type){
						echo '<div class="alert alert-danger">Please <a href="'.site_url('admin/plan/recharge_plan/'.$user['id']).'" style="color:blue;">Recharge your plan</a> for make your service appliance visible.</div>';
					}else{
						$appliances = $this->appliance_m->get_appliances();
						$tech_appliances = $this->appliance_m->get_tech_appliances ($user['id']);
						$tech_apps = array();
						if (! empty ($tech_appliances)) {
							foreach ($tech_appliances as $ta) {
								$tech_apps[] = $ta['appliance_id'];
							}
						}
						if($appliances){
							foreach($appliances as $aplnc){
								$checked = in_array($aplnc['appliance_id'],$tech_apps)?'checked="checked"':'';
								echo '<div class="col-md-6 col-sm-6 col-xs-6">
										  <input type="checkbox" onchange="updateApplnces(this)" name="aplncs[]" value="'.$aplnc['appliance_id'].'" '.$checked.' /> '.$aplnc['appliance_name'].'
									  </div>';
							}
						}
					}
					?>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="widget box">
			<div class="widget-header">
				<h4><i class="icon-map-marker"></i> Locations</h4>
				<div class="toolbar no-padding">
					<div class="btn-group">
						<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
					</div>
				</div>
			</div>
			<div class="widget-content" style="max-height:200px;overflow:auto;">
				<form class="form-horizontal" action="" method="post" >
					<div class="form-group" id="appliance_div">
					<?php
					$locations = $this->default_m->get_locations ();
					$tech_locations = $this->appliance_m->get_tech_locations ($user['id']);
					
					$tech_locs = [];
					if (! empty ($tech_locations)) {
						foreach ($tech_locations as $tl) {
							$tech_locs[] = $tl['location_id'];
						}
					}
					if($locations){
						foreach($locations as $loc){
							$checked = in_array($loc['id'],$tech_locs)?'checked="checked"':'';
							echo '<div class="col-md-6 col-sm-6 col-xs-6">
										<input type="checkbox" onchange="changeLocation(this)" name="loc[]" value="'.$loc['id'].'" '.$checked.' /> '.$loc['title'].'
									</div>';
						}
					}
					?>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="widget box">
			<div class="widget-header">
				<h4><i class="icon-cogs"></i> Skills</h4>
			</div>
			<div class="widget-content">
				<form id="add-skill" class="form-horizontal" action="<?php echo site_url("admin/user/add_skills/".$id);?>" method="post" >
				<div class="form-group">
					<div class="col-md-12" id="show-skills">
					<?php
					if (! empty ($skills)) {
					foreach ($skills as $skill) {
						$url = site_url ('admin/user/delete_skill/'.$user['id'].'/'.$skill['id']);
						$msg = 'Want to delete '.$skill['title'].' skill';
						?>
						<span class="badge badge-info ml-2 mb-2 "><?php echo $skill['title']; ?> <a href="javascript:void()" class="btn btn-xs btn-danger" onclick="showConfirm ('<?php echo $url; ?>','<?php echo $msg; ?>')">X</a></span>
						<?php
					}	
					}
					?>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<input type="text" name="skill_name" placeholder="Add skill" class="form-control" id="skill_name">
					</div>
				</div>
				<div class="action-group">
					<button type="submit" name="submit" class="btn btn-primary pull-right">Add</button>
				</div>
				<br clear="all" />
				</form>
			</div>
		</div>
	</div>
	<?php
	}else if($user['status']==STATUS_STAFF){
		$posts = $this->user_m->getStaffPost();
	?>
	<div class="row">
		<div class="widget box">
			<div class="widget-header">
				<h4><i class="icon-user"></i> Staff Previliges</h4>
				<div class="toolbar no-padding">
					<div class="btn-group">
						<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
					</div>
				</div>
			</div>
			<div class="widget-content">
				<form class="form-horizontal" action="<?php echo site_url("admin/user/updateServiceDetail/".$id);?>" method="post" >
					<div id="staffMSG"></div>
					<div class="form-group">
						<label for="" class="label-control col-md-3 col-sm-12 col-xs-12">Post Of Staff</label>
						<div class="col-md-9 col-sm-12 col-xs-12">
							<select name="post" id="staff_post" class="form-control">
							<?php
							if($posts){
								echo '<option value="0">Select Post</option>';
								foreach($posts as $post){
									echo '<option value="'.$post['id'].'">'.$post['title'].'</option>';
								}
							}
							?>
							</select>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php
	}
	?>
</div>
<div class="modal fade" id="profileImg">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="img-container">
            <div class="imageBox">
                <div class="thumbBox"></div>
                <div class="spinner" style="display: none">Loading...</div>
            </div>
            <div class="action">
                <form method="post">
                    <input type="file" id="file" class="form-control" style="position:absolute; visibility:hidden;">
                    <a id="selectFile" class="btn btn-sm btn-success btn-outline" style="margin-right:5px;">Select Image</a>
                    <a id="btnDone" class="btn btn-sm btn-warning" style="margin-right:5px;">Done</a>
                    <a id="btnZoomIn" class="btn btn-sm btn-primary" style="margin-right:5px;">Zoom In</a>
                    <a id="btnZoomOut" class="btn btn-sm btn-primary" style="margin-right:5px;">Zoom Out</a>
                </form>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<style>
	.modal-body .img-container
	{
		position: relative;
		width:98%;
		top: 5%; left: 0; right: 0; bottom: 0;
		text-align:center;
	}
	.action
	{
		width: 100%;
		height: 30px;
		margin: 10px auto;
	}
	.cropped>img
	{
		margin-right: 10px;
	}
	
	.imageBox
	{
		position: relative;
		/*height: 600px;
		width: 400px;
		border:1px solid #aaa;*/
		width:300px;
		height:300px;
		background: #fff;
		overflow: hidden;
		background-repeat: no-repeat;
		cursor:move;
		margin:0 auto;
	}
	
	.imageBox .thumbBox
	{
		position: absolute;
		/*top: 20%;
		left: 20%;*/
		width: 300px;
		height: 300px;
		/*margin-top: -35px;
		margin-left: -35px;*/
		box-sizing: border-box;
		border: 1px solid rgb(102, 102, 102);
		box-shadow: 0 0 0 1000px rgba(0, 0, 0, 0.5);
		background: none repeat scroll 0% 0% transparent;
	}
	
	.imageBox .spinner
	{
		position: absolute;
		top: 0;
		left: 0;
		bottom: 0;
		right: 0;
		text-align: center;
		line-height: 300px;
		background: rgba(0,0,0,0.7);
	}
</style>

<script src="<?php echo base_url($this->config->item("backend_path")."/plugins/crop/cropbox.js");?>"></script>
<script type="text/javascript">
    window.onload = function() {
        var options =
        {
            imageBox: '',
            thumbBox: '',
            spinner: '',
            imgSrc: ''
        }
        var cropper;
        document.querySelector('#file').addEventListener('change', function(){
            var reader = new FileReader();
			options = {imageBox:'.imageBox',thumbBox:'.thumbBox',spinner:'.spinner',imgSrc:'avatar.png'}
            reader.onload = function(e) {
                options.imgSrc = e.target.result;
                cropper = new cropbox(options);
            }
            reader.readAsDataURL(this.files[0]);
            //this.files = [];
        });
        /*document.querySelector('#signature').addEventListener('change', function(){
            var reader = new FileReader();
			var size = this.files[0].size;
			if(size<=(20480)){
				reader.onload = function(e) {
					$("#signImg").html("<img src='"+e.target.result+"' width='189px' height='76px' />");
					$("#sign").val(e.target.result)
				}
				reader.readAsDataURL(this.files[0]);
				//this.files = [];
			}else{
				alert("file too large. please select file under 20KB or less.");
				$('#sign').val('');
			}
        })*/
	   $('#btnDone').click(function(){
            var img = cropper.getDataURL();
			document.querySelector('#imgprd').src = img;
			document.getElementById('cropImg').value = img;
			$("#profileImg").modal("toggle");
        });
        document.querySelector('#btnZoomIn').addEventListener('click', function(){
            cropper.zoomIn();
        });
        document.querySelector('#btnZoomOut').addEventListener('click', function(){
            cropper.zoomOut();
        });
		
		$("#selectFile").click(function(){
			$("#file").click();

		});

	};
	//$('.datepicker').datepicker({changeYear:true});
	var addSkillFormSelector = document.getElementById ('add-skill');
	if (addSkillFormSelector) {	
		addSkillFormSelector.addEventListener ('submit', e => {
			e.preventDefault ();
			var formURL = addSkillFormSelector.getAttribute ('action');
			$.post( formURL, $( "#add-skill" ).serialize(), function(data, status){
				if(status=='success'){
					$('#show-skills').append (data);
					$('#skill_name').val ('');
				}else{

				}
			});
		});
	}
	var addtechFormSelector = document.getElementById ('tech_cat');
	if (addtechFormSelector) {
		addtechFormSelector.addEventListener ('change', e => {
			e.preventDefault ();
			$.get( '<?php echo site_url('admin/services/update_category/');?>'+addtechFormSelector.value+'/<?php echo $user['id'];?>', function(data, status){
				if(status=='success'){
					var msg = '<div class="alert alert-success fade in"><button class="close" aria-hidden="true" data-dismiss="alert" type="button"><i class="fa fa-times-circle" data-dismiss="alert"></i></button><i class="icon-remove close" data-dismiss="alert"></i> Update Category Successfully!</div>';
					$('#category_div').html(msg+$('#category_div').html());
				}
			});
		});
	}
	var staffPostSelector = document.getElementById ('staff_post');
	if (staffPostSelector) {	
		staffPostSelector.addEventListener ('change', e => {
			e.preventDefault ();
			$.get( '<?php echo site_url('admin/user/update_post/');?>'+$('#staff_post').val()+'/'+'<?php echo $user['id'];?>', function(data, status){
				if(status=='success'){
					var msg = '<div class="alert alert-success fade in"><button class="close" aria-hidden="true" data-dismiss="alert" type="button"><i class="fa fa-times-circle" data-dismiss="alert"></i></button><i class="icon-remove close" data-dismiss="alert"></i> Update Post Successfully!</div>';
					$('#staffMSG').html(msg);
				}
			});
		});
	}
	function updateApplnces(ele){
		var state = ele.checked?1:0;
		$.get( '<?php echo site_url('admin/services/changeTechAppliances/'.$user['id']);?>/'+ele.value+'/'+state);
	}
	function changeLocation(ele){
		var state = ele.checked?1:0;
		$.get( '<?php echo site_url('admin/services/changeTechLocation/'.$user['id']);?>/'+ele.value+'/'+state);
	}

</script>