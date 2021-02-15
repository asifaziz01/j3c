<!--/team-->
<style>
h2,h3,h4,h5,h6{
    background-color:#999;
    color:#FFF;
}
</style>
<section class="container">
	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
		<div class="row">
			<form id="form-horizontal" action="<?php echo site_url ('public/home/services'); ?>" method="POST" class="serach-form-area ">
				<div class="col-md-5 col-sm-12 col-xs-12">
					<select class="form-control" name="category">
						<option value="0">Choose Category</option>
						<?php
							if (! empty ($tech_categories)) {
								foreach ($tech_categories as $cat) {
									$selected = ($_POST['category']==$cat['id'])?'selected="selected"':'';
									?>
									<option value="<?php echo $cat['id']; ?>" <?php echo $selected;?> ><?php echo $cat['title']; ?></option>
									<?php
								}						
							}
						?>
					</select>
				</div>
				<div class="col-md-5 col-sm-12 col-xs-12">
					<select id="location" name="location"  class="form-control select2">
						<option value="">Select Location</option>
						<?php 
							if (! empty($locations)) {
								foreach ($locations as $app) {
									$selected = ($_POST['location']==$app['id'])?'selected="selected"':'';
									?>
									<option value="<?php echo $app['id']; ?>" <?php echo $selected;?> ><?php echo $app['title']; ?></option>
									<?php
								}
							}
							?>
					</select>
				</div>
				<div class="col-md-2 col-sm-12 col-xs-12">
					<button type="submit" style="float:left;" class="btn btn-primary">Find Provider</button>
				</div>
			</form>
		</div>
		<div class="col-lg-12 col-md-12">
			<h3 align="center">Our <span>Professional</span> Service Providers</h3>
			<?php
			if($technicians){
				foreach($technicians as $tech){
					$skills = $this->technicians_model->get_skills($tech['member_id']);
					$pi = $this->users_model->view_profile_image ($tech['member_id']);
					$tech['name'] = $tech['first_name'].(($tech['second_name'])?' '.$tech['second_name']:' ').$tech['last_name'];
					$category = $this->technicians_model->get_technician_categories($tech['category_id']);
					?>
					<div class="col-lg-6 col-md-6">
						<img src="<?php echo base_url ($pi); ?>" width="100%" alt="">
						<div class="team-title">
							<h5 class="text-center"><strong><?php echo $tech['name']; ?></strong></h5>
							<p class="desp"> <?php echo $category['title']; ?></p>
							<!--<ul class="team-social-icons">
								<li class="facebook">
									<a href="#link" title="Facebook">
										<span class="fa fa-facebook" aria-hidden="true"></span>
									</a>
								</li>
								<li class="twitter">
									<a href="#link" title="Twitter">
										<span class="fa fa-twitter" aria-hidden="true"></span>
									</a>
								</li>
								<li class="dribbble">
									<a href="#link" title="Dribbble">
										<span class="fa fa-dribbble" aria-hidden="true"></span>
									</a>
								</li>

							</ul>-->
						</div>
					</div>
					<?php
				}
			}
			?>
		</div>
	</div>
</section>
<div class="modal fade" id="maplocation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Set your location here</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="map"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
      </div>
    </div>
  </div>
