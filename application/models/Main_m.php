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
	public function getFeedbackByApp($apid=false){
		if($apid){
			$this->db->select('id');
			$this->db->from('customer_enquiries');
			$this->db->where('appliance_id',$apid);
			$qry = $this->db->get();
			$data=[];
			if($qry->num_rows()>0){
				$res = $qry->result_array();
				foreach($res as $rs){
					$data[]=$rs['id'];
				}
			}
			if(count($data)==0){$data[]='-1';}
			$this->db->_reset_select();
		}
		$this->db->where_in('eid',$data);
		$sql = $this->db->get('feedback');
		if($sql->num_rows()>0){
			$res = $sql->result_array();
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
			$values['eid']=$this->input->post('eid');
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
	public function saveRank($rank=false,$tid=false){
		if($rank && $tid){
			$value = array('technician_id'=>$tid,'customer_id'=>$this->session->userdata('id'),'rank'=>$rank,'date'=>time());
			$this->db->insert('technician_rank',$value);
			return true;
		}else{
			return false;
		}
	}
}