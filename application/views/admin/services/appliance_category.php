<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="widget box">
            <div class="widget-header">
                <h2 class="title"><?php echo $page_title;?></h2>
            </div>
            <div class="widget-content">
                <table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
                    <thead>
                        <tr>
                            <th>Icon</th>
                            <th width="70%">Category Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        if (!empty ($cats)) {
                            foreach ($cats as $cat) {
                                ?>
                                <tr>
                                    <td><span class="img-thumbnail bg-white rounded-circle p-4"><img width="25px" src="<?php echo base_url($this->config->item('template_path').'images/'.$cat['icon']); ?>" /></span></td>
                                    <td class=""><?php echo $cat['title']; ?></td>
                                    <td><?php echo anchor ('admin/services/new_appliance/'.$cat['id'], 'Add Appliance','class="btn btn-primary btn-xs"'); ?></td>
                                </tr>
                                <?php
                                $i++;
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">
                                <a class="btn btn-primary btn-sm" href="<?php echo site_url('admin/services/create_category');?>">Create Category</a>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
