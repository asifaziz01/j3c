<!--Contact Information Start-->
<section id="contact_information" style="padding-top:30px;">
    <div class="container">
        <div class="row"> 
            <!--Left Form Part-->
            <div class="col-md-12 col-sm-12 col-xs-12" style="background-color:#FFF;margin-bottom:10px;"> 
                <!--Contact Information-->
                <div class="contact_information_left "> 
                    <!-- HTML Form (wrapped in a .bootstrap-iso div) -->
                    <div class="booking_form">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h4><?php echo $page_title;?></h4>
                                </div>
                                <form class="form-horizontal" method="post">
                                <input type="hidden" value="" name="profile_pic" id="cropImg" />
                                <input type="hidden" name="father" value="<?php echo $me['father'];?>">
                                <input type="hidden" name="adhaar" value="<?php echo $me['adhaar'];?>">
                                <input type="hidden" name="pan" value="<?php echo $me['pan'];?>">
                                <input type="hidden" name="gst" value="<?php echo $me['gst'];?>">
                                <input type="hidden" name="company" value="<?php echo $me['company'];?>">
                                <table class="table table-striped table-condensed">
                                    <tbody>
                                        <tr>
                                            <?php
                                            $profilePic = $this->user_m->getProfilePic($me['id']);
                                            $profilePic = ($profilePic)? base_url($this->config->item("filemanager")."profile_pic/".$profilePic['filename']):base_url($this->config->item("filemanager")."profile_pic/no-profile.png");
                                            ?>
                                            <td width="40%" style="text-align:right;"></td>
                                            <td style="text-align:left;">
                                                <img id="imgprd" src="<?php echo $profilePic;?>" style="width:100px;height:115px;" />
                                                <br clear="all" />
                                                <a href="#" class="btn btn-default text-center" data-toggle="modal" data-target="#profileImg"><i class="fa fa-pencil"></i> Change Image</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%" style="text-align:right;">User ID :</td>
                                            <td style="text-align:left;"><?php echo $me['username'];?></td>
                                        </tr>
                                        <tr>
                                            <td width="40%" style="text-align:right;">Name :</td>
                                            <td style="text-align:left;"><input type="text" name="uname" class="form-control" value="<?php echo $me['name'];?>"></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:right;">Gender :</td>
                                            <td style="text-align:left;">
                                                <select name="gender" class="form-control">
                                                    <option value="1">Male</option>
                                                    <option value="2">FMale</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:right;">Address :</td>
                                            <td style="text-align:left;"><textarea name="address" class="form-control" ><?php echo $me['address'];?></textarea></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:right;">Email :</td>
                                            <td style="text-align:left;"><input type="text" name="email" class="form-control" value="<?php echo $me['email'];?>"></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:right;">Contact No. :</td>
                                            <td style="text-align:left;"><input type="text" name="mobile" class="form-control" value="<?php echo $me['phone'];?>" disabled></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2">
                                                <div class="form-actions">
                                                    <button Type="submit" name="submit" class="btn btn-primary pull-right">Save</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
</script>