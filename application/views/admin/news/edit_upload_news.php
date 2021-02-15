<div class="row">
	<div class="col-md-12">
    	<div class="block">
            <form id="form-validation" class="form-horizontal form-bordered" method="post" action="<?php echo site_url("admin/news/edit_uploaded_news/".$id);?>" enctype="multipart/form-data">
            
            <div class="form-group">
                <label class="control-label col-md-4" for="val_username">Category 
                    <span class="text-danger">*</span>
                </label>
                <div class="col-md-6">
                    <div class="input-group">
                    	<?php
						$cats = $this->news_m->getNewsCategory();
						?>
                        <select name="cat_id" class="form-control">
                        	<?php
							if($cats){
								foreach($cats as $ct){
									$selected="";
									if(isset($_post["cat_id"]) && $this->input->post("cat_id")==$ct['id']){
											$selected = "Selected='Selected'";
									}
									?>
                                    <option value="<?php echo $ct['id'];?>" <?php echo $selected;?> ><?php echo $ct['title'];?></option>
                                    <?php
								}
							}
							?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4" for="val_username">News Title 
                    <span class="text-danger">*</span>
                </label>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" name="title" value="<?php echo $results["title"];?>" class="form-control" />
                        <!--<span class="input-group-addon">
                            <i class="gi gi-user"></i>
                        </span>-->
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4" for="val_username">News File 
                    <!--<span class="text-danger">*</span>-->
                </label>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="file" name="userfiles" value="" class="form-control" />
                        <br clear="all" />
                        <?php echo $results["filename"];?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4" for="val_username">News Date 
                    <span class="text-danger">*</span>
                </label>
                <div class="col-md-6">
                    <div class="input-group input-daterange" data-date-format="dd/mm/yyyy">
                        <input id="example-daterange1" class="form-control text-center" type="text" placeholder="From" name="date_from" value="<?php echo date("d/m/Y",strtotime($results["date_from"]));?>"></input>
                        <span class="input-group-addon">
                            <i class="fa fa-angle-right"></i>
                        </span>
                        <input id="example-daterange2" class="form-control text-center" type="text" placeholder="To" name="date_till" value="<?php echo  date("d/m/Y",strtotime($results["date_till"]));?>"></input>
                    </div>
                </div>
            </div>
            <div class="form-group form-actions">
                <div class="col-md-8 col-md-offset-4">
                    <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                    <a href="<?php echo site_url("admin/news");?>" class="btn btn-sm btn-warning">Cancel</a>
                </div>
            </div>
			</form>
        </div>
    </div>
