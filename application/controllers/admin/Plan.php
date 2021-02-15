<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Plan extends CI_Controller {
	
	var $toolbar_buttons = [];
	
	public function __construct () {
		parent::__construct();
		$this->load->model('user_m');
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
	
	public function index () {
		
		$data['plans'] = $this->plan_m->get_plan ();
		$data['page_title'] = 'Plan Manager';
		
		$this->load->view ($this->config->item('backend_path') . 'header', $data);
		$this->load->view ('admin/plan/index', $data);
		$this->load->view ($this->config->item('backend_path') . 'footer', $data);		
	}
	public function create_plan () {
		$this->form_validation->set_rules("title","Plan Title","required");
		$this->form_validation->set_rules("amount","Plan Amount","required|numeric");
		$this->form_validation->set_rules("hour","Plan Hour","required|numeric");
		if($this->form_validation->run()==true){
			$this->plan_model->create_plan();
			redirect('admin/plan/index');
		}
		$data['page_title'] = 'Create Plan';
		
		$this->load->view ($this->config->item('backend_path') . 'header', $data);
		$this->load->view ('admin/plan/create_plan', $data);
		$this->load->view ($this->config->item('backend_path') . 'footer', $data);		
	}
	public function edit_plan ($id) {
		$this->form_validation->set_rules("title","Plan Title","required");
		$this->form_validation->set_rules("amount","Plan Amount","required|numeric");
		$this->form_validation->set_rules("hour","Plan Hour","required|numeric");
		if($this->form_validation->run()==true){
			$this->plan_model->create_plan($id);
			redirect('admin/plan/index');
		}

		$data['id'] = $id;
		$data['page_title'] = 'Update Plan';
		$data['plan'] = $this->plan_m->get_plan($id);
		$this->load->view ($this->config->item('backend_path') . 'header', $data);
		$this->load->view ('admin/plan/edit_plan', $data);
		$this->load->view ($this->config->item('backend_path') . 'footer', $data);		
	}
	public function recharge_plan ($id=0) {
		$this->form_validation->set_rules("plan","Select Plan","required");
		if($this->form_validation->run()==true){
			$this->plan_m->setTechnicianPlan();
			$this->message->set('Recharge plan success!','success',true);
			redirect('admin/plan/recharge_plan/'.$id);
		}
		$data['id'] = $id;
		$data['technician'] = $this->user_m->getUser($id);
		$data['page_title'] = 'Recharge Plan for Technician';
		$this->load->view ($this->config->item('backend_path') . 'header', $data);
		$this->load->view ('admin/plan/recharge_plan', $data);
		$this->load->view ($this->config->item('backend_path') . 'footer', $data);		
	    
	}
}