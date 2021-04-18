<span class="closebtn" onclick="closeNav()">&times;</span>
<?php
if(!$this->session->userdata('login')){
    $menus = $this->config->item("menu");
    if($menus){
        foreach($menus as $menu){
            echo '<a href="'.site_url($menu[1]).'"> '.$menu[0].'</a>';
        }
    }
    echo '<a href="'.site_url('login').'"><span class="hidden-lg hidden-md">Login/Registor</a>';
}else{
    echo '<a href="javascript:void(0)" style="color:#FFF;"><u>'.$this->session->userdata('name').'</u></a>';
    $navigation = $this->settings_m->getMenu(false,false,array('parent'=>'0'));//json_decode($string,true);
    $role = $this->role_m->getPrivilage($this->session->userdata("status"));
    $modules = explode(",",$role['module_list']);
    foreach($navigation as $nav): 
        if(in_array($nav['id'], $modules)){
            echo '<a href="'.site_url($nav['link']).'"> '.$nav['title'].'</a>';
        }
    endforeach;
    echo '<a href="'.site_url('login/logout').'"><span class="hidden-lg hidden-md">Logout</a>';
}
?>