<?php
$menus = $this->settings_m->getMenu();//json_decode($string,true);
?>
<div class="col-md-12 col-sm-12 no-padding">
	<form id="menufrm" action="<?php echo site_url('admin/settings/deletemenu');?>" method="post">
	<table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
		<thead>
			<th></th>
			<th>#</th>
			<th data-class="expand">Title</th>
			<th data-hide="phone,tablet">Parent</th>
			<th data-hide="phone,tablet">Link</th>
			<th data-hide="phone,tablet">Index</th>
			<th data-hide="phone,tablet">Status</th>
			<th>Action</th>
		</thead>
		<tbody>
		<?php
		if($menus)
		{
			foreach($menus as $menu){
				$parent = ($menu['parent']==0)?array('title'=>'Root'):$this->settings_m->getMenu($menu['parent']);
				$disabled = ($menu['parent']>0)?'disabled="disabled"':'';
				echo '<tr>';
				echo '<td><input type="checkbox" name="ids[]" value="'.$menu['id'].'" /></td>';
				echo '<td>'.$menu['id'].'</td>';
				echo '<td>'.$menu['title'].'</td>';
				echo '<td>'.$parent['title'].'</td>';
				echo '<td>'.$menu['link'].'</td>';
				echo '<td><input type="text" name="indx_'.$menu['id'].'" class="form-control" '.$disabled.' size="2" value="'.$menu['indexing'].'" /></td>';
				echo '<td>'.(($menu['status'])?'Enable':'Disable').'</td>';
				?>
				<td>
					<a class="btn btn-default btn-xs btn-alt" href="<?php echo site_url('"admin/settings/editmenu/'.$menu['id']);?>"><i class="icon-pencil"></i></a>
					<a class="btn btn-danger btn-xs btn-alt" href="javascript:void(0);" onClick="showConfirm('<?php echo site_url('admin/settings/deletemenu/'.$menu['id']);?>','Are You sure want to delete this menu.')"><i class="icon-trash"></i></a>
				</td>
				<?php
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
		<tfoot>
			<tr>
				<td colspan="8">
					<input type="submit" name="save" onclick="$('#menufrm').attr('action','<?php echo site_url('admin/settings/saveindex');?>')" value="Save" class="btn btn-primary pull-right" />
					<input type="submit" name="delete" value="Delete" class="btn btn-danger" />
				</td>
			</tr>
		</tfoot>
	</table>
	</form>
</div>