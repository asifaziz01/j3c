<br clear="all" />
<div class="col-md-12">
    <div class="box full">
    	<div class="box-header with-border">
        	<h4 class="box-title">Edit Notification</h4>
        </div>
        <div class="box-body">
            <form id="form-validation" class="form-horizontal form-bordered" method="post" onsubmit="encodeHtmlEntity()" action="<?php echo site_url("admin/news/edit_news/".$id);?>" enctype="application/x-www-form-urlencoded">
            
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
                                    if($results && $results['category_id']==$ct['id']){
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
                <label class="control-label col-md-4" for="val_username">Title 
                    <span class="text-danger">*</span>
                </label>
                <div class="col-md-6">
                    <input type="text" name="title" value="<?php echo $results['title'];?>" class="form-control" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4" for="val_username">Set Default 
                </label>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="radio" name="default" class="flat-red" value="1" <?php if($results['status']){echo 'checked="checked"';}?>/>
                    </div>
                </div>
            </div>
            <!--<div class="form-group">
                <label class="control-label col-md-4" for="val_username">Show At Front Page 
                </label>
                <div class="col-md-6">
                    <div class="input-group">
                        <label class="switch switch-success">
                            <input type="checkbox" name="front_show" value="1" <?php echo ($results['front_show']==1)? "checked='checked'": ""; ?> ></input>
                            <span></span>
                        </label>
                    </div>
                </div>
            </div>-->
            <div class="form-group">
                <label class="control-label col-md-4" for="val_username">Notification 
                    <span class="text-danger">*</span>
                </label>
                <div class="col-md-6">
                    <textarea name="news" class="form-control tinyeditor" ><?php echo html_entity_decode($results['news']);?></textarea>
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
</div>
