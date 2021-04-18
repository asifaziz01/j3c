  <!--Our services Section Satrt-->
  <section id="services">
    <div class="container text-center" style="padding-left:0px">
      <h1 class="panel-heading">Our services</h1>
      <?php
        $categories = $this->appliance_m->get_categories();
        if($categories){
          echo '<ul class="services-list" style="text-align:left;">';
          foreach($categories as $cat){
            $appliances = $this->appliance_m->get_appliances($cat['id']);
            if($appliances){
              foreach($appliances as $appliance){
                echo '<li><a href="'.site_url('public/main/issueForm/'.$cat['id'].'/'.$appliance['appliance_id']).'"><img src="'.base_url ($this->config->item("template_path").'images/'.$appliance['icon']).'" alt="'.$appliance['appliance_name'].'" /><br />'.$appliance['appliance_name'].'</a></li>';
              }
            }
          }
          echo '</ul>';
        }
        ?>
    </div>
  </section>
  <!--Our services Section End--> 
  
  <!--How it works Section Satrt-->
  <section id="howitwork">
    <div class="container text-center">
      <h1 class="panel-heading">How it works</h1>
      <div class="row">
        <div class="col-md-3 col-xs-offset-0 step-one"> <img  src="<?php echo base_url ($this->config->item("template_path").'images/choose_service.png');?>" alt="Book" class="img-circle htw" />
          <h4>Pick A Service</h4>
          <p>Find your service, investigate the up-front prices and highly reviewed Independent Service Technician.</p>
        </div>
        <div class="col-md-1 hidden-xs hidden-sm"> </div>
        <div class="col-md-3 step-two"> <img  src="<?php echo base_url ($this->config->item("template_path").'images/Book.png');?>" alt="Schedule" class="img-circle" />
          <h4>Book Online</h4>
          <p>Simply tell us what the problem is and when and where a Technician should show up.</p>
        </div>
        <div class="col-md-1 hidden-xs hidden-sm"> </div>
        <div class="col-md-3"> <img  src="<?php echo base_url ($this->config->item("template_path").'images/pay.png');?>" alt="Relax" class="img-circle" />
          <h4>Pay After Work is Done</h4>
          <p>We connect you to a technician who will fix your problem — you pay only after the work is completed .</p>
        </div>
      </div>
    </div>
  </section>
  <!--How it works Section End--> 
  
  <!--Trust Security Section Satrt-->
  <section id="trust-security">
    <div class="container text-center">
      <h1 class="panel-heading">Your Trust and Security</h1>
      <div class="row text-left">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="icon_box_one">
            <div class="icons"><img src="<?php echo base_url ($this->config->item("template_path").'images/time.png');?>" alt="SAVES" /></div>
            <div class="box_content">
              <h4>SAVES YOU TIME</h4>
              <p>We helps you live smarter, giving you time to focus on what's most important.</p>
              <!--<a href="#" class="read-more">Read More <span class="glyphicon glyphicon-menu-right"></span></a>--> </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="icon_box_one">
            <div class="icons"><img src="<?php echo base_url ($this->config->item("template_path").'images/Safety.png');?>" alt="Safety" /></div>
            <div class="box_content">
              <h4>For Your Safety</h4>
              <p>All of our Helpers undergo rigorous identity checks and personal interviews. Your safety is even our concern too.</p>
              <!--<a href="#" class="read-more">Read More <span class="glyphicon glyphicon-menu-right"></span></a>--> </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="icon_box_one">
            <div class="icons"><img src="<?php echo base_url ($this->config->item("template_path").'images/best.png');?>" alt="Best"  /></div>
            <div class="box_content">
              <h4>Best-Rated Professionals</h4>
              <p>Our experienced taskers perform their tasks with dedication and perfection. We appreciate your reviews about the service.</p>
              <!--<a href="#" class="read-more">Read More <span class="glyphicon glyphicon-menu-right"></span></a>--> </div>
          </div>
        </div>
        <!--<div class="col-md-4 col-sm-6 col-xs-12">
          <div class="icon_box_one">
            <div class="icons"><img src="<?php echo base_url ($this->config->item("template_path").'images/Equipped.png');?>" alt="Equipped" /></div>
            <div class="box_content">
              <h4>We Are Well Equipped</h4>
              <p>Let us know if you have any specific equirement, otherwise our guys carry their own supplies.</p>
          </div>
        </div>-->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="icon_box_one">
            <div class="icons"><img src="<?php echo base_url ($this->config->item("template_path").'images/touch.png');?>" alt="Always" /></div>
            <div class="box_content">
              <h4>Always In Touch</h4>
              <p>Book your service online on one tap, keep a track of your service status and also keep in touch with your Helper.</p>
              <!--<a href="#" class="read-more">Read More <span class="glyphicon glyphicon-menu-right"></span></a>--> </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="icon_box_one">
            <div class="icons"><img src="<?php echo base_url ($this->config->item("template_path").'images/cash.png');?>" alt="cash" /></div>
            <div class="box_content">
              <h4>Cash-Free Facility</h4>
              <p>Pay through secure online mode only after your job is done.</p>
              <!--<a href="#" class="read-more">Read More <span class="glyphicon glyphicon-menu-right"></span></a>--> </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="icon_box_one">
            <div class="icons"><img src="<?php echo base_url ($this->config->item("template_path").'images/cash.png');?>" alt="cash" /></div>
            <div class="box_content">
              <h4>15 Days Warranty</h4>
              <p>All appliance services are covered by 15 days warranty any issues with in our warranty period please
 call us immediately.</p>
              <!--<a href="#" class="read-more">Read More <span class="glyphicon glyphicon-menu-right"></span></a>--> </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="icon_box_one">
            <div class="icons"><img src="<?php echo base_url ($this->config->item("template_path").'images/cash.png');?>" alt="cash" /></div>
            <div class="box_content">
              <h4>Excellent customer support</h4>
              <p>You can believe us for any service assistance. we might be glad to answer your queries via call or e-mail reach us. we might like to hear from you.</p>
              <!--<a href="#" class="read-more">Read More <span class="glyphicon glyphicon-menu-right"></span></a>--> </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--Trust Security Section End--> 
  
  <!--Our Numbers Satrt-->
  <section id="numbers">
    <div class="container text-center">
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-6"> 
          <!--counter box-->
          <div class="counter_box text-center">
            <div class="counter_icon"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></div>
            <div class="counter_number counter"><span class="stat-count">100</span>%</div>
            <h4 class="counter_name">Quality</h4>
          </div>
          <!--counter box end--> 
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6"> 
          <!--counter box-->
          <div class="counter_box text-center">
            <div class="counter_icon"><i class="fa fa-user" aria-hidden="true"></i></div>
            <div class="counter_number counter"><span class="stat-count">2500</span>+</div>
            <h4 class="counter_name">People Working</h4>
          </div>
          <!--counter box end--> 
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6"> 
          <!--counter box-->
          <div class="counter_box text-center">
            <div class="counter_icon"><i class="fa fa-calendar-o" aria-hidden="true"></i></div>
            <div class="counter_number counter"><span class="stat-count">8</span> Years</div>
            <h4 class="counter_name">Years Experience</h4>
          </div>
          <!--counter box end--> 
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6"> 
          <!--counter box-->
          <div class="counter_box text-center">
            <div class="counter_icon"><i class="fa fa-smile-o" aria-hidden="true"></i></div>
            <div class="counter_number counter"><span class="stat-count">900</span>+</div>
            <h4 class="counter_name">Happy Smiles</h4>
          </div>
          <!--counter box end--> 
        </div>
      </div>
    </div>
  </section>
  <!--/Our Numbers Satrt End--> 
  
  <!--Features Section Satrt-->
  <!--<section id="features">
    <div class="container text-center features-section">
      <div class="row text-left">
        <div class="col-md-6 col-sm-6 col-xs-12 text-center"> <img src="<?php echo base_url ($this->config->item("template_path").'images/qualit_work.png');?>"  alt="Meet the Hire Pros"/> </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
          <h2>Meet the Hire Pros</h2>
          <div class="icon_box_one"> <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
            <div class="box_content">
              <h4>Lorem Ipsum is simply dummy text</h4>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
            </div>
          </div>
          <div class="icon_box_one"> <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
            <div class="box_content">
              <h4>Lorem Ipsum is simply dummy text</h4>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been.</p>
            </div>
          </div>
          <div class="icon_box_one"> <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
            <div class="box_content">
              <h4>Lorem Ipsum is simply dummy text</h4>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's .</p>
            </div>
          </div>
          <div class="icon_box_one"> <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
            <div class="box_content">
              <h4>Lorem Ipsum is simply dummy text</h4>
              <p>dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>-->
  <!--Features Section End--> 
  
  <!--Testimonails Section Satrt-->
  <section id="testimonails">
    <div class="container text-center">
    <h1 class="panel-heading">Customer Feedback</h1>
      <div class="row">
        <div class="col-md-12">
          <?php 
          $feedback = $this->main_m->getFeedback(false,array('status'=>1));
          ?>
          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel "> <!-- Indicators -->
            <?php if($feedback){ ?>
            <ol class="carousel-indicators">
              <?php
              $sr=0;
              foreach($feedback as $fb){?>
              <li data-target="#carousel-example-generic" data-slide-to="<?php echo $sr++;?>" class="<?php echo ($sr==0)?'active':'';?>"></li>
              <?php } ?>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner text-center">
              <?php
              $sr=0;
              foreach($feedback as $fb){?>
              <div class="item <?php echo ($sr==0)?'active':'';?>">
                <div class="avatar"><img class="img-circle" src="<?php echo base_url ($this->config->item("template_path").'images/clinte1.png');?>"   alt="Client 1"/></div>
                <h3><?php echo $fb['name'];?></h3>
                <strong><?php echo $fb['email'];?></strong>
                <p><?php echo $fb['message'];?></p>
              </div>
              <?php $sr++; } ?>
            </div>
            <?php
            }
            ?>
            <!-- Controls --> <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev"> <span class="fa fa-angle-left"></span> </a> <a class="right carousel-control" href="#carousel-example-generic" data-slide="next"> <span class="fa fa-angle-right"></span> </a> </div>
        </div>
      </div>
    </div>
  </section>
  <!--Testimonails Section End--> 
  
  <!--Downlod app Section Satrt-->
  <!--<section id="downlod_app">
    <div class="container text-center">
      <div class="row text-left">
        <div class="col-md-5 col-sm-12 col-xs-12 responsive-look"> <img src="<?php echo base_url ($this->config->item("template_path").'images/mobile.png');?>" alt="DOWNLOAD APP NOW"/> </div>
        <div class="col-md-7 col-sm-12 col-xs-12">
          <div class="downlod_text text-center">
            <h2><strong>DOWNLOAD</strong> APP NOW</h2>
            <p>Slect your device platform and get<br />
              download start</p>
            <button type="button" class="btn btn-primary btn-outline"><i class="fa fa-apple" aria-hidden="true"></i> APPLE USER</button>
            <button type="button" class="btn btn-primary btn-outline"><i class="fa fa-android" aria-hidden="true"></i> ANDROAID USER</button>
          </div>
        </div>
      </div>
    </div>
  </section>-->
  <!--Features Section End--> 
  
  <!--Trusted Section Satrt-->
  <!--<section id="trusted">
    <div class="container text-center">
      <div class="row text-left">
        <div class="col-md-2 col-sm-3 col-xs-12">
          <h3 class="panel-heading">TRUSTED BY</h3>
        </div>
        <div class="col-md-10 col-sm-12 col-xs-12">
          <ul class="trusted_logo owl-carousel" id="trusted-slider">
            <li><a href="#"><img src="<?php echo base_url ($this->config->item("template_path").'images/Trusted_logo1.png');?>" alt="Logo 1"/></a></li>
            <li><a href="#"><img src="<?php echo base_url ($this->config->item("template_path").'images/Trusted_logo2.png');?>" alt="Logo 2"/></a></li>
            <li><a href="#"><img src="<?php echo base_url ($this->config->item("template_path").'images/Trusted_logo3.png');?>" alt="Logo 3"/></a></li>
            <li><a href="#"><img src="<?php echo base_url ($this->config->item("template_path").'images/Trusted_logo1.png');?>" alt="Logo 4"/></a></li>
            <li><a href="#"><img src="<?php echo base_url ($this->config->item("template_path").'images/Trusted_logo2.png');?>" alt="Logo 5"/></a></li>
            <li><a href="#"><img src="<?php echo base_url ($this->config->item("template_path").'images/Trusted_logo2.png');?>" alt="Logo 6"/></a></li>
            <li><a href="#"><img src="<?php echo base_url ($this->config->item("template_path").'images/Trusted_logo3.png');?>" alt="Logo 7"/></a></li>
            <li><a href="#"><img src="<?php echo base_url ($this->config->item("template_path").'images/Trusted_logo1.png');?>" alt="Logo 8"/></a></li>
          </ul>
        </div>
      </div>
    </div>
  </section>-->
  <!--Trusted Section End--> 
  
  <!--Call To Action Start-->
  <section id="call-to-action">
    <div class="container free_consultation">
      <div class="row">
        <div class="col-md-8 col-sm-8 col-xs-12 text-left">
          <h2>Wanted a Free Consultation?</h2>
          <p>we are always ready to welcome you!</p>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12 m-text-center text-right"> <a class="btn btn-primary btn-outline">Schedule Cleaning </a> </div>
      </div>
    </div>
  </section>
  <!--Call To Action End--> 

