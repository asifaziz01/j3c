<div class="row no-padding">
	<div class="widget box">
		<div class="widget-content">
			<table  class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
				<thead>
					<tr>
					<th data-class="expand">#</th>
					<th data-class="expand">Feedback</th>
					<th data-class="expand">Subject</th>
					<th data-class="expand">Name</th>
					<th data-hide="phone,tablet">Email</th>
					<th data-hide="phone,tablet">Mobile</th>
					<th data-hide="phone,tablet">Date</th>
					<th data-hide="phone,tablet">Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
				if($feedback){
					$sr = 1;
					foreach($feedback as $fb){
						?>
						<tr>
							<td><?php echo $sr++;?></td>
							<td><?php echo $fb['message'];?></td>
							<td><?php echo $fb['subject'];?></td>
							<td><?php echo $fb['name'];?></td>
							<td><?php echo $fb['email'];?></td>
							<td><?php echo $fb['mobile'];?></td>
							<td><?php echo date('d M Y H:i:s',strtitime($fb['date']));?></td>
							<td>
							</td>
						</tr>
						<?php
					}
				}
				?>
				</tbody>
			</div>
		</div>
	</div>
</div>
<script>
function dispatchNow(e){
	var conf = window.confirm("Are you sure this item is dispatched.");
		if(conf){
			document.location.href='<?php echo site_url('admin/user/dispatchNow');?>/'+e.value;
		}
}
</script>