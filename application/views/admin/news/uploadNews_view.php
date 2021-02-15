<!-- start div #main -->
	    <div id="main">
            <div class="main-content">
                <div class="full-width">
                    <div class="title-box">
                        <h1><?php echo $results['title'];?></h1>
                    </div>
                    <?php 
					$file = base_url("template/contents/news/")."/".$results['filename'];
					?>
                    <a href="<?php echo site_url("admin/news");?>" class="btn btn-default pull-right"><i class="fa fa-repeat"></i> Back</a>
                    <iframe src="http://docs.google.com/gview?url=<?php echo $file;?>&embedded=true" style="width:100%; height:700px;" frameborder="0"></iframe>
                </div> 
