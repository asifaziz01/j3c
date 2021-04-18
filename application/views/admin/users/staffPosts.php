<div class="row">
    <div class="col-md-5 col-sm-12 col-xs-12">
        <div class="widget box">
            <div class="widget-header">
                <h4 class="title">Create/Update Post</h4>
            </div>
            <div class="widget-content">
                <form class="form-horizontal" action="<?php echo site_url('admin/user/staff_posts/'.$id);?>" method="post">
                    <div class="form-group">
                        <label for="" class="label-control col-md-4 col-sm-12 col-xs-12">Post Title</label>
                        <div class="col-md-8 col-sm-12 col-xs-12">
                            <input type="text" class="form-control" name="title" id="" value="<?php echo ($post)?$post['title']:'';?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="label-control col-md-4 col-sm-12 col-xs-12">Previliges</label>
                        <div class="col-md-8 col-sm-12 col-xs-12">
                            <?php
                            $save_prev=[];
                            if($post){
                                $save_prev=explode(',',$post['previliges']);
                            }
                            $prev = $this->role_m->getPrivilage(STATUS_STAFF);
                            $prev = explode(",",$prev['module_list']);
                            $menus = $this->settings_m->getMenu();
                            foreach($menus as $menu){
                                if(in_array($menu['id'],$prev)){
                                    $checked = (in_array($menu['id'],$save_prev))?'checked="checked"':'';
                                    echo '<p><label><input type="checkbox" name="mnu[]" value="'.$menu['id'].'" '.$checked.'>&nbsp;';
                                    echo $menu['title'].'</label></p>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-actions">
                        <input type="submit" value="<?php echo ($post)?'Update':'Create';?>" class="btn btn-primary btn-sm pull-right">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-7 col-sm-12 col-xs-12">
    <div class="widget box">
            <div class="widget-header">
                <h4 class="title"><?php echo 'Post List';?></h4>
            </div>
            <div class="widget-content">
                <table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th width="70%">Post</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        if (!empty ($posts)) {
                            $sr=1;
                            foreach ($posts as $post) {
                                ?>
                                <tr>
                                    <td><?php echo $sr++;?></td>
                                    <td class=""><?php echo $post['title']; ?></td>
                                    <td>
                                        <?php echo anchor ('admin/user/staff_posts/'.$post['id'], '<i class="icon-pencil"></i>','class="btn btn-primary btn-xs"'); ?>
                                        <a href='javascript:void(0);' class="btn btn-danger btn-xs" onclick="showConfirm('<?php echo site_url('admin/user/delete_posts/'.$post['id']);?>','Are you sure want to delete.')" ><i class="icon-trash"></i></a>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
