<form action="<?php echo site_url("admin/settings/previeleges");?>" method="post">
	<div class="col-md-3 col-sm-12">
		<table class="table table-responsive table-condenced table-striped table-bordered">
			<thead>
				<th>User Type</th>
			</thead>
			<tbody>
			<?php
			if($usertypes)
			{
				foreach($usertypes as $usertype){
					$checked = ($usrtyp && $usrtyp==$usertype['id'])?'checked="checked"':'';
					echo '<tr>';
					echo '<td><label><input type="radio" name="usrtyp" value="'.$usertype['id'].'" onchange="show_prev(this.value)" '.$checked.'> '.$usertype['title'].'</label></td>';
					echo '<?tr>';
				}
			}
			?>
			</tbody>
		</table>
	</div>
	<div class="col-md-9 col-sm-12">
		<table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
			<thead>
				<th>#</th>
				<th>Title</th>
				<th>Link</th>
				<th>Parent</th>
			</thead>
			<tbody id="menubody">
			<?php
			if($usrtyp && $menus)
			{
				$prev = $this->settings_m->getPrevieleges($usrtyp);
				$prev = explode(",",$prev['module_list']);
				foreach($menus as $menu){
					$checked = (in_array($menu['id'],$prev))?'checked="checked"':'';
					$parent = ($menu['parent']==0)?array('title'=>'Root'):$this->settings_m->getMenu($menu['parent']);
					echo '<tr>';
					echo '<td><input type="checkbox" name="mnu[]" value="'.$menu['id'].'" '.$checked.'></td>';
					echo '<td>'.$menu['title'].'</td>';
					echo '<td>'.$menu['link'].'</td>';
					echo '<td>'.$parent['title'].'</td>';
					echo '</tr>';
				}
				echo '<tr>
					<td colspan="4"><input type="submit" class="btn btn-primary pull-right" value="Set Previelege" /></td>
				</tr>
			';
			}
			?>
			</tbody>
		</table>
	</div>
</form>
<script>
function show_prev(id){
	getData('<?php echo site_url('admin/settings/getPrevieleges/');?>'+id,'menubody');
}
</script>