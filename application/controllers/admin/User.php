<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("user_m");
		$this->load->model("main_m");
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
	public function index(){
		$data['page_title'] = "Users";
		$this->load->view($this->config->item("backend_path").'header',$data);
		$this->load->view('admin/users/index',$data);
		$this->load->view($this->config->item("backend_path").'footer',$data);
	}
	public function create_user(){
		$this->form_validation->set_rules("email","Email","required");
		$this->form_validation->set_rules("password","Password","required");
		$this->form_validation->set_rules("repassword","Re-Password","required|matches[password]");
		$this->form_validation->set_rules("uname","Name","required");
		$this->form_validation->set_rules("gender","Gender","required");
		$this->form_validation->set_rules("mobile","Mobile","required");
		$this->form_validation->set_rules("address","Address","required|htmlentities");
		if($this->form_validation->run()==true){
			$id = $this->user_m->create_user();
			if($_POST['profile_pic'] && $id){
				$this->addProfilePic($id,$_POST['profile_pic']);
			}
			$user = $this->user_m->getUser($id);
			$message = 'Congrats!'.PHP_EOL.'you are successfully registered with Just3click'.PHP_EOL.'Your User Id - '.$user['username'].PHP_EOL.'Password - '.$user['temp'].PHP_EOL.'please visit at www.Just3click.com';
			$this->sms->send($user['phone'], $message);
			$this->message->set("User registration successfull!","success",true);
			if($user['status']==STATUS_TECHNICIAN){
				redirect("admin/user/edit_user/".$id);
			}else{
				redirect("admin/user/index/".$id);
			}
		}
		$data['page_title'] = "New User";
		$this->load->view($this->config->item("backend_path").'header',$data);
		$this->load->view('admin/users/new_user',$data);
		$this->load->view($this->config->item("backend_path").'footer',$data);
	}
	
	public function edit_user($id=false){
		$this->form_validation->set_rules("email","Email","required");
		$this->form_validation->set_rules("uname","Name","required");
		$this->form_validation->set_rules("gender","Gender","required");
		$this->form_validation->set_rules("mobile","Mobile","required");
		$this->form_validation->set_rules("address","Address","required");
		$this->form_validation->set_rules("adhaar","Adhaar","required");
		$this->form_validation->set_rules("pan","Pan Number","required");
		if($this->form_validation->run()==true){
			$this->user_m->create_user($id);
			if($_POST['profile_pic'] && $id){
				$this->addProfilePic($id,$_POST['profile_pic']);
			}
			$this->message->set("User registration successfull!","success",true);
			redirect("admin/user");
		}
		$data['page_title'] = "Edit User";
		$data['id'] = $id;
		$this->load->view($this->config->item("backend_path").'header',$data);
		$this->load->view('admin/users/edit_user',$data);
		$this->load->view($this->config->item("backend_path").'footer',$data);
	}
	
	public function user_detail($id=false){
		$data['page_title'] = "User Detail";
		$data['user'] = $this->user_m->getUser($id);
		$this->load->view($this->config->item("backend_path").'header',$data);
		$this->load->view('admin/users/user_detail',$data);
		$this->load->view($this->config->item("backend_path").'footer',$data);
	}
		//==== add Profile pic ========
	public function addProfilePic($uid=false,$img=false,$folder=false){
		//===== image uploading code ======
		$img = ($img)?$img:$_POST['profile_pic'];
		if($img){
			$img = str_replace("[removed]","", $img);
			$img = str_replace(' ', '+', $img);

			$user = $this->user_m->getUser($uid);
			$folderName = ($folder)?$folder:'profile_pic';
			$imgpath = realpath($this->config->item('filemanager').$folderName)."/";
			$imgname = 'user_'.$user['id'] . '.png';

			$source = fopen($img, 'r');
			$destination = fopen($imgpath.$imgname, 'w');
			
			if(stream_copy_to_stream($source, $destination)){
				$imgdata = array("uid"=>$uid,"filename"=>$imgname,"type"=>"image/png");
				$this->user_m->addProfilePic($uid,$imgdata);
				$this->message->set("Action Completed Successfully!","success", true);
			}else{
				$this->message->set("Image not upload!","danger", true);
			}
			
			fclose($source);
			fclose($destination);

			/*$img = str_replace('data:image/png;base64,', '', $img);
			$data = base64_decode($img);
			$imgname = $user['ABO'] . '.png';
			$file = $imgpath . $imgname;
			$success = file_put_contents($file, $data);*/
		}else{
			$this->message->set("Please Select an Image for profile picture!","danger", true);
		}
	}
	//================================//
	public function change_password(){
		$data['page_title'] = "Change password";
		$data['no_banner'] = true;
				
		$this->form_validation->set_rules('old_password', 'Old Password', 'required|trim');
		$this->form_validation->set_rules('new_password', 'New Password', 'alpha_numeric|min_length[6]|matches[confirm_password]|trim');
		$this->form_validation->set_rules('confirm_password', 'cofirm Password', 'required|alpha_numeric|min_length[6]|trim');
		if($this->form_validation->run()==true) {
			$user = $this->user_m->getUser($this->session->userdata('id'),array("password"=>md5($this->input->post('old_password'))));
			if($user){
				$this->user_m->change_password();
				$user = $this->default_m->getLoginDetail(false,$this->session->userdata('id'));
				if($user){
					if($user['phone']){
						$mobile = $user['phone'];
						$message = 'Your Login ID is '.$user['username'].' & Password is '.$user['temp'];
						$this->sms->send($user['phone'], $message);
						$this->message->set($message,'info',true);
					}else{
						$this->message->set('Mobile No not set for this user.','info',true);
					}
				}
				redirect("admin/main");
			}else{
				$this->message->set("Current Password Mis-match! Please try again.","danger",true);
				redirect("admin/user/change_password");
			}
		}
		
		$this->load->view($this->config->item("backend_path")."header", $data);
		$this->load->view("admin/change_password");
		$this->load->view($this->config->item("backend_path")."footer", $data);
	}
	public function changeUserPassword(){
		$this->form_validation->set_rules('password', 'New Password', 'alpha_numeric|min_length[6]|matches[repassword]|trim');
		$this->form_validation->set_rules('repassword', 'cofirm Password', 'required|alpha_numeric|min_length[6]|trim');
		if($this->form_validation->run()==true) {
			$user = $this->user_m->getUser($this->input->post('id'));
			if($user){
				$this->default_m->query("update ".TABLE_PREFIX."user set password='".md5($this->input->post('password'))."', temp='".$this->input->post('password')."' where id='".$this->input->post('id')."'",'insert');
				if($user){
					if($user['phone']){
						$mobile = $user['phone'];
						$message = 'Your password is changed by admin, your new password is '.$this->input->post('password');
						$this->sms->send($user['phone'], $message);
						$this->message->set($message,'info',true);
					}else{
						$this->message->set('Mobile No not set for this user.','info',true);
					}
				}
				redirect("admin/user");
			}
		}else{
			$this->message->set(validation_errors(),"danger",true);
			redirect("admin/user/edit_user/".$this->input->post('id'));
		}
	}
	public function profile(){
		$data['page_title'] = "View Profile";
		$data['no_banner'] = true;
		$data['profile'] = $this->user_m->getUser($this->session->userdata('id'));
		$this->load->view($this->config->item("backend_path")."header", $data);
		$this->load->view("admin/users/profile",$data);
		$this->load->view($this->config->item("backend_path")."footer", $data);
	}
	public function edit_profile(){
		$id = $this->session->userdata('id');
		$this->form_validation->set_rules("uname","Name","required");
		$this->form_validation->set_rules("gender","Gender","required");
		$this->form_validation->set_rules("address","Address","required");
		if($this->form_validation->run()==true){
			$this->user_m->create_user($id);
			if($_POST['profile_pic'] && $id){
				$this->addProfilePic($id,$_POST['profile_pic']);
			}
			$this->message->set("User registration successfull!","success",true);
			redirect("admin/user/profile");
		}
		$data['page_title'] = "Edit Profile";
		$data['no_banner'] = true;
		$data['profile'] = $this->user_m->getUser($id);
		$this->load->view($this->config->item("backend_path")."header", $data);
		$this->load->view("admin/users/edit_profile",$data);
		$this->load->view($this->config->item("backend_path")."footer", $data);
	}
	public function activateUser(){
		$this->form_validation->set_rules("uid","User Id","required");
		$this->form_validation->set_rules("pkg","Package","required");
		//$this->form_validation->set_rules("amount","Amount","required");
		if($this->form_validation->run()==true){
			$res = $this->user_m->activateUser();
			if($res){
				$this->business->directIncomeDistribute($this->input->post('uid'));
				$user = $this->default_m->getUserByABO($this->input->post('uid'));
				$pkg = $this->product_m->products($this->input->post("pkg"),PKG);
				$mobile = $user['phone'];
				$message = 'Your account activat with '.$pkg['name'].'('.$pkg['mrp'].') now its time to lets start your business.';
				$this->sms->send($user['phone'], $message);
				$this->message->set("User Activate Successfully!","success",true);
				redirect("admin/main");
			}
		}
		$data['page_title'] = "Activate User";
		$data['no_banner'] = true;
		$this->load->view($this->config->item("backend_path")."header", $data);
		$this->load->view("admin/users/activateUser",$data);
		$this->load->view($this->config->item("backend_path")."footer", $data);
	}
	// Technician functions========
	public function add_category () {
		$this->form_validation->set_rules ('title', 'Title', 'required|trim');
		if ($this->form_validation->run () == true) {
			$skill = $this->user_m->add_category ();
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>true, 'message'=>'Category added', 'redirect'=>site_url('admin/technicians/categories') )));
		} else {
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode(array('status'=>false, 'error'=>validation_errors() )));			
		}
	}
	
	public function add_skills ($id=0) {
		$this->form_validation->set_rules ('skill_name', 'Skill Name', 'required|trim');
		if ($this->form_validation->run () == true) {
			$sid = $this->user_m->save_skill ($id);
			$skill = $this->user_m->get_skills(false,$sid);
			$url = site_url('admin/user/delete_skill/'.$id.'/'.$skill['id']);
			echo '<span class="badge badge-info ml-2 mb-2 ">'.$skill['title'].' <a href="javascript:void(0)" class="btn btn-xs btn-danger" onclick="showConfirm(\''.$url.'\',\'Are you sure want delete '.$skill['title'].'\')">X</a></span>&nbsp;&nbsp;';
		}
	}

    public function delete_category ($id=0) {
        $this->technicians_model->delete_category ($id);
		$this->message->set ('Category deleted successfully', 'success', true);
        redirect ('admin/technicians/categories');
    }

    public function delete_skill ($technician_id=0, $id=0) {
        $this->user_m->delete_skill ($id);
		$this->message->set ('Skill deleted successfully', 'success', true);
		$url = explode('/',$_SERVER['HTTP_REFERER']);
		$redir = $url[(count($url)-4)].'/'.$url[(count($url)-3)].'/'.$url[(count($url)-2)];
		redirect ($redir.'/'.$technician_id);
    }
	public function techDetail($tid=false){
		$data['user'] = $this->user_m->getUser($tid);
		$this->load->view('admin/users/techDetail',$data);
	}
	public function verifyTechnician(){
		$this->form_validation->set_rules("tid","Technician Id","required");
		if($this->form_validation->run()==true){
			$res = $this->user_m->verifyTechnician();
			if($res){
				$user = $this->user_m->getUser($this->input->post('tid'));
				$mobile = $user['phone'];
				$message = 'Your varification completed. You are in verified Technician list';
				$this->sms->send($user['phone'], $message);
				$this->message->set("User Verification Successfully!","success",true);
			}
			redirect("admin/user/verifyTechnician");
		}
		$data['page_title'] = "verify Technician";
		$data['technicians'] = $this->user_m->getUser(false,array('status'=>STATUS_TECHNICIAN));
		$this->load->view($this->config->item("backend_path")."header", $data);
		$this->load->view("admin/users/technicianList",$data);
		$this->load->view($this->config->item("backend_path")."footer", $data);
	}
	public function feedBack(){
		/*$this->form_validation->set_rules("tid","Technician Id","required");
		if($this->form_validation->run()==true){
			$res = $this->user_m->verifyTechnician();
			if($res){
				$user = $this->user_m->getUser($this->input->post('tid'));
				$mobile = $user['phone'];
				$message = 'Your varification completed. You are in verified Technician list';
				$this->sms->send($user['phone'], $message);
				$this->message->set("User Verification Successfully!","success",true);
			}
			redirect("admin/user/verifyTechnician");
		}*/
		$data['page_title'] = "Feedback";
		$data['feedback'] = $this->user_m->getFeedback();
		$this->load->view($this->config->item("backend_path")."header", $data);
		$this->load->view("admin/feedback/index",$data);
		$this->load->view($this->config->item("backend_path")."footer", $data);
	}
	public function staff_posts($id=false){
		$this->form_validation->set_rules('title','Post Title','required');
		$this->form_validation->set_rules('mnu[]','Previliges','required');
		if($this->form_validation->run()==true){
			$this->user_m->createStaffPost($id);
			$this->message->set('Action completed successfully!','success',true);
			redirect('admin/user/staff_posts');
		}
		$data['id'] = $id;
		$data['post'] = ($id)?$this->user_m->getStaffPost($id):false;
		$data['page_title'] = "Staff Posts";
		$data['posts'] = $this->user_m->getStaffPost();
		$this->load->view($this->config->item("backend_path")."header", $data);
		$this->load->view("admin/users/staffPosts",$data);
		$this->load->view($this->config->item("backend_path")."footer", $data);
	}
	public function delete_posts($id=false){
		if($id){
			$this->user_m->delete_post($id);
			$this->message->set('Action completed successfully!','success',true);
		}else{
			$this->message->set('Action unsuccessfull!','danger',true);
		}
		redirect('admin/user/staff_posts');
	}
	public function update_post($pid=false,$uid=false){
		if($pid && $uid){
			$this->user_m->update_post($pid,$uid);
			return true;
		}else{
			return false;
		}
	}
	public function feedbackVerify($id=false){
		if($id){
			$this->user_m->feedbackVerify($id);
			echo 1;
		}else{
			echo false;
		}
	}
}