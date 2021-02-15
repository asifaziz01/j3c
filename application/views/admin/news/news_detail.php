<div class="block">
    <div class="block-title">
        <h2><?php echo $results['title'];?></h2>
    </div>
    <div class="block-content">
        <!--<p>You can add controls to a block and make it intera…</p>-->
        <ul class="fa-ul list-li-push">
            <li>
                <!--<i class="fa fa-li fa-check text-success"></i>-->
                <div class="col-md-4" style="text-align:right;"><strong>News Picture : </strong></div>
                <div class="col-md-4">
				<?php 
				$gallery_path = base_url($this->config->item('backend_template_path')."../contents/news/");
				?>
                <img src="<?php echo $gallery_path."/".$results['filename'];?>" width="250px" />
                </div>
                <br clear="all" />
            </li>
            <li>
                <!--<i class="fa fa-li fa-check text-success"></i>-->
                <div class="col-md-4" style="text-align:right;"><strong>News : </strong></div>
                <div class="col-md-4">
				<?php echo html_entity_decode($results['news']);?>
                </div>
                <br clear="all" />
            </li>
            <li>
                <!--<i class="fa fa-li fa-check text-success"></i>-->
                <div class="col-md-4" style="text-align:right;"><strong>Front Show : </strong></div>
                <div class="col-md-4">
				<?php echo ($results['front_show']==1)? "Yes" : "No";?>
                </div>
                <br clear="all" />
            </li>
            <li>
                <!--<i class="fa fa-li fa-check text-success"></i>-->
                <div class="col-md-4" style="text-align:right;"><strong>Date : </strong></div>
                <div class="col-md-4">
				<?php echo $results['date'];?>
                </div>
                <br clear="all" />
            </li>
            <li>
                <!--<i class="fa fa-li fa-check text-success"></i>-->
                <div class="col-md-12" style="text-align:right;">
                	<a href="<?php echo site_url("admin/news");?>" class="btn btn-warning"><i class="fa fa-repeat"></i> Back</a>
                </div>
                
                <br clear="all" />
            </li>
        </ul>
        <br clear="all" />
    </div>
    <p class="text-muted"></p>
</div>
