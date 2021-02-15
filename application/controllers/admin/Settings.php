<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct() {
		parent::__construct();

		if((get_cookie('loginIn') && !$this->session->userdata('id')) || !get_cookie('loginIn')){
			delete_cookie('loginIn');
			redirect('login');
		}
		$this->load->model("user_m");
		$this->load->model("main_m");
		$userType = $this->default_m->getUserType();
		if($userType){
			foreach($userType as $usrtyp){
				$txt = $usrtyp['term'];
				define($txt,$usrtyp['id']);
			}
		}
	}
	//==== add Profile pic ========
	public function addPicture($id=false,$img=false,$folder=false,$detail=false){
		//===== image uploading code ======
		$img = ($img)?$img:$_POST['profile_pic'];
		if($img){
			$img = str_replace("[removed]","", $img);
			$img = str_replace(' ', '+', $img);

			//$product = $this->restourent_m->getProducts($id);
			$folderName = ($folder)?$folder:'products';
			$imgpath = realpath($this->config->item('filemanager').$folderName)."/";
			$imgname = 'img_'.$detail['id'] . '.png';

			$source = fopen($img, 'r');
			$destination = fopen($imgpath.$imgname, 'w');
			
			if(stream_copy_to_stream($source, $destination)){
				$imgdata = array("image"=>$imgname,"image_type"=>"image/png");
				//$this->restourent_m->addProductPic($pid,$imgdata);
				$this->message->set("Action Completed Successfully!","success", true);
			}else{
				$imgdata=false;
				$this->message->set("Image not upload!","danger", true);
			}
			
			fclose($source);
			fclose($destination);
			return $imgdata;
			/*$img = str_replace('data:image/png;base64,', '', $img);
			$data = base64_decode($img);
			$imgname = $user['ABO'] . '.png';
			$file = $imgpath . $imgname;
			$success = file_put_contents($file, $data);*/
		}else{
			$this->message->set("Please Select an Image for Product!","danger", true);
			return false;
		}
	}
	//================================//
	public function index(){
		$data['page_title'] = "Settings";
		$data['no_banner'] = true;
		$this->load->view($this->config->item('backend_path') . 'header', $data);
		$this->load->view("admin/settings/index", $data);
		$this->load->view($this->config->item('backend_path') . 'footer', $data);	
	}
	//======== menu settings =============
	public function saveindex(){
		if($this->input->post('save')){
			$menus = $this->settings_m->getMenu();
			if($menus){
				foreach($menus as $menu){
					$data = array("indexing"=>$this->input->post('indx_'.$menu['id']));
					$this->settings_m->setIndex($menu['id'],$data);
				}
				$this->message->set("Action completed successfully!","success",true);
			}

		}

		redirect('admin/settings/menus');
	}
	public function menus(){
		$data['page_title'] = "Manage Menu";
		$data['no_banner'] = true;
		$this->load->view($this->config->item('backend_path') . 'header', $data);
		$this->load->view("admin/settings/menus", $data);
		$this->load->view($this->config->item('backend_path') . 'footer', $data);	
	}
	public function addmenu(){
		$this->form_validation->set_rules("title","Title","required");
		$this->form_validation->set_rules("link","Link","required");
		if($this->form_validation->run()==true){
			$this->settings_m->addmenu();
			$this->message->set("Action complete successfully!","success", true);
			redirect("admin/settings");
		}
		$data['page_title'] = "Add Menu";
		$data['no_banner'] = true;
		$this->load->view($this->config->item('backend_path') . 'header', $data);
		$this->load->view("admin/settings/addmenu", $data);
		$this->load->view($this->config->item('backend_path') . 'footer', $data);	
	}
	public function editmenu($id=false){
		$this->form_validation->set_rules("title","Title","required");
		$this->form_validation->set_rules("link","Link","required");
		if($this->form_validation->run()==true){
			$this->settings_m->addmenu($id);
			$this->message->set("Action complete successfully!","success", true);
			redirect("admin/settings");
		}
		$data['page_title'] = "Add Menu";
		$data['no_banner'] = true;
		$data['id'] = $id;
		$data['menu'] = $this->settings_m->getMenu($id);
		$this->load->view($this->config->item('backend_path') . 'header', $data);
		$this->load->view("admin/settings/editmenu", $data);
		$this->load->view($this->config->item('backend_path') . 'footer', $data);	
	}
	public function deletemenu($id=false){
		if($id){
			$this->settings_m->deleteMenu($id);
			$this->message->set("Delete Menu Item Successfully!","success",true);
		}
		if($this->input->post('ids')){
			$del=0;
			foreach($this->input->post('ids') as $id){
				$this->settings_m->deleteMenu($id);
				$del=1;
			}
			if($del){
				$this->message->set("Delete Menu Item Successfully!","success",true);
			}
		}
		redirect("admin/settings/menus");
	}
	//=====================================
	//======user type======================
	public function create_usertype(){
		$this->form_validation->set_rules("usertype","User Type","required");
		$this->form_validation->set_rules("term","Term","required");
		if($this->form_validation->run()==true){
			$this->settings_m->create_userType();
			echo '<div style="background-color:green;color:white;text-align:center;">Create Successfully!</div>'.br(1);
		}else{
			echo '<div style="background-color:red;color:white;text-align:center;">Something Wrong!</div>'.br(1);
		}
		$this->userType_list();
	}
	public function userType_list(){
		$userTypes = $this->settings_m->getUserType();
		echo '<table class="table table-responsive table-condenced table-striped table-bordered">
					<thead>
						<th>#</th>
						<th>User</th>
						<th>Action</th>
					</thead>
					<tbody>';
		if($userTypes)
		{
			foreach($userTypes as $ut){
				echo '<tr>';
				echo '<td>'.$ut['id'].'</td>';
				echo '<td>'.$ut['title'].'</td>';
				echo '<td>
					  </td>';
				echo '</tr>';
			}
		}
		echo '</tbody></table>';
	}
	public function deleteUserType($id=false){
		if($id){
			$this->settings_m->deleteUserPrevilige($id);
			$this->settings_m->deleteUserType($id);
			$this->user_m->deleteUser(false,array("status"=>$id));
			$this->message->set('Action completed Successfylly!','success',true);
		}else{
			$this->message->set('Action not completed Successfylly!','danger',true);
		}
		redirect('admin/settings/');
	}
	//========previeleges==========
	public function previeleges($usrtyp=false){
		$this->form_validation->set_rules('usrtyp','User Type','required');
		$this->form_validation->set_rules('mnu[]','Menu','required');
		if($this->form_validation->run()==true){
			$this->settings_m->setPrevieleges($this->input->post('usrtyp'));
			$this->message->set("Action Complete Successfully!","success",true);
			redirect("admin/settings/previeleges/".$this->input->post('usrtyp'));
		}
		$data['page_title'] = "Previeleges";
		$data['no_banner'] = true;
		$data['usrtyp'] = $usrtyp;
		if($this->session->userdata['status']!=STATUS_SUPER){$clause=array("id >"=>1);}else{$clause=false;}
		$data['usertypes'] = $this->settings_m->getUserType(false, $clause);
		$data['menus'] = $this->settings_m->getMenu();
		$this->load->view($this->config->item('backend_path') . 'header', $data);
		$this->load->view("admin/settings/previeleges", $data);
		$this->load->view($this->config->item('backend_path') . 'footer', $data);	
	}
	public function getPrevieleges($usrtyp=false){
		$menus = $this->settings_m->getMenu();
		$prev = $this->settings_m->getPrevieleges($usrtyp);
		$prev = explode(",",$prev['module_list']);
		if($menus)
		{
			foreach($menus as $menu){
				$checked = (in_array($menu['id'],$prev))?'checked="checked"':'';
				$parent = ($menu['parent']==0)?array('title'=>'Root'):$this->settings_m->getMenu($menu['parent']);
				echo '<tr>';
				echo '<td><input type="checkbox" name="mnu[]" value="'.$menu['id'].'" '.$checked.'></td>';
				echo '<td>'.$menu['title'].'</td>';
				echo '<td>'.$menu['link'].'</td>';
				echo '<td>'.$parent['title'].'</td>';
				echo '</tr>';
			}
			echo '<tr>
					<td colspan="4"><input type="submit" class="btn btn-primary pull-right" value="Set Previelege" /></td>
				</tr>
			';
		}
	}
	//======Category======================
	public function add_category(){
		$this->form_validation->set_rules("category","Category","required");
		if($this->form_validation->run()==true){
			$id = $this->settings_m->create_category();
			if($_POST['category_pic']){
				$category = $this->settings_m->getCategory($id);
				$data=$this->addPicture(false,$_POST['category_pic'],'category',$category);
				if($data){
					$this->settings_m->add_category_data($id,$data);
				}
			}
			$this->message->set("Action complete Successfully!","success",true);
			redirect("admin/settings");
		}
		$data['page_title'] = "Add Category";
		$data['no_banner'] = true;
		$this->load->view($this->config->item('backend_path') . 'header', $data);
		$this->load->view("admin/settings/add_category", $data);
		$this->load->view($this->config->item('backend_path') . 'footer', $data);	
	}
	public function edit_category($id=false){
		$this->form_validation->set_rules("category","Category","required");
		if($this->form_validation->run()==true){
			$this->settings_m->create_category($id);
			if($_POST['category_pic']){
				$category = $this->settings_m->getCategory($id);
				$data=$this->addPicture(false,$_POST['category_pic'],'category',$category);
				if($data){
					$this->settings_m->add_category_data($id,$data);
				}
			}
			$this->message->set("Action complete successfully!","success", true);
			redirect("admin/settings");
		}
		$data['page_title'] = "Update Category";
		$data['no_banner'] = true;
		$data['id'] = $id;
		$data['category'] = $this->settings_m->getCategory($id);
		$this->load->view($this->config->item('backend_path') . 'header', $data);
		$this->load->view("admin/settings/edit_category", $data);
		$this->load->view($this->config->item('backend_path') . 'footer', $data);	
	}
	public function foodCategories(){
		$categories = $this->settings_m->getCategory();
		echo '<table class="table table-responsive table-condenced table-striped table-bordered">
					<thead>
						<th>#</th>
						<th>Category</th>
						<th>Action</th>
					</thead>
					<tbody>';
		if($categories)
		{
			foreach($categories as $cat){
				echo '<tr>';
				echo '<td>'.$cat['id'].'</td>';
				echo '<td>'.$cat['title'].'</td>';
				echo '<td>
					  </td>';
				echo '</tr>';
			}
		}
		echo '</tbody></table>';
	}
	//=============================
	//=======location==============
	public function add_food_type(){
		$this->form_validation->set_rules("title","Title","required");
		if($this->form_validation->run()==true){
			$this->settings_m->add_foodType();
			$this->message->set("Action complete successfully!","success", true);
			redirect("admin/settings");
		}
		$data['page_title'] = "Add Food Type";
		$data['no_banner'] = true;
		$this->load->view($this->config->item('backend_path') . 'header', $data);
		$this->load->view("admin/settings/add_food_type", $data);
		$this->load->view($this->config->item('backend_path') . 'footer', $data);	
	}
	public function edit_food_type($id=false){
		$this->form_validation->set_rules("title","Title","required");
		if($this->form_validation->run()==true){
			$this->settings_m->add_foodType($id);
			$this->message->set("Action complete successfully!","success", true);
			redirect("admin/settings");
		}
		$data['page_title'] = "Edit Food Type";
		$data['no_banner'] = true;
		$data['food_type'] = $this->settings_m->getfoodType($id);
		$this->load->view($this->config->item('backend_path') . 'header', $data);
		$this->load->view("admin/settings/edit_food_type", $data);
		$this->load->view($this->config->item('backend_path') . 'footer', $data);	
	}
	public function foodTypeList($type=false){
		$foodTypes = $this->settings_m->getFoodType();
		echo '<table class="table table-responsive table-condenced table-striped table-bordered">
					<th data-class="expend">Type</th>
					<th>Action</th>
					<tbody>';
		if($places)
		{
			foreach($places as $place){
				$state = $this->default_m->getStates($place['state']);
				$city = $this->default_m->getCity(false,$place['city']);
				echo '<tr>';
				echo '<td>'.$place['place'].'</td>';
				echo '<td>'.$state['name'].'</td>';
				echo '<td>'.$city['name'].'</td>';
				echo '<td>
						<a class="btn btn-default btn-xs btn-alt pull-right" href="'.site_url("admin/settings/edit_place/".$place['id']).'"><i class="icol-pencil"></i></a>
					  </td>';
				echo '</tr>';
			}
		}
		echo '</tbody></table>';
	}
	//=============================
	//===Location==================
	public function cityList($st=false){
		if($st){
			$cities = $this->default_m->getCity($st);
			if($cities){
				foreach($cities as $city){
					echo '<option value="'.$city['id'].'">'.$city['name'].'</option>';
				}
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	//=============================
}
