<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="author" content="Inovexia Software Services">
<meta name="description" content="Just3Click">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="application-name" content="J3C">
<meta name="apple-mobile-web-app-title" content="J3C">
<meta name="theme-color" content="#4285F4">
<meta name="msapplication-navbutton-color" content="#4285F4">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="msapplication-starturl" content="<?php echo site_url (''); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!--==== Apple Touch Icons ====-->
<link rel="icon" sizes="128x128" href="<?php echo base_url($this->config->item("template_path"). 'images/touch/icon128.png'); ?>">
<link rel="apple-touch-icon" sizes="128x128" href="<?php echo base_url($this->config->item("template_path"). 'images/touch/icon128.png'); ?>">
<link rel="icon" sizes="192x192" href="<?php echo base_url($this->config->item("template_path"). 'images/touch/icon192.png'); ?>">
<link rel="apple-touch-icon" sizes="192x192" href="<?php echo base_url($this->config->item("template_path"). 'images/touch/icon192.png'); ?>">
<link rel="icon" sizes="256x256" href="<?php echo base_url($this->config->item("template_path"). 'images/touch/icon256.png'); ?>">
<link rel="apple-touch-icon" sizes="256x256" href="<?php echo base_url($this->config->item("template_path"). 'images/touch/icon256.png'); ?>">
<link rel="icon" sizes="384x384" href="<?php echo base_url($this->config->item("template_path"). 'images/touch/icon384.png'); ?>">
<link rel="apple-touch-icon" sizes="384x384" href="<?php echo base_url($this->config->item("template_path"). 'images/touch/icon384.png'); ?>">
<link rel="icon" sizes="512x512" href="<?php echo base_url($this->config->item("template_path"). 'images/touch/icon512.png'); ?>">
<link rel="apple-touch-icon" sizes="512x512" href="<?php echo base_url($this->config->item("template_path"). 'images/touch/icon512.png'); ?>">

<!--==== Fav-icon ====-->
<link rel="icon" href="<?php echo base_url($this->config->item("template_path"). 'images/fav-icon.png'); ?>" type="image/png" sizes="512x512">
<!--==== Manifest JSON ====-->
<link rel="manifest" href="<?php echo base_url ('manifest.json'); ?>">

<title><?php echo site_name();?> | <?php echo $page_title;?></title>

<!-- Bootstrap -->
<link href="<?php echo base_url ($this->config->item("template_path").'css/bootstrap.min.css');?>" rel="stylesheet"  />
<link href="<?php echo base_url ($this->config->item("template_path").'css/style.css');?>" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url ($this->config->item("template_path").'css/font-awesome.min.css');?>" />
<link rel="stylesheet" href="<?php echo base_url ($this->config->item("template_path").'css/offcanvas.css');?>" />
<link rel="stylesheet" href="<?php echo base_url ($this->config->item("template_path").'css/owlcarousel/owl.carousel.min.css');?>" />
<link rel="stylesheet" href="<?php echo base_url ($this->config->item("template_path").'css/owlcarousel/owl.theme.default.min.css');?>" />
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;1,300;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url ($this->config->item("template_path").'css/custom.css');?>" />

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script src="<?php echo base_url ($this->config->item("template_path").'js/jquery.min.js');?>"></script>
<script src="<?php echo base_url ($this->config->item("template_path").'js/popper.min.js');?>"></script>
<script src="<?php echo base_url ($this->config->item("template_path").'js/bootstrap.min.js');?>"></script>

    <style>
		.ticker-wrap {
			position: fixed;
			/*bottom: 0;*/
			width: 100%;
			overflow: hidden;
			height: 2rem;
			font-size:12px;
			font-weight:bold;
			/*background-color: rgba(1, 1, 1, 0.5);*/
			padding-left: 100%; /*// offsets items to begin*/
		}

		.ticker {
			display: inline-block;
			height: 2rem;
			line-height: 2rem;
			white-space: nowrap;
			padding-right: 100%; /*// taken from container as display inline-block*/
		}

		.ticker__item {
			display: inline-block;
			padding: 0 2rem;
			font-size: 1rem;
			color: #000;
		}

		@keyframes ticker {
			0% {
				-webkit-transform: translate3d(0, 0, 0);
						transform: translate3d(0, 0, 0);

			}
			100% {
				-webkit-transform: translate3d(-550%, 0, 0);
						transform: translate3d(-550%, 0, 0);
			}
		}

		.ticker {
			animation-name: ticker;
			animation-iteration-count: infinite;
			animation-timing-function: linear;
			animation-duration: 100s; /*// tweak based on number of items/desired speed*/
		}

		.ticker:hover { -webkit-animation-play-state: paused; -moz-animation-play-state: paused; -o-animation-play-state: paused; animation-play-state: paused; }
