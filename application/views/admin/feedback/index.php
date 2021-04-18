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
							<td><?php echo date('d M Y H:i:s',strtotime($fb['date']));?></td>
							<td>
								<?php if(!$fb['status']){?>
								<a id="lnk<?php echo $fb['id'];?>" href="javascript:void(0);" onclick="verify('<?php echo $fb['id'];?>');" class="btn btn-success btn-xs">Verify</a>
								<?php }?>
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
function verify(id){
	$.get('<?php echo site_url('admin/user/feedbackVerify/');?>'+id,function(data,status,xhr){
		if(status=='success'){
			if(data){
				$('#lnk'+id).css('display','none');
			}
		}
	})
}
</script>