<!-- The Modal -->
<div class="modal fade" id="enquiryForm">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Select Issue</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form id="msform" class="form-horizontal" action="<?php echo site_url ('public/main/search'); ?>" method="post">
                <input type="checkbox" name="isGST" value="1" style="position:absolute;visibility:hidden;" />
                <input type="hidden" name="appliance_id" value="" />
                <div class="form-group">
                  <div class="col-md-12 col-sm-12">
                    <select name="brand" id="brand" class="form-control select2" >
                      <option value="">Select Brand</option>
                    </select> 
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-12 col-sm-12">
                    <select name="type" id="type" class="form-control select2" >
                      <option value="">Select Type</option>
                    </select> 
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-12 col-sm-12">
                    <select name="issue" onchange="getIssueInfo(this.value);" id="issue" class="form-control select2" >
                      <option value="">Select Issue</option>
                    </select>
                  </div>
                </div>
                <div class="form-group issueInfo"></div>
                <div class="form-actions">
                  <div class="col-md-4 col-sm-4 pull-right">
                    <!--<button type="button" name="add_cart" class="btn btn-success" onClick="addToCart()"><i class="fa fa-plus"></i> Add To Cart (<span id="cart_item_no"><script>document.write(cartValue)</script></span>)</button>-->
                    <input type="button" name="next1" onClick="addToCart();" class="btn btn-primary" value="Add Issue" style="" />
                  </div>
                  <br /><br />
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
</div>



