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
                                <form class="form-hrizontal" action="<?php echo site_url('public/main/add_feedback');?>" method="post">
                                    <div class="form-group">
                                        <label for="" class="label-control col-md-3 col-sm-4 col-xs-4 text-right">Subject &nbsp;&nbsp;&nbsp;</label>
                                        <div class="col-md-9 col-sm-8 col-xs-8">
                                            <input type="text" rows="8" name="subject" class="form-control" placeholder="subject">
                                        </div>
                                    </div>
                                    <br clear="all" /><br clear="all" />
                                    <div class="form-group">
                                        <label for="" class="label-control col-md-3 col-sm-4 col-xs-4 text-right">Message &nbsp;&nbsp;&nbsp;</label>
                                        <div class="col-md-9 col-sm-8 col-xs-8">
                                            <textarea rows="8" name="message" class="form-control" placeholder="Feedback"></textarea>
                                        </div>
                                    </div>
                                    <br clear="all" /><br clear="all" />
                                    <div class="form-actions">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <button type="submit" class="btn btn-primary pull-right">Submit</button>
                                        </div>
                                    </div>
                                </form>
                                <br clear="all" /><br clear="all" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>