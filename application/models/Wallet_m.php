<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Wallet_m extends CI_Model {
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
	public function calculateTotalHourofjob($tid=false){
		if($tid){
			$this->db->select_sum('plan_hour');
			$this->db->where('technician_id',$tid);
			$this->db->where('plan_type','1');
			$sql = $this->db->get('technician_plan');
			if($sql->num_rows()>0){
				$res = $sql->row_array();
				return $res;
			}else{
				return false;
			}
		}
	}
	public function calculateTotalSpendhour($tid=false){
		if($tid){
			$this->db->select_sum('work_hour');
			$this->db->where(array('technician_id'=>$tid));
			$sql = $this->db->get('customer_enquiries');
			if($sql->num_rows()>0){
				$res = $sql->row_array();
				return $res;
			}else{
				return false;
			}
		}
	}
	public function calculateLeftTime($tid=false, $ptype=false){
		$totaltime = $this->calculateTotalHourofjob($this->session->userdata('id'));
		$spendtime = $this->calculateTotalSpendhour($this->session->userdata('id'));
		if($totaltime['plan_hour']){
			$leftHour = $totaltime['plan_hour'] - $spendtime['work_hour'];
			$isActivePlan = $this->plan_m->get_technicianActivePlan($tid);
			$spendTime = ($isActivePlan['pick_date'])?number_format(((time()-$isActivePlan['pick_date']))/(3600),2,'.',''):0;
			$totalLefttime = (($leftHour)-($spendTime));
			return $totalLefttime;
		}else{
			return 0;
		}
	}
}