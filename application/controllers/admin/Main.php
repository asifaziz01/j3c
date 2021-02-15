<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("user_m");
		$this->load->model("main_m");
		$this->load->model("wallet_m");
		$this->load->model("plan_m");
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
	public function index($userinfo=false){
		$data['page_title'] = "Dashboard";
		if($userinfo){$data['userinfo']=$userinfo;}
		$this->load->view($this->config->item("backend_path").'header',$data);
		$this->load->view('admin/dashboard',$data);
		$this->load->view($this->config->item("backend_path").'footer',$data);
	}
	public function sendSMS(){
		$message = 'Your Login Id - admin'.PHP_EOL.'Password - test1234';
		$this->sms->send('9795246784', $message);
	}
    public function sendOTP($mobile=false,$name=false){
        if($mobile && $name){
            $res = $this->sms->sendOTP($mobile,$name);
            echo $res?$res:false;
        }else{
            return false;
        }
    }
    public function verifyOTP($mobile=false,$val=false){
        if($mobile && $val){
            $res = $this->sms->verifyOTP($mobile,$val);
            echo $res?'OTP Verify!':false; 
        }else{
            return false;
        }
    }
}