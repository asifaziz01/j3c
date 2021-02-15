<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Default_m extends CI_Model {
	var $details;
	public function __construct() {
		parent::__construct();
		$this->load->helper('date');
	}
	public function getProc($qry=false){
		if($qry){
			$res = $this->db->query($qry);
			if($res->num_rows()>0){
				return $result = $res->result_array();
			}else{
				return false;
			}
		}
	}
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

	public function hour2countdown($value){
		$hours = floor($value / 3600);
		$minutes = floor(($value / 60) % 60);
		$seconds = $value % 60;

		return $hours.":".$minutes.":".$seconds;
	}
	public function hour2time($value){
		$seconds=0;$hours=0;$minutes=0;
		$seconds += $value*3600;

		$hours = floor($seconds/3600);
		$seconds -= $hours*3600;
		$minutes  = floor($seconds/60);
		$seconds -= $minutes*60;
		// return "{$hours}:{$minutes}:{$seconds}";
		return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds); // Thanks to Patrick
	}
	public function sum_the_time($time_array=false) {
		if($time_array){
			$times = $time_array;
			$seconds = 0;
			foreach ($times as $time)
			{
				list($hour,$minute,$second) = explode(':', $time);
				$seconds += $hour*3600;
				$seconds += $minute*60;
				$seconds += $second;
			}
			$hours = floor($seconds/3600);
			$seconds -= $hours*3600;
			$minutes  = floor($seconds/60);
			$seconds -= $minutes*60;
			// return "{$hours}:{$minutes}:{$seconds}";
			return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds); // Thanks to Patrick
		}else{
			return false;
		}
	  }

	  public function compare_time($time1=false,$time2=false,$cond='<') {
		if($time1 && $time2){
			$time1seconds = 0;$time2seconds = 0;

			list($hour,$minute,$second) = explode(':', $time1);
			$time1seconds += $hour*3600;
			$time1seconds += $minute*60;
			$time1seconds += $second;

			list($hour,$minute,$second) = explode(':', $time2);
			$time2seconds += $hour*3600;
			$time2seconds += $minute*60;
			$time2seconds += $second;

			/*$hours = floor($seconds/3600);
			$seconds -= $hours*3600;
			$minutes  = floor($seconds/60);
			$seconds -= $minutes*60;
			// return "{$hours}:{$minutes}:{$seconds}";
			return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds); // Thanks to Patrick*/
			if($cond=='<' && $time2seconds < $time1seconds){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function createDateRangeArray($strDateFrom,$strDateTo,$match=false)
	{
		$aryRange=array();
	
		$iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
		$iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));
	
		if ($iDateTo>=$iDateFrom)
		{
			$dt = date($match['key'],$iDateFrom);
			if(in_array($dt,$match['val'])){
				array_push($aryRange,date('Y-m-d',$iDateFrom));// first entry
			}
			while ($iDateFrom<$iDateTo)
			{
				$iDateFrom+=86400; // add 24 hours
				if($match){
					$dt = date($match['key'],$iDateFrom);
					if(in_array($dt,$match['val'])){
						array_push($aryRange,date('Y-m-d',$iDateFrom));
					}
				}else{
					array_push($aryRange,date('Y-m-d',$iDateFrom));
				}
			}
		}
		return $aryRange;
	}
	public function array_column($array,$colname,$Indexkey=''){
		$return_array = array();
		if(is_array($array) || is_object($array)){
		  foreach($array as $arrayDATA){
			if(is_object($arrayDATA)){
			  if(isset($arrayDATA->{$colname})){
				if(isset($Indexkey) && isset($arrayDATA->{$Indexkey}) ){
				  $return_array[$arrayDATA->{$Indexkey}] = $arrayDATA->{$colname};
				} else {
				  $return_array[] = $arrayDATA->{$colname};
				}
			  }
			} else if(is_array($arrayDATA)) {
			  if(isset($arrayDATA[$colname])){
				if(isset($Indexkey) && isset($arrayDATA[$Indexkey]) ){
				  $return_array[$arrayDATA[$Indexkey]] = $arrayDATA[$colname];  
				} else {
				  $return_array[] = $arrayDATA[$colname]; 
				} 
			  } 
			}     
		  }
		} 
		return $return_array;
	}
	
	public function genrateUniquiId($str=false, $len=4){
		return substr(sprintf("%u", crc32($str)),0,$len);
	}

	public function getDefaultConfig($term=false, $clause=false){
		if($term){$this->db->where("term",$term);}
		if($clause){$this->db->where($clause);}
		//$this->db->where("disabled","0");
		$query = $this->db->get("config");
		if($query->num_rows()>0){
			$results = ($term)? $query->row_array() : $query->result_array();
			
			return $results;
		}else{
			return false;	
		}
	}
	
	public function saveDefault(){
		$rows = $this->getDefaultConfig();
		
		foreach($rows as $row){
			$this->db->where("term", $row['term']);
			$values = array("value"=>(($this->input->post($row['term']))?$this->input->post($row['term']):$row['value']));
			$this->db->update("config", $values);
		}
	}

	public function sendMail($to=false, $subject=false, $message=false, $from=false){
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
		// More headers
		$headers .= 'From: '.$from. "\r\n";
		//$headers .= 'Cc: ' . "\r\n";
		
		if(mail($to,$subject,$message,$headers)){
			$this->message->set("Email send sucessfully please check your mail/sms.","success", true);
			return true;	
		}else{
			$this->message->set("Email not send! please check your email id/phone no.","danger", true);
			return false;	
		}
	}

	//============================================
		public function getStates($id=false){
		$cid=101;
		if($id){$this->db->where("id",$id);}
		$this->db->where("country_id",$cid);
		$this->db->order_by("name", "ASC");
		$query = $this->db->get("states");
		if($query->num_rows()>0){
			$result = ($id)? $query->row_array() : $query->result_array();
			return $result;	
		}else{
			return false;	
		}
	}

	public function getCity($sid=false, $id=false){
		if($id){$this->db->where("id", $id);}
		if($sid){$this->db->where("state_id", $sid);}
		$query = $this->db->get("cities");
		if($query->num_rows()>0){
			$result = ($id)? $query->row_array() : $query->result_array();
			return $result;	
		}else{
			return false;	
		}
	}
	public function getLoginDetail($login=false, $uid=false){
		if(!$uid){
			$login = (!$login)?$this->session->userdata("login"):$login;
			$this->db->where("username", $login);
		}
		if($uid){$this->db->where("id", $uid);}
		$query = $this->db->get("user");	
		if($query->num_rows()>0){
			$results = $query->row_array();
			return $results;	
		}else{
			return false;	
		}
	}
	//===============================//
	public function getDefaultTheme($def=false){
		if($def){$this->db->where('default','1');}
		$qry = $this->db->get('theme');
		if($qry->num_rows()>0){
			$res = $qry->row_array();
			return ($def)?$res['style']:$qry->result_array();	
		}else{
			return false;	
		}
	}
	public function updateTheme($style=false){
		if($style){
			$this->db->update("theme", array("default"=>"0"));
			
			$this->db->where("style",$style);
			$this->db->update("theme",array("default"=>"1"));	
		}
	}
	public function getUserType($userType = false){
		if($userType){
			$this->db->where("id",$userType);
		}
		$sql = $this->db->get('user_type');
		if($sql->num_rows()>0){
			$res = ($userType)?$sql->row_array():$sql->result_array();
			return $res;
		}else{
			return false;
		}
	}
	public function get_locations ($lid=false,$clause=false) {
		if($lid){$this->db->where("id",$lid);}
		if($clause){$this->db->where($clause);}
		$this->db->order_by('title', 'ASC');
		$sql = $this->db->get('sys_locations');
		if($sql->num_rows()>0){
			return ($lid)?$sql->row_array():$sql->result_array();
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
}