</div>
<!-- End testimonial Area -->
<script src="https://apis.mapmyindia.com/advancedmaps/v1/<?php echo MAP_API;?>/map_load?v=1.3"></script>
<!-- model for Map location -->
<script type="text/javascript">
var lastResult='';
function createOptions(val){
	if(val){
		$('#loader').css("display","block");
		$("#brand").load('<?php echo site_url('public/home/createOptions');?>/brand/'+val, function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success"){
				$('#loader').css("display","none");
				if(!responseTxt){
					alert('No data available.');
				}else{
					//$("#brand").attr("disabled",false);
					$("#search").attr("disabled",false);
					$("#brand").focus();
					$("#brand").html(responseTxt);
					$("#type").load('<?php echo site_url('public/home/createOptions');?>/type/'+val, function(responseTxt, statusTxt, xhr){
						if(statusTxt == "success"){
						if(!responseTxt){
							alert('No data available.');
						}else{
							//$("#type").attr("disabled",false);
							$("#type").html(responseTxt);
						}
						}
						if(statusTxt == "error"){
						alert('Something wrong in file Loading. Please contact your service provider.');
						}
					});
					$("#issue").load('<?php echo site_url('public/home/createOptions');?>/issue/'+val, function(responseTxt, statusTxt, xhr){
						if(statusTxt == "success"){
						if(!responseTxt){
							alert('No data available.');
						}else{
							//$("#issue").attr("disabled",false);
							$("#issue").html(responseTxt);
						}
						}
						if(statusTxt == "error"){
						alert('Something wrong in file Loading. Please contact your service provider.');
						}
					});
				}
			}
			if(statusTxt == "error"){
				$('#loader').css("display","none");
				alert('Something wrong in file Loading. Please contact your service provider.');
			}
		});
	}else{
		/*$("#brand").attr("disabled",true);
		$("#type").attr("disabled",true);
		$("#issue").attr("disabled",true);*/
		$("#search").attr("disabled",true);
	}
}
function validateSearch(stype){
	$('#loader').css("display","block");
	if(stype=="search1"){
		var appliance = $('#appliance').val();
		var brand = $('#brand').val();
		var type = $('#type').val();
		var issue = $('#issue').val();
		if(brand=="" || type=="" || issue==""){
			$('#loader').css("display","none");
			alert("Please fill all required fields.");
			return false;
		}else{
			$("#search1").load(encodeURI('<?php echo site_url('public/home/nextFilter');?>/'+appliance+'/'+brand+'/'+type+'/'+issue), function(responseTxt, statusTxt, xhr){
				if(statusTxt == "success"){
					$('#loader').css("display","none");
					if(!responseTxt){
						alert('Problem in Load! try again.');
					}else{
						$("#search1").html(responseTxt);
					}
				}
				if(statusTxt == "error"){
					$('#loader').css("display","none");
					alert('Something wrong in file Loading. Please contact your service provider.');
				}
			});
			return false;
		}
	}else if(stype=="search2"){
		var appliance = $('#appliance').val();
		var brand = $('#brand').val();
		var type = $('#type').val();
		var issue = $('#issue').val();
		var customer_name = $('#customer_name').val();
		var mobile = $('#mobile').val();
		var location = $('#location').val();
		var map_location = $('#map_location').val();
		var address = $('#address').val();
		if(location=="" || address=="" || map_location==""){
			$('#loader').css("display","none");
			alert("Please give your address, location and set map location.");
			return false;
		}else{
			$('#loader').css("display","none");
			return true;
		}
	}
}
function sendOTP(mobile,name){
	if(mobile && name){
		if(mobile.length==10){
			$('#loader').css("display","block");
			$('input[name=mobile]').load('<?php echo site_url('customer/services_actions/sendOTP');?>/'+mobile+'/'+name, function(responseTxt, statusTxt, xhr){
				if(statusTxt == "success"){
					if(!responseTxt){
						alert('try again.');
					}else{
						$('input[name=mobile]').attr("readonly",true);
						$('input[name=otp]').attr("disabled",false);
						$('input[name=otp]').focus();
					}
				}
				if(statusTxt == "error"){
					alert('Something wrong in file Loading. Please contact your service provider.');
				}
				$('#loader').css("display","none");
			});
		}
	}
}
function verifyOTP(mobile,otp){
	if(mobile && otp){
		if(otp.length==6){
			$('#loader').css("display","block");
			$('input[name=otp]').load('<?php echo site_url('customer/services_actions/verifyOTP');?>/'+mobile+'/'+otp, function(responseTxt, statusTxt, xhr){
				if(statusTxt == "success"){
					$('#loader').css("display","none");
					if(!responseTxt){
						alert('Invalid OTP, please enter valid OTP or resend OTP.');
					}else{
						$('input[name=mobile]').attr('readonly',false);
						$('#location').attr('disabled',false);
						$('#address').attr('disabled',false);
						$('#searchbtn').attr('disabled',false);
					}
				}
				if(statusTxt == "error"){
					$('#loader').css("display","none");
					alert('Something wrong in file Loading. Please contact your service provider.');
				}
			});
		}
	}
}
	function getLocation(event,value){
      //if(value && (event.keyCode==32 || event.keyCode==188)){
      if(value){
		$(".list-option").css("display","block");
        $(".list-option").html('Proccessing ....');
        $('.list-option').load("<?php echo site_url('public/home/locationsOutput/');?>"+encodeURI(value), function(responseTxt, statusTxt, xhr){
          if(statusTxt == "success"){
			if(responseTxt){
				lastResult = responseTxt
				$(".list-option").html(responseTxt);
			}else{
				$(".list-option").html(lastResult);
			}
          }
        });
      }
    }
	function getValue(val,place_id){
		$('input[name=location]').val(val);
		$('input[name=place_id]').val(place_id);
		$('input[name=city_id]').load('<?php echo site_url('public/home/getCityByPlaceId/');?>'+place_id, function(responseTxt, statusTxt, xhr){
          if(statusTxt == "success"){
			if(responseTxt){
				$("input[name=city_id]").val(responseTxt);
			}else{
				$("#cityModal").modal('show');
				//$("input[name=city_id]").html(lastResult);
			}
          }else{
			alert('city not available! please select by list1.');
		  }
        });
    	$('.list-option').html('');
		$(".list-option").css("display","none");
    }
</script>
