<?php 
class Mlm_m extends CI_Model {
	public function query($qry=false,$term='select'){
		if($qry){
			$sql = $this->db->query($qry);
			if($sql){
				$res = ($term=='select')?$sql->result_array():true;
				return $res;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function truncateTable($table=false){
		if($table){
			$res = $this->db->truncate($table);
			if($res){
				return true;	
			}else{
				return false;	
			}
		}else{
			return false;	
		}
	}
	public function createWallet($data=false){
		if($data){
			$res = $this->db->insert("wallet",$data);
			if($res){
				return true;
			}else{
				return false;
			}
		}
	}
	public function getUserProduct($uid=false){
		if($uid){
			$qry = $this->db->where("uid",$uid)->get("user_package")->row_array();
			if($qry){
				return $qry;
			}else{
				return false;	
			}
		}else{
			return false;	
		}
	}
	public function getLevelStatus($userID=false){
		if($userID){
			$this->db->where("u_id",$userID);
			$qry = $this->db->get("level_status");
			if($qry->num_rows()>0){
				$res = $qry->row_array();
				return $res;
			}else{
				return false;	
			}
		}else{
			return false;
		}
	}
	public function getUpgradeDetail(){
		$qry = $this->db->get("lastupgration");
		if($qry->num_rows()>0){
			$result = $qry->result_array();
			//$res = $result[(count($result)-1)];
			return $result;
		}else{
			return false;	
		}
	}
	public function getLastUpgrade(){
		$qry = $this->db->get("lastupgration");
		if($qry->num_rows()>0){
			$result = $qry->result_array();
			$res = $result[(count($result)-1)];
			return $res;
		}else{
			return false;	
		}
	}
	public function setUpgradeDate(){
		$lastupdt = $this->getLastUpgrade();
		if(!$lastupdt){$lastupdt['latest_date']="";}
		$this->db->insert("lastupgration",array("last_date"=>$lastupdt['latest_date'],"latest_date"=>date("Y-m-d H:i:s")));
	}
	public function updateLevel($data=false){
		if($data){
			$res = $this->db->insert_batch("level_status", $data);
			//$lastupdt = $this->getLastUpgrade();
			//if($res){$this->db->insert("lastupgration",array("last_date"=>$lastupdt['latest_date'],"latest_date"=>date("Y-m-d H:i:s")));}
			return ($res)?true:false;
		}else{
			return false;	
		}
	}
	
	public function makeTransation($data=false){
		if($data){
			//if($uid){$this->db->where("u_id", $uid);}
			$res = $this->db->insert_batch("transact", $data);
			return ($res)?true:false;
		}else{
			return false;	
		}
	}
	public function selectLeg($spnsr=false,$leg=false){
		$this->db->where("sponser_id",$spnsr);
		if($leg){$this->db->where("leg",$leg);}
		$qry = $this->db->get("user");
		if($qry->num_rows()>0){
			if($qry->num_rows()==2){
				return array(1,2);	
			}else if($qry->num_rows()==1){
				return array((($leg)?$leg:1));
			}else{
				$leg=array();
				return $leg;
			}
		}else{
			return array();	
		}
	}
	public function getGenerology($ibo=false, $users=false){
		$dwnusr=false;
		if($users){
			foreach($users as $user){
				if($user['parent']==$ibo){
					$dwnusr[] = array($user['ABO'],$user['id']);	
				}
			}
		}
		if($dwnusr){
			return $dwnusr;
		}else{
			return false;	
		}
	}
	public function upgrade_payment($data=false){
		if($data){
			$this->db->insert_batch("payment_satellment", $data);
			return true;
		}else{
			return false;	
		}
	}
	public function getAllUsersPKG(){
		$values=false;
		$qry = $this->db->get("user_package");
		if($qry->num_rows()>0){
			foreach($qry->result_array() as $row){
				$values[$row['uid']] = $row['pid'];	
			}
			return $values;
		}else{
			return false;	
		}
	}
	public function getTotalUserBussiness($ids=false,$clause=false){
		if($ids){
			$this->db->select_sum("amount");
			if($clause){$this->db->where_in($clause);}
			$this->db->where_in("uid",$ids);
			$this->db->where("calculate !=","0");	
			$qry = $this->db->get("user_package");
			if($qry->num_rows()>0){
				$res = $qry->row_array();
				return $res;	
			}else{
				return false;	
			}
		}else{
			return false;	
		}
	}

	public function getPaymentDetail($where=false,$select=false){
		if($where){
			$this->db->where($where);	
		}
		if($select){
			if(array_key_exists("SUM",$select)){
				$this->db->select_sum($select["SUM"]);
				$single_row=1;
			}
			if(array_key_exists("LIKE",$select)){
				$this->db->like($select["LIKE"][0],$select["LIKE"][1],'both');
			}
		}
		$qry = $this->db->get("payment_satellment");
		if($qry->num_rows()>0){
			$res = $qry->result_array();
			return $res;	
		}else{
			return false;	
		}
	}
	public function validateFirstCalculation($abo=false){
		if($abo){
			$this->db->where(array("parent"=>$abo,"sponser_id"=>$abo));
			$sql = $this->db->get("user");
			if($sql->num_rows()>0){
				$res = $sql->num_rows();
				return $res;
			}else{
				return 0;
			}
		}
	}
	public function getRewards($uid=false,$id=false,$type=REWARD_INCOME,$clause=false){
		if($uid || $id){
			if($clause){$this->db->where($clause);}
			if($id){$this->db->where('id',$id);}
			if($uid){$this->db->where('uid',$uid);}
			$this->db->where('type',$type);
			$qry = $this->db->get('rewards');
			if($qry->num_rows()>0){
				$res = ($id)?$qry->row_array():$qry->result_array();
				return $res;
			}else{
				return false;
			}
		}
	}
	public function rewardClaim($rid=false){
		$this->db->where("id",$rid)->update("rewards",array("request"=>1,"req_date"=>date('Y-m-d H:i:s')));
		return true;
	}
	public function rewardGrant($rid=false){
		$this->db->where("id",$rid)->update("rewards",array("request"=>0,"distribute"=>1,"distribute_date"=>date('Y-m-d H:i:s')));
		return true;
	}
	public function getUpgradePKGDetail($id=false,$clause=false){
		if($id){$this->db->where("id",$id);}
		if($clause){$this->db->where($clause);}
		$qry = $this->db->get("user_cashback_upgrade");
		if($qry->num_rows()>0){
			$res = ($id)?$qry->row_array():$qry->result_array();
			return $res;
		}else{
			return false;
		}
	}
	public function cashbackUpgrade($uid=false){
		if($uid){
			$pkg = $this->product_m->products($this->input->post('pkg'));
			if($pkg){
				$values = array(
					"uid"=>$uid,
					"bv"=>$pkg['bv'],
					"pid"=>$pkg['id'],
					"roi_ins"=>$pkg['roi_ins'],
					"roi_days"=>$pkg['roi_days']
				);
				if($this->db->insert("user_cashback_upgrade",$values)){
					$this->db->where('uid',$uid)->update("user_package",array("upgrade_roi"=>1));
					return true;
				}
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
}