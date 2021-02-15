<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_m extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	public function getUser($uid=false, $clause=false, $order_by=false)
	{
		if($uid){$this->db->where('id', $uid);}
		if($clause){$this->db->where($clause);}
		if($order_by){$this->db->order_by($order_by);}
		if($this->session->userdata('status') > STATUS_SUPER){$this->db->where("status !=",STATUS_SUPER);}
		$q = ($uid)?$this->db->get('user')->row_array():$this->db->get('user')->result_array();
		if ( $q !="") {
			return $q;
		} else {
			return FALSE;
		}
	}
    public function get_technicians ($appliance_id=0, $location=0) {
        
        $this->db->select ('DISTINCT (U.id), U.*');
        $this->db->from ('user U');
        $this->db->where ('U.status', STATUS_TECHNICIAN);
        if($appliance_id){$this->db->where_in ('TA.appliance_id', explode(',',$appliance_id));}
		$this->db->where ('TL.location_id', $location);
		$this->db->join('technician_locations TL','U.id=TL.technician_id','inner');
		if($appliance_id){$this->db->join('technician_appliances TA','TL.technician_id=TA.technician_id','inner');}
        $sql = $this->db->get ();
        return $sql->result_array ();
    }
	public function addProfilePic($uid=false, $data=false)
	{
		if($uid && $data){
			$prfpic = $this->getProfilePic($uid);
			if(!$prfpic){
				$this->db->insert("profile_pic", $data);
			}else{
				$this->db->where('uid', $uid);
				$this->db->update("profile_pic", $data);
			}
			return true;
		} else {
			return false;
		}
	}
	public function getProfilePic($uid=false)
	{
		if($uid){$this->db->where('uid', $uid);}
		$qry = $this->db->get('profile_pic')->row_array();
		if ($qry) {
			return $qry;
		} else {
			return false;
		}
	}
	public function create_user($id=false){
		$values = array(
			"name"=>$this->input->post("uname"),
			"father"=>$this->input->post("father"),
			"gender"=>$this->input->post("gender"),
			"adhaar"=>$this->input->post("adhaar"),
			"pan"=>$this->input->post("pan"),
			"gst"=>$this->input->post("gst"),
			"company"=>$this->input->post("company"),
			"address"=>$this->input->post("address")
			);
		if(!$id){
			$values['phone']=$this->input->post("mobile");
			$values['email']=$this->input->post("email");
			$values['temp']=$this->input->post('password');
			$values['password']=md5($this->input->post('password'));
			$values['username']=$this->input->post("mobile");
			$values['status']=$this->input->post("user_type");
			$values['created_by']=$this->session->userdata('login');
		}
		
		$sql = ($id)?$this->db->where("id",$id)->update("user",$values):$this->db->insert("user",$values);
		if($sql){
			if(!$id){
				$id=$this->db->insert_id();
				return $id;
			}else{
				return $id;
			}
		}else{
			return false;
		}
	}
	public function verifyTechnician(){
		if($this->input->post('tid')){
			$values = array('approved'=>1,
							'appr_date'=>date('Y-m-d H:i:s'),
							'approved_by'=>$this->session->userdata('login')
						);
			$this->db->where('id',$this->input->post('tid'));
			$qry = $this->db->update('user',$values);
			return true;
		}else{
			return false;
		}
	}
	public function deleteUser($id=false,$clause=false){
		if($id || $clause){
			if($id){
				$this->db->where('id',$id);
			}
			if($clause){
				$this->db->where($clause);
			}
			$qry = $this->db->delete('user');
			return true;
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
	public function dispatchNow($uid){
		if($uid){
			$values = array("kit_dispatch"=>1,"kit_dispatch_date"=>date('Y-m-d'));
			$this->db->where("uid",$uid)->update("user_package",$values);
			return true;
		}
	}
	/*---// TECHNICIANS //---*/
	public function get_technician_categories ($id=false) {
		if($id){$this->db->where('id',$id);}
	    $this->db->order_by ('title', 'ASC');
	    $sql = $this->db->get ('technician_categories');
	    return ($id)?$sql->row_array():$sql->result_array (); 
	}
	public function delete_category ($id=0) {
	    $this->db->where ('id', $id);
	    $sql = $this->db->delete ('technician_categories');
	}

	public function get_skills ($technician_id=0,$id=false) {
		if($technician_id){$this->db->where ('technician_id', $technician_id);}
		if($id){$this->db->where ('id', $id);}
		$sql = $this->db->get ('technician_skills');
		return ($id)?$sql->row_array():$sql->result_array ();
	}

	public function save_skill ($technician_id=0) {
		$data['technician_id'] = $technician_id;
		$data['title'] = $this->input->post ('skill_name');
		$this->db->insert ('technician_skills', $data);
		$id = $this->db->insert_id();
		return $id;
	}
	public function delete_skill ($id=0) {
	    $this->db->where ('id', $id);
	    $sql = $this->db->delete ('technician_skills');
	}
	public function saveCustomerInfo ($pass=false) {
		$refId = $this->default_m->genrateUniquiId(time(),5);
		$name = $this->input->post("customer_name");
		$values=array(
			"category_id" 		=>5,
			"reg_no"			=>$refId,
			"username"			=>$this->input->post("mobile"),
			"password"			=>md5($pass),
			"temp"				=>$pass,
			"name"				=>$name,
			"phone"				=>$this->input->post("mobile"),
			"address"			=>$this->input->post("address"),
			"mobile_verified"	=>1,
			"enable"			=>1,
			"approved"			=>1,
			"status"			=>STATUS_CUSTOMER,
			"reg_date"			=>time()
		);
		$res = $this->db->insert("user",$values);
		if($res){
			$id=$this->db->insert_id();
			return $id;
		}else{
			return false;
		}
	} 
	public function getRank($tid=false,$cid=false){
		if($tid){
			$this->db->where('technician_id',$tid);
			if($cid){$this->db->where('customer_id',$cid);}
			$sql = $this->db->get('technician_rank');
			if($sql->num_rows()>0){
				$res = $sql->result_array();
				return $res;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function getFeedback($fid=false,$clause=false){
		if($fid){$this->db->where('id',$fid);}
		if($clause){$this->db->where($clause);}
		$this->db->order_by('date','ASC');
		$sql = $this->db->get('feedback');
		if($sql->num_rows()>0){
			$res = ($fid)?$sql->row_array():$sql->result_array();
			return $res;
		}else{
			return false;
		}
	}
}