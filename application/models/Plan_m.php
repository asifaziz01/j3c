<?php defined('BASEPATH') OR exit('No direct script access allowed');

class plan_m extends CI_Model {
	public function get_plan($id=false){
		if($id){
			$this->db->where("id",$id);
		}
		$sql = $this->db->get('plan');
		if($sql->num_rows()>0){
			$res = ($id)?$sql->row_array():$sql->result_array();
			return $res;
		}else{
			return false;
		}
	}	

	public function create_plan($id=false){
		if($id){
			$this->db->where("id",$id);
		}
		$values = array(
			"title" => $this->input->post('title'),
			"type" => $this->input->post('type'),
			"amount" => $this->input->post('amount'), 
			"hour" =>  $this->input->post('hour')
		);
		$res = ($id)?$this->db->update('plan',$values):$this->db->insert('plan',$values);
	}

	public function get_technician_plan($id=false,$tid=false,$pid=false){
		if($id){ $this->db->where("id",$id); }
		if($tid){ $this->db->where("technician_id",$tid); }
		if($pid){ $this->db->where("plan_id",$pid); }
		$sql = $this->db->get('technician_plan');
		if($sql->num_rows()>0){
			$res = ($id)?$sql->row_array():$sql->result_array();
			return $res;
		}else{
			return false;
		}
	}	
	public function get_technicianActivePlan($tid=false){
		if($tid){ $this->db->where("technician_id",$tid); }
		$this->db->where('close_date','');
		$sql = $this->db->get('customer_enquiries');
		if($sql->num_rows()>0){
			$res = $sql->row_array();
			return $res;
		}else{
			return false;
		}
	}	
	public function setTechnicianPlan(){
		$plan = $this->get_plan($this->input->post('plan'));
		$values = array(
			"technician_id" => $this->input->post('id'),
			"plan_type" => $plan['type'],
			"plan_id" => $this->input->post('plan'),
			"plan_amount" => $plan['amount'],
			"plan_hour" => $plan['hour']
		);
		$this->db->insert('technician_plan',$values);
		return true;
	}
}