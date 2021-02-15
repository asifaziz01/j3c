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
              <p>We Are Here To Help <br />
                You!!!</p>
              <form class="form-horizontal">
                <div class="form-group" style="border-bottom:1px solid #FFF;">
                    <?php
                    $applicances = $this->appliance_m->get_appliances($cid);
                    if($applicances){
                        echo '<select name="appliance_id" class="form-control" onchange="createOptions();" style="background-color:#2F8588;color:#FFF;">';
                            echo '<option value="">Select Appliance</option>';
                        foreach($applicances as $aplnc){
                          $disable = ($apid)?(($apid!=$aplnc['appliance_id'])?'disabled="disabled"':'selected="selected"'):'';
                          echo '<option value="'.$aplnc['appliance_id'].'" '.$disable.'>'.$aplnc['appliance_name'].'</option>';
                        }
                        echo '</select>';
                    }
                    ?>
                </div>
                <div class="form-group" style="border-bottom:1px solid #FFF;">
                   <select name="brand" id="brand" class="form-control" style="background-color:#2F8588;color:#FFF;">
                       <option value="">Select Brand</option>
                   </select>
                </div>
                <div class="form-group" style="border-bottom:1px solid #FFF;">
                   <select name="type" id="type" class="form-control" style="background-color:#2F8588;color:#FFF;">
                       <option value="">Select Brand</option>
                   </select>
                </div>
                <div class="form-group" style="border-bottom:1px solid #FFF;">
                   <select name="issue" id="issue" class="form-control" onchange="getIssueInfo(this.value)" style="background-color:#2F8588;color:#FFF;">
                       <option value="">Select Issue</option>
                   </select>
                </div>
                <div class="form-group" id="issueInfo"></div>
                <div class="form-group">
                  <div class="quick_btn">
                    <button type="button" class="btn btn-default btn-skin" onclick="addToCart();">Next</button>
                  </div>
                </div>
              </form>
              <div style="margin-left:-20px">
                <div class="col-md-4 col-sm-4 col-xs-4 text-center"><div class="circle"><h3><i class="fa fa-inr"></i> 149</h3></div><div class="cir_cont">Lowest Inspection charge</div></div>
                <div class="col-md-4 col-sm-4 col-xs-4 text-center"><div class="circle"><h3>15 days</h3></div><div class="cir_cont">15 Days Warranty</div></div>
                <div class="col-md-4 col-sm-4 col-xs-4 text-center"><div class="circle"><h1><i class="fa fa-check"></i></h1></div><div class="cir_cont">Trusted Technicians</div></div>
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
    <h2 class="ml2" style="font-size:1.5em;background-color:#3FCAD8;color:#FFF;text-transform:uppercase;text-align:center;"><span><?php echo $app['head_content'];?></span></h2> 
    <div class="container text-center">
      <div class="row text-left">
        <!--<div class="col-md-6 col-sm-6 col-xs-12 text-center"> <img src="<?php echo site_url($this->config->item("template_path").'images/qualit_work.png');?>"> </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
          <h2>Laptop & Desktop Repair in Gorakhpur</h2>
          <div class="icon_box_one"> <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
            <div class="box_content">
              <p>Just3click  provides best experienced Laptop & Desktop technicians, our Laptop & Desktop  repair  costs are very competitive also we provide 15 days warranty for service. We keep our inspection charge very low in market. If you are booking  Laptop & Desktop repair with Just3click, you will not have to worry about quality and after service support, we provide excellent customer support. You can avail our service to repair your Laptop & Desktop.</p>
            </div>
          </div>
          <div class="icon_box_one"> <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
            <div class="box_content">
              <p>All technicians could not service all kind of Laptop & Desktop models and brands, some Laptop & Desktop Repair technicians are not familiar with certain brands. At Just3click  we have technicians to Repair  all kind of Laptop & Desktop, based on your model and brand we will send the experienced technician to your door-step.</p>
            </div>
          </div>
        </div>-->
        <div class="col-md-6 col-sm-6 col-xs-12 text-center"> <img src="<?php echo site_url($this->config->item("template_path").'images/'.$app['body_content_image']);?>"> </div>
        <?php echo $app['body_content'];?>
      </div>
    </div>
  </section>
  <script type="text/javascript" language="javascript">
  var textWrapper = document.querySelector('.ml2');
  textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

  anime.timeline({loop: true})
    .add({
      targets: '.ml2 .letter',
      scale: [4,1],
      opacity: [0,1],
      translateZ: 0,
      easing: "easeOutExpo",
      duration: 950,
      delay: (el, i) => 70*i
    }).add({
      targets: '.ml2',
      opacity: 0,
      duration: 1000,
      easing: "easeOutExpo",
      delay: 500
    });
  </script>
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
		$("#brand").load('<?php echo site_url('main/createOptions');?>/brand/'+val, function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success"){
				$('#loader').css("display","none");
				if(!responseTxt){
					alert('No data available.');
				}else{
					$('input[name=appliance_id]').val(val);
					$("#brand").focus();
					$("#brand").html(responseTxt);
					$("#type").load('<?php echo site_url('main/createOptions');?>/type/'+val, function(responseTxt, statusTxt, xhr){
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
					$("#issue").load('<?php echo site_url('main/createOptions');?>/issue/'+val, function(responseTxt, statusTxt, xhr){
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
  document.location.href='<?php echo site_url('main/enquiryBox');?>'
}

function getIssueInfo(val){
    $('#issueInfo').load('<?php echo site_url('main/issueInfo');?>/'+val, function(responseTxt, statusTxt, xhr){
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