<script type="text/javascript">
var lastResult='';
function getAppliance(val){
	if(val){
		$('#loader').css("display","block");
		$("#aplnce").load('<?php echo site_url('public/main/appOptions/');?>/'+val, function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success"){
				$('#loader').css("display","none");
				if(!responseTxt){
					alert('No data available.');
				}else{
          $("#step1").attr("disabled",false);
        }
			}
			if(statusTxt == "error"){
				$('#loader').css("display","none");
				alert('Something wrong in file Loading. Please contact your service provider.');
			}
		});
	}else{
		$("#step1").attr("disabled",true);
	}
}

function createOptions(val){
  cat = $('select[name=service_category]').val();
  val = $('select[name=service_appliance]').val();
  if(!val){
    alert('Please select Appliance from appliance list.')
  }else{
    document.location.href='<?php echo site_url('public/main/issueForm');?>/'+cat+'/'+val
  }
	/**/
}

function getIssueInfo(val){
  $('.issueInfo').load('<?php echo site_url('public/main/issueInfo/');?>/'+val, function(responseTxt, statusTxt, xhr){
    $('#cartloader').css('display','none');
        if(statusTxt == "success"){
    if(responseTxt){
      //$('#cartDiv').html(responseTxt);
    }else{
      //$("input[name=city_id]").html(lastResult);
    }
        }
      });
}

