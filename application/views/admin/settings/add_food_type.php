<div class="col-md-6 col-sm-12">
	<div class="widget box">
		<div class="widget-header">
			<h4><i class="icon-plus"></i> <?php echo $page_title;?></h4>
		</div>
		<div class="widget-content">
			<form class="form-hroizontal row-border" action="" method="post" >
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-12">Type Title</label>
					<div class="col-md-9 col-sm-12">
						<input type="text" name="title" value="" class="form-control" placeholder="Food Type" />
					</div>
				</div>
				<br clear="all" />
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-12">Parent</label>
					<div class="col-md-9 col-sm-12">
						<?php
						$parent = $this->settings_m->getFoodType(false,array('parent'=>'0'));
						?>
						<select name="parent" class="select2 full-width-fix">
							<option value='0'>Main</option>
							<?php
							if($parent){
								foreach($parent as $prnt){
									echo '<option value='.$prnt['id'].'>'.$prnt['title'].'</option>';
								}
							}
							?>
						</select>
					</div>
				</div>
				<br clear="all" />
				<div class="form-actions">
					<a href="#" class="btn btn-danger">Cancel</a>
					<button type="submit" class="btn btn-primary pull-right">Add Type</button>
				</div>
			</form>
		</div>
	</div>
</div>