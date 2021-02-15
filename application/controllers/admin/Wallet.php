<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wallet extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("user_m");
		$this->load->model("plan_m");
		$this->load->model("wallet_m");
		$this->load->model('enquiry_m');

		if(!$this->session->userdata("login")){
			delete_cookie("loginIn");
			redirect("main");
		}
		$userType = $this->default_m->getUserType();
		if($userType){
			foreach($userType as $usrtyp){
				$txt = $usrtyp['term'];
				define($txt,$usrtyp['id']);
			}
		}
	}
	public function account(){
		$data['page_title'] = "Wallet Account";
		$data['tech_plan'] = $this->plan_m->get_technician_plan(false,$this->session->userdata('id'));
		$this->load->view($this->config->item("backend_path").'header',$data);
		$this->load->view('admin/wallet/index',$data);
		$this->load->view($this->config->item("backend_path").'footer',$data);
	}
}