function addToCart(){
  var appliance = $('input[name=appliance_id]').val();
  var brand = $('#brand').val();
  var type = $('#type').val();
  var issue = $('#issue').val();
  var item = appliance+'-'+brand+'-'+type+'-'+issue;
  var name = 'just3click_'+appliance+'-'+brand+'-'+type+'-'+issue;
  if(getCookie("just3click_cart")){
    if(appliance!="" && brand!="" && type!="" && issue!=""){
      if(getCookie(name)){
        alert("Issue Already Added in cart! Please select another issue.");
      }else{
        var cartItems = parseInt(getCookie("just3click_cart"));
        setCookie("just3click_cart", (cartItems+1));
        setCookie(name, true);
        setCookie('just3clickItems', item+','+getCookie("just3clickItems"));
        $('#cart_item_no').html(getCookie("just3click_cart"));
      }
    }else{
      alert("Please Select all required fields.");
    }
  }else{
    if(appliance!="" && brand!="" && type!="" && issue!=""){
      setCookie("just3click_cart", 1);
      setCookie(name, true);
      setCookie('just3clickItems', item);
      $('#cart_item_no').html(getCookie("just3click_cart"));
      $("input[name=next]").css("visibility","visible");
      //$('select[name=appliance]').prop('disabled', 'disabled');;
      //$("input[name=appliance_id]").val($("select[name=appliance]").val());
    }else{
      alert("Please Select all required fields.");
    }
  }
  document.location.href='<?php echo site_url('public/main/enquiryBox');?>'
}

</script>