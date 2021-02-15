<?php
if(get_cookie('loginIn') && $this->session->userdata('id')){
	$navigation = $this->settings_m->getMenu(false,false,array('parent'=>'0'));//json_decode($string,true);
	$role = $this->role_m->getPrivilage($this->session->userdata("status"));
	$modules = explode(",",$role['module_list']);
	?>
	<div class="col-lg-9 col-sm-4 col-md-2 order-3 order-lg-2">
		<div class="main__menu__wrap">
			<nav class="main__menu__nav d-none d-lg-block">
				<ul class="mainmenu">
					<?php 
					foreach($navigation as $nav): 
						if(in_array($nav['id'], $modules)){
							$submenu = $this->settings_m->getMenu(false,false,array('parent'=>$nav['id']));
							if($submenu){?>
							   <li class="<?php echo ($submenu)?'drop':'';?>" id="<?php echo "'main_".$nav['id']."'"; ?>">
								  <a href="#" onclick="clickMenu(this);"><i class="fa fa-files-o"></i> <?php echo $nav['title']; ?></a>
								  <ul class="dropdown__menu">
									<?php
									$subnum=0; 
									foreach($submenu as $nav_sub){
										if(in_array($nav_sub['id'], $modules)){
										?>
										 <li id="<?php echo "'main_".$nav_sub['id']."'"; ?>" ><?php echo anchor($nav_sub['link'],$nav_sub['title'].'', array('onclick'=>'clickMenu(this);')) ?></li>
										<?php
											$subnum++;
										}
									} ?>
								 </ul>
								</li>
							<?php 
							}else{
							?>
								<li id="<?php echo "'main_".$nav['id']."'"; ?>">
								  <?php echo anchor($nav['link'],$nav['title'], array('onclick'=>'clickMenu(this);')); ?>
								</li>          
							<?php 
							} 
						} 
					endforeach; ?>
				</ul>
			</nav>
			
		</div>
	</div>
	<!--<div class="col-lg-1 col-sm-4 col-md-4 order-2 order-lg-3">
		<div class="header__right d-flex justify-content-end">
			<div class="log__in">
				<a href="<?php echo site_url('login/logout');?>"><i class="zmdi zmdi-account-o"></i></a>
			</div>
			<div class="shopping__cart">
				<?php
				$order = $this->main_m->getOrder($this->session->userdata('id'),false,array('checkout'=>'0'));
				?>
				<a class="minicart-trigger" href="#"><i class="zmdi zmdi-shopping-basket"></i></a>
				<?php if($order){ ?>
				<div class="shop__qun">
					<span><?php echo count($order);?></span>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>-->
   <?php
}else{
	$uri = $this->uri->segment(2);
	$home=false;$foodlist=false;$contact=false;
	if($uri=='business_plan'){
		$foodlist='class="active"';	
	}else if($uri=='contact'){
		$contact='class="active"';
	}else{
		$home='class="active"';
	}
	?>
	<div class="col-lg-9 col-sm-4 col-md-2 order-3 order-lg-2">
		<div class="main__menu__wrap">
			<nav class="main__menu__nav d-none d-lg-block">
				<ul class="mainmenu">
					<li><a href="<?php echo site_url('main/index');?>">Home</a></li>
					<li><a href="<?php echo site_url('main/food_list');?>">Food List</a></li>
					<li><a href="<?php echo site_url('main/contact');?>">Contact</a></li>
				</ul>
			</nav>
		</div>
    </div>
	<div class="col-lg-1 col-sm-4 col-md-4 order-2 order-lg-3">
		<div class="header__right d-flex justify-content-end">
			<div class="log__in">
				<a class="accountbox-trigger" href="<?php echo site_url('login');?>"><i class="zmdi zmdi-account-o"></i></a>
			</div>
		</div>
	</div>
<?php
}
?>