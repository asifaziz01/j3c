<?php
$profilePic = $this->user_m->getProfilePic($profile['id']);
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
			</div>
		</div>
	</div>
</div>
<div class="col-md-8 col-sm-12 no-padding">
	<div class="widget box">
		<div class="widget-header">
			<h4><i class="icon-user"></i> Prfile Detail</h4>
			<div class="toolbar no-padding">
				<a href="<?php echo site_url('admin/user/edit_profile');?>" class="btn btn-primary"><i class="icon-pencil"></i></a>
			</div>
		</div>
		<div class="widget-content">
			<form class="form-horizontal">
			<div class="form-group">
				<div class="col-md-3">Login ID</div>
				<div class="col-md-9">
				  <?php echo $profile['username'];?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">Email</div>
				<div class="col-md-9">
				  <?php echo $profile['email'];?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">Name</div>
				<div class="col-md-9">
				  <?php echo $profile['name'];?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">Father Name</div>
				<div class="col-md-9">
				  <?php echo $profile['father'];?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">Gender</div>
				<div class="col-md-9">
				  <?php echo ($profile['gender']==1)?'Male':'Female';?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">Adhaar</div>
				<div class="col-md-9">
				  <?php echo $profile['adhaar'];?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">Pan</div>
				<div class="col-md-9">
				  <?php echo $profile['pan'];?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">Mobile</div>
				<div class="col-md-9">
				  <?php echo $profile['phone'];?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">Address</div>
				<div class="col-md-9">
				  <?php echo $profile['address'];?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">Registration Date</div>
				<div class="col-md-9">
				  <?php echo date('d M Y',strtotime($profile['reg_date']));?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">Aproval Date</div>
				<div class="col-md-9">
				  <?php echo date('d M Y',strtotime($profile['appr_date']));?>
				</div>
			</div>
			</form>
			<br clear="all" />
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
</script>
