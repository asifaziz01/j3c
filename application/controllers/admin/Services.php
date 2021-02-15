<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {
	public function __construct () {
        parent::__construct();
        $this->load->model("enquiry_m");
        $this->load->model("user_m");
        $this->load->model("plan_m");
		if(!$this->session->userdata("login")){
			delete_cookie("loginIn");
			redirect('main');
		}
		$userType = $this->default_m->getUserType();
		if($userType){
			foreach($userType as $usrtyp){
				$txt = $usrtyp['term'];
				define($txt,$usrtyp['id']);
			}
		}
	}
	
	
	public function index ($category=false/*SERVICE_CATEGORY_APPLIANCES*/) {
	    $this->appliances ($category);
	}

	public function appliances ($category=false/*SERVICE_CATEGORY_APPLIANCES*/) {
		
		$data['appliances'] = $this->appliance_m->get_appliances ($category);
		
		$data['category'] = $category;
		$data['page_title'] = 'Appliances';
		
		$this->load->view ($this->config->item("backend_path") . 'header', $data);
		$this->load->view ('admin/services/appliances', $data);
		$this->load->view ($this->config->item("backend_path") . 'footer', $data);		
	}
	public function appliances_list($cid=false){
		$appliances = $this->appliance_m->get_appliances($cid);
		if($appliances){
			foreach($appliances as $aplnc){
				echo '<div class="col-md-6 col-sm-6 col-xs-6">
					  	<input type="checkbox" name="aplncs[]" value="'.$aplnc['appliance_id'].'" /> '.$aplnc['appliance_name'].'
				      </div>';
			}
		}
	}
	public function appliances_options($cid=false){
		$appliances = $this->appliance_m->get_appliances($cid);
		if($appliances){
			echo '<option value=""> Select Appliance</option>';
			foreach($appliances as $aplnc){
				echo '<option value="'.$aplnc['appliance_id'].'"> '.$aplnc['appliance_name'].'</option>';
			}
		}
	}
	public function create_category(){
		$this->form_validation->set_rules("title","Category Title","required");
		$this->form_validation->set_rules("iconname","Icon","required");
		if($this->form_validation->run()==true){
			$this->appliance_m->create_category();
			$this->message->set("Category create successfully!","success", true);
			redirect('admin/services/applianceCategory');
		}
		$data['page_title'] = 'Create Category';
		$this->load->view ($this->config->item("backend_path") . 'header', $data);
		$this->load->view ('admin/services/create_category', $data);
		$this->load->view ($this->config->item("backend_path") . 'footer', $data);		
	}
	public function applianceCategory(){
		$data['page_title'] = 'Appliance Category';
		$data['cats'] = $this->appliance_m->get_categories();
		$this->load->view ($this->config->item("backend_path") . 'header', $data);
		$this->load->view ('admin/services/appliance_category', $data);
		$this->load->view ($this->config->item("backend_path") . 'footer', $data);		
	}
	public function update_category($cid=false,$uid=false){
		$qry = 'UPDATE '.TABLE_PREFIX.'user set category_id='.$cid.' WHERE id='.$uid;
		$res = $this->appliance_m->query($qry);
	}
	public function changeTechAppliances($tid=false,$aid=false,$state=false){
		if($tid && $aid){
			$this->appliance_m->change_tech_appliance($tid,$aid,$state);
		}
	}
	public function changeTechLocation ($technician_id=0, $location_id=0, $state=0) {
		$this->appliance_m->change_tech_location ($technician_id, $location_id, $state);
	}

	public function add_appliance ($category=0,$appliance_id=0) {
		$this->form_validation->set_rules ('app_cat', 'Appliance Category', 'required|trim');
		$this->form_validation->set_rules ('appliance_name', 'Appliance Name', 'required|trim');
		$this->form_validation->set_rules ('service_type', 'Service Type', 'required|trim');
		if ($this->form_validation->run () == true) {
			if($_FILES['logo']['name']){
				$config['upload_path']          = realpath($this->config->item('template_path').'images/services-icons').'/';
				$config['allowed_types']        = 'gif|jpg|png';
				$config['max_size']             = 100;
				$config['max_width']            = 800;
				$config['max_height']           = 800;
				$config['file_name']            = $_FILES['logo']['name'];
				$config['overwrite']            = true;
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('logo'))
				{
					$this->message->set($this->upload->display_errors(),'danger',true);
				}else{
					$this->message->set('File Upload Successfully!','success',true);
				}
			}
			/*if($_FILES['img']['name']){
				$config['upload_path']          = base_url($this->config->item('filemanager').'content_image/');
				$config['allowed_types']        = 'gif|jpg|png';
				$config['max_width']            = 800;
				$config['max_height']           = 800;
				$config['file_name']            = $_FILES['img']['name'];
				$config['overwrite']            = true;
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('img'))
				{
					$this->message->set($this->upload->display_errors(),'danger',true);
				}else{
					$this->message->set($this->upload->display_errors(),'danger',true);
				}
			}*/
			$appliance_id = $this->appliance_m->save_appliance ($this->input->post('app_cat'), $appliance_id);
			$this->message->set('Update successfully!','success',true);
			redirect('admin/services/appliances');
		}
		$data['cid'] = $category;
		$data['category'] 	  = $this->appliance_m->get_categories ();//$category;
		$data['page_title'] = 'Create New Appliance';

		$this->load->view ($this->config->item("backend_path") . 'header', $data);
		$this->load->view ('admin/services/new_appliance', $data);
		$this->load->view ($this->config->item("backend_path") . 'footer', $data);		
	}
	public function edit_appliance ($category=0,$appliance_id=0) {
		$this->form_validation->set_rules ('app_cat', 'Appliance Category', 'required|trim');
		$this->form_validation->set_rules ('appliance_name', 'Appliance Name', 'required|trim');
		$this->form_validation->set_rules ('service_type', 'Service Type', 'required|trim');
		if ($this->form_validation->run () == true) {
			if($_FILES['logo']['name']){
				$config['upload_path']          = realpath(($this->config->item('template_path').'images/services-icons'))."/";
				$config['allowed_types']        = 'gif|jpg|png';
				$config['max_size']             = 100;
				$config['max_width']            = 800;
				$config['max_height']           = 800;
				$config['file_name']            = $_FILES['logo']['name'];
				$config['overwrite']            = true;
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('logo'))
				{
					$this->message->set($this->upload->display_errors(),'danger',true);
				}else{
					$this->message->set('File Upload Successfully!','success',true);
				}
			}
			/*if($_FILES['img']['name']){
				echo $config['upload_path']          = base_url($this->config->item('filemanager').'content_image/');
				$config['allowed_types']        = 'gif|jpg|png';
				$config['max_width']            = 800;
				$config['max_height']           = 800;
				$config['file_name']            = $_FILES['img']['name'];
				$config['overwrite']            = true;
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('img'))
				{
					$this->message->set($this->upload->display_errors(),'danger',true);
				}else{
					$this->message->set($this->upload->display_errors(),'danger',true);
				}
			}*/
			$appliance_id = $this->appliance_m->save_appliance ($this->input->post('app_cat'), $appliance_id);
			$this->message->set('Update successfully!','success',true);
			redirect('admin/services/appliances');
		}				
		$data['appliance'] = $this->appliance_m->get_appliance ($appliance_id);
		$data['brands'] = $this->appliance_m->get_brands ($appliance_id);
		$data['issues'] = $this->appliance_m->get_issues ($appliance_id);
		$data['types']  = $this->appliance_m->get_appliance_types ($appliance_id);
		$data['logo']   = $this->appliance_m->get_appliance_logo ($appliance_id);
		$data['appliance_id'] = $appliance_id;
		$data['cid'] = $category;
		$data['category'] 	  = $this->appliance_m->get_categories ();//$category;
		$data['page_title'] = 'Update Appliance Details';

		$this->load->view ($this->config->item("backend_path") . 'header', $data);
		$this->load->view ('admin/services/edit_appliance', $data);
		$this->load->view ($this->config->item("backend_path") . 'footer', $data);		
	}
	public function appliance_Detail($app_id=false){
		$data['page_title'] = 'Appliance Details';
		$data['appliance'] = $this->appliance_m->get_appliance ($app_id);

		$this->load->view ($this->config->item("backend_path") . 'header', $data);
		$this->load->view ('admin/services/appliance_detail', $data);
		$this->load->view ($this->config->item("backend_path") . 'footer', $data);		
	}
	public function brand($bid=false,$appid=false){
		$this->form_validation->set_rules("app_cat","Appliance Category","required");
		$this->form_validation->set_rules("appliance","Appliance","required");
		$this->form_validation->set_rules("brand","Brand","required");
		if($this->form_validation->run()==true){
			$this->appliance_m->save_brand($bid);
			$this->message->set("New Brand create successfully!","success",true);
			redirect('admin/services/brand');
		}
		$data['page_title'] = 'Appliance Brand';
		$data['bid'] = $bid;
		$data['appid']=$appid;
		$data['category'] 	  = $this->appliance_m->get_categories ();//$category;
		$data['brand'] = $brand = $bid?$this->appliance_m->get_brands (false,$bid):false;
		$data['appliance'] = $bid?$this->appliance_m->get_appliance ($brand['appliance_id']):false;
		$this->load->view ($this->config->item("backend_path") . 'header', $data);
		$this->load->view ('admin/services/brand', $data);
		$this->load->view ($this->config->item("backend_path") . 'footer', $data);		
	}
	public function brand_options($appid=false){
		$brands = $this->appliance_m->get_brands($appid);
		if($brands){
			echo '<option value=""> Select Appliance</option>';
			foreach($brands as $brand){
				echo '<option value="'.$brand['brand_id'].'"> '.$brand['brand_name'].'</option>';
			}
		}
	}
	public function appliance_type($tid=false,$appid=false){
		$this->form_validation->set_rules("app_cat","Appliance Category","required");
		$this->form_validation->set_rules("appliance","Appliance","required");
		$this->form_validation->set_rules("type","Appliance Type","required");
		if($this->form_validation->run()==true){
			$this->appliance_m->save_appliance_type($tid);
			$this->message->set("New Type create successfully!","success",true);
			redirect('admin/services/appliance_type');
		}
		$data['page_title'] = 'Appliance Type';
		$data['tid'] = $tid;
		$data['appid']=$appid;
		$data['category'] 	  = $this->appliance_m->get_categories ();//$category;
		$data['type'] = $type = $appid?$this->appliance_m->get_appliance_types (false,$tid):false;
		$data['appliance'] = $appid?$this->appliance_m->get_appliance ($type['appliance_id']):false;
		$this->load->view ($this->config->item("backend_path") . 'header', $data);
		$this->load->view ('admin/services/appliance_type', $data);
		$this->load->view ($this->config->item("backend_path") . 'footer', $data);		
	}
	public function appliance_issue($isid=false,$appid=false){
		$this->form_validation->set_rules("app_cat","Appliance Category","required");
		$this->form_validation->set_rules("appliance","Appliance","required");
		$this->form_validation->set_rules("issue","Appliance Issue","required");
		if($this->form_validation->run()==true){
			$this->appliance_m->save_issue($isid);
			$this->message->set("New Issue create successfully!","success",true);
			redirect('admin/services/appliance_issue');
		}
		$data['page_title'] = 'Appliance Issue';
		$data['isid'] = $isid;
		$data['appid']=$appid;
		$data['category'] 	  = $this->appliance_m->get_categories ();//$category;
		$data['issue'] = $issue = $appid?$this->appliance_m->get_issues (false,$isid):false;
		$data['appliance'] = $appid?$this->appliance_m->get_appliance ($issue['appliance_id']):false;
		$this->load->view ($this->config->item("backend_path") . 'header', $data);
		$this->load->view ('admin/services/appliance_issue', $data);
		$this->load->view ($this->config->item("backend_path") . 'footer', $data);		
	}
	public function editIssue($isid=false){
		$issues = $this->services_model->get_issues (0,$isid);
		if($isid){
			echo '<input type="hidden" name="sel_issue" value="'.$isid.'">
			<input type="text" name="issue_title" value="'.$issues['issue_title'].'" class="form-control" id="issue_title" placeholder="Issue Title" autofocus="true">
			<br /><input type="text" name="issue_price" value="'.$issues['price'].'" class="form-control" id="issue_price" placeholder="Issue Price">
			<br /><input type="text" name="issue_offer" value="'.$issues['offer_price'].'" class="form-control" id="issue_offer" placeholder="Issue Offer Price">
			<br /><textarea name="issue_description" class="form-control" id="issue_description" placeholder="Issue Description">'.$issues['description'].'</textarea>';
		}
	}
	public function selfRecharge () {
		$this->form_validation->set_rules("plan","Select Plan","required");
		if($this->form_validation->run()==true){
			$this->plan_m->setTechnicianPlan();
			$this->message->set('Recharge plan success!','success',true);
			redirect('admin/plan/recharge_plan/'.$id);
		}
		$data['id'] = $id = $this->session->userdata('id');
		$data['technician'] = $this->user_m->getUser($id);
		$data['page_title'] = 'Self Recharge';
		$this->load->view ($this->config->item('backend_path') . 'header', $data);
		$this->load->view ('admin/plan/selfRecharge', $data);
		$this->load->view ($this->config->item('backend_path') . 'footer', $data);		
	}
}