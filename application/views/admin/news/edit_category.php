<div class="row">
	<div class="col-md-5">
    	<div class="block">
            <form id="form-validation" class="form-horizontal form-bordered" method="post" action="<?php echo site_url("admin/news/edit_category/".$id);?>">
            
            <div class="form-group">
                <label class="control-label" for="val_username">Post Title 
                    <span class="text-danger">*</span>
                </label>
                <div class="col-md-12">
                    <div class="input-group">
                        <input type="text" name="title" value="<?php echo $results['title'];?>" class="form-control" />
                        <!--<span class="input-group-addon">
                            <i class="gi gi-user"></i>
                        </span>-->
                    </div>
                </div>
            </div>
            <div class="form-group form-actions">
                <div class="col-md-8 col-md-offset-4">
                    <button class="btn btn-sm btn-primary" type="submit">Update</button>
                    <a href="<?php echo site_url("admin/news");?>" class="btn btn-sm btn-warning">Cancel</a>
                </div>
            </div>
			</form>
        </div>
    </div>
    <div class="col-md-5">
    	<div class="block">
            <div class="table-responsive">
                <table class="datatable table table-vcenter table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
					$results = $this->news_m->getNewsCategory();
                    if($results){
                        foreach($results as $result){
                            echo '<tr>';
                                echo '<td>'.$result['title'].'</td>';
                                echo '<td>';
									if($result['delete_permission']){
										echo '<a href="'.site_url("admin/news/edit_category/".$result["id"]).'" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i>
										</a>
										<a href="'.site_url("admin/news/delete_category/".$result["id"]).'" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i>
										</a>';
									}
									echo '</td>';
                            echo '</tr>';
						}
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
