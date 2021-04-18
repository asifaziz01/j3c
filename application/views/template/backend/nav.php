<?php
if(get_cookie('loginIn')){
	$navigation = $this->settings_m->getMenu(false,false,array('parent'=>'0'));//json_decode($string,true);
	$role = $this->role_m->getPrivilage($this->session->userdata("status"));
	if($this->session->userdata('status')==STATUS_STAFF){
		if(!$this->session->userdata('post')){
			$modules=array();
		}else{
			$post = $this->user_m->getStaffPost($this->session->userdata('post'));
			$modules = ($post['previliges'])?explode(",",$post['previliges']):[];
		}
	}else{
		$modules = explode(",",$role['module_list']);
	}
	?>
	<ul id="nav">
		<?php
		foreach($navigation as $nav): 
			if(in_array($nav['id'], $modules)){
				$submenu = $this->settings_m->getMenu(false,false,array('parent'=>$nav['id']));
				if($submenu){?>
				   <li id="<?php echo "'main_".$nav['id']."'"; ?>">
					  <a href="<?php echo $nav['link'];?>" onclick="clickMenu(this);"><i class="fa fa-files-o"></i> <?php echo $nav['title']; ?></a>
					  <ul class="sub-menu">
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
		endforeach; 
		?>
		<?php if(!get_cookie('loginIn')){?>
			<li class="hidden-lg"><a href="<?php echo site_url('login/registration');?>">Register</a></li>
			<li class="hidden-lg"><a href="<?php echo site_url('login');?>">login</a></li>
		<?php }else{?>
			<li class="hidden-lg"><a href="<?php echo site_url('login/logout');?>">logout</a></li>
		<?php } ?>
	</ul>
   <?php
}