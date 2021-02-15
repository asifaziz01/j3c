<div class="row">
    <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="widget box">
            <div class="widget-header">
                <h4 class="title"><?php echo $page_title;?></h4>
            </div>
            <div class="widget-content">
                <form action="" class="form-horizontal">
                <div class="form-group">
                        <label for="" class="label-control col-md-3 col-sm-12 col-xs-12">
                            Category
                        </label>
                        <div class="col-md-9 col-sm-12 col-xs-12">
                            <?php $categories = $this->appliance_m->get_categories();?>
                            <select name="category" onchange="getAppliance(this.value)" class="form-control">
                                <option value=''>Select Category</option>
                                <?php
                                if($categories){
                                    foreach($categories as $cat){
                                        echo '<option value="'.$cat['category_id'].'">'.$cat['title'].'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="label-control col-md-3 col-sm-12 col-xs-12">
                            Appliance
                        </label>
                        <div class="col-md-9 col-sm-12 col-xs-12">
                            <select id="appliance" name="appliance" onchange="createOptions();" class="form-control"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="label-control col-md-3 col-sm-12 col-xs-12">
                            Brand
                        </label>
                        <div class="col-md-9 col-sm-12 col-xs-12">
                            <select id="brand" name="brand" class="form-control"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="label-control col-md-3 col-sm-12 col-xs-12">
                            Type
                        </label>
                        <div class="col-md-9 col-sm-12 col-xs-12">
                            <select id="type" name="type" class="form-control"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="label-control col-md-3 col-sm-12 col-xs-12">
                            Issue
                        </label>
                        <div class="col-md-9 col-sm-12 col-xs-12">
                            <select id="issue" name="issue" onchange="getIssueInfo(this.value)" class="form-control"></select>
                        </div>
                    </div>
                    <div class="form-group" id="issueInfo" style="background-color:#000;color:#fff;font-weight:bold;"></div>
                    <div class="form-actions">
                        <input Type="button" name="submit" value="Next >>" onclick="addToCart()" class="btn btn-sm btn-primary pull-right" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-sm-12 col-xs-12">
        <div class="widget box">
            <div class="widget-content">
                <table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
                    <thead>
                        <th>#</th>
                        <th>Appliance</th>
                        <th>Brand</th>
                        <th>Type</th>
                        <th>Issue</th>
                        <th>Price</th>
                        <th></th>
                    </thead>
                    <tbody id="selectedIssueList">
                    <?php
                    $totalprice=0;$totaloffer=0;$price='';$totalpaid=0;$discount=0;
                    if(!empty($_COOKIE['just3click_cart'])){
                        $orders = $_COOKIE['just3clickItems'];
                        $orders = explode(',',$orders);
                        $aplnc = false;
                        if($orders){
                            $sr=1;
                            foreach($orders as $ordr){
                                $ord = explode('-',$ordr);
                                $aplnc[] = $ord[0];
                                $appliance = $this->appliance_m->get_appliance($ord[0]);
                                $brand = $this->appliance_m->get_brands(false,$ord[1]);
                                $type = $this->appliance_m->get_appliance_types(false,$ord[2]);
                                $issue = $this->appliance_m->get_issues(false,$ord[3]);
                                $price .= (($issue['offer_price'])?$issue['offer_price']:$issue['price']).',';
                                $totalprice +=$issue['price'];
                                $totaloffer +=$issue['offer_price'];
                                $discount +=($issue['offer_price'])?($issue['price']-$issue['offer_price']):0;
                                echo '<tr>';
                                echo '<td>'.$sr++.'</td>';
                                echo '<td>'.$appliance['appliance_name'].'</td>';
                                echo '<td>'.$brand['brand_name'].'</td>';
                                echo '<td>'.$type['type_name'].'</td>';
                                echo '<td>'.$issue['issue_title'].'</td>';
                                echo '<td>'.((($issue['offer_price'])?$issue['offer_price']:$issue['price'])).'</td>';
                                ?><td><a class="btn btn-danger btn-xs" href="javascript:void(0);" onclick="deleteCartItem('<?php echo $ordr;?>')" ><i class="icon-trash"></i></a></td><?php
                                echo '</tr>';
                            }
                            $totalpaid = ($discount)?($totalprice-$discount):$totalprice;
                        }
                        if($aplnc){
                            echo '<input type="hidden" name="items_price" value="'.$price.'" />
                            <input type="hidden" name="appliance" value="'.implode(",",array_unique($aplnc)).'" >';
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function getAppliance(cat){
    $('#loader').css("display","block");
    $.get('<?php echo site_url('admin/enquiries/appliances_options');?>/'+cat,function(data,status){
        if(status=='success'){
            $('#appliance').html(data);
        }
        $('#loader').css("display","none");
    });
}
function createOptions(val){
    val = (!val)?$("#appliance").val():val;
    if(val){
		$('#loader').css("display","block");
		$("#brand").load('<?php echo site_url('admin/enquiries/createOptions');?>/brand/'+val, function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success"){
				$('#loader').css("display","none");
				if(!responseTxt){
					alert('No data available.');
				}else{
					$('input[name=appliance_id]').val(val);
					$("#brand").focus();
					$("#brand").html(responseTxt);
					$("#type").load('<?php echo site_url('admin/enquiries/createOptions');?>/type/'+val, function(responseTxt, statusTxt, xhr){
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
					$("#issue").load('<?php echo site_url('admin/enquiries/createOptions');?>/issue/'+val, function(responseTxt, statusTxt, xhr){
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

function getIssueInfo(val){
    $('#issueInfo').load('<?php echo site_url('admin/enquiries/issueInfo');?>/'+val, function(responseTxt, statusTxt, xhr){
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

function addToCart(){
  var appliance = $('#appliance').val();
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
        //$('#cart_item_no').html(getCookie("just3click_cart"));
      }
    }else{
      alert("Please Select all required fields.");
    }
  }else{
    if(appliance!="" && brand!="" && type!="" && issue!=""){
      setCookie("just3click_cart", 1);
      setCookie(name, true);
      setCookie('just3clickItems', item);
      //$('#cart_item_no').html(getCookie("just3click_cart"));
      //$("input[name=next]").css("visibility","visible");
      //$('select[name=appliance]').prop('disabled', 'disabled');;
      //$("input[name=appliance_id]").val($("select[name=appliance]").val());
    }else{
      alert("Please Select all required fields.");
    }
  }
  
  $.get('<?php echo site_url('admin/enquiries/selectedIssuesList');?>',function(data,status){
    $('#loader').css('display','block');
      if(status == "success"){
          $('#selectedIssueList').html(data);
      }
      $('#loader').css('display','none');
  });
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

  $.get('<?php echo site_url('admin/enquiries/selectedIssuesList');?>',function(data,status){
    $('#loader').css('display','block');
      if(status == "success"){
          $('#selectedIssueList').html(data);
      }
      $('#loader').css('display','none');
  });
}

</script>