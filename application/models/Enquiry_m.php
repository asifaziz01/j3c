<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Enquiry_m extends CI_Model {
	
	/*---// APPLIANCES //---*/
	public function get_enquiries ($id=false,$clause=false) {
		if($id){$this->db->where('id',$id);}
		if($clause){$this->db->where($clause);}
	    $this->db->order_by('enquiry_date', 'DESC');
	    $sql = $this->db->get ('customer_enquiries');
		if($sql->num_rows()>0){
			return ($id)?$sql->row_array ():$sql->result_array ();
		}else{
			return false;
		}
	}
    public function save_enquiry ($customer_id=false) {
		$customer_id = ($customer_id)?$customer_id:$this->session->userdata('id');
		//$storeEnq = $this->get_enquiries(false,array('customer_id'=>$customer_id,'location'=>$this->input->post('location'),'mobile'=>$this->input->post ('mobile')));
		//if(!$storeEnq){
			/*$data['customer_id'] = (!$customer_id)?$this->session->userdata ('id'):$customer_id;
			$data['customer_name'] = $this->input->post ('customer_name');
			$data['location'] = $this->input->post ('location');
			$data['map_location'] = $this->input->post ('map_location');
			$data['mobile'] = $this->input->post ('mobile');
			$data['items'] = $this->input->post ('items');
			$data['qty'] = $this->input->post ('qty');
			$data['price'] = $this->input->post ('items_price');
			$data['address'] = $this->input->post ('address');
			$data['status'] = ENQUIRY_STATUS_PENDING;
			$data['enquiry_date'] = time ();
			$data['isGSTbill'] = ($this->input->post('isGST'))?$this->input->post('isGST'):0;
			$data['technician_id'] = 0;
			$this->db->insert ('customer_enquiries', $data);*/
			if(!empty($_COOKIE['just3click_cart'])){
				$orders = $_COOKIE['just3clickItems'];
				$orders = explode(',',$orders);
				$aplnc = false;
				if($orders){
				  foreach($orders as $ordr){
					$ord = explode('-',$ordr);
					$aplnc[] = $ord[0];
				  }
				  
				  $qryStr='INSERT INTO '.TABLE_PREFIX.'customer_enquiries(customer_id,customer_name,location,map_location,mobile,appliance_id,items,qty,price,address,status,enquiry_date,isGSTbill,technician_id) VALUES ';
				  $qryVal=false;
				  $dscnctarr = array_count_values($aplnc);
				  foreach($dscnctarr as $apl=>$key){
					$items=array();$qty=array();$price=array();
					foreach($orders as $ordr){
						$ord = explode('-',$ordr);
						if($apl == $ord[0]){
							$issue = $this->appliance_m->get_issues($apl,$ord[3]);
							$items[] = $ordr;
							$qty[]=1;
							$price[]=(($issue['offer_price'])?$issue['offer_price']:$issue['price']);
						}
					}
					$qryVal[]='('.((!$customer_id)?$this->session->userdata ('id'):$customer_id).',
								"'.$this->input->post ('customer_name').'",
								"'.$this->input->post ('location').'",
								"'.$this->input->post ('map_location').'",
								'.$this->input->post ('mobile').',
								'.$apl.',
								"'.implode(',',$items).'",
								"'.implode(',',$qty).'",
								"'.implode(',',$price).'",
								"'.$this->input->post ('address').'",
								"'.ENQUIRY_STATUS_PENDING.'",
								'.time().',
								'.(($this->input->post('isGST'))?$this->input->post('isGST'):0).'
								,0)';
				  }
				}

				if($qryVal){
					$qryVal = implode(',',$qryVal);
					$qryStr .=$qryVal;
					$this->db->query($qryStr);
				}
			}
		//}
    } 
	public function getTechnicianLocations($tid=false){
		if($tid){
			$app=false;
			$this->db->where('technician_id',$tid);
			$qry=$this->db->get('technician_locations');
			if($qry->num_rows()>0){
				$res = $qry->result_array();
				foreach($res as $rs){
					$app[]=$rs['location_id'];
				}
				return $app;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function getTechnicianAppliances($tid=false){
		if($tid){
			$app=false;
			$this->db->where('technician_id',$tid);
			$qry=$this->db->get('technician_appliances');
			if($qry->num_rows()>0){
				$res = $qry->result_array();
				foreach($res as $rs){
					$app[]=$rs['appliance_id'];
				}
				return $app;
			}else{
				return false;
			}
		}else{
			return false;
		}
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
	public function servicePick($data=false,$clause=false){
		if($data && is_array($data)){
			$this->db->where($clause);
			$this->db->update('customer_enquiries',$data);
			return true;
		}else{
			return false;
		}
	}
	public function jobClose(){
		$enquiry = $this->get_enquiries($this->input->post("eid"));
		$calculateHour = number_format((((time()-$enquiry['pick_date']))/(3600)),2,'.','');
		$values = array(
			"work_hour"=>$calculateHour,
			"close_date"=>time(),
			"status"=>2,
			"job_otp"=>''
		);
		$res = $this->db->where("id",$this->input->post("eid"))->update("customer_enquiries",$values);
		if($res){
			return true;
		}else{
			return false;
		}
	}
}