<div class="row no-padding">
	<div class="widget box">
		<div class="widget-content">
			<table  class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
				<thead>
					<tr>
					<th data-class="expand">#</th>
					<th data-class="expand">Name</th>
					<th data-class="expand">Type</th>
					<th data-hide="phone">Mobile</th>
					<th data-hide="phone,tablet">Status</th>
					<th data-hide="phone,tablet">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if($technicians){
						$sr = 1;
						foreach($technicians as $technician){
							$userType = $this->settings_m->getUserType($technician['status']);
							?>
							<tr>
								<td><?php echo $sr++;?></td>
								<td><?php echo $technician['name'];?></td>
								<td><?php echo $userType['title'];?></td>
								<td><?php echo $technician['phone'];?></td>
								<td>
								<?php 
								echo ($technician['approved']=='1')?'<span class="label label-success label-sm">Verified</span>':'<span class="label label-danger label-sm">Not Verified</span>';
								?>
								</td>
								<td>
									<a href="javascript:void(0);" onclick="getTechDetail('<?php echo $technician['id'];?>')" class="btn btn-xs btn-primary" data-toggle="tooltips" title="Detail"><i class="icon-list"></i></a>
								</td>
							</tr>
							<?php
						}
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal fade" id="techDetail" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Technician verification</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="techList"></div>
      <div class="modal-footer">
        <button type="button" id="verifyButton" class="btn btn-primary" onclick="$('#techDet').submit();" disabled>Verify Now</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
function getTechDetail(tid){
	$('#techDetail').modal('toggle');
	$('#loader').css("display","block");
	$.get('<?php echo site_url('admin/user/techDetail');?>/'+tid,function(data,status){
		if(status=='success'){
			$('#techList').html(data);
			$('#verifyButton').attr('disabled',false)
		}
		$('#loader').css("display","none");
	});
}
</script>