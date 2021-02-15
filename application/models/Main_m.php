<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main_m extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	public function getFeedback($id=false,$clause=false)
	{
		if($id){$this->db->where('id',$id);}
		if($clause){$this->db->where($clause);}
		$sql = $this->db->get('feedback');
		if($sql->num_rows()>0){
			$res = ($id)?$sql->row_array():$sql->result_array();
			return $res;
		}else{
			return false;
		}
	}
	public function addFeedback(){
		$values = array(
				"subject"=>$this->input->post('subject'),
				"message"=>$this->input->post('message')
		);
		if($this->session->userdata('id')){
			$values['mobile']=$this->session->userdata('login');
			$values['name']=$this->session->userdata('name');
			$values['email']=$this->session->userdata('email');
		}else{
			$values['mobile']=$this->input->post('mobile');
			$values['name']=$this->input->post('name');
			$values['email']=$this->input->post('email');
		}
		$res = $this->db->insert('feedback',$values);
		if($res){
			return true;
		}else{
			return false;
		}
	}
	public function deleteFeedback($id=false){
		if($id){
			$this->db->where('id',$id);
			$this->db->delete('feedback');
			return true;
		}else{
			return false;
		}
	}
}