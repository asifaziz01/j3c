<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Appliance_m extends CI_Model {
	
	public function query($data=false){
		if($data){
			$this->db->query($data);
			return true;
		}else{
			return false;
		}
	}
	/*---// APPLIANCES Category //---*/
	public function get_categories ($cid=0) {
		if($cid){$this->db->where("id",$cid);}
		$sql = $this->db->get ('appliance_categories');
		if($sql->num_rows()>0){
			$res = ($cid)?$sql->row_array():$sql->result_array();
			return $res; 
		}else{
			return false;
		}
	}
	public function create_category(){
		$values = array(
			"title" =>$this->input->post("title"),
			"icon" =>'services-icons/'.$this->input->post("iconname")
		);
		$this->db->insert("appliance_categories",$values);
		return true;
	}
	/*---// APPLIANCES //---*/
	public function get_appliances ($category_id=0) {
		if($category_id){$this->db->where("category_id",$category_id);}
	    $sql = $this->db->get ('appliances');
	    return $sql->result_array (); 
	}

	public function get_appliance ($appliance_id=0) {
	    $this->db->where ('appliance_id', $appliance_id);
	    $sql = $this->db->get ('appliances');
	    return $sql->row_array (); 
	}

	public function save_appliance ($category_id=SERVICE_CATEGORY_APPLIANCES, $appliance_id=0) {
		$data['appliance_name'] = $this->input->post ('appliance_name');
		$data['service_type'] = $this->input->post ('service_type');
		$data['category_id'] = $category_id;
		$data['head_content'] = $this->input->post('heading_content');
		$data['body_content'] = $this->input->post('body_content');
		if($_FILES['img']['name']){$data['body_content_image'] = $_FILES['img']['name'];}
		$data['content'] = $this->input->post('content');
		if($_FILES['logo']['name']){$data['icon'] = 'services-icons/'.$_FILES['logo']['name'];}
		$data['status'] = 1;
		$data['position'] = 'position+1';
		if($appliance_id){$this->db->where("appliance_id",$appliance_id);}
		$sql = (!$appliance_id)?$this->db->insert ('appliances', $data):$this->db->update ('appliances', $data);
		$appliance_id = (!$appliance_id)?$this->db->insert_id ():$appliance_id;
		return $appliance_id;
	}
	
	public function get_appliance_logo ($appliance_id=0) {
		$logo_path = $this->config->item ('appliance_logo_path');
		$file_name = 'logo_'.$appliance_id.'.png';
		$full_path = $logo_path . $file_name;
		$file = get_file_info ($full_path);
		if (! empty ($file)) {
			return $full_path;
		} else {
			return $logo_path . 'default.png';
		}
	}
	
	public function delete_appliance ($appliance_id=0) {
	    $this->db->where ('appliance_id', $appliance_id);
	    $sql = $this->db->delete ('appliances');
		if($sql){
			$sql1 = $this->delete_brand(false,array('appliance_id'=>$appliance_id));
			if($sql){
				$sql2 = $this->delete_type(false,array("appliance_id"=>$appliance_id));
				if($sql){
					$this->delete_issue(false,array('appliance_id'=>$appliance_id));
					$this->db->where('appliance_id',$appliance_id)->delete('customer_enquiries');
				}
			}
		}
	}


	/*---// BRANDS //---*/
	public function get_brands ($appliance_id=0,$bid=false) {
		if ($appliance_id > 0) {$this->db->where ('appliance_id', $appliance_id);}
		if ($bid > 0) {$this->db->where ('brand_id', $bid);}
	    $sql = $this->db->get ('appliance_brands');
	    return ($bid)?$sql->row_array():$sql->result_array (); 
	}

	public function save_brand ($brand_id=0) {
		$data['brand_name'] = $this->input->post ('brand');
		if ($brand_id > 0) {
			$this->db->where ('brand_id', $brand_id);
		} else {
			$data['appliance_id'] = $this->input->post('appliance');
			$data['position'] = 'position+1';
		}
		$sql = ($brand_id)?$this->db->update ('appliance_brands', $data):$this->db->insert ('appliance_brands', $data);			
	}

	public function delete_brand ($brand_id=0,$clause=false) {
		if($clause){$this->db->where($clause);}
	    if($brand_id){$this->db->where ('brand_id', $brand_id);}
	    $sql = $this->db->delete ('appliance_brands');
	}

	/*---// ISSUE //---*/
	public function get_issues ($appliance_id=0,$isid=false) {
		if ($appliance_id > 0) {
			$this->db->where ('appliance_id', $appliance_id);			
		}
		if($isid){$this->db->where('issue_id',$isid);}
	    $sql = $this->db->get ('appliance_issues');
	    return ($isid)?$sql->row_array():$sql->result_array (); 
	}

	public function save_issue ($issue_id=0) {
		$data['issue_title'] = $this->input->post ('issue');
		$data['price'] = $this->input->post ('price');
		$data['offer_price'] = $this->input->post ('offer_price');
		$data['description'] = $this->input->post ('issue_description');
		if ($issue_id > 0) {
			$sql = $this->db->where('issue_id',$issue_id)->update ('appliance_issues', $data);
		} else {
			$data['appliance_id'] = $this->input->post('appliance');
			$data['status'] = 1;
			$sql = $this->db->insert ('appliance_issues', $data);			
		}
		return true;
	}

	public function delete_issue ($issue_id=0,$clause=false) {
	    if($issue_id){$this->db->where ('issue_id', $issue_id);}
		if($clause){$this->db->where($clause);}
	    $sql = $this->db->delete ('appliance_issues');
	}

	/*---// BRAND TYPES //---*/
	public function get_appliance_types ($appliance_id=0,$tid=false) {
		if ($appliance_id > 0) {
			$this->db->where ('appliance_id', $appliance_id);			
		}
		if($tid){$this->db->where("type_id",$tid);}
	    $sql = $this->db->get ('appliance_types');
	    return ($tid)?$sql->row_array():$sql->result_array (); 
	}

	public function save_appliance_type ($appliance_type_id=0) {
		$data['type_name'] = $this->input->post ('type');
		if ($appliance_type_id > 0) {
			$this->db->where ('type_id', $appliance_type_id);
		} else {
			$data['appliance_id'] = $this->input->post('appliance');
			$data['position'] = 'position+1';
		}
		$sql = ($appliance_type_id)?$this->db->update ('appliance_types', $data):$this->db->insert ('appliance_types', $data);
		return true;
	}
	
	public function delete_type ($type_id=0,$clause=false) {
		if($clause){$this->db->where($clause);}
	    if($type_id){$this->db->where ('type_id', $type_id);}
	    $sql = $this->db->delete ('appliance_types');
	}
	
    public function get_technicians ($appliance_id=0, $location=0, $cat_id=false) {
        
        $this->db->select ('DISTINCT (M.member_id), M.*');
        $this->db->from ('members M');
        $this->db->where ('M.role_id', USER_ROLE_TECHNICIAN);
        if($appliance_id){$this->db->where ('TA.appliance_id', $appliance_id);}
        if($cat_id){$this->db->where ('M.category_id', $cat_id);}
		$this->db->where ('TL.location_id', $location);
		$this->db->join('technician_locations TL','M.member_id=TL.technician_id','inner');
		if($appliance_id){$this->db->join('technician_appliances TA','TL.technician_id=TA.technician_id','inner');}
        $sql = $this->db->get ();
        return $sql->result_array ();
    }
	public function change_tech_appliance ($technician_id=0, $appliance_id=0, $state=0) {
		if ($state == 1) {
			$data['technician_id'] = $technician_id;
			$data['appliance_id']  = $appliance_id;
			$this->db->insert ('technician_appliances', $data);
		} else {
			$this->db->where ('technician_id', $technician_id);
			$this->db->where ('appliance_id', $appliance_id);
			$this->db->delete ('technician_appliances');			
		}
	}
	public function change_tech_location ($technician_id=0, $location_id=0, $state=0) {
		if ($state == 1) {
			$data['technician_id'] = $technician_id;
			$data['location_id']  = $location_id;
			$this->db->insert ('technician_locations', $data);
		} else {
			$this->db->where ('technician_id', $technician_id);
			$this->db->where ('location_id', $location_id);
			$this->db->delete ('technician_locations');			
		}
	}	
	public function get_tech_appliances ($technician_id=0) {
	    $this->db->where ('technician_id', $technician_id);
	    $sql = $this->db->get ('technician_appliances');
	    return $sql->result_array ();
	}

	public function get_tech_locations ($technician_id=0) {
	    $this->db->where ('technician_id', $technician_id);
	    $sql = $this->db->get ('technician_locations');
	    return $sql->result_array();
	}
}