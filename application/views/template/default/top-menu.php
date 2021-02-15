<div class="col-md-9 col-sm-12 col-xs-12">
	<nav class="navbar"> 
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
			<a class="navbar-brand" href="#"><img class="logo-dark hidden-xs"  src="<?php echo base_url ($this->config->item("template_path").'images/logo.png');?>" alt="" /> <img class="logo-dark hidden-lg hidden-md hidden-sm"  src="<?php echo base_url ($this->config->item("template_path").'images/logo.png');?>" alt="" /></a> 
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="main-menu collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-left">
			<?php
			if(!$this->session->userdata('login')){
				$menus = $this->config->item("menu");
				if($menus){
					foreach($menus as $menu){
						echo '<li><a href="'.site_url($menu[1]).'"> '.$menu[0].'</a></li>';
					}
				}
			}else{
				$navigation = $this->settings_m->getMenu(false,false,array('parent'=>'0'));//json_decode($string,true);
				$role = $this->role_m->getPrivilage($this->session->userdata("status"));
				$modules = explode(",",$role['module_list']);
				foreach($navigation as $nav): 
					if(in_array($nav['id'], $modules)){
						echo '<li><a href="'.site_url($nav['link']).'"> '.$nav['title'].'</a></li>';
					}
				endforeach;
			}
			?>
			</ul>
		</div><!-- /.navbar-collapse -->
	</nav><br clear="all" />
</div>
<div class="col-md-3  col-sm-12 col-xs-12">
	<ul class="right-contact">
		<!--<li style="vertical-align:bottom"><i class="fa fa-phone" aria-hidden="true"></i> +91 8107186985</li>-->
		<?php if(!$this->session->userdata('login')){?>
			<li class="pull-right"><a href="<?php echo site_url('login');?>" class="btn btn-primary btn-skin"><span class="hidden-lg hidden-md"><i class="fa fa-lock"></i></span><span class="hidden-sm hidden-xs">Login/Registor</span></a></li>
		<?php }else{ ?>
			<li class="pull-right"><a href="<?php echo site_url('login/logout');?>" class="btn btn-primary btn-skin"><span class="hidden-lg hidden-md"><i class="fa fa-power-off"></i></span><span class="hidden-sm hidden-xs">Logout</span></a></li>
		<?php } ?>
	</ul>
</div>
