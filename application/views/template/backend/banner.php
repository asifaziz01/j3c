<?php
if(!isset($no_banner) && !isset($small_banner)){
?>
<!-- Background Area Start -->
<section id="slider" class="slider-area">	
    <div class="slider-wrapper">
        <div class="single-slide" style="background-image: url('<?php echo base_url($this->config->item('template_path').'img/slider/slider1.jpg');?>');">
            <div class="slider-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-content-wrapper">
                                <div class="text-content">
                                    <h2>Ashihara Karate <br  />International</h2>
                                    <p>Make yourself stronger. There Is difficult Way <br> in fornt you.</p>
                                    <a href="<?php echo site_url('login/registration');?>" class="default-btn">Registration</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slider-img">
                <div class="slider-img-three">
                    <img src="<?php echo base_url($this->config->item('template_path').'img/slider/slider-img.png');?>" alt="slider">
                </div>
            </div>
        </div>
        <div class="single-slide">
            <div class="slider-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-content-wrapper">
                                <div class="text-content">
                                    <h2>Ashihara Karate <br  />International</h2>
                                    <p>Make yourself stronger. There Is difficult Way <br> in fornt you.</p>
                                    <a href="<?php echo site_url('login/registration');?>" class="default-btn">Registration</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slider-img">
                <div class="slider-img-three">
                    <img src="<?php echo base_url($this->config->item('template_path').'img/slider/slider-img.png');?>" alt="slider">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Background Area End -->
<?php
}else if(!isset($no_banner) && isset($small_banner)){
?>
<!-- Banner Area Start -->
    <div class="banner-area-wrapper">
        <div class="banner-area text-center">	
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="banner-content-wrapper">
                            <div class="banner-content">
                                <h2><?php echo $page_title;?></h2> 
                                <!--<div class="banner-breadcrumb">
                                    <ul>
                                        <li><a href="index.html">home </a> - </li>
                                        <li>Login</li>
                                    </ul>
                                </div>-->
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
<!-- Banner Area End -->
<?php
}else{
?>
<!-- Banner Area Start -->
    <div class="banner-area-wrapper">
        <div class="text-left" style="background-color:#04F57B;padding-top:10px;padding-bottom:10px;">	
                <h2 style="color:#FFF;margin:10px;"><?php echo $page_title;?></h2> 
        </div>
    </div>
<!-- Banner Area End -->
<?php	
}
?>