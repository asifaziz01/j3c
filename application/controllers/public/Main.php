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
		$data['page_title'] = "Home";
        $data['slider'] = true;
		$this->load->view($this->config->item("template_path").'header',$data);
		$this->load->view('public/index',$data);
		$this->load->view($this->config->item("template_path").'footer',$data);
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
	public function issueForm($cid=false,$apid=false){
		$data['page_title']='Issue Form';
		$data['no_banner']=true;
		$data['cid'] = $cid;
		$data['apid'] = $apid;
		$this->load->view ($this->config->item("template_path") . 'header', $data);
        $this->load->view ('public/issueForm', $data);
        $this->load->view ($this->config->item("template_path") . 'footer', $data);
	}
	public function enquiryBox(){
        $data['page_title'] = 'Enquiry';
		$data['no_banner']=true;
		$this->load->view ($this->config->item("template_path") . 'header', $data);
        $this->load->view ('public/enquiryBox', $data);
        $this->load->view ($this->config->item("template_path") . 'footer', $data);
	}
	public function finalCheckout(){
        $data['page_title'] = 'Final Checkout';
		$data['no_banner']=true;
		$this->load->view ($this->config->item("template_path") . 'header', $data);
        $this->load->view ('public/finalCheckout', $data);
        $this->load->view ($this->config->item("template_path") . 'footer', $data);
	}
	public function appOptions($id=false){
		if($id){
			$appliance = $this->appliance_m->get_appliances ($id);
			if($appliance){
				echo '<option value="">Select Appliance</option>';
				foreach($appliance as $app){
					echo '<option value="'.$app['appliance_id'].'">'.$app['appliance_name'].'</option>';
				}
			}
		}
	}
	public function createOptions($field=false,$id=false){
		if($field){
			switch ($field){
				case 'brand':
					$brands = $this->appliance_m->get_brands ($id);
					if($brands){
						echo '<option value="">Select Brand</option>';
						foreach($brands as $brand){
							echo '<option value="'.$brand['brand_id'].'">'.$brand['brand_name'].'</option>';
						}
					}
				break;
				case 'type':
					$types = $this->appliance_m->get_appliance_types ($id);
					if($types){
						echo '<option value="">Select Type</option>';
						foreach($types as $type){
							echo '<option value="'.$type['type_id'].'">'.$type['type_name'].'</option>';
						}
					}
				break;
				case 'issue':
					$issues = $this->appliance_m->get_issues ($id);
					if($issues){
						echo '<option value="">Select Issue</option>';
						foreach($issues as $issue){
							echo '<option value="'.$issue['issue_id'].'" >'.$issue['issue_title'].'</option>';
						}
					}
				break;
			}
		}
	}
	public function myBooking(){
        $data['page_title'] = 'My Booking';
		$data['enquiries'] = $this->enquiry_m->get_enquiries(false,array('customer_id'=>$this->session->userdata('id')));
		$this->load->view ($this->config->item("template_path") . 'header', $data);
        $this->load->view ('public/myBooking', $data);
        $this->load->view ($this->config->item("template_path") . 'footer', $data);
	}
	public function details($enc_id=false){
		$data['enc_id']=$enc_id;
		$data['enc'] = $this->enquiry_m->get_enquiries($enc_id);
		$data['page_title'] = 'Enquiry Details';
        $this->load->view ($this->config->item('template_path') . 'header', $data);
        $this->load->view ('public/details', $data);
        $this->load->view ($this->config->item('template_path') . 'footer');
	}
	public function search () {
        $this->form_validation->set_rules("customer_name","Customer Name","required");
        $this->form_validation->set_rules("mobile","Mobile","required");
        $this->form_validation->set_rules("location","Location","required");
        $this->form_validation->set_rules("map_location","Map Location","required");
        $this->form_validation->set_rules("address","Address","required");
        if($this->form_validation->run()==true){
            $user = $this->user_m->getUser(false,array("phone"=>$this->input->post('mobile')));
            $data['technicians'] = $technicians = $this->user_m->get_technicians ($this->input->post('appliance'),$this->input->post('location'));
            if(!$user){
                $pass = $this->default_m->genrateUniquiId(time(),6);
                $id = $this->user_m->saveCustomerInfo($pass);
                $user = $this->user_m->getUser($id);
                $mobile = $user['phone'];
                $message = 'You are register on just3click.com'.PHP_EOL.'Your id - '.$user['username'].PHP_EOL.'Password - '.$pass.PHP_EOL. 'Service Provider contact you soon. Thank You.';
                $res = $this->sms->send($mobile,$message);
            }else{
                $user = ($user)?$user[0]:false;
                $id = $user['id'];
                $mobile = $user['phone'];
                $message = 'You are already registered on just3click.com'.PHP_EOL. 'Service Provider contact you soon. Thank You.';
                $res = $this->sms->send($mobile,$message);
            }
            $_POST['items'] = $_COOKIE['just3clickItems'];
            $items = explode(",",$_POST['items']);
            $qty=false;$_POST['qty']='';
            if($items){
                foreach($items as $item){
                    $qty[] = 1;//$_POST['qty_'.$item];
                }
                $_POST['qty'] = implode(",",$qty);
            }
            $this->enquiry_m->save_enquiry($id);
            delete_cookie('just3click_cart');
            delete_cookie('just3clickItems');

            if($technicians){
                $contacts=false;
                foreach($technicians as $tech){
                    $contacts[]=$tech['phone'];
                }
                //print_r($contacts);exit;
                if($contacts){
                    $contacts = implode(",",$contacts);
                    $message = 'One query submited from your location from '.$user['name'].', check your customer query list.';
                    $res = $this->sms->send($contacts,$message);
                }
            }
            if ($remember == 1) {				
                setcookie('remember', md5($row->username), time()+12*3600, '/');
            }
            $this->session->set_userdata( array(
                            'login'			=> $user['username'],
                            'id'			=> $user['id'],
                            'name'			=> $user['name'],
                            'email'			=> $user['email'],
                            'role_id'		=> $user['status'],
                            'status'		=> $user['status'],
                            'isLoggedIn'	=> true
                            ));
            
            $this->message->set("Successfully signed in.","success", true);
			$this->session->set_userdata("group_id",$user['status']);
            redirect('public/main/myBooking/');
        }
        //$this->load->view (INCLUDE_PATH . 'header', $data);
        //$this->load->view ('public/services/enquiryConfirm', $data);
        //$this->load->view (INCLUDE_PATH . 'footer', $data);
        /*$data['page_title'] = 'Search Result';
		$this->load->view (INCLUDE_PATH . 'header', $data);
        $this->load->view ('public/services/search', $data);
        $this->load->view (INCLUDE_PATH . 'footer', $data);*/
	}
	public function reviews(){
        $data['page_title'] = 'Feedback';
		$data['feedback'] = $this->main_m->getFeedback(false,array('mobile'=>$this->session->userdata('login')));
		$this->load->view ($this->config->item("template_path") . 'header', $data);
        $this->load->view ('public/reviews', $data);
        $this->load->view ($this->config->item("template_path") . 'footer', $data);
	}
	public function add_feedback(){
		if(!$this->session->userdata('id')){
			$this->form_validation->set_rules('cname', 'Name', 'required');
			$this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric');
			$this->form_validation->set_rules('email', 'Email', 'required');
		}
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('message', 'Message', 'required');
		
		if ($this->form_validation->run() == true)  {
			$this->main_m->addFeedback();
			redirect("public/main/reviews");
		}
		$data['page_title']="Feedback";
		$this->load->view($this->config->item('template_path') . 'header', $data);
		$this->load->view('public/newFeedback');
		$this->load->view($this->config->item('template_path') . 'footer', $data);
	}
	public function deleteFeedback($id=false){
		if($id){
			$this->main_m->deleteFeedback($id);
			$this->message->set("feedback delete successfully!","success",true);
		}
		redirect('public/main/reviews');
	}
}