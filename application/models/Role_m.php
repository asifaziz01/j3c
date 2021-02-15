<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Role_m extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	public function getPrivilage($id=false){
		if($id){
			$this->db->where('id',$id);	
		}
		$qry = $this->db->get('role');
		if($qry->num_rows()>0){
			$res = ($id)?$qry->row_array():$qry->result_array();
			return $res;	
		}else{
			return false;	
		}
	}
	public function setPrivilages(){
		$privilage = $this->getPrivilage($this->input->post('user_type'));
		$user_type = $this->config->item('user_type');
		$values['id'] = $user_type[$this->input->post('user_type')];
		$prevl=false;
		if($this->input->post('mnu')){
			foreach($this->input->post('mnu') as $mnu){
				$prevl[] = $mnu;	
			}
		}
		
		if($prevl){
			$prevl = implode(",",$prevl);
			if($privilage){
				$this->db->where("id",$this->input->post('user_type'));
				$this->db->update("role",array("module_list"=>$prevl));	
			}else{
				$this->db->insert("role",array("module_list"=>$prevl));	
			}
		}else{
			return false;	
		}
	}
	//========role section ==========//
	public function add_rol($data)
	{
		//print_r($data);
		if($this->db->insert('role', $data))
			return true;
		else
			return false;
	}
	public function cheak_role($data)
	{
		$role = $this->db->where('role_name', $data)->get('role')->result_array();
		if($role)
			return $role;
		else
			return false;
	}
	public function get_role()
	{
		$detail = $this->db->get('role')->result_array();
		return $detail;
	}
	public function get_rol_id($id=false)
	{
		$detail = $this->db->where('id',$id)->get('role')->row_array();
		return $detail;
	}
	public function role_edit($data, $id)
	{
		$detail = $this->db->where('id',$id)->update('role', $data);
		return $detail;
	}
	public function role_del($id)
	{
		$detail = $this->db->where('id',$id)->delete('role');
		return true;
	}
}