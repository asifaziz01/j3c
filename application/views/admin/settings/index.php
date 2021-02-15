<?php 
$menus = $this->settings_m->getMenu(false,false,array('parent'=>0));//json_decode($string,true);
?>
<div class="col-md-4 col-sm-12">
	<div class="widget box">
		<div class="widget-header">
			<h4><i class="icon-list"></i> Menus</h4>
			<div class="toolbar no-padding">
				<div class="btn-group">
					<a class="btn btn-xs" href="<?php echo site_url("admin/settings/previeleges");?>" title="Previleges"><i class="icon-cogs"></i></a>
					<a class="btn btn-xs" href="<?php echo site_url("admin/settings/addmenu");?>"><i class="icon-plus"></i></a>
					<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
				</div>
			</div>
		</div>
		<div class="widget-content" style="max-height:350px;overflow:auto;">
			<div class="dd" id="nestable_list_1">
				<?php
				if($menus){
				?>
				<ol class="dd-list">
					<?php
					foreach($menus as $menu){
						$submenus = $this->settings_m->getMenu(false,false,array('parent'=>$menu['id']));
						if($submenus){
						?>
							<li class="dd-item" data-id="<?php echo $menu['id'];?>">
								<div class="dd-handle"><?php echo $menu['title'];?>
									<a class="btn btn-default btn-xs btn-alt pull-right" href="<?php echo site_url("admin/settings/editmenu/".$menu['id']);?>"><i class="icol-pencil"></i></a>
								</div>
								<ol class="dd-list">
								<?php
								foreach($submenus as $submenu){
								?>
									<li class="dd-item" data-id="<?php echo $submenu['id'];?>">
										<div class="dd-handle"><?php echo $submenu['title'];?>
											<a class="btn btn-default btn-xs btn-alt pull-right" href="<?php echo site_url("admin/settings/editmenu/".$submenu['id']);?>"><i class="icol-pencil"></i></a>
										</div>
									</li>
								<?php
								}
								?>
								</ol>
							</li>
						<?php
						}else{
						?>
							<li class="dd-item" data-id="<?php echo $menu['id'];?>">
								<div class="dd-handle"><?php echo $menu['title'];?>
									<a class="btn btn-default btn-xs btn-alt pull-right" href="<?php echo site_url("admin/settings/editmenu/".$menu['id']);?>"><i class="icol-pencil"></i></a>
								</div>
							</li>
						<?php
						}
						?>
						</li>
						<?php
					}
				?>
				</ol>
				<?php
				}
				?>
			</div>
		</div>
	</div>
</div>
<!--===== User Type =====-->
<div class="col-md-4 col-sm-12">
	<div class="widget box">
		<div class="widget-header">
			<h4>User Type</h4>
			<div class="toolbar no-padding">
				<div class="btn-group">
					<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
				</div>
			</div>
		</div>
		<div class="widget-content" style="max-height:350px;overflow:auto;">
			<form class="form-horizontal" action="<?php echo site_url("admin/settings/create_usertype");?>" onsubmit="submitForm(this,'result'); this.reset();return false;" method="post">
				<div class="form-group">
					<div class="col-md-3 col-sm-12" style="text-align:right;">
						<input type="checkbox" name="show_create" value="1" />
					</div>
					<label class="col-md-9 col-sm-12 control-label" style="text-align:left;">Show In Create</label>
				</div>
				<div class="form-group">
					<label class="col-md-3 col-sm-12 control-label">Type</label>
					<div class="col-md-9 col-sm-12">
						<input type="text" class="form-control" name="usertype" value="" placeholder="User Type" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 col-sm-12 control-label">Term</label>
					<div class="col-md-9 col-sm-12">
						<input type="text" class="form-control" name="term" value="" placeholder="Term" />
					</div>
				</div>
				<div class="form-actions">
					<input type="submit" class="btn btn-primary pull-right" value="Create" />
				</div>
				</div>
			<?php
			$userTypes = $this->settings_m->getUserType();//json_decode($string,true);
			?>
			<div id="result">
				<table class="table table-responsive table-condenced table-striped table-bordered">
					<thead>
						<th>#</th>
						<th>User</th>
						<th>Action</th>
					</thead>
					<tbody>
					<?php
					if($userTypes)
					{
						foreach($userTypes as $ut){
							echo '<tr>';
							echo '<td>'.$ut['id'].'</td>';
							echo '<td>'.$ut['title'].'</td>';
							echo '<td>';
							?>
							<a href="<?php echo site_url('admin/settings/deleteUserType/'.$ut['id']);?>" class="btn btn-xs btn-danger"><i class="icon-trash"></i></a>
							<?php 
							echo '</td>';
							echo '</tr>';
						}
					}else{
					?>
					<tr>
						<td></td><td>None Found!</td><td></td><td></td><td></td><td></td>
					</tr>
					<?php
					}
					?>
					</tbody>
				</table>
			</div>
			</form>
		</div>
	</div>
</div>

