  <style>
    .rcorners {
      border-radius: 50px;
    }
  </style>
  <!--Contact Information Start-->
  <section id="contact_information">
    <div class="container">
      <div class="row"> 
        <!--Left Form Part-->
        <div class="col-md-8 col-sm-8 col-xs-12"> 
          
          <!--Contact Information-->
          <div class="contact_information_left "> 
            
            <!-- HTML Form (wrapped in a .bootstrap-iso div) -->
            <div class="booking_form">
              <div class="container-fluid">
                <div class="row">
                  <form method="post" action="<?php echo site_url('public/main/search');?>">
                    <!--Choose Service-->
                    <h2>Services Place</h2>
                    <?php 
                      $totalprice=0;$totaloffer=0;$price='';$totalpaid=0;$discount=0;
                      if(!empty($_COOKIE['just3click_cart'])){
                        $orders = $_COOKIE['just3clickItems'];
                        $orders = explode(',',$orders);
                        $aplnc = false;
                        if($orders){
                          foreach($orders as $ordr){
                            $ord = explode('-',$ordr);
                            $aplnc[] = $ord[0];
                            $issue = $this->appliance_m->get_issues(false,$ord[3]);
                            $price .= (($issue['offer_price'])?$issue['offer_price'].',':$issue['price']).',';
                            $totalprice +=$issue['price'];
                            $totaloffer +=$issue['offer_price'];
                            $discount +=($issue['offer_price'])?($issue['price']-$issue['offer_price']):0;
                          }
                          $totalpaid = ($discount)?($totalprice-$discount):$totalprice;
                        }
                      
                        if($aplnc){
                        ?>
                        <input type="hidden" name="items_price" value="<?php echo $price;?>" />
                        <input type="hidden" name="appliance" value="<?php echo implode(",",array_unique($aplnc));?>" > 
                        <?php
                        /*$dscnctarr = array_count_values($aplnc);
                        foreach($dscnctarr as $apl=>$key){
                          $appliance = $this->appliance_m->get_appliance($apl);
                          ?>
                          <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <div class="input-group">
                              <div class="input-group-addon" onclick="issuesList('<?php echo $appliance['appliance_id'];?>');" data-toggle="modal" data-target="#deleteEnquiryForm"> <i class="fa fa-minus" aria-hidden="true" id="minus_bed"></i></div>
                              <input type="text" class="form-control" onclick="alert(this.value)" value="<?php echo $appliance['appliance_name'].' ('.$key.')';?>" readonly />
                              <div class="input-group-addon" onclick="createOptions('<?php echo $appliance['appliance_id'];?>');" data-toggle="modal" data-target="#enquiryForm"><i class="fa fa-plus" aria-hidden="true" id="add_bed"></i></div>
                            </div>
                          </div>
                          <?php
                        }*/
                      }
                    }
                    ?>
                    <!--<div class="form-group col-md-6 col-sm-6 col-xs-12 padding-r">
                      <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-minus" aria-hidden="true" id="minus_bath"></i> </div>
                        <input type="text" class="form-control" id="bathroom" placeholder="1 Bathroom" />
                        <div class="input-group-addon"><i class="fa fa-plus" aria-hidden="true" id="add_bath"></i> </div>
                      </div>
                    </div>-->

                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <label><input type="radio" name="isGST" value="0" style="vertical-align:middle;" checked />&nbsp; At Home</label>&nbsp;&nbsp;&nbsp;
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <label><input type="radio" name="isGST" value="1" style="vertical-align:middle;" />&nbsp; At Office</label>
                      </div>
                    </div>

                    <div class="clearfix"></div>
                    <hr />
                    <h2>Contact Information</h2>
                    <p>This information will be used to contact you about your service</p>
                    <p class="msg"></p>
                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                      <input class="form-control" readonly id="name" name="customer_name" placeholder="Name*" type="text" value="<?php echo $this->session->userdata('name');?>"/>
                    </div>
                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                      <input class="form-control" readonly id="mobile" name="mobile" placeholder="Mobile Number*" autocomplete="false" type="text" value="<?php echo $this->session->userdata('login');?>" />
                    </div>
                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                      <input class="form-control" id="otp" name="otp" placeholder="OTP" type="text"/>
                    </div>
                    <div class="clearfix"></div>
                    <hr />
                    <!--Service Address-->
                    <h2>Service Address</h2>
                    <p>Where would you like us to clean?</p>
                    <div class="form-group col-md-6 col-sm-6 col-xs-12 ">
                      <textarea class="form-control" id="address" name="address" placeholder="Address*" disabled></textarea>
                    </div>
                    <div class="form-group col-md-6 col-sm-6 col-xs-12 select_box ">
                      <?php $locations = $this->default_m->get_locations();?>
                      <select id="location" name="location" class="form-control" disabled>
                        <option value="">Select location</option>
                        <?php 
                        if (!empty($locations)) {
                          foreach($locations as $app) {
                            echo '<option value="'.$app['id'].'">'.$app['title'].'</option>';
                          }
                        }
                        ?>
                      </select>
                    </div>
                    <input type="hidden" name="map_location" value="">
                    <div id="map" style="width:100%;height:200px;"></div>
                    <div class="clearfix"></div>
                    <hr />
                    <!--BOOK NOW-->
                    <div class="booking_summary hidden-lg hidden-md" style="position:fixed;bottom:0px;left:0px;z-index:1005;background-color:#1E1E1E;color:#fff; width:100%;font-size:1.5em;">
                      <div class="col-sm-6 col-xs-6 text-left"><i class="fa fa-inr"></i><?php echo $totalpaid;?></div>
                      <div class="col-sm-6 col-xs-6 text-right">
                        <button class="btn btn-primary rcorners" id="submit" name="submit" type="submit" <?php echo ($totalpaid)?'':'DISABLED';?> > SUBMIT ENQUIRY</button>
                      </div>
                    </div>
                    <div class="form-group col-md-6 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                      <button class="btn btn-primary btn-skin" id="submit" name="submit" type="submit"  <?php echo ($totalpaid)?'':'DISABLED';?> > SUBMIT ENQUIRY</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!--Contact Information--> 
          
        </div>
        <!--/Left Form Part-->
        
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="contact_information_right text-center">
          <div class="booking_summary hidden-xs">
              <h1>Booking Summary</h1>
              <ul>
                <li><i class="fa fa-home" aria-hidden="true"></i>Home Service</li>
                <li><i class="fa fa-calendar" aria-hidden="true"></i>Service date</li>
                <li><i class="fa fa-refresh" aria-hidden="true"></i>24 x 7</li>
              </ul>
              <div class="price_totle">
                <div class="subtotal">
                  <div class="heading text-left">SUBTOTAL</div>
                  <div class="price text-right"><i class="fa fa-inr"></i> <?php echo ($totalprice)?$totalprice:0;?></div>
                </div>
                <div class="subtotal">
                  <div class="heading text-left">DISCOUNT</div>
                  <div class="price text-right"><i class="fa fa-inr"></i> <?php echo ($discount)?$discount:0;?></div>
                </div>
                <div class="subtotal">
                  <div class="heading text-left">TOTAL:</div>
                  <div class="price text-right"><i class="fa fa-inr"></i> <?php echo $totalpaid;?></div>
                </div>
              </div>
            </div>
            <div class="booking_summary">
              <div class="icon_box_one">
                <div class="icons"><img src="<?php echo base_url($this->config->item("template_path").'images/booking/time3.png');?>" alt="time3" /></div>
                <div class="box_content">
                  <h4>SAVES YOUR TIME</h4>
                  <p>We helps you live smarter, giving you time to focus on what's most important.</p>
                </div>
              </div>
              <div class="icon_box_one">
                <div class="icons"><img src="<?php echo base_url($this->config->item("template_path").'images/booking/Safety3.png');?>" alt="Safety3" /></div>
                <div class="box_content">
                  <h4>For Your Safety</h4>
                  <p>All of our Helpers undergo rigorous identity checks and personal interviews. Your safety is even our concern too.</p>
                </div>
              </div>
              <div class="icon_box_one">
                <div class="icons"><img src="<?php echo base_url($this->config->item("template_path").'images/booking/best3.png');?>" alt="best3" /></div>
                <div class="box_content">
                  <h4>Best-Rated Professionals</h4>
                  <p>Our experienced taskers perform their tasks with dedication and perfection. We appreciate your reviews about the service.</p>
                </div>
              </div>
              <div class="icon_box_one">
                <div class="icons"><img src="<?php echo base_url($this->config->item("template_path").'images/booking/Equipped3.png');?>" alt="Equipped3" /></div>
                <div class="box_content">
                  <h4>We Are Well Equipped</h4>
                  <p>Let us know if you have any specific equirement.</p>
                </div>
              </div>
              <div class="icon_box_one">
                <div class="icons"><img src="<?php echo base_url($this->config->item("template_path").'images/booking/touch3.png');?>" alt="touch3" /></div>
                <div class="box_content">
                  <h4>Always In Touch</h4>
                  <p>Book your service online on one tap, keep a track of your service status and also keep in touch with your Helper.</p>
                </div>
              </div>
              <div class="icon_box_one">
                <div class="icons"><img src="<?php echo base_url($this->config->item("template_path").'images/booking/cash3.png');?>" alt="cash3" /></div>
                <div class="box_content">
                  <h4>Cash-Free Facility</h4>
                  <p>Pay through secure online mode only after your job is done.</p>
                </div>
              </div>
              <div class="box_btn">
                <button class="btn btn-primary booknow btn-skin" type="submit">LEARN MORE</button>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--Contact Information End--> 

