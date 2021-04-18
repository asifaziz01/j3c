<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title><?php echo site_name();?> | <?php echo $page_title;?></title>

	<!--=== CSS ===-->

	<!-- Bootstrap -->
	<link href="<?php echo base_url($this->config->item('backend_path')."bootstrap/css/bootstrap.min.css");?>" rel="stylesheet" type="text/css" />

	<!-- jQuery UI -->
	<!--<link href="plugins/jquery-ui/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />-->
	<!--[if lt IE 9]>
		<link rel="stylesheet" type="text/css" href="plugins/jquery-ui/jquery.ui.1.10.2.ie.css"/>
	<![endif]-->

	<!-- Theme -->
	<link href="<?php echo base_url($this->config->item('backend_path')."assets/css/main.css");?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url($this->config->item('backend_path')."assets/css/plugins.css");?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url($this->config->item('backend_path')."assets/css/responsive.css");?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url($this->config->item('backend_path')."assets/css/icons.css");?>" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" href="<?php echo base_url($this->config->item('backend_path')."assets/css/fontawesome/font-awesome.min.css");?>">
	<!--[if IE 7]>
		<link rel="stylesheet" href="assets/css/fontawesome/font-awesome-ie7.min.css">
	<![endif]-->

	<!--[if IE 8]>
		<link href="assets/css/ie8.css" rel="stylesheet" type="text/css" />
	<![endif]-->
	<!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>-->

	<!--=== JavaScript ===-->

	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."assets/js/libs/jquery-1.10.2.min.js");?>"></script>
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js");?>"></script>

	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."bootstrap/js/bootstrap.min.js");?>"></script>
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."assets/js/libs/underscore.min.js");?>"></script>

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="assets/js/libs/html5shiv.js"></script>
	<![endif]-->

	<!-- Smartphone Touch Events -->
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."plugins/touchpunch/jquery.ui.touch-punch.min.js");?>"></script>
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."plugins/event.swipe/jquery.event.move.js");?>"></script>
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."plugins/event.swipe/jquery.event.swipe.js");?>"></script>

	<!-- General -->
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."assets/js/libs/breakpoints.js");?>"></script>
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."plugins/respond/respond.min.js");?>"></script> <!-- Polyfill for min/max-width CSS3 Media Queries (only for IE8) -->
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."plugins/cookie/jquery.cookie.min.js");?>"></script>
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."plugins/slimscroll/jquery.slimscroll.min.js");?>"></script>
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."plugins/slimscroll/jquery.slimscroll.horizontal.min.js");?>"></script>

	<!-- Page specific plugins -->
	<!-- Charts -->
	<!--[if lt IE 9]>
		<script type="text/javascript" src="plugins/flot/excanvas.min.js"></script>
	<![endif]-->
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."plugins/sparkline/jquery.sparkline.min.js");?>"></script>
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."plugins/flot/jquery.flot.min.js");?>"></script>
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."plugins/flot/jquery.flot.tooltip.min.js");?>"></script>
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."plugins/flot/jquery.flot.resize.min.js");?>"></script>
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."plugins/flot/jquery.flot.time.min.js");?>"></script>
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."plugins/flot/jquery.flot.growraf.min.js");?>"></script>
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."plugins/easy-pie-chart/jquery.easy-pie-chart.min.js");?>"></script>

	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."plugins/daterangepicker/moment.min.js");?>"></script>
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."plugins/daterangepicker/daterangepicker.js");?>"></script>
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."plugins/blockui/jquery.blockUI.min.js");?>"></script>

	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."plugins/fullcalendar/fullcalendar.min.js");?>"></script>

	<!-- Noty -->
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."plugins/noty/jquery.noty.js");?>"></script>
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."plugins/noty/layouts/top.js");?>"></script>
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."plugins/noty/themes/default.js");?>"></script>

	<!-- Forms -->
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."plugins/uniform/jquery.uniform.min.js");?>"></script>
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."plugins/select2/select2.min.js");?>"></script>

	<!-- DataTables -->
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."plugins/datatables/jquery.dataTables.min.js");?>"></script>
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."plugins/datatables/DT_bootstrap.js");?>"></script>
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."plugins/datatables/responsive/datatables.responsive.js");?>"></script> <!-- optional -->

	<!-- App -->
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."assets/js/app.js");?>"></script>
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."assets/js/plugins.js");?>"></script>
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."assets/js/plugins.form-components.js");?>"></script>
	<script type="text/javascript">
		function getData(dataSource, divID, valueADD){
			var obj = document.getElementById(divID)
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					if(valueADD!="" && valueADD=="+"){
						obj.innerHTML +=xmlhttp.responseText;
					}else if(valueADD!="" && valueADD=="attr"){
						obj.innerHTML='Change Remark';
					}else if(valueADD!="" && valueADD=="form"){
						obj.value=xmlhttp.responseText;
					}else{
					   obj.innerHTML=xmlhttp.responseText;
					}
				}else{
					if(valueADD==""){
						obj.innerHTML = '<img src="<?php echo base_url($this->config->item('backend_path').'assets/img/ajax-loading.gif');?>" style="width:50px;" />';
					}
				}
			}
			xmlhttp.open("POST",dataSource,true);
			xmlhttp.send();
			//xmlhttp.close();
			return false;
		}
		
		function setCookie(cname, cvalue, exdays) {
          var d = new Date();
          d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
          var expires = "expires="+d.toUTCString();
          document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }

        function getCookie(cname) {
          var name = cname + "=";
          var ca = document.cookie.split(';');
          for(var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
              c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
              return c.substring(name.length, c.length);
            }
          }
          return "";
        }
        function deleteCookie(name){ 
          setCookie(name, '', -1); 
        }
</script>
	<script>
	$(document).ready(function(){
		"use strict";

		App.init(); // Init layout and core plugins
		Plugins.init(); // Init all plugins
		FormComponents.init(); // Init all form-specific plugins
	});
	"use strict";
	function submitForm(e, divId)
	{
		var obj = document.getElementById(divId);
		var xhr = new XMLHttpRequest();
		if (xhr.upload) {
			obj.innerHTML = '<div id="upload-progress"><div class="progress-bar"></div></div>';
			xhr.upload.addEventListener('progress', function(event) {
				var percent = 0;
				var position = event.loaded || event.position;
				var total = event.total;
				if (event.lengthComputable) {
					percent = Math.ceil(position / total * 100);
				}
				//update progressbar
				$("#upload-progress .progress-bar").css("width", + percent +"%");
			}, true);
		}
		xhr.onload = function(){ obj.innerHTML = xhr.responseText; }
		xhr.open (e.method, e.action, true);
		xhr.send (new FormData(e));
		return false;
	}
	
	</script>
	<style>
	@media print
	{    
		.no-print, .no-print *
		{
			display: none !important;
		}
	}
	.upload-progress{
		width:100%;
		height:5px;
	}
	.progress-bar{
		background-color:#FFF;
	}
    </style>

	<!-- Demo JS -->
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."assets/js/custom.js");?>"></script>
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."assets/js/demo/pages_calendar.js");?>"></script>
	<!--<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."assets/js/demo/charts/chart_filled_blue.js");?>"></script>
	<script type="text/javascript" src="<?php echo base_url($this->config->item('backend_path')."assets/js/demo/charts/chart_simple.js");?>"></script>-->
</head>

<body>
	<div id="loader" style="position:absolute;top:0;left:0;opacity:0.5;width:100%;height:98%;z-index:10000;background-color:#fff;display:none;">
		<img src="<?php echo base_url($this->config->item('backend_path').'assets/img/ajax-loading.gif');?>" style="position:absolute;z-index:100001;width:100px;top:200px;left:48%;">
	</div>
	<!-- Header -->
	<header class="header navbar navbar-fixed-top" role="banner">
		<!-- Top Navigation Bar -->
		<div class="container">

			<!-- Only visible on smartphones, menu toggle -->
			<ul class="nav navbar-nav">
				<li class="nav-toggle"><a href="javascript:void(0);" title=""><i class="icon-reorder"></i></a></li>
			</ul>

			<!-- Logo -->
			<a class="navbar-brand" href="<?php echo site_url('admin/main');?>">
				<img src="<?php echo base_url("favicon.ico");?>" alt="logo" />
				<strong><?php echo site_name();?></strong>
			</a>
			<!-- /logo -->

			<!-- Sidebar Toggler -->
			<a href="#" class="toggle-sidebar bs-tooltip" data-placement="bottom" data-original-title="Toggle navigation">
				<i class="icon-reorder"></i>
			</a>
			<a href="javascript:void(0);" class="navbar-brand hidden-lg hidden-md" style="position:absolute;left:25%;top:40px;">
				<img src="<?php echo base_url($this->config->item('template_path')."images/logo.png");?>" alt="logo" />
			</a>
			<!-- /Sidebar Toggler -->
			<!-- Top Right Menu -->
			<ul class="nav navbar-nav navbar-right">
			<?php 
			if($this->session->userdata('status')==STATUS_TECHNICIAN){
				$newenquirie = $this->enquiry_m->get_enquiries(false,array('status'=>0));
				$tech_locations = $this->default_m->getTechnicianLocations($this->session->userdata('id'));
				$tech_appliance = $this->default_m->getTechnicianAppliances($this->session->userdata('id'));
				$notif_num=0;
				if($newenquirie){
					foreach($newenquirie as $enc){
						$strt=1;$temp_itms=array();
						if(($tech_appliance) && (in_array($enc['location'],$tech_locations))){
							//if(!$enc['status'] || ($enc['status'] && $enc['technician_id']==$this->session->userdata['id']))
							//{
							/*$items = explode(",",$enc["items"]);
							foreach($items as $item){
								$item = explode("-",$item);
								$temp_itms[]=$item[0];
							}
							$diffaplnc = array_diff_assoc($temp_itms, $tech_appliance);
							
							if(count($diffaplnc)==0){
								$notif_num +=1;
							}*/
							$notif_num +=1;
						}
					}
				}
				?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-bell"></i>
						<span class="badge"><?php echo ($notif_num)?($notif_num):0; ?></span>
					</a>
					<ul class="dropdown-menu extended notification">
						<li class="title">
							<p>You have <?php echo ($notif_num)?($notif_num):0; ?> new Notifications</p>
						</li>
						<?php

						if($newenquirie){
							foreach($newenquirie as $enc){
							$strt=1;$temp_itms=array();
							if(($tech_appliance) && (in_array($enc['location'],$tech_locations))){
								//if(!$enc['status'] || ($enc['status'] && $enc['technician_id']==$this->session->userdata['id']))
								//{
							
								/*$items = explode(",",$enc["items"]);
								foreach($items as $item){
									$item = explode("-",$item);
									$temp_itms[]=$item[0];
								}
								$diffaplnc = array_diff_assoc($temp_itms, $tech_appliance);
								
								if(count($diffaplnc)==0){*/
									echo '<li>
										<a href="'.site_url('admin/enquiries/index').'">
											<span class="subject">
												<span class="from">'.$enc['customer_name'].'</span>
												<span class="time"> '.date('d M Y',$enc['enquiry_date']).'</span>
											</span>
										</a>
									</li>';
								//}
							  }
						  }
						}
						?>
					</ul>
				</li>
			<?php } ?>
				<!-- User Login Dropdown -->
				<li class="dropdown user">
					<?php $userProf = $this->user_m->getUser($this->session->userdata('id'));?>
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<!--<img alt="" src="assets/img/avatar1_small.jpg" />-->
						<i class="<?php echo ($userProf['gender']==1)?'icon-male':'icon-female';?>"></i>
						<span class="username"><?php echo $userProf['name'];?></span>
						<i class="icon-caret-down small"></i>
					</a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo site_url('admin/user/profile');?>"><i class="icon-user"></i> My Profile</a></li>
						<li><a href="<?php echo site_url('admin/user/change_password');?>"><i class="icon-cog"></i> Change Password</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo site_url("login/logout");?>"><i class="icon-key"></i> Log Out</a></li>
					</ul>
				</li>
				<!-- /user login dropdown -->
			</ul>
			<!-- /Top Right Menu -->
		</div>
		<!-- /top navigation bar -->
	</header> <!-- /.header -->
	<div id="container">
		<div id="sidebar" class="sidebar-fixed">
			<div id="sidebar-content">
				<!-- Search Input -->
				<form class="sidebar-search">
					<div class="input-box">
						<button type="submit" class="submit">
							<i class="icon-search"></i>
						</button>
						<span>
							<input type="text" placeholder="Search...">
						</span>
					</div>
				</form>

				<!-- Search Results -->
				<div class="sidebar-search-results">

					<i class="icon-remove close"></i>
					<!-- Documents -->
					<div class="title">
						Documents
					</div>
				</div> <!-- /.sidebar-search-results -->

				<!--=== Navigation ===-->
				<?php $this->load->view($this->config->item('backend_path').'nav');?>
				<!--==== End Navigations=======-->
			</div>
			<div id="divider" class="resizeable"></div>
		</div>
		<!-- /Sidebar -->

		<div id="content">
			<div class="container">
				<!-- Breadcrumbs line -->
				<div class="crumbs">
					<ul id="breadcrumbs" class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="<?php echo site_url('admin/main');?>">Dashboard</a>
						</li>
						<li class="current">
							<a href="javascript:void(0);" title=""><?php echo $page_title;?></a>
						</li>
					</ul>
				</div>
				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3><?php echo $page_title;?></h3>
					</div>			
				</div>	
				<br clear="all" />
				<div id="notificationMSG" class="col-md-12">
					<div>
					<?php echo (validation_errors())? '<div class="alert alert-danger fade in">
							<button class="close" aria-hidden="true" data-dismiss="alert" type="button"><i class="fa fa-times-circle" data-dismiss="alert"></i></button>
							<i class="icon-remove close" data-dismiss="alert"></i> '.validation_errors().'</div>' : '';
							
						  // User generated messages
						
						echo $this->message->display();
					?>
					</div>
				</div>
				<script>
					setTimeout(function() {
						$('#notificationMSG').fadeOut('fast');
					}, 5000);
				</script>