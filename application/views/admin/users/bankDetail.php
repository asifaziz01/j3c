<div class="col-md-4 col-sm-12 no-padding">
	<div class="widget box">
		<div class="widget-header">
			<h4><i class="icon-list"></i> Set Bank Detail</h4>
		</div>
		<div class="widget-content">
			<?php
			$bankDet=false;
			if($id){
				$bankDet = $this->user_m->getUserBank($id);
			}
			?>
			<form class="form-horizontal" action="<?php echo site_url("admin/user/bankDetail/".$id);?>" method="post" >
				<div class="form-group">
					<div class="col-md-3">Name</div>
					<div class="col-md-9">
					  <input type="text" name="uname" class="form-control" value="<?php echo ($bankDet)?$bankDet['name']:'';?>" placeholder="Bank name" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-3">Account No.</div>
					<div class="col-md-9">
					  <input type="text" name="acc_no" class="form-control" value="<?php echo ($bankDet)?$bankDet['acc_no']:'';?>" placeholder="Account No" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-3">Bank Name</div>
					<div class="col-md-9">
					  <input type="text" name="bank" class="form-control" value="<?php echo ($bankDet)?$bankDet['bank']:'';?>" placeholder="Bank name" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-3">Branch</div>
					<div class="col-md-9">
					  <input type="text" name="branch" class="form-control" value="<?php echo ($bankDet)?$bankDet['branch']:'';?>" placeholder="Branch" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-3">IFSC</div>
					<div class="col-md-9">
					  <input type="text" name="ifsc" class="form-control" value="<?php echo ($bankDet)?$bankDet['ifsc']:'';?>" placeholder="IFSC Code" />
					</div>
				</div>
				<?php
				if(($this->session->userdata('status')==STATUS_ADMIN) || (($this->session->userdata('status')==STATUS_CUSTOMER && !$banks) || $id)){
				?>
				<div class="action-group">
					<div class="col-md-12"><br>
					  <button type="submit" name="submit" class="btn btn-primary pull-right">Add Detail</button>
					</div>
				</div>
				<?php
				}
				?>
				<br clear="all" />
			</form>
		</div>
	</div>
</div>

<div class="col-md-8 col-sm-12 no-padding">
	<div class="widget box">
		<div class="widget-header">
			<h4><i class="icon-user"></i> <?php echo $page_title;?></h4>
		</div>
		<div class="widget-content">
		  <table  class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
			<thead>
				<tr>
				  <th data-class="expand">#</th>
				  <th data-class="expand">Name</th>
				  <th data-class="expand">Account No</th>
				  <th data-hide="phone,tablet">Bank</th>
				  <th data-hide="phone,tablet">Branch</th>
				  <th data-hide="phone">IFSC</th>
				  <th data-hide="phone,tablet">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if($banks){
					$sr = 1;
					foreach($banks as $bank){
						?>
						<tr>
							<td><?php echo $sr++;?></td>
							<td><?php echo $bank['name'];?></td>
							<td><?php echo $bank['acc_no'];?></td>
							<td><?php echo $bank['bank'];?></td>
							<td><?php echo $bank['branch'];?></td>
							<td><?php echo $bank['ifsc'];?></td>
							<td>
								<a href="<?php echo site_url("admin/user/bankDetail/".$bank['id']);?>" data-toggle="tooltip"  class="btn btn-xs btn-success" title="Edit Detail"><i class="icon-pencil"></i></a>
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

<div class="modal fade" id="bankDet">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>