<!-- The Modal -->
<div class="modal fade" id="enquiryForm">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Select Issue</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form id="msform" class="form-horizontal" action="<?php echo site_url ('admin/services/search'); ?>" method="post">
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
<!-- The Modal -->
<div class="modal fade" id="deleteEnquiryForm">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Delete Issues</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body" id="issueList">
        </div>
      </div>
    </div>
</div>
<style>
  .modal {
    top:100px;
  }
</style>
<script type="text/javascript">
var lastResult='';

function createOptions(val){
  val = (!val)?$("input[name=appliance_id]").val():val;
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
  var appliance = $('input[name=appliance_id]').val();
  var brand = $('#brand').val();
  var type = $('#type').val();
  var issue = $('#issue').val();
  var item = appliance+'-'+brand+'-'+type+'-'+issue;
  var name = 'just3click_'+appliance+'-'+brand+'-'+type+'-'+issue;
  if(getCookie("just3click_cart")){
    if(appliance!="" && brand!="" && type!="" && issue!=""){
      if(getCookie(name)){
        alert("Issue Already Add in List! Please select another issue.");
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
function deleteCartItem(cookie_name){
  var tempItems = false;
  var cartItems = getCookie('just3clickItems').split(',');
  if(cartItems.length==1){
    deleteCookie('just3clickItems');
    deleteCookie('just3click_'+cookie_name);
    deleteCookie('just3click_cart');
  }else{
    var tempItems=new Array();
    for(var a=0;a<cartItems.length;a++){
      if(cartItems[a]==cookie_name){
        deleteCookie('just3click_'+cartItems[a]);
        setCookie('just3click_cart',(parseInt(getCookie('just3click_cart'))-1));
      }else{
        tempItems[tempItems.length] = cartItems[a];
      }
    }
    tempItems = tempItems.join(',');
    setCookie('just3clickItems',tempItems);
  }
  document.location.href='<?php echo site_url('main/enquiryBox');?>';
}

function issuesList(val){
  $('#loader').css("display","block");
  $("#issueList").load('<?php echo site_url('main/issuesList');?>/'+val, function(responseTxt, statusTxt, xhr){
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
    $('#loader').css("display","none");
  });
}
</script>
<script>
  $('#mobile').on('input', function(e){
    var key = e.which || this.value.substr(-1).charCodeAt(0);
    if( key < 48 || key > 57){
      alert('Only numeric value allowed.');
      this.value='';
    }else{
      if(this.value.length==10){
        if($('#name').val()){
          $('#loader').css("display","block");
          $('input[name=mobile]').load('<?php echo site_url('public/main/sendOTP');?>/'+this.value+'/'+ $('#name').val(), function(responseTxt, statusTxt, xhr){
            $('#loader').css("display","none");
            if(statusTxt == "success"){
              if(!responseTxt){
                this.value='';
                this.focus();
                alert('try again.');
              }else{
                //$('input[name=mobile]').attr("readonly",true);
                $('input[name=otp]').attr("disabled",false);
                $('input[name=otp]').focus();
              }
            }
            if(statusTxt == "error"){
              alert('Message Not Send. Please contact your service provider.');
            }
          });
        }else{
          alert("first Enter your Name!");
          this.value="";
          $('#name').focus();
        }
      }
    }
  });
  $('#otp').on('input', function(e){
    if(this.value.length==6){
      $('#loader').css("display","block");
      $('input[name=otp]').load('<?php echo site_url('public/main/verifyOTP');?>/'+ $('#mobile').val() +'/'+ this.value, function(responseTxt, statusTxt, xhr){
				if(statusTxt == "success"){
					$('#loader').css("display","none");
					if(!responseTxt){
						$('.msg').html('<div class="alert alert-danger">Invalid OTP!</div>');
            this.focus();
					}else{
      			$('input[name=mobile]').attr('readonly',true);
						$('#otp').attr('disabled',true);
						$('#location').attr('disabled',false);
						$('#address').attr('disabled',false);
						$('#submit').attr('disabled',false);
            $('.msg').html('<div class="alert alert-success">OTP Verify!</div>');
						//$('input[name=make_payment]').attr('disabled',false);
					}
				}
				if(statusTxt == "error"){
					$('#loader').css("display","none");
					alert('Something wrong in Proccessing. Please contact your service provider.');
				}
			});
    }
  });
</script>
<script src="https://apis.mapmyindia.com/advancedmaps/v1/<?php echo MAP_API;?>/map_load?v=1.3"></script>
<script>
  var marker = [];
  var map=new MapmyIndia.Map("map",{ center:[26.760759, 83.373703],zoomControl: true,hybrid:true });
  map.on("click", function(e) 
  {
    var pt = e.latlng;
    var title = $("#address").val();
    if(marker.length>0){
      map.removeLayer(marker[0]);
      delete marker;
      marker = [];
    }
    marker.push(addMarker(pt, title));
  });
  function addMarker(position, title, draggable) 
  {
    $("#loader").css("display","block");
    $("#address").load("<?php echo site_url('main/getAutoAddressByCoord/');?>/"+position.lat+"/"+position.lng, function(responseTxt, statusTxt, xhr){
      if(statusTxt == "success"){
        $("#loader").css("display","none");
        if(responseTxt){
          $data = $.parseJSON(responseTxt);
          $("#address").val(title);
        }
      }else{
        $("#loader").css("display","none");
        alert("city not available! please select by list1.");
      }
    });
    var mk = new L.Marker(position, {draggable: true, title: title}); 
    mk.bindPopup(title, {closeButton: true, autopan: true, zoomAnimation: true}).openPopup(); 
    map.addLayer(mk);
    
    $("input[name=map_location]").val(position);
    //$("#searchbtn").attr("disabled",false);
    //Although we.ll talk about a few things in the code segment in a moment 
    //but lets put it in here so that you have the full picture. 
    //marker events:
    /*mk.on("click", function (e) 
    { 
      //your code about what you want to do on a marker click 
    });*/
    return mk; 
  }
</script>