/* The side navigation menu */
.sidenav {
    height: 100%; /* 100% Full-height */
    width: 0; /* 0 width - change this with JavaScript */
    position: fixed; /* Stay in place */
    z-index: 11000000; /* Stay on top */
    top: 0; /* Stay at the top */
    right: 0;
    background-color: #111; /* Black*/
    overflow-x: hidden; /* Disable horizontal scroll */
    padding-top: 60px; /* Place content 60px from the top */
    transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
  }

  /* The navigation menu links */
  .sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 1.2em;
    color: #818181;
    display: block;
    transition: 0.3s;
    border-bottom:1px solid #818181;
  }

  /* When you mouse over the navigation links, change their color */
  .sidenav a:hover {
    color: #FFF;
  }

  /* Position and style the close button (top right corner) */
  .sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
    color:#CCC;
  }

  /* Style page content - use this if you want to push the page content to the right when you open the side navigation */
  #main {
    transition: margin-left .5s;
    padding: 20px;
  }

  /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
  @media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
  }
  a.backHistory{
    position:absolute;
    z-index:100000;
    color:#CCC;
    left:10px;
    top:5px;
  }


  .toolbar{
    background-color:#080D22;
  }
  .toolbar a{
    width:32px;
    height:32px;
    color:#FFF;
    padding-left:7px;
  }
</style>

	<script src="<?php echo base_url ($this->config->item("template_path").'js/anime.min.js');?>"></script>
	<link rel="stylesheet" href="<?php echo base_url ($this->config->item("template_path").'css/anime.css');?>" />
	<link rel="stylesheet" href="<?php echo base_url ($this->config->item("template_path").'css/datatable.css');?>" />
</head>
<body>
<!--Wrapper Start-->
<div id="wrapper" style="background:url(<?php echo base_url($this->config->item('template_path').'images/bg.png');?>);">
  <img src="<?php echo base_url ($this->config->item("template_path").'images/loader.gif');?>" id="loader" style="position:absolute;z-index:10000;width:50px;top:200px;left:48%;display:none;">
  <!--Header Section Start-->
  <?php if(!isset($no_header)){?>
	<header id= "header" data-spy="affix" data-offset-top="60" data-offset-bottom="60" style="padding-top:0px;padding-bottom:0px; ">
    <div class="container">
			<div class="row">
				<?php if(!isset($no_top_menu)){$this->load->view($this->config->item("template_path")."top-menu");}?>
			</div>
		</div>
    <?php if(isset($toolbar)){?>
      <div class="container hidden-lg hidden-md toolbar" style="border-top:1px solid #666;padding-top:5px;margin-top:5px;">
        <div class="col-md-6 col-sm-6 col-xs-6">
          <a class="btn" href="<?php echo site_url($toolbar['home']);?>"><i class="fa fa-home"></i></a>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
          <a class="btn" href="<?php echo site_url($toolbar['profile']);?>"><i class="fa fa-user"></i></a>
        </div>
      </div>
    <?php } ?>
	</header>
	<div id="mySidenav" class="sidenav hidden-lg hidden-md">
		<?php $this->load->view($this->config->item("template_path")."sidebar");?>
	</div>
  <?php } ?>
  <!--/Header Section End-->
  <?php if(isset($slider)){$this->load->view($this->config->item("template_path")."slider");}?>
