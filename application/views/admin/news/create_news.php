<br clear="all" />
<div class="col-md-12">
    <div class="box full">
    	<div class="box-header with-border">
        	<h4 class="box-title">Create Notification</h4>
        </div>
        <div class="box-body">
            <form id="form-validation" class="form-horizontal form-bordered" method="post" action="<?php echo site_url("admin/news/create_news");?>" enctype="multipart/form-data">
            
            <!--<div class="form-group">
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
            </div>-->
            <div class="form-group">
                <label class="control-label col-md-4" for="val_username">News Title 
                    <span class="text-danger">*</span>
                </label>
                <div class="col-md-6">
                    <input type="text" name="title" value="<?php echo $this->input->post("title");?>" class="form-control" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4" for="val_username">Set Default 
                </label>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="radio" name="default" class="flat-red" value="1"/>
                    </div>
                </div>
            </div>
            <!--<div class="form-group">
                <label class="control-label col-md-4" for="val_username">Show At Front Page 
                </label>
                <div class="col-md-6">
                    <div class="input-group">
                        <label class="switch switch-success">
                            <input type="checkbox" name="front_show" value="1"></input>
                            <span></span>
                        </label>
                    </div>
                </div>
            </div>-->
            <div class="form-group">
                <label class="control-label col-md-4" for="val_username">News 
                    <span class="text-danger">*</span>
                </label>
                <div class="col-md-6">
                    <textarea id="small-editor" name="news" class="form-control  tinyeditor" ><?php echo $this->input->post("news");?></textarea>
                    <!--<span class="input-group-addon">
                        <i class="gi gi-user"></i>
                    </span>-->
                </div>
            </div>
            <!--<div class="form-group">
                <label class="control-label col-md-4" for="val_username">News Date 
                    <span class="text-danger">*</span>
                </label>
                <div class="col-md-6">
                    <div class="input-group">
                        <input id="example-datepicker2" class="form-control input-datepicker" type="text" placeholder="dd/mm/yy" data-date-format="dd/mm/yy" name="date" value="<?php echo $this->input->post("date");?>"></input>
                    </div>
                </div>
            </div>-->
            <div class="form-group form-actions">
                <div class="col-md-8 col-md-offset-4">
                    <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                    <a href="<?php echo site_url("admin/news");?>" class="btn btn-sm btn-warning">Cancel</a>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>