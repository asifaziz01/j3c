<!--Contact Information Start-->
<section id="contact_information" style="padding-top:30px;">
    <div class="container">
        <div class="row"> 
            <!--Left Form Part-->
            <div class="col-md-12 col-sm-12 col-xs-12" style="background-color:#FFF;margin-bottom:10px;"> 
                <!--Contact Information-->
                <div class="contact_information_left "> 
                    <!-- HTML Form (wrapped in a .bootstrap-iso div) -->
                    <div class="booking_form">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h4><?php echo $page_title;?></h4>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6 text-right" style="padding-top:5px;">
                                    <a href="<?php echo site_url('public/main/editProfile');?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                                </div>
                                <table class="table table-striped table-condensed">
                                    <tbody>
                                        <tr>
                                            <?php
                                            $profilePic = $this->user_m->getProfilePic($me['id']);
                                            $profilePic = ($profilePic)? base_url($this->config->item("filemanager")."profile_pic/".$profilePic['filename']):base_url($this->config->item("filemanager")."profile_pic/no-profile.png");
                                            ?>
                                            <td width="40%" style="text-align:right;"></td>
                                            <td style="text-align:left;">
                                                <img src="<?php echo $profilePic;?>" style="width:100px;height:115px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%" style="text-align:right;">User ID :</td><td style="text-align:left;"><?php echo $me['username'];?></td>
                                        </tr>
                                        <tr>
                                            <td width="40%" style="text-align:right;">Name :</td><td style="text-align:left;"><?php echo $me['name'];?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:right;">Gender :</td><td style="text-align:left;"><?php echo ($me['gender']==1)?'Male':'Female';?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:right;">Address :</td><td style="text-align:left;"><?php echo $me['address'];?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:right;">Email :</td><td style="text-align:left;"><?php echo $me['email'];?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:right;">Contact No. :</td><td style="text-align:left;"><?php echo $me['phone'];?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
