<div class="" style="">
	<div class="widget box">
		<div class="widget-header">
			<h4 class="title"><?php echo $page_title;?></h4>
			<div class="toolbar no-padding">
				<div class="btn-group">
					<a href="<?php echo site_url("admin/services/appliances");?>" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Back"><i class="icon-arrow-left"></i></a>
				</div>
			</div>
		</div>
		<div class="widget-content">
			<table class="table table-striped table-bordered">
				<?php 
				$total = 0;
				if($appliance){
					$category = $this->appliance_m->get_categories($appliance['category_id']);
					$logo = base_url($this->config->item('template_path').'images/'.$appliance['icon']);
					?>
					<tr>
						<td width="20%"></td>
						<td>
							<img src="<?php echo $logo;?>" width="50px" class="img-responsive center-block">
						</td>
					</tr>
					<tr>
						<td><strong>Category</strong></td><td><?php echo $category['title'];?></td>
					</tr>
					<tr>
						<td><strong>Name</strong></td><td><?php echo $appliance['appliance_name'];?></td>
					</tr>
					<tr>
						<td><strong>Service Type</strong></td><td><?php echo ($appliance['service_type']==1)?'Job Hour':'No. of Jobs';?></td>
					</tr>
					<tr>
						<td><strong>Heading Content</strong></td><td><?php echo $appliance['head_content'];?></td>
					</tr>
					<tr>
						<td><strong>Content Point</strong></td><td><?php echo $appliance['content'];?></td>
					</tr>
					<tr>
						<td><strong>Body Content</strong></td><td><?php echo $appliance['body_content'];?></td>
					</tr>
					<tr>
						<?php
						$content_img = ($appliance['body_content_image'])?base_url($this->config->item('filemanager').'content_image/'.$appliance['body_content_image']):'';
						?>
						<td><strong>Content Image</strong></td>
						<td><img src="<?php echo $content_img;?>" width="100px" class="img-responsive center-block"></td>
					</tr>
				<?php
				} 
				?>
			</table>
		</div>
	</div>
</div>