<div class="col-md-6 col-sm-12">
	<div class="widget box">
		<div class="widget-header">
			<h4><i class="icon-plus"></i> Add Menu</h4>
		</div>
		<div class="widget-content">
			<form class="form-hroizontal row-border" action="" method="post" >
				<div class="form-group">
					<label class="col-md-3 control-label">Menu Title</label>
					<div class="col-md-9 col-sm-12">
						<input type="text" class="form-control" name="title" value="" placeholder="Menu Title" />
					</div>
				</div>
				<br clear="all" />
				<div class="form-group">
					<?php
					$menus = $this->settings_m->getMenu(false,false,array('parent'=>'0'));//json_decode($string,true);
					?>
					<label class="col-md-3 control-label">Parent</label>
					<div class="col-md-9 col-sm-12">
						<select name="parent" class="form-control">
							<option value="0">Root</option>
							<?php
							if($menus){
								foreach($menus as $menu){
									?>
									<option value="<?php echo $menu['id'];?>"><?php echo $menu['title'];?></option>
									<?php
								}
							}
							?>
						</select>
					</div>
				</div>
				<br clear="all" />
				<div class="form-group">
					<label class="col-md-3 control-label">Menu Link</label>
					<div class="col-md-9 col-sm-12">
						<input type="text" class="form-control" name="link" value="#" placeholder="Menu Link" />
					</div>
				</div>
				<br clear="all" />
				<div class="form-actions">
					<a href="<?php echo site_url("admin/settings");?>" class="btn btn-danger">Cancel</a>
					<button type="submit" class="btn btn-primary pull-right">Add Menu</button>
				</div>
			</form>
		</div>
	</div>
</div>