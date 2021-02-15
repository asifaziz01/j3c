<div class="col-md-8 col-sm-12 no-padding">
	<div class="widget box">
		<div class="widget-header">
			<h4><i class="icon-user"></i> <?php echo $page_title;?></h4>
		</div>
		<div class="widget-content">
			<form class="form-horizontal" action="<?php echo site_url("admin/user/activateUser");?>" method="post" >
			  <div class="form-group">
				<div class="col-md-3">User ID</div>
				<div class="col-md-9">
				  <input type="text" name="uid" onchange="getUserDetail(this.value);" class="form-control" value="" placeholder="User ID" />
				</div>
			  </div>
			  <div class="form-group show_hide">
				<div class="col-md-3">User Name</div>
				<div class="col-md-9">
				  <input type="text" name="uname" class="form-control" value="" placeholder="User Name" readonly />
				</div>
			  </div>
			  <div class="form-group show_hide">
				<div class="col-md-3">Choose Package</div>
				<div class="col-md-9">
				  <!--<input type="text" name="pkg" class="form-control" value="" placeholder="Selected Package name" readonly />-->
				  <?php
				  $pkgs = $this->product_m->products(false,PKG);
				  ?>
				  <select name="pkg" class="form-control">
					<?php
					if($pkgs){
						foreach($pkgs as $pkg){
							echo '<option value="'.$pkg['id'].'">'.$pkg['name'].' ('.$pkg['mrp'].')'.'</option>';
						}
					}
					?>
				  </select>
				</div>
				<div style="font-size:11px;text-align:center;" id="spnsrName"></div>
			  </div>
			  <!--<div class="form-group show_hide">
				<div class="col-md-3">Amount</div>
				<div class="col-md-9">
				  <input type="text" name="amount" class="form-control" value="" placeholder="Amount" readonly />
				</div>
			  </div>-->
			  <div class="action-group">
				<div class="col-md-12"><br>
				  <button type="submit" name="submit" class="btn btn-primary pull-right">Activate Now</button>
				</div>
			  </div>
			  <br clear="all" />
			</form>
		</div>
	</div>
</div>
<script>
function getUserDetail(ABO){
	if(ABO){
		$('input[name=uname]').load('<?php echo site_url('admin/user/userDetailforTopup');?>/'+ABO, function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success"){
				if(!responseTxt){
					alert('Incorrect Sponser ID please check again.');
					$('input[name="uid"]').val('');
					$('input[name="uid"]').focus();
				}else{
					var val = $.parseJSON(responseTxt);
					$(".show_hide").css("display","block");
					$("input[name=uname]").val(val['uname']);
					$("input[name=pkg]").val(val['pkg']);
					$("input[name=amount]").val(val['amount']);
				}
			}
			if(statusTxt == "error"){
				alert('Something wrong in file Loading. Please contact your service provider.')
			}
		});
	}
}

$(".show_hide").css("display","none");
</script>
