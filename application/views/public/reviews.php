<!--Contact Information Start-->
<section id="contact_information" style="padding-top:30px;">
    <div class="container">
        <div class="row"> 
            <!--Left Form Part-->
            <div class="col-md-12 col-sm-12 col-xs-12"> 
          
                <!--Contact Information-->
                <div class="contact_information_left "> 
            
                    <!-- HTML Form (wrapped in a .bootstrap-iso div) -->
                    <div class="booking_form">
                        <div class="container-fluid">
                            <div class="row">
                                <h4><?php echo $page_title;?></h4>
                                <table class="responsive">
                                    <thead>
                                        <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Review</th>
                                        <!--<th>Action</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    if (!empty ($feedback)) {
                                        $sr=1;
                                        foreach ($feedback as $fb) {
                                            ?>
                                            <td><?php echo $sr++;?></td>
                                            <td data-label="Date"><?php echo date('d M Y H:i:s',strtotime($fb['date']));?></td>
                                            <td data-label="Feedback"><?php echo $fb['message'];?></td>
                                            <!--<td data-label="Action">
                                                <a href="javascript:void(0);" onclick="showConfirm('<?php echo site_url('public/main/deleteFeedback/'.$fb['id']);?>','Are you sure want to delelte?')" class="btn btn-danger btn-xs" title="Delete"><i class="fa fa-trash"></i></a>
                                            </td>-->
                                            <?php
                                            echo '</tr>';
                                        }
                                    }else{
                                        echo '<tr><td colspan="3">No enquiry found.</td></tr>';
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <br clear="all" /><br clear="all" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>