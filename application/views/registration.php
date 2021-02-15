<form method="post" action="<?php echo site_url("login/registration");?>" >
	<input type="hidden" value="" name="profile_pic" id="cropImg" />
	  <div class="col-md-12 form-group">
		  <input type="text" name="parent" onchange="getParentName(this.value);getLastSponser(this.value,$('select[name=leg]').val())" class="form-control" value="<?php echo (isset($_POST['parent']))?$_POST['parent']:'';?>" placeholder="Sponser"/>
		<div style="font-size:11px;text-align:center;" id="parentName"></div>
	  </div>
	  <div class="col-md-12 form-group">
		  <input type="text" name="sponser" onchange="getSponserName(this.value);" class="form-control" value="<?php echo (isset($_POST['sponser']))?$_POST['sponser']:'';?>" placeholder="Upline" readonly />
		<div style="font-size:11px;text-align:center;" id="spnsrName"></div>
	  </div>
	  <div class="col-md-12 form-group">
		  <select name="leg" id="leg" onchange="getLastSponser($('input[name=parent]').val(),this.value)" class="form-control">
			<option value="<?php echo LEFT;?>">Left Leg</option>
			<option value="<?php echo RIGHT;?>">Right Leg</option>
		  </select>
	  </div>
	  <div class="col-md-12 form-group">
		  <?php
		  $pkgs = $this->product_m->products(false,PKG);
		  ?>
		  <select name="package" class="form-control">
			<?php
			if($pkgs){
				foreach($pkgs as $pkg){
					$disabled = ($pkg['status']==0)?'disabled="disabled"':"";
					echo '<option value="'.$pkg['id'].'" '.$disabled.'>'.$pkg['name'].' ('.$pkg['mrp'].')'.'</option>';
				}
			}
			?>
		  </select>
	  </div>
	  <!--<div class="form-group">
		<div class="col-md-3">Login ID</div>
		<div class="col-md-9">
		  <input type="text" name="login" class="form-control" value="" placeholder="Login ID"/>
		</div>
	  </div>-->
	  <div class="col-md-12 form-group">
		  <input type="email" name="email" class="form-control" value="<?php echo (isset($_POST['email']))?$_POST['email']:'';?>" placeholder="email" />
	  </div>
	  <div class="col-md-12 form-group">
		  <input type="password" name="password" value="" class="form-control" placeholder="password"/>
	  </div>
	  <div class="col-md-12 form-group">
		  <input type="password" name="repassword" class="form-control" value="" placeholder="Re-enter password" />
	  </div>
	  <div class="col-md-12 form-group">
		  <input type="text" name="uname"<?php echo (isset($_POST['uname']))?$_POST['uname']:'';?> class="form-control" value="" placeholder="name" />
	  </div>
	  <div class="col-md-12 form-group">
		  <input type="text" name="father" class="form-control" value="<?php echo (isset($_POST['father']))?$_POST['father']:'';?>" placeholder="Father" />
	  </div>
	  <div class="col-md-12 form-group">
		  <div class="form-check" align="left">
			  <label class="form-check-label" style="font-size:14px;">
				<input class="form-check-input" type="radio" name="gender" value="1" checked> Male
			  </label>&nbsp;&nbsp;&nbsp;&nbsp;
			  <label class="form-check-label" style="font-size:14px;">
				<input class="form-check-input" type="radio" name="gender" value="2"> Female
			  </label>
		  </div>
	  </div>
	  <div class="col-md-12 form-group">
		  <input type="text" name="adhaar" class="form-control" value="<?php echo (isset($_POST['adhaar']))?$_POST['adhaar']:'';?>" placeholder="Adhaar No" />
	  </div>
	  <div class="col-md-12 form-group">
		  <input type="text" name="pan" class="form-control" value="<?php echo (isset($_POST['pan']))?$_POST['pan']:'';?>" placeholder="Pan No" />
	  </div>
	  <div class="col-md-12 form-group">
		  <input type="text" name="mobile" class="form-control" value="<?php echo (isset($_POST['mobile']))?$_POST['mobile']:'';?>" placeholder="Mobile No" />
	  </div>
	  <div class="col-md-12 form-group">
		  <textarea name="address" class="form-control" placeholder="Address" ><?php echo (isset($_POST['address']))?$_POST['address']:'';?></textarea>
	  </div>
	  <div class="col-md-12 action-group">
		<div class="col-md-12"><br>
		  <button type="submit" name="submit" class="btn btn-primary pull-right">Add New User</button>
		</div>
	  </div>
	<br clear="all" /><br clear="all" /><br clear="all" /><br clear="all" />
	<div class="col-md-12">
		<a href="javascript:void(0);" onclick="getData('<?php echo site_url("login/show_login");?>','formDiv');" class="btn btn-danger pull-left">Login</a>
		<a href="<?php echo site_url("login/new_registeration");?>" class="btn btn-success pull-right">Forgot Password</a>
	</div>
</form>
