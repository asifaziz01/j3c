<!--<div class="col-md-8 col-sm-12 col-xs-12">
	<nav class="navbar navbar-expand-lg navbar-dark" style="padding-top:0px;badding-bottom:0px;"> 
		<a class="navbar-brand" href="#">
			<img class="logo-dark" src="<?php echo base_url ($this->config->item("template_path").'images/logo.png');?>" />
		</a>
		<button class="navbar-toggler" onclick="openNav()" type="button" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" aria-expanded="false">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
			<?php
			if(!$this->session->userdata('login')){
				$menus = $this->config->item("menu");
				if($menus){
					foreach($menus as $menu){
						echo '<li class="nav-item"><a class="nav-link" href="'.site_url($menu[1]).'"> '.$menu[0].'</a></li>';
					}
				}
			}else{
				$navigation = $this->settings_m->getMenu(false,false,array('parent'=>'0'));//json_decode($string,true);
				$role = $this->role_m->getPrivilage($this->session->userdata("status"));
				$modules = explode(",",$role['module_list']);
				foreach($navigation as $nav): 
					if(in_array($nav['id'], $modules)){
						echo '<li class="nav-item"><a class="nav-link" href="'.site_url($nav['link']).'"> '.$nav['title'].'</a></li>';
					}
				endforeach;
			}
			?>
			</ul>
		</div>
	</nav>
</div>
<div class="col-md-3  col-sm-12 col-xs-12 hidden-sm hidden-xs">
	<ul class="right-contact">
		<?php if(!$this->session->userdata('login')){?>
			<li class="pull-right"><a href="<?php echo site_url('login');?>" class="btn btn-primary btn-skin"><span class="hidden-lg hidden-md"><i class="fa fa-lock"></i></span><span class="hidden-sm hidden-xs">Login/Registor</span></a></li>
		<?php }else{ ?>
			<li class="pull-right"><a href="<?php echo site_url('login/logout');?>" class="btn btn-primary btn-skin"><span class="hidden-lg hidden-md"><i class="fa fa-power-off"></i></span><span class="hidden-sm hidden-xs">Logout</span></a></li>
		<?php } ?>
	</ul>
</div>-->
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" style="padding-top:0px;padding-bottom:0px;">
	<a class="navbar-brand mr-auto mr-xs-0" href="#" style="padding-top:0px;padding-bottom:7px;">
		<img class="logo-dark hidden-sm hidden-xs" src="<?php echo base_url ($this->config->item("template_path").'images/logo.png');?>" />
		<img class="logo-dark hidden-lg hidden-md" src="<?php echo base_url ($this->config->item("template_path").'images/logo-mini.png');?>" />
	</a>
	<button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="navbar-collapse offcanvas-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
		<?php
			if(!$this->session->userdata('login')){
				$menus = $this->config->item("menu");
				if($menus){
					foreach($menus as $menu){
						echo '<li class="nav-item"><a class="nav-link" href="'.site_url($menu[1]).'"> '.$menu[0].'</a></li>';
					}
				}
			}else{
				$navigation = $this->settings_m->getMenu(false,false,array('parent'=>'0'));//json_decode($string,true);
				$role = $this->role_m->getPrivilage($this->session->userdata("status"));
				$modules = explode(",",$role['module_list']);
				foreach($navigation as $nav): 
					if(in_array($nav['id'], $modules)){
						echo '<li class="nav-item"><a class="nav-link" href="'.site_url($nav['link']).'"> '.$nav['title'].'</a></li>';
					}
				endforeach;
			}
		?>
		</ul>
		<form class="form-inline my-2 my-lg-0">
			<?php if(!$this->session->userdata('login')){?>
				<a href="<?php echo site_url('login');?>" class="btn btn-primary btn-skin"><i class="fa fa-lock"></i> Login/Registor</a>
			<?php }else{ ?>
				<a href="<?php echo site_url('login/logout');?>" class="btn btn-primary btn-skin"><span class="hidden-lg hidden-md"><i class="fa fa-power-off"></i></span><span class="hidden-sm hidden-xs">Logout</span></a>
			<?php } ?>
		</form>
	</div>
</nav>