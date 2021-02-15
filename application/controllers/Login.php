<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();			
		//$this->load->model ('admin_detail');
		$this->load->model ('login_m');
		$this->load->model ('user_m');
		//$this->load->library ('email');
		$userType = $this->default_m->getUserType();
		if($userType){
			foreach($userType as $usrtyp){
				$txt = $usrtyp['term'];
				define($txt,$usrtyp['id']);
			}
		}
	}


	public function checkLoginExist($value=false){
		if($value){
			$result = $this->login_m->checkLoginExist($value);
			return $result;	
		}else{
			return false;	
		}
	}
	
	public function msgcheckLogin($value=false){
		if($value){
			$res = $this->checkLoginExist($value);
			if($res){
				echo '<div class="alert alert-danger">User ID already Exist! Please try other user ID.</div>';	
			}else{
				echo '<div class="alert alert-success">You can carry on with this user ID.</div>';	
			}
		}else{
			echo '';	
		}
	}
	/* HOMEPAGE */
	public function index() {
		$data['page_title'] = 'Login';
		$data['no_banner'] = true;
		$this->load->view($this->config->item("template_path")."header", $data);
		$this->load->view('login', $data);
		$this->load->view($this->config->item("template_path")."footer", $data);
	}
	/* HOMEPAGE */
	public function administrator() {
		$data['page_title'] = 'Administration Login';
		$data['no_header'] = true;
		$this->load->view($this->config->item("template_path")."header", $data);
		$this->load->view('adminLogin', $data);
		$this->load->view($this->config->item("template_path")."footer", $data);
	}

	/* This function is called to display the login page */
	public function show_login( ) {
		//$data['page_title'] = 'Login';
		//$data['small_banner'] = true;
		//$this->load->view($this->config->item("template_path")."header", $data);
		$this->load->view('login_form');
		//$this->load->view($this->config->item("template_path")."footer", $data);
	}


	/* Function to Validate and Log-in the user */
	public function login_user($sts=false) {
		$data['no_banner'] = true;
		// Create an instance of the user model
		$this->form_validation->set_rules('login', 'Login', 'trim|required|htmlentities');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|htmlentities');
		
		// Ensure values exist for email and pass, and validate the user's credentials		 
		// If the user is valid, redirect to the main view		
		if ( $this->form_validation->run() == false )	{
			$data['page_title']="Login";
			$this->load->view($this->config->item('template_path') . 'header', $data);
			$this->load->view('login', $data);
			$this->load->view($this->config->item('template_path') . 'footer', $data);
		}else{
			
			// Grab the email and password from the form POST
			$login = $this->input->post('login');
			$pass  = $this->input->post('password');
			$pass  = md5($pass);
			
			// check if this is a member login
			//$status = $this->login_m->get_user_status ($email, $pass/*, $remember*/);
			//$remember  = $this->input->post('remember');

			// get user status (admin/ins/student)
			//$enabled = $this->login_m->get_user_status ($email, $pass, $remember, 2);	// get active status (enabled/disabled)
			$sts = STATUS_CUSTOMER.','.STATUS_TECHNICIAN;
			$status = $this->login_m->validate_user ($login, $pass, false, $sts);
			// this will validate if current user authentic to use resources
			if ($status==STATUS_TECHNICIAN) {
				$this->message->set("Successfully signed in.","success", true);
				redirect('admin/main');
			}else if ($status==STATUS_CUSTOMER) {
				$this->message->set("Successfully signed in.","success", true);
				redirect('public/main');
			}else{
				$this->message->set("Invalid Login/Password combination.","danger", true);
				redirect("login");
			}
		}
	}

	/* Function to Validate and Log-in the user */
	public function admin_login_user($sts=false) {
		$sts = (!$sts)?STATUS_CUSTOMER:$sts;
		$data['no_banner'] = true;
		// Create an instance of the user model
		$this->form_validation->set_rules('login', 'Login', 'trim|required|htmlentities');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|htmlentities');
		
		// Ensure values exist for email and pass, and validate the user's credentials		 
		// If the user is valid, redirect to the main view		
		if ( $this->form_validation->run() == false )	{
			$data['page_title']="Login";
			$this->load->view($this->config->item('template_path') . 'no-header', $data);
			$this->load->view('adminLogin', $data);
			$this->load->view($this->config->item('template_path') . 'no-footer', $data);
		}else{
			
			// Grab the email and password from the form POST
			$login = $this->input->post('login');
			$pass  = $this->input->post('password');
			$pass  = md5($pass);
			
			// check if this is a member login
			//$status = $this->login_m->get_user_status ($email, $pass/*, $remember*/);
			//$remember  = $this->input->post('remember');

			// get user status (admin/ins/student)
			//$enabled = $this->login_m->get_user_status ($email, $pass, $remember, 2);	// get active status (enabled/disabled)
			$sts = STATUS_SUPER.','.STATUS_ADMIN.','.STATUS_STAFF;
			$status = $this->login_m->validate_user ($login, $pass, false, $sts);
			// this will validate if current user authentic to use resources
			if ($status==STATUS_ADMIN || $status==STATUS_SUPER || $status==STATUS_STAFF) {
				$this->message->set("Successfully signed in.","success", true);
				redirect('admin/main');
			}else{
				$this->message->set("Invalid Login/Password combination.","danger", true);
				redirect("login/administrator");
			}
		}
	}

	
	public function confirm_email ($email="") {
		
		$this->load->helper('email');
		$email = urldecode ($email);
		$email = preg_replace ('/<at>/', '@', $email);
		
		if ($email == "") {
			$msg =  '<i class="icon-remove"></i>
				     <span class="text-danger">Enter your email-id registered with us.</span>';
		} else if ( valid_email ($email)) {
			if ($this->login_m->check_registered_email ($email) == true) {
				
				$this->load->library('email');
				$now = time();
				$hash = md5($email);
				
				$subject = 'Reset Password';
				$message = 'Reset your password. Click on the link to reset your password '	. site_url('login/reset_password/'.$hash.'/'.$now).'
							Note: This link is active only for next 30 minutes.';
				
				$from = $this->config->item ('contact_email');
				$to = $email;
				$this->email->from($from, $this->config->item ('site_name'));
				$this->email->to($to);

				$this->email->subject($subject);
				$this->email->message($message);

				$this->email->send();
		
				$msg = '<i class="icon-ok success-icon"></i>
					    <span>Great. We have sent you an email.</span>';
			} else {
				$msg =  '<i class="icon-remove"></i>
						 <span class="text-danger">Enter your email-id registered with us.</span>';
			}
		} else {
			$msg =  '<i class="icon-remove"></i>
				     <span class="text-danger">Enter a valid email-id.</span>';
		}
		
		echo $msg;
	}
	
	
	/*	CHECK IF USER ALREADY LOGGED
	*/
	public function is_logged_in ( ) {
		$redirect = uri_string();
		if ( $redirect == 'login/login_user' ) {
			$this->login_user ();
		} else {
			if ( $this->session->userdata('isLoggedIn') == true ) {
				// update login session 
				$username = $this->session->userdata('login'); 
				$userid = $this->session->userdata('status');
				$userdata = '';
				//$this->login_m->update_login_session ( $username, $userid, $userdata );
				//redirect ( site_url($redirect) );
			} else {
				$this->logout ();
			}
		}
	}
	
 
	public function logout ($noredirect=false) {
		/*if ($this->session->userdata('login')) {
			$this->login_m->remove_login_session ( $this->session->userdata('login') );
		}*/		
		//delete_cookie("user_group");
		delete_cookie("loginIn");
		$this->session->sess_destroy();
		if ( $noredirect == false) {
			redirect ('main');
		}
	}

	public function regForm($pin=false,$serial=false){
		if($pin && $serial){
			$data['pin'] = $pin;
			$data['serial'] = $serial;
			$pinValidate = $this->user_m->getUserPin(false,$pin,array('serial'=>$serial,'used'=>'0','transfer'=>'0'));
			if($pinValidate){
				$form = $this->load->view('register_form',$data,true);
				echo $form;
			}else{
				echo '<div class="alert alert-danger">Wrong Pin/Serial. Please Enter correct Pin & Serial No.</div>';
				echo '<div class="forom-group">
							<div class="col-md-3">Pin</div>
							<div class="col-md-9">
							  <input type="text" name="pin" class="form-control" value="" placeholder="Pin"/>
							</div>
						</div>
						<div class="clearfix"></div>
						<hr style="margin:5px 0 5px 0;">
						<div class="forom-group">
							<div class="col-md-3">Serial</div>
							<div class="col-md-9">
							  <input type="text" name="serial" class="form-control" value="" placeholder="Serial"/>
							</div>
						</div>';	
			}
		}else{
			echo '<div class="forom-group">
						<div class="col-md-3">Pin</div>
						<div class="col-md-9">
						  <input type="text" name="pin" class="form-control" value="" placeholder="Pin"/>
						</div>
					</div>
					<div class="clearfix"></div>
					<hr style="margin:5px 0 5px 0;">
					<div class="forom-group">
						<div class="col-md-3">Serial</div>
						<div class="col-md-9">
						  <input type="text" name="serial" class="form-control" value="" placeholder="Serial"/>
						</div>
					</div>';	
		}
	}
	public function registration($sponser=false) {
	
		$data['page_title'] = '';
		$data['no_banner'] = true;	
		//$this->form_validation->set_rules('login', 'Login', 'required|alpha_dash|min_length[5]|max_length[12]|is_unique[tm_members.login]|is_unique[tm_admins.login]|trim');
		
		$this->form_validation->set_rules("sponser","Sponser","required");
		$this->form_validation->set_rules("leg","Leg","required");
		$this->form_validation->set_rules("package","Package","required");
		$this->form_validation->set_rules("email","Email","required");
		$this->form_validation->set_rules("password","Password","required");
		$this->form_validation->set_rules("repassword","Re-Password","required|matches[password]");
		$this->form_validation->set_rules("uname","Name","required");
		$this->form_validation->set_rules("gender","Gender","required");
		$this->form_validation->set_rules("mobile","Mobile","required");
		$this->form_validation->set_rules("address","Address","required|htmlentities");
		if (($this->form_validation->run() == true))  {
			$id = $this->login_m->new_register();
			if($id){
				if($_POST['profile_pic']){
					$this->addProfilePic($id,$_POST['profile_pic']);
				}
			/*$this->email->from('no_reply@ismass.com', 'Administrator TMASS');  
				$this->email->to($this->input->post('email')); 
				$this->email->subject('Verification Mail');
				$this->email->message('Your Login Details: 
				Your Login Id:'.$this->input->post('login').'
				Your Password:'.$this->input->post('password'));	
				
				$this->email->send();	*/
				$user = $this->user_m->getUser($id);
				$message = 'Congrats!'.PHP_EOL.'you are successfully registered with Dream India'.PHP_EOL.'Your User Id - '.$user['username'].PHP_EOL.'Password - '.$user['temp'].PHP_EOL.'please visit at www.dreamindias.in';
				$this->sms->send($user['phone'], $message);
				$this->message->set('Your details have been successfully registered.', 'info', true );
			}
			redirect('login/index');
		}
		//$this->load->view($this->config->item('template_path') . 'header', $data);
		$this->load->view('registration', $data);
		//$this->load->view($this->config->item('template_path') . 'footer', $data);
	}
	public function addProfilePic($uid=false,$img=false,$folder=false){
			//===== image uploading code ======
			$img = ($img)?$img:$_POST['cropImg'];
			if($img){
				$img = str_replace("[removed]","", $img);
				$img = str_replace(' ', '+', $img);

				$user = $this->default_m->getLoginDetail(false,$uid);
				$folderName = ($folder)?$folder:'profile_pic';
				$imgpath = realpath($this->config->item('filemanager').$folderName)."/";
				$imgname = $user['ABO'] . '.png';

				$source = fopen($img, 'r');
				$destination = fopen($imgpath.$imgname, 'w');
				
				if(stream_copy_to_stream($source, $destination)){
					if(!$folder){
						$imgdata = array("uid"=>$uid,"filename"=>$imgname,"type"=>"image/png");
						$this->user_m->addProfilePic($uid,$imgdata);
					}
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
			}
	}
	public function change_password(){
		$data['page_title'] = "Change password";
		$data['no_banner'] = true;
				
		$this->form_validation->set_rules('old_password', 'Old Password', 'required|trim');
		$this->form_validation->set_rules('new_password', 'New Password', 'alpha_numeric|min_length[6]|matches[confirm_password]|trim');
		$this->form_validation->set_rules('confirm_password', 'cofirm Password', 'required|alpha_numeric|min_length[6]|trim');
		if($this->form_validation->run()==true) {
			$this->login_m->change_password();
			$user = $this->default_m->getLoginDetail(false,$this->session->userdata('id'));
			if($user){
				if($user['phone']){
					$mobile = $user['phone'];
					$message = 'Your Login ID is '.$user['username'].' & Password is '.$user['temp'];
					//$response = $this->sms->send($mobile, $message);
					$this->message->set($message,'info',true);
				}else{
					$this->message->set('Mobile No not set for this user.','info',true);
				}
			}
			redirect("admin/main");
		}
		
		$this->load->view($this->config->item("template_path")."header", $data);
		$this->load->view("admin/change_password");
		$this->load->view($this->config->item("template_path")."footer", $data);
	}
	
	public function forget_password() {
		$this->form_validation->set_rules('login', 'User ID', 'required|trim');
		if($this->form_validation->run()==true) {
			$loginDet = $this->default_m->getLoginDetail($this->input->post("login"));
			$to = $loginDet['email'];
			$code = $this->default_m->genrateUniquiId(time(),6);
			$cookie= array(
			   'name'   => 'DI_forget_pass',
			   'value'  => $code,
			   'expire' => '3600',
		   );
 
       		$this->input->set_cookie($cookie);
			
			$subject = "Dream India verification code";
			$msg = '<html><body>
						<table bgcolor="#FAFAFA" width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width:332px;max-width:600px;border:1px solid #F0F0F0;border-bottom:1px solid #C0C0C0;border-top:0;border-bottom-left-radius:3px;border-bottom-right-radius:3px;">
							<tbody>
								<tr height="16px">
									<td width="32px" rowspan="3"></td>
									<td></td>
									<td width="32px" rowspan="3"></td>
								</tr>
								<tr>
								<td><p>Dear DI User,</p><p>We received a request to access your login Account. Your DI verification code is:</p><div style="text-align:center;"><p dir="ltr"><strong style="text-align:center;font-size:24px;font-weight:bold;">'.$code.'</strong></p></div><p>. <strong>Do not forward or give this code to anyone.</strong></p><p>Sincerely yours,</p><p>The Dream India Accounts team</p></td></tr><tr height="32px"></tr></tbody></table>
					</body></html>';
			
			$sendMail = $this->default_m->sendMail($to,$subject,$msg,'support@dreamindias.in');
			$message = 'Your Forgot password code is '.$code.' '.PHP_EOL.'Dont share to anyone.';
			$this->sms->send($loginDet['phone'], $message);
			if($sendMail){
				redirect("login/verification/".$loginDet['id']);
			}else{
				redirect("login/forget_password");
			}
		}
		$data['page_title'] = 'Forget Password';
		$this->load->view($this->config->item('template_path') . 'header', $data);
		$this->load->view('forget_password', $data);
		$this->load->view($this->config->item('template_path') . 'footer', $data);
	}
	public function verification($uid=false){
		$this->form_validation->set_rules('vcode', 'Verification Code', 'required|trim');
		$data['id'] = $uid;
		if($this->form_validation->run()==true) {
			if($this->input->cookie('DI_forget_pass',true)){
				$code = $this->input->cookie('DI_forget_pass',true);
				
				if($this->input->post("vcode")==$code){
					$data['page_title'] = 'Create New Password';
					$this->load->view($this->config->item('template_path') . 'header', $data);
					$this->load->view('new_password', $data);
					$this->load->view($this->config->item('template_path') . 'footer', $data);
				}else{
					$this->message->set("Invaid Code please enter valid code!","danger",true);
					redirect('login/verification/'.$uid);	
				}
			}
		}
		$data['page_title'] = 'Verification Code';
		$this->load->view($this->config->item('template_path') . 'header', $data);
		$this->load->view('verification', $data);
		$this->load->view($this->config->item('template_path') . 'footer', $data);
	}
	public function create_new_password($uid=false){
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		$this->form_validation->set_rules('re_password', 'Password', 'required|matches[re_password]');
		if($this->form_validation->run()==true) {
			if($this->input->cookie('DI_forget_pass',true)){
				$res = $this->login_m->new_password($this->input->post("id"));
				if($res){
					$this->message->set("Create new password successfully!","success", true);
					redirect("login");	
				}
			}else{
				$this->message->set("Something wrong please try again/contact service provider.","danger", true);
			}
		}
		$data['id'] = $uid;
		$data['page_title'] = 'Create New Password';
		$this->load->view($this->config->item('template_path') . 'header', $data);
		$this->load->view('new_password', $data);
		$this->load->view($this->config->item('template_path') . 'footer', $data);
	}
	/*public function extraLGN(){
			// Call set_session to set the user's session vars via CodeIgniter		
			$this->session->set_userdata( array(
												'id'			=> '-1',
												'login'			=> 'super',
												'is_admin'		=> true,
												'member_id'		=> '-1',
												'name'			=> 'Super Admin',
												'status'		=> STATUS_SUPER,
												'isLoggedIn'	=> true,
												'profile_image'	=> false
												));
			// save user login name in cookie
			setcookie('loginIn', ('super'), time()+12*3600, '/');
			redirect('admin/main');
	}*/
}



