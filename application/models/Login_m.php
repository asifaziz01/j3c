<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_m extends CI_Model {
	var $details;
	public function __construct() {
		parent::__construct();
		$this->load->helper('date');
	}
	public function get_user_status ( $login, $password, $remember=0, $search_type=0 ) {
		if  ( $search_type == 1 ) {
			// get user status (Admin/Instructors/Student/Parents etc)
			$query = $this->db->query("SELECT status FROM ".TABLE_PREFIX."user WHERE (username='$login' OR email='$login') AND password='$password'");

			if ($query->num_rows() > 0 ) {
				// this is a member account
				$row = $query->row();
				return $row->status;
			}
		} else {
			return false;
		}

	}
	public function validate_user ( $login, $password, $remember=0, $status=false,$otp=false) {
		$status = ($status)?' AND status IN ('.$status.')':$status;
		$passwordTxt = (!$otp)?' AND password="'.$password.'"':'';
		$query = $this->db->query('SELECT id, status, name, username, email,post FROM '.TABLE_PREFIX.'user WHERE (username="'.$login.'" OR email="'.$login.'") '.$passwordTxt.' AND enable="1"'.$status);
		if ($query->num_rows() > 0 ) {
			$row = $query->row_array();
			if ($remember == 1) {				
				setcookie('remember', md5($row->username), time()+12*3600, '/');
			}
			$this->session->set_userdata( array(
							'login'			=> $row['username'],
							'id'			=> $row['id'],
							'name'			=> $row['name'],
							'email'			=> $row['email'],
							'post'			=> $row['post'],
							'status'		=> $row['status'],
							'isLoggedIn'	=> true
							));

			// save user login name in cookie

			setcookie('loginIn', ($row['username']), time()+12*3600, '/');
			// update current login time 
			$this->db->where('username', $row['username']);
			$this->db->update('user', array('last_login'=>date('Y-m-d H:i:s')) );
			//========check user is approved or not approved =====
			//$this->default_m->distributeDirectIncomeByUser($row['id']);
			//====================================================
			
			return $row['status'];	
		}else{
			return false;	
		}
	}

	public function get_technician_categories ($id=false) {
		if($id){$this->db->where('id',$id);}
	    $this->db->order_by ('title', 'ASC');
	    $sql = $this->db->get ('technician_categories');
	    return ($id)?$sql->row_array():$sql->result_array (); 
	}

	public function add_technician($pass){
		$data['name'] = $this->input->post ('uname');
		$data['username'] = $this->input->post ('mobile');
		$data['phone'] = $this->input->post ('mobile');
		$data['created_by'] = 0;
		$data['reg_date'] = time ();
		$data['password'] = md5($pass);
		$data['temp'] = $pass;
		$data['status'] = STATUS_TECHNICIAN;
		$data['category_id'] = $this->input->post ('category');
		$sql = $this->db->insert ('user', $data);
		$technician_id = $this->db->insert_id ();

		return $technician_id;
	}

	
	public function check_login_sessions ($userdata) {

		

		$que = $this->db->query("SELECT * FROM ".TABLE_PREFIX."login_sessions Where userdata='$userdata'");

		if ($que->num_rows() > 0 ) {

			$res = $que->row_array();

			return $res;		

		} else {

			return 0;

		}

		

	}

	

	public function get_member_info ($login){

		

		$query = $this->db->query("SELECT * FROM ".TABLE_PREFIX."user WHERE username='$login'");

		$result = $query->row_array();

		if($query->num_rows() > 0 ){

		

			return $result;	

		}

		

		$qry = $this->db->query("SELECT * FROM ".TABLE_PREFIX."user WHERE username='$login'");

		$rlt = $qry->row_array();

		if($qry->num_rows() > 0 ){

		

			return $rlt;	

		}

		

		

	}

	

	public function update_last_login($login, $status){
		$this->db->where('login', $login);
		$this->db->update('user', array('last_login'=>time()) );
	}

	  

	public function set_profile_picture ($member_id) {



		$this->load->helper('file');

		$root_dir 	= './';

		$home_dir = $this->config->item('profile_picture_path');

		$path_to_image_dir  = $root_dir . $home_dir . '/' ;

		$file_name = 'pi_'.$member_id.'.gif';

		$file_path = $path_to_image_dir . $file_name;

		// if a profile_image of this user does not exists we can proceed normally

		if ( read_file ( $file_path ) == false ) {

			$data = $home_dir . 'no_image.gif';						 

		} else {

			$data = $home_dir . '/' . $file_name;						

		}

		

		return $data;

	}



	

	public function check_registered_email ($email) {	

		$this->db->where ('email', $email);

		$this->db->from ('user');

		$sql = $this->db->get ();

		if ($sql->num_rows () > 0 ) {

			return true;

		} else {

				return false;

		}

	}

	

	/*	CHECK IF USER ALREADY LOGGED

	*/

	public function update_login_session ( $username, $userid, $userdata ) {

		$this->db->where('username', $username );

		$this->db->where('userdata', $userdata );

		$this->db->update('login_session', array('login'	=> $username, 

												 'id'	=> $userid, 

												 'time'		=> now(), 

												 'keep_loggedin'=> 'keep_loggedin', 

												 'userdata'		=> $userdata) );



	}

	

	/*	CHECK IF USER ALREADY LOGGED

	*/

	public function remove_login_session ( $username ) {

		// delete login session

		$sql = $this->db->get_where('login_sessions', array('username'=> $username) );

		if ($sql->num_rows() > 0 ) {

			$this->db->delete('login_sessions', array('username'=> $username) );

		}

		// save logout time

		// date timestamp ( tadays date only)

		$date_ts = mktime (0, 0, 0, date ('m'), date ('d'), date ('Y') );

		$this->db->where ( array ('member_id'=>$this->session->userdata ('member_id'), 'date_ts'=>$date_ts) );

		$this->db->update ('members_online_log', array ( 'loggedout'=>0) );

	}	

	

	// get user password

	public function get_user_password ($login) {

		$this->db->select ('password');

		$this->db->where ('username', $login);

		$this->db->or_where ('email', $login);

		$query = $this->db->get ('user');

		if  ( $query->num_rows () > 0 ) {

			$row = $query->row ();

			return $row->password;

		} else {

				return false;

		}

	}

	

	public function new_register($userstatus = STATUS_CUSTOMER) {		
		$ABO = $this->default_m->genrateUniquiId(time(), 6);
		$values = array(
						"name"=>$this->input->post("uname"),
						"father"=>$this->input->post("father"),
						"gender"=>$this->input->post("gender"),
						"adhaar"=>$this->input->post("adhaar"),
						"pan"=>$this->input->post("pan"),
						"phone"=>$this->input->post("mobile"),
						"address"=>$this->input->post("address"),
						"leg"=>$this->input->post("leg"),
						'temp'=>$this->input->post('password'),
						'password'=>md5($this->input->post('password')),
						'parent'=>$this->input->post('parent'),
						'sponser_id'=>$this->input->post('sponser'),
						'ABO'=>$ABO,
						'username'=>$ABO,
						'status'=>$userstatus,
						'created_by'=>'self'
					    );
		//if(!$id){
		//}
		$this->db->insert('user', $values);
		//$id = $this->db->insert_id();
		//$userid = $this->default_m->genrateUniquiId($id, 6);
		
		return $this->db->insert_id();
	}

	

	public function getLoginDetailByspr($ibo=false){
		$this->db->where("IBO", $ibo);
		$query = $this->db->get("user");	
		if($query->num_rows()>0){
			$results = $query->row_array();
			return $results;	
		}else{
			return false;	
		}
	}
	public function getLoginDetail($login=false){
		$login = (!$login)?$this->session->userdata("login"):$login;
		$this->db->where("username", $login);
		$query = $this->db->get("user");	
		if($query->num_rows()>0){
			$results = $query->row_array();
			return $results;	
		}else{
			return false;	
		}
	}

	public function checkLoginExist($value=false){
		if($value){
			$login = $value;
			$this->db->where(array("username"=>$login));
			$query = $this->db->get("user");	
			if($query->num_rows()>0){
				return true;	
			}else{
				return false;	
			}
		}else{
			return false;	
		}
	}
	
	public function change_password(){
		$oldPass = $this->input->post("old_password");
		$this->db->where(array("username"=>$this->session->userdata('login'), "password"=>md5($oldPass)));
		$query = $this->db->get("user");
		if($query->num_rows()>0){
			$this->db->where(array("username"=>$this->session->userdata('login'), "password"=>md5($oldPass)));
			$this->db->update("user", array("password"=>md5($this->input->post("new_password")),"temp"=>$this->input->post("new_password")));	
		}
	}
	public function new_password($id=false){
		$this->db->where(array("id"=>$id));
		$query = $this->db->get("user");
		if($query->num_rows()>0){
			$this->db->where(array("id"=>$id));
			$this->db->update("user", array("password"=>md5($this->input->post("password")),"temp"=>$this->input->post("password")));
			return true;	
		}
	}
}