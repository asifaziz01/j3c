<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4 class="title">Plan List</h4>
            </div>
            <div class="widget-content">
                <table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
                    <thead>
                        <th data-class="expand">#</th>
                        <th data-class="expand">Plan Title</th>
                        <th data-class="expand">Plan Amount</th>
                        <!--<th data-hide="phone,tablet">Contact No.</th>
                        <th data-hide="phone,tablet">Address</th>-->
                        <th data-hide="phone,tablet">Type</th>
                        <th data-hide="phone,tablet">Hour/Jobs</th>
                        <!--<th data-hide="phone,tablet">Brand</th>
                        <th data-hide="phone,tablet">Type</th>-->
                        <th data-class="expand">Action</th>
                    </thead>
                    <tbody>
                    <?php 
                    if (!empty ($plans)) {
                        $sr=1;
                        foreach ($plans as $plan) {
                            echo '<tr>';
                            echo '<td>'.$sr.'</td>';
                            echo '<td>'.$plan['title'].'</td>';
                            echo '<td>'.$plan['amount'].'</td>';
                            echo '<td>'.(($plan['type']==1)?'Job Hour':'No. of Jobs').'</td>';
                            echo '<td>'.$plan['hour'].'</td>';
                            echo '<td>';
                                echo '<a href="'.site_url('admin/plan/edit_plan/'.$plan['id']).'" title="Update" class="btn btn-success btn-xs"><i class="icon-pencil"></i></a>';
                            echo '</td>';
                            echo '</tr>';
                            $sr++;
                        }
                    }
                    ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6"><a href="<?php echo site_url('admin/plan/create_plan');?>" class="btn btn-primary primary-sm pull-right">Create Plan</a></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
