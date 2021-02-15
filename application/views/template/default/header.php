<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php echo site_name();?> | <?php echo $page_title;?></title>
<!-- Bootstrap -->
<link href="<?php echo base_url ($this->config->item("template_path").'css/bootstrap.min.css');?>" rel="stylesheet"  />
<link href="<?php echo base_url ($this->config->item("template_path").'css/style.css');?>" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url ($this->config->item("template_path").'css/font-awesome.min.css');?>" />
<link rel="stylesheet" href="<?php echo base_url ($this->config->item("template_path").'css/owlcarousel/owl.carousel.min.css');?>" />
<link rel="stylesheet" href="<?php echo base_url ($this->config->item("template_path").'css/owlcarousel/owl.theme.default.min.css');?>" />
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="<?php echo base_url ($this->config->item("template_path").'js/jquery-3.1.0.js');?>"></script> 
	<script type="text/javascript">
      
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
	</style>

	<script src="<?php echo base_url ($this->config->item("template_path").'js/anime.min.js');?>"></script> 
	<link rel="stylesheet" href="<?php echo base_url ($this->config->item("template_path").'css/anime.css');?>" />
	<link rel="stylesheet" href="<?php echo base_url ($this->config->item("template_path").'css/datatable.css');?>" />
</head>
<body>
<!--Wrapper Start-->
<div id="wrapper"> 
  <img src="<?php echo base_url ($this->config->item("template_path").'images/loader.gif');?>" id="loader" style="position:absolute;z-index:10000;width:50px;top:200px;left:48%;display:none;">
  <!--Header Section Start-->
  <?php if(!isset($no_header)){?>
	<header id= "header" data-spy="affix" data-offset-top="60" data-offset-bottom="60">
		<div class="container">
		<div class="row">
			<?php if(!isset($no_top_menu)){$this->load->view($this->config->item("template_path")."top-menu");}?>
		</div>
		</div>
		<!-- /.container --> 
	</header>
  <?php } ?>
  <!--/Header Section End--> 
  <?php if(isset($slider)){$this->load->view($this->config->item("template_path")."slider");}?>
