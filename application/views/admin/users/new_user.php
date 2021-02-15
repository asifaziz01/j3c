<div class="col-md-4 col-sm-12 no-padding">
	<div class="widget box">
		<div class="widget-header">
			<h4><i class="icon-picture"></i> Profile Picture</h4>
		</div>
		<div class="widget-content">
			<div class="list-group">
				<li class="list-group-item no-padding">
					<img id="imgprd" src="<?php echo base_url($this->config->item('filemanager').'/profile_pic/no-profile.png');?>" alt="">
				</li>
				<a href="javascript:void(0);" class="list-group-item text-center" data-toggle="modal" data-target="#profileImg"><i class="icon-pencil"></i> Select Image</a>
			</div>
		</div>
	</div>
</div>
<div class="col-md-8 col-sm-12 no-padding">
	<div class="widget box">
		<div class="widget-header">
			<h4><i class="icon-user"></i> New user</h4>
		</div>
		<div class="widget-content">
			<form class="form-horizontal" id="registration" action="<?php echo site_url("admin/user/create_user");?>" method="post" >
			  <input type="hidden" value="" name="profile_pic" id="cropImg" />
			  <?php
				$user_types = $this->settings_m->getUserType(false,array('show_create'=>1));
				if($user_types){
					echo '<div class="form-group">
							<div class="col-md-3">User Type</div>
							<div class="col-md-9">
							<select class="form-control" name="user_type">';
						foreach($user_types as $usrtyp){
						?>
						<option value="<?php echo $usrtyp['id'];?>"><?php echo $usrtyp['title'];?></option>
						<?php
						}
						echo '</select>';
					echo '</div></div>';
				}
			  ?>
			  <div class="form-group">
				<div class="col-md-3">Name</div>
				<div class="col-md-9">
				  <input type="text" name="uname"<?php echo (isset($_POST['uname']))?$_POST['uname']:'';?> class="form-control" value="" placeholder="name" />
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-md-3">Father Name</div>
				<div class="col-md-9">
				  <input type="text" name="father" class="form-control" value="<?php echo (isset($_POST['father']))?$_POST['father']:'';?>" placeholder="Father" />
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-md-3">Email</div>
				<div class="col-md-9">
				  <input type="email" name="email" class="form-control" value="<?php echo (isset($_POST['email']))?$_POST['email']:'';?>" placeholder="email" />
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-md-3">Password</div>
				<div class="col-md-9">
				  <input type="password" name="password" value="" class="form-control" placeholder="password"/>
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-md-3">Re-Enter Password</div>
				<div class="col-md-9">
				  <input type="password" name="repassword" class="form-control" value="" placeholder="Re-enter password" />
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-md-3">Gender</div>
				<div class="col-md-9">
				  <div class="form-check" align="left">
					  <label class="form-check-label" style="font-size:14px;">
						<input class="form-check-input" type="radio" name="gender" value="1" checked> Male
					  </label>&nbsp;&nbsp;&nbsp;&nbsp;
					  <label class="form-check-label" style="font-size:14px;">
						<input class="form-check-input" type="radio" name="gender" value="2"> Female
					  </label>
				  </div>
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-md-3">Adhaar</div>
				<div class="col-md-9">
				  <input type="text" name="adhaar" class="form-control" value="<?php echo (isset($_POST['adhaar']))?$_POST['adhaar']:'';?>" placeholder="Adhaar No" />
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-md-3">Pan</div>
				<div class="col-md-9">
				  <input type="text" name="pan" class="form-control" value="<?php echo (isset($_POST['pan']))?$_POST['pan']:'';?>" placeholder="Pan No" />
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-md-3">Mobile</div>
				<div class="col-md-9">
				  <input type="text" name="mobile" class="form-control" value="<?php echo (isset($_POST['mobile']))?$_POST['mobile']:'';?>" placeholder="Mobile No" />
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-md-3">Address</div>
				<div class="col-md-9">
				  <textarea name="address" class="form-control" placeholder="Address" ><?php echo (isset($_POST['address']))?$_POST['address']:'';?></textarea>
				</div>
			  </div>
			  <div class="action-group">
				<div class="col-md-12"><br>
				  <button type="submit" name="submit" class="btn btn-primary pull-right">Add New User</button>
				</div>
			  </div>
			  <br clear="all" />
			</form>
		</div>
	</div>
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
<?php if(isset($_POST['parent'])){?>
	<script>
		getParentName($('input[name=parent]').val());
		getLastSponser(this.value,$('input[name=leg]').val());
		getSponserName($('input[name=sponser]').val());
	</script>
<?php } ?>

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
<script>
function getSponserName(ABO){
	if(ABO){
		$('#spnsrName').load('<?php echo site_url('admin/user/sponserName');?>/'+ABO, function(responseTxt, statusTxt, xhr){
			$('#spnsrName').html('checking sponser details.');
			if(statusTxt == "success"){
				if(!responseTxt){
					alert('Incorrect Sponser ID please check again.');
					$('#spnsrName').html('');
					$('input[name="sponser"]').val('');
					$('input[name="sponser"]').focus();
				}else{
					$('#spnsrName').html(responseTxt);
					//$('input[name="parent"]').val(ABO);
					//getParentName(ABO);
				}
			}
			if(statusTxt == "error"){
				alert('Something wrong in file Loading. Please contact your service provider.')
			}
		});
	}
}
function getParentName(ABO){
	if(ABO){
		$('#parentName').load('<?php echo site_url('admin/user/sponserName');?>/'+ABO, function(responseTxt, statusTxt, xhr){
			$('#parentName').html('checking sponser details.');
			if(statusTxt == "success"){
				if(!responseTxt){
					alert('Incorrect Parent ID please check again.');
					$('#parentName').html('');
					$('input[name="parent"]').val('');
					$('input[name="parent"]').focus();
				}else{
					$('#parentName').html(responseTxt);
				}
			}
			if(statusTxt == "error"){
				alert('Something wrong in file Loading. Please contact your service provider.')
			}
		});
	}
}
</script>

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
	function getLastSponser(id,leg){
		$('input[name=sponser]').load('<?php echo site_url('admin/mlm/getLastSponser');?>/'+id+'/'+leg, function(responseTxt, statusTxt, xhr){
			//$('#parentName').html('checking sponser details.');
			if(statusTxt == "success"){
				if(!responseTxt){
					alert('Incorrect Sponser ID please check again.');
					$('#parentName').html('');
					$('input[name="parent"]').val('');
					$('input[name="parent"]').focus();
				}else{
					var val = $.parseJSON(responseTxt);
					$('input[name=sponser]').val(val['abo']);
					//$('#leg option').prop('disabled','disabled');
					$('#leg option[value="'+val['leg']+'"]').attr('disabled', false);
					$('#leg option[value="'+val['leg']+'"]').attr('selected', true);
					getSponserName(val['abo']);
					/*$('select[name=package] option').prop('disabled','disabled');
					$('select[name=package] option[value='+val['pkg']+']').prop('disabled',false);
					$('select[name=package] option[value='+val['pkg']+']').prop('selected',true);*/
					/*if(val['disable']){
						$('#leg option[value="'+val['disable']+'"]').attr('disabled', true);
					}*/
				}
			}else if(statusTxt == "error"){
				alert('Something wrong in file Loading. Please contact your service provider.')
			}
		});
	}
	//$('.datepicker').datepicker({changeYear:true});
</script>
