<br clear="all" />
<div class="col-md-12">
    <div class="box full">
        <div class="table-responsive">
            <table class="datatable table table-vcenter table-condensed table-bordered">
                <thead>
                    <tr>
                        <th>Content Title</th>
                        <th>Message</th>
                        <th>Show</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                if($results){
                    foreach($results as $result){
						$value = urldecode(html_entity_decode($result['news']));
                        echo '<tr>';
                            echo '<td>'.$result['title'].'</td>';
                            echo '<td>'.html_entity_decode($value).'</td>';
							echo '<td class="text-center">'.(($result['status'])?"Show":"").'</td>';
                            echo '<td>';
							if($this->session->userdata('status')==STATUS_ADMIN){
                            echo '<a href="'.site_url("admin/news/edit_news/".$result["id"]).'" data-toggle="tooltip" title="Edit Notification" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></a>
                                  <a href="'.site_url("admin/news/delete_news/".$result["id"]).'" data-toggle="tooltip" title="Delete Notification" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>';
							}
                            echo '</td>';
                        echo '</tr>';
                    }
                }
                ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            <div class="form-group actions-group">
                            	<?php if($this->session->userdata('status')==STATUS_ADMIN){?>
                                <a href="<?php echo site_url("admin/news/create_news");?>" class="btn btn-info" />Create News</a>
                                <!--<a href="<?php echo site_url("admin/news/upload_news");?>" class="btn btn-danger" />Upload Contents</a>
                                <a href="<?php echo site_url("admin/news/create_category");?>" class="btn btn-warning" />Category</a>-->
                                <?php } ?>
                            </div>
                        </td>
                   </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
