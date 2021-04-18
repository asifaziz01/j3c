<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Enquiries extends CI_Controller {
	
	var $toolbar_buttons = [];
	
	public function __construct () {
		parent::__construct();
		$this->load->model('user_m');
		$this->load->model("plan_m");
		$this->load->model("enquiry_m");
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
		$data['enquiries'] = $this->enquiry_m->get_enquiries();
		$data['page_title'] = 'List of Enquiries';

		$this->load->view ($this->config->item('backend_path') . 'header', $data);
		if($this->session->userdata('status')==STATUS_CUSTOMER){
			$this->load->view ('admin/enquiries/index', $data);
		}else{
			$this->load->view ('admin/enquiries/enquiries', $data);
		}
        $this->load->view ($this->config->item('backend_path') . 'footer');
	}
	public function history () {
		if($this->session->userdata('status')==STATUS_TECHNICIAN){
			$data['page_title'] = 'Job History';
			$clause = array('technician_id'=>$this->session->userdata('id'),'close_date !='=>'');
		}else if($this->session->userdata('status')==STATUS_CUSTOMER){
			$data['page_title'] = 'Enquiry History';
			$clause = array('customer_id'=>$this->session->userdata('id'),'close_date !='=>'');
		}
		$data['enquiries'] = $this->enquiry_m->get_enquiries(false,$clause);

        $this->load->view ($this->config->item('backend_path') . 'header', $data);
		$this->load->view ('admin/enquiries/history', $data);
        $this->load->view ($this->config->item('backend_path') . 'footer');
	}
	public function details($enc_id=false){
		$data['enc_id']=$enc_id;
		$data['enc'] = $this->enquiry_m->get_enquiries($enc_id);
		$data['page_title'] = 'Enquiry Details';
        $this->load->view ($this->config->item('backend_path') . 'header', $data);
        $this->load->view ('admin/enquiries/details', $data);
        $this->load->view ($this->config->item('backend_path') . 'footer');
	}
    public function service_enquiry ($appliance_id=0) {
        $this->form_validation->set_rules ('customer_name', 'Name', 'required');
        $this->form_validation->set_rules ('mobile', 'Mobile', 'required|numeric|min_length[10]|max_length[12]');
        $this->form_validation->set_rules ('otp', 'OTP', 'required|numeric|min_length[6]');
        if ($this->form_validation->run () == true) {
            $location = $this->input->post ('location');
            $this->enquiry_m->save_enquiry ($appliance_id);
            redirect ('admin/user/technicians/'.$appliance_id.'/'.$location);
        } else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));
        }
    }
	public function job_done($eid=false){
		$data['page_title'] = 'Job Done';
		$this->load->view($this->config->item('backend_path').'header',$data);
		$this->load->view('admin/enquiries/job_done',$data);
		$this->load->view($this->config->item('backend_path').'footer',$data);
	}
	public function jobClose ($eid=false) {
		$this->form_validation->set_rules("otp","OTP","required");
		if($this->form_validation->run()==true){
			$enquiry = $this->enquiry_m->get_enquiries($eid);
			if($enquiry['job_otp']==$this->input->post('otp')){
				$this->enquiry_m->jobClose();
				$this->message->set("Job close successfully!","success",true);
				redirect("admin/enquiries/index");
			}else{
				$this->message->set("OTP Not Match! Please try again.","danger",true);
				redirect("admin/enquiries/jobClose/".$eid);
			}
		}
		$data['page_title'] = 'OTP Confirmation for Job done';
		$data['eid']=$eid;
		$data['enquiry'] = $this->enquiry_m->get_enquiries($eid);
		$this->load->view ($this->config->item('backend_path') . 'header', $data);
		$this->load->view ('admin/enquiries/jobClose', $data);
		$this->load->view ($this->config->item('backend_path') . 'footer', $data);		
	}
	public function jobDiliver ($eid=false) {
		$this->form_validation->set_rules("otp","OTP","required");
		if($this->form_validation->run()==true){
			$enquiry = $this->enquiry_m->get_enquiries($eid);
			if($enquiry['job_otp']==$this->input->post('otp')){
				$this->enquiry_m->jobClose();
				$this->message->set("Job close successfully!","success",true);
				redirect("admin/enquiries/index");
			}else{
				$this->message->set("OTP Not Match! Please try again.","danger",true);
				redirect("admin/enquiries/jobDiliver/".$eid);
			}
		}
		$data['page_title'] = 'OTP Confirmation for Job diliver';
		$data['eid']=$eid;
		$data['enquiry'] = $enquiry = $this->enquiry_m->get_enquiries($eid);
		$OTP = $this->default_m->genrateUniquiId(time().$enquiry['mobile'],6);
		$values = array("job_otp"=>$OTP);
		$this->enquiry_m->servicePick($values,array('id'=>$eid));
		$msg='Appliance dilivery OTP is '.$OTP.','.PHP_EOL.'keep these OTP safe & show your technician after service completion';
		$sms = $this->sms->send($enquiry['mobile'],$msg);

		$this->load->view ($this->config->item('backend_path') . 'header', $data);
		$this->load->view ('admin/enquiries/jobDiliver', $data);
		$this->load->view ($this->config->item('backend_path') . 'footer', $data);		
	}
	public function appRecieve ($eid=false) {
		$this->form_validation->set_rules("otp","OTP","required");
		$this->form_validation->set_rules("appDetail","Appliance Detail","required|trim");
		if($this->form_validation->run()==true){
			$enquiry = $this->enquiry_m->get_enquiries($eid);
			if($enquiry['recieve_otp']==$this->input->post('otp')){
				$values = array("recieved"=>1,"recieve_detail"=>$this->input->post('appDetail'),"recieve_app_image"=>(($_FILES['appImage']['name'])?str_replace(" ","_",$_FILES['appImage']['name']):''));
				$res = $this->enquiry_m->servicePick($values,array('id'=>$eid));
				if($res){
					if($_FILES['appImage']['name']){
						$config['upload_path']          = realpath($this->config->item('filemanager').'/content_image').'/';
						$config['allowed_types']        = 'gif|jpg|png';
						//$config['max_size']             = 150;
						$config['width']            	= 500;
						$config['file_name']            = $_FILES['appImage']['name'];
						$config['overwrite']            = true;
						$this->load->library('upload', $config);
						if ( ! $this->upload->do_upload('appImage'))
						{
							$this->message->set($this->upload->display_errors(),'danger',true);
						}else{
							$this->message->set('File Upload Successfully!','success',true);
						}
					}
				}
				$this->message->set("Job Recieved successfully!","success",true);
				redirect("admin/enquiries/index");
			}else{
				$this->message->set("OTP Not match! Please try again.","danger",true);
				redirect("admin/enquiries/appRecieve/".$eid);
			}
		}
		$data['page_title'] = 'Recieve Appliance from Customer';
		$data['eid']=$eid;
		$data['enquiry'] = $enquiry = $this->enquiry_m->get_enquiries($eid);
		$OTP = $this->default_m->genrateUniquiId(time().$enquiry['mobile'],6);
		$values = array("recieve_otp"=>$OTP);
		$this->enquiry_m->servicePick($values,array('id'=>$eid));
		$msg='Appliance recieve OTP is '.$OTP.','.PHP_EOL.'keep these OTP safe.';
		$sms = $this->sms->send($enquiry['mobile'],$msg);
		$this->load->view ($this->config->item('backend_path') . 'header', $data);
		$this->load->view ('admin/enquiries/appRecieve', $data);
		$this->load->view ($this->config->item('backend_path') . 'footer', $data);		
	}
	public function servicePick ($sid=false) {
		if($sid){
			$enquiry = $this->enquiry_m->get_enquiries($sid,array('status'=>0));
			$tech_appliance = $this->enquiry_m->getTechnicianAppliances($this->session->userdata('id'));
			$tech_plan = $this->enquiry_m->get_technician_plan(false,$this->session->userdata('id'));
			if($enquiry && in_array($enquiry['appliance_id'],$tech_appliance)){
				$technician = $this->user_m->getUser($this->session->userdata('id'));
				$OTP = ($tech_plan[count($tech_plan)-1]['plan_type']==1)?$this->default_m->genrateUniquiId(time().$enquiry['mobile'],6):'';
				$values = array('technician_id'=>$this->session->userdata('id'),'pick_date'=>time(),"job_otp"=>$OTP,'status'=>1);
				$res = $this->enquiry_m->servicePick($values,array('id'=>$sid));
				if($res){
					if($tech_plan[count($tech_plan)-1]['plan_type']==2){
						$msg='Your job picked by '.$technician['name'].PHP_EOL.', cal at '.$technician['phone'];
					}else{
						$msg='Your OTP is '.$OTP.','.PHP_EOL.'keep these OTP safe until contact with the service provider'.PHP_EOL.' or cal to '.$technician['phone'];
					}
					$sms = $this->sms->send($enquiry['mobile'],$msg);
					$this->message->set("Action completed successfully! please contact to customer and get service OTP by customer within 24 hour till your service is blocked by system. You will not able to pick other customer service.","success",true);
				}
			}else{
				$this->message->set("Invalid Functionality, Please try by system.","danger",true);
			}
		}
		redirect('admin/enquiries/index');
	}
	public function issueRegister(){
		$data['page_title'] = 'Register New Issue';
		$this->load->view ($this->config->item('backend_path') . 'header', $data);
		$this->load->view ('admin/enquiries/newIssue', $data);
		$this->load->view ($this->config->item('backend_path') . 'footer', $data);		
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
	public function appliances_options($cid=false){
		$appliances = $this->appliance_m->get_appliances($cid);
		if($appliances){
			echo '<option value=""> Select Appliance</option>';
			foreach($appliances as $aplnc){
				echo '<option value="'.$aplnc['appliance_id'].'"> '.$aplnc['appliance_name'].'</option>';
			}
		}
	}
	public function issueInfo($id=false){
		if($id){
			$issue = $this->appliance_m->get_issues(false,$id);
			if($issue){
				echo '<span style="color:red;">*</span> <small>'.$issue['description'].'</small>';
			}
		}
	}
	public function selectedIssuesList(){
		$totalprice=0;$totaloffer=0;$price='';$totalpaid=0;$discount=0;
		if(!empty($_COOKIE['just3click_cart'])){
			$orders = $_COOKIE['just3clickItems'];
			$orders = explode(',',$orders);
			$aplnc = false;
			if($orders){
				$sr=1;
				foreach($orders as $ordr){
					$ord = explode('-',$ordr);
					$aplnc[] = $ord[0];
					$appliance = $this->appliance_m->get_appliance($ord[0]);
					$brand = $this->appliance_m->get_brands(false,$ord[1]);
					$type = $this->appliance_m->get_appliance_types(false,$ord[2]);
					$issue = $this->appliance_m->get_issues(false,$ord[3]);
					$price .= (($issue['offer_price'])?$issue['offer_price']:$issue['price']).',';
					$totalprice +=$issue['price'];
					$totaloffer +=$issue['offer_price'];
					$discount +=($issue['offer_price'])?($issue['price']-$issue['offer_price']):0;
					echo '<tr>';
					echo '<td>'.$sr++.'</td>';
					echo '<td>'.$appliance['appliance_name'].'</td>';
					echo '<td>'.$brand['brand_name'].'</td>';
					echo '<td>'.$type['type_name'].'</td>';
					echo '<td>'.$issue['issue_title'].'</td>';
					echo '<td>'.((($issue['offer_price'])?$issue['offer_price']:$issue['price'])).'</td>';
					echo '<td><a class="btn btn-danger btn-xs" href="javascript:void(0);" onclick=deleteCartItem("'.$ordr.'") ><i class="icon-trash"></i></a></td>';
					echo '</tr>';
				}
				$totalpaid = ($discount)?($totalprice-$discount):$totalprice;
			}
			if($aplnc){
				echo '<input type="hidden" name="items_price" value="'.$price.'" />
				<input type="hidden" name="appliance" value="'.implode(",",array_unique($aplnc)).'" >';
			}
		}
	}
}