<?php
$userTypes = $this->user_m->getUserType();//json_decode($string,true);
?>
<div class="col-md-12 col-sm-12">
	<table class="table table-responsive table-condenced table-striped table-bordered">
		<thead>
			<th>#</th>
			<th>User</th>
			<th>Action</th>
		</thead>
		<tbody>
		<?php
		if($menus)
		{
			echo '<tr>';
			foreach($userTypes as $ut){
				echo '<td>'.$ut['id'].'</td>';
				echo '<td>'.$ut['title'].'</td>';
				echo '<td>
					  </td>';
			}
			echo '</tr>';
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