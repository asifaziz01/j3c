<style>
  .circle {
    /*background: lightblue;*/
    border:3px double #FFF;
    border-radius: 50%;
    width: 85px;
    height: 85px;
  }
  .circle h3{
    font-size:14px;
    margin-top:40%;
  }
  h4.cir_cont{
    font-size:15px;
    text-align:center;
    border:1px solid #fff;
  }
  .blink span{
		animation: blink 1s linear infinite;
	}
  @keyframes blink{
    0%{opacity: 0;}
    50%{opacity: .5;}
    100%{opacity: 1;}
  }
  .banner_content div div ul{
    padding-top:25px;
  }
  .banner_content div div ul li{
    font-size:1.6em;
  }
</style>
<!--Banner Start-->
  <section id="service_banner" style="padding-top:10px;">
    <div class="container text-center service_banner_layer">
      <div class="banner_content">
        <div class="row text-left">
          <div class="col-md-8 col-lg-8 hidden-sm hidden-xs">
            <?php if(!$apid){?>
            <h1 class="service-heading">Choose your needed service</h1>
            <ul class="featurs_list">
              <li><i class="fa fa-check-square-o" aria-hidden="true"></i> For best Services</li>
              <li><i class="fa fa-check-square-o" aria-hidden="true"></i> For Convinience with your pocket</li>
              <li><i class="fa fa-check-square-o" aria-hidden="true"></i> For Professional Service Provider</li>
              <li><i class="fa fa-check-square-o" aria-hidden="true"></i> For saving your time</li>
            </ul>
            <?php
            }else{
              $app = $this->appliance_m->get_appliance($apid);
              if($app){
                echo $app['content'];
              }
            }
            ?>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="quick_contact">
              <p style="text-align:center;">We Are Here To Help You!!!</p>
              <form class="form-horizontal">
                <div class="form-group" style="border-bottom:1px solid #FFF;">
                    <?php
                    $applicances = $this->appliance_m->get_appliances($cid);
                    if($applicances){
                        echo '<select name="appliance_id" class="form-control" onchange="createOptions();" style="color:#FFF;">';
                          echo '<option value="">Select Appliance</option>';
                          foreach($applicances as $aplnc){
                            $selected = ($aplnc['appliance_id']==$apid)?'selected="selected"':'';
                            echo '<option value="'.$aplnc['appliance_id'].'" '.$selected.'>'.$aplnc['appliance_name'].'</option>';
                          }
                          echo '</select>';
                    }
                    ?>
                </div>
                <div class="form-group" style="border-bottom:1px solid #FFF;">
                   <select name="brand" id="brand" class="form-control" style="color:#FFF;">
                       <option value="">Select Brand</option>
                   </select>
                </div>
                <div class="form-group" style="border-bottom:1px solid #FFF;">
                   <select name="type" id="type" class="form-control" style="color:#FFF;">
                       <option value="">Select Brand</option>
                   </select>
                </div>
                <div class="form-group" style="border-bottom:1px solid #FFF;">
                   <select name="issue" id="issue" class="form-control" onchange="getIssueInfo(this.value)" style="color:#FFF;">
                       <option value="">Select Issue</option>
                   </select>
                </div>
                <div class="form-group" id="issueInfo"></div>
                <div class="form-group">
                  <div class="quick_btn">
                    <button type="button" class="btn btn-default btn-skin" onclick="addToCart();" style="background-color:#FFF;border:1px solid rgb(3, 0, 22);color:rgb(3, 0, 22);">Next</button>
                  </div>
                </div>
              </form>
              <div style="margin-left:-15px;">
                <div class="row">
                  <div class="col-4 text-center pull-left">
                    <div class="circle">
                      <h3><i class="fa fa-inr"></i> 149</h3>
                    </div>
                    <div class="cir_cont">Lowest Inspection charge</div>
                  </div>
                  <div class="col-4 text-center pull-left">
                    <div class="circle">
                      <h3>15 days</h3>
                    </div>
                    <div class="cir_cont">15 Days Warranty</div>
                  </div>
                  <div class="col-4 text-center pull-left">
                    <div class="circle">
                      <h2 style="margin-top:20px;"><i class="fa fa-check"></i></h2>
                    </div>
                    <div class="cir_cont">Trusted Technicians</div>
                  </div>
                </div>
              </div>
              <br clear="all" />
            </div>
          </div>
          <div class="col-sm-12 col-xs-12 hidden-lg hidden-md">
            <?php if(!$apid){?>
            <h1 class="service-heading">Choose your needed service</h1>
            <ul class="featurs_list">
              <li><i class="fa fa-check-square-o" aria-hidden="true"></i> For best Services</li>
              <li><i class="fa fa-check-square-o" aria-hidden="true"></i> For Convinience with your pocket</li>
              <li><i class="fa fa-check-square-o" aria-hidden="true"></i> For Professional Service Provider</li>
              <li><i class="fa fa-check-square-o" aria-hidden="true"></i> For saving your time</li>
            </ul>
            <?php
            }else{
              $app = $this->appliance_m->get_appliance($apid);
              if($app){
                echo $app['content'];
              }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <!--/Banner End--> 
  <section id="features" style="background-image:none;background-color:#080D22;padding-top:0px;">
    <h2 class="blink" style="color:#FFF;text-transform:uppercase;text-align:center;margin:0px 0px;padding:5px 0px 5px 0;width:95%;"><span class="" style="font-size:.95em;"><?php echo $app['head_content'];?></span></h2> 
    <div class="container text-center">
      <div class="row text-left">
        <div class="col-md-6 col-sm-12 col-xs-12 text-center" style="border:1px Solid #666;margin-bottom:10px;background-color: rgba(204, 204, 204, 0.1);">
          <img style="max-width:400px;max-height:400px;" src="<?php echo site_url($this->config->item("template_path").'images/'.$app['body_content_image']);?>"> 
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12 text-justify">
          <?php echo $app['body_content'];?>
        </div>
      </div>
    </div>
  </section>
  <!--Testimonails Section Satrt-->
  <section id="testimonails">
    <div class="container text-center">
      <h1 class="panel-heading">Customer Review</h1>
      <div class="row">
        <div class="col-md-12">
          <?php 
          $feedback = $this->main_m->getFeedbackByApp($apid);
          ?>
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> <!-- Indicators -->
            <?php if($feedback){ ?>
            <ol class="carousel-indicators">
              <?php
              $sr=0;
              foreach($feedback as $fb){?>
              <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $sr++;?>" class="<?php echo ($sr==0)?'active':'';?>"></li>
              <?php } ?>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner text-center">
              <?php
              $sr=0;
              foreach($feedback as $fb){?>
              <div class="carousel-item <?php echo ($sr==0)?'active':'';?>">
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
            <!-- Controls --> 
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
        </div>
      </div>
    </div>
  </section>
  <!--Testimonails Section End--> 
  <!--How it works Section Satrt-->
  <section id="howitwork">
    <div class="container text-center">
      <h1 class="panel-heading">How it works</h1>
      <div class="row">
        <div class="col-md-3 col-xs-offset-0 step-one"><img src="<?php echo base_url ($this->config->item("template_path").'images/02home/book2.png');?>" alt="book2" />
          <h4>Book</h4>
          <p>Select the date and time you'd like<br />
            your perofessional to show up</p>
        </div>
        <div class="col-md-1 hidden-xs hidden-sm"> </div>
        <div class="col-md-3 step-two"> <img  src="<?php echo base_url ($this->config->item("template_path").'images/02home/Schedule2.png');?>" alt="Schedule2" />
          <h4>Schedule</h4>
          <p>Certified Taskers comes over<br/>
            and done your task</p>
        </div>
        <div class="col-md-1 hidden-xs hidden-sm"> </div>
        <div class="col-md-3"> <img  src="<?php echo base_url ($this->config->item("template_path").'images/02home/Relax2.png');?>" alt="Relax2" />
          <h4>Relax</h4>
          <p>your task is completed to your<br/>
            satisfaction - guranteed</p>
        </div>
      </div>
    </div>
    <br /><br /><br />
  </section>
  <!--How it works Section End--> 
<script type="text/javascript">
var lastResult='';

function createOptions(val){
    val = (!val)?$("select[name=appliance_id]").val():val;
    if(val){
		$('#loader').css("display","block");
		$("#brand").load('<?php echo site_url('public/main/createOptions');?>/brand/'+val, function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success"){
				$('#loader').css("display","none");
				if(!responseTxt){
					alert('No data available.');
				}else{
					$('input[name=appliance_id]').val(val);
					$("#brand").focus();
					$("#brand").html(responseTxt);
					$("#type").load('<?php echo site_url('public/main/createOptions');?>/type/'+val, function(responseTxt, statusTxt, xhr){
						if(statusTxt == "success"){
                            if(!responseTxt){
                                alert('No data available.');
                            }else{
                                $("#type").html(responseTxt);
                            }
						}
						if(statusTxt == "error"){
						alert('Something wrong in file Loading. Please contact your service provider.');
						}
					});
					$("#issue").load('<?php echo site_url('public/main/createOptions');?>/issue/'+val, function(responseTxt, statusTxt, xhr){
						if(statusTxt == "success"){
						if(!responseTxt){
							alert('No data available.');
						}else{
							$("#issue").html(responseTxt);
						}
						}
						if(statusTxt == "error"){
						alert('Something wrong in file Loading. Please contact your service provider.');
						}
					});
				}
			}
			if(statusTxt == "error"){
				$('#loader').css("display","none");
				alert('Something wrong in file Loading. Please contact your service provider.');
			}
		});
	}else{
		$("#search").attr("disabled",true);
	}
}


function addToCart(){
  var appliance = $('select[name=appliance_id]').val();
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

function getIssueInfo(val){
    $('#issueInfo').load('<?php echo site_url('public/main/issueInfo');?>/'+val, function(responseTxt, statusTxt, xhr){
      $('#loader').css('display','block');
      if(statusTxt == "success"){
        if(responseTxt){
          $('#issueInfo').html(responseTxt);
        }else{
          $('#issueInfo').html('');
        }
      }
      $('#loader').css('display','none');
    });
}

<?php
if($apid){
  ?>
    createOptions('<?php echo $apid;?>');
  <?php
}
?>
</script>