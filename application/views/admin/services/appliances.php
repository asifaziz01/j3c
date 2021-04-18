<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="widget box">
            <div class="widget-header">
                <h4 class="title"><?php echo $page_title;?></h4>
                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs dropdown-toggle" data-toggle="dropdown">
                            Manage <i class="icon-angle-down"></i>
                        </span>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="<?php echo site_url('admin/services/brand');?>">Manage Brand</a></li>
                            <li><a href="<?php echo site_url('admin/services/appliance_type');?>">Manage Type</a></li>
                            <li><a href="<?php echo site_url('admin/services/appliance_issue');?>">Manage Issue</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="widget-content">
                <table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
                    <thead>
                        <tr>
                            <th data-class="expand">#</th>
                            <th data-class="expand">Icon</th>
                            <th data-class="expand">Name</th>
                            <th data-hide="phone,tablet">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        if (!empty ($appliances)) {
                            foreach ($appliances as $appliance) {
                                ?>
                                <tr>
                                    <td align="center"><?php echo $i;?></td>
                                    <td align="center"><span class="img-thumbnail bg-white rounded-circle p-4"><img width="25px" src="<?php echo base_url($this->config->item('template_path').'images/'.$appliance['icon']); ?>" /></span></td>
                                    <td><?php echo $appliance['appliance_name']; ?></td>
                                    <td>
                                        <a class="btn btn-xs btn-primary" data-toggle="tooltip" title="View Details" href="<?php echo site_url('admin/services/appliance_detail/'.$appliance['appliance_id']);?>"><i class="icon-search"></i></a>
                                        <a class="btn btn-xs btn-success" data-toggle="tooltip" title="Update Detail" href="<?php echo site_url('admin/services/edit_appliance/'.$appliance['category_id'].'/'.$appliance['appliance_id']);?>"><i class="icon-pencil"></i></a>
                                        <a class="btn btn-xs btn-danger" data-toggle="tooltip" title="Delete" href="javascript:void(0);" onclick="showConfirm('<?php echo site_url('admin/services/deleteAppliance/'.$appliance['appliance_id']);?>','Are you sure want to delete <?php echo $appliance['appliance_name']; ?>');"><i class="icon-trash"></i></a>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">
                            <a class="btn btn-primary btn-sm pull-right" href="<?php echo site_url('admin/services/add_appliance');?>">Create Appliance</a>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
