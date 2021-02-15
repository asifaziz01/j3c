<?php 
class Settings_m extends CI_Model {
	//====fetch menu items ======================
	public function getMenu($id=false, $parent=false, $extra=false){
		if($id){
			$this->db->where("id", $id);
		}
		if($parent){
			$this->db->where("parent", $parent);
		}
		if($extra){
			$this->db->where($extra);
		}
		
		$this->db->order_by('indexing','ASC');
		$query = $this->db->get("menus");
		if($query->num_rows()>0){
			$result = ($id || $parent)? $query->row_array():$query->result_array();
			return $result;	
		}else{
			return false;	
		}
	}
	public function addmenu($id=false){
		if($id){$this->db->where("id",$id);}
		$values = array("title"=>$this->input->post("title"),"link"=>$this->input->post("link"),"parent"=>$this->input->post("parent"));
		$sql = ($id)?$this->db->update("menus",$values):$this->db->insert("menus",$values);
		if($sql){
			return true;	
		}else{
			return false;	
		}
	}
	public function deleteMenu($id=false){
		if($id){
			$this->db->where('id',$id);
			$qry = $this->db->delete("menus");
			return true;
		}else{
			return false;
		}
	}
	public function setIndex($id=false,$data=false){
		if($id && $data){
			$this->db->where("id",$id);
			$this->db->update("menus",$data);
			return true;
		}
	}
	//====user type==========
	public function getUserType($id=false,$clause=false){
		if($id){$this->db->where("id",$id);}
		if($clause){$this->db->where($clause);}
		$this->db->order_by("id","ASC");
		$sql=$this->db->get("user_type");
		if($sql->num_rows()>0){
			$result = ($id)?$sql->row_array():$sql->result_array();
			return $result;
		}else{
			return false;
		}
	}
	public function create_userType(){
		$values = array('title'=>$this->input->post('usertype'),'term'=>$this->input->post('term'),'show_create'=>$this->input->post('show_create'));
		$sql = $this->db->insert("user_type",$values);
		if($sql){
			return true;
		}else{
			return false;
		}
	}
	public function deleteUserType($usertype=false){
		if($usertype){
			$this->db->where("id",$usertype);
			$qry = $this->db->delete("user_type");
			return true;
		}else{
			return false;
		}
	}
	//=======================
	//====Previeleges========
	public function getPrevieleges($usrtyp=false){
		if($usrtyp){$this->db->where("user_type",$usrtyp);}
		$sql=$this->db->get("role");
		if($sql->num_rows()>0){
			$result = $sql->row_array();
			return $result;
		}else{
			return false;
		}
	}
	public function setPrevieleges($usrtyp=false){
		if($usrtyp){
			$flg = $this->getPrevieleges($usrtyp);
			if(!$flg){
				$userType = $this->getUserType($this->input->post('usrtyp'));
				$values = array("user_type"=>$this->input->post('usrtyp'),"role_name"=>$userType['title'],"module_list"=>implode(",",$this->input->post('mnu')));
			}else{
				$values = array("module_list"=>implode(",",$this->input->post('mnu')));
				$this->db->where('user_type',$usrtyp);
			}
			$qry = ($flg)?$this->db->update('role',$values):$this->db->insert('role',$values);
			if($qry){
				return true;
			}else{
				return false;
			}
		}
	}
	public function deleteUserPrevilige($usertype=false){
		if($usertype){
			$this->db->where("user_type",$usertype);
			$qry = $this->db->delete("role");
			return true;
		}else{
			return false;
		}
	}
	//=======================
	//====category==========
	public function getCategory($id=false,$clause=false){
		if($id){$this->db->where("id",$id);}
		if($clause){$this->db->where($clause);}
		$this->db->order_by("id","ASC");
		$sql=$this->db->get("category");
		if($sql->num_rows()>0){
			$result = ($id)?$sql->row_array():$sql->result_array();
			return $result;
		}else{
			return false;
		}
	}
	public function create_category($id=false){
		$values = array('title'=>$this->input->post('category'));
		if($id){$this->db->where('id',$id);}
		$sql = ($id)?$this->db->update("category",$values):$this->db->insert("category",$values);
		if($sql){
			if(!$id){$id=$this->db->insert_id();}
			return $id;
		}else{
			return false;
		}
	}
	public function add_category_data($id=false,$data=false){
		if($id && $data){
			$this->db->where('id',$id);
			$sql = $this->db->update("category",$data);
			if($sql){
				if(!$id){$id=$this->db->insert_id();}
				return $id;
			}else{
				return false;
			}
		}
	}
	//=======================
	//==== Food Type==========
	public function getfoodType($id=false,$clause=false){
		if($id){$this->db->where("id",$id);}
		if($clause){$this->db->where($clause);}
		$this->db->order_by("id","ASC");
		$sql=$this->db->get("food_type");
		if($sql->num_rows()>0){
			$result = ($id)?$sql->row_array():$sql->result_array();
			return $result;
		}else{
			return false;
		}
	}
	public function add_foodType($id=false){
		if($id){$this->db->where("id",$id);}
		$values = array("title"=>$this->input->post("title"),"parent"=>$this->input->post("parent"));
		$sql = ($id)?$this->db->update("food_type",$values):$this->db->insert("food_type",$values);
		if($sql){
			return true;	
		}else{
			return false;	
		}
	}
	
	//=======================
}