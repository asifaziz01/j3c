<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Message:: a library for giving feedback to the user
 *
 * @author  Adam Jackett
 * @url http://www.darkhousemedia.com/
 * @version 2.1
 */

class Sms {
    
    var $CI;
	var $api = false;
	var $url = false;
	var $user = false;
	var $password = false;
	var $sender = false;
    function __construct($config=array()){    
        $this->CI =& get_instance();        
        $this->CI->load->library('session');
		$this->url = $this->CI->default_m->getDefaultConfig('sms_url');
		$this->url = ($this->url)?$this->url['value']:false;
		$this->api = $this->CI->default_m->getDefaultConfig('api_key');
		$this->api = ($this->api)?$this->api['value']:false;
		$this->sender = $this->CI->default_m->getDefaultConfig('sender_name');
		$this->sender = ($this->sender)?$this->sender['value']:false;
		$this->user = $this->CI->default_m->getDefaultConfig('sms_user');
		$this->user = ($this->user)?$this->user['value']:false;
		$this->password = $this->CI->default_m->getDefaultConfig('sms_pass');
		$this->password = ($this->password)?$this->password['value']:false;
    }
    
	public function send($mobile=false,$message=false){
		if($mobile && $message){
			$link = $this->url."sendSMS?username=".$this->user."&message=".urlencode($message)."&sendername=".$this->sender."&smstype=TRANS&numbers=".$mobile."&apikey=".$this->api;
			$str = file_get_contents($link);
			$json = json_decode($str, true);
			$json = ($json)?$json[0]:false;
			return ($json['responseCode'])?$json['responseCode']:false;
		}
	}
	public function sendOTP($mobile=false,$name=false){
		if($mobile){
			$OTP = $this->CI->default_m->genrateUniquiId($mobile.$name.time(),6);
			$link = $this->url."sendSMS?username=".$this->user."&message=".urlencode($OTP)."&sendername=".$this->sender."&smstype=TRANS&numbers=".$mobile."&apikey=".$this->api;
			$str = file_get_contents($link);
			$json = json_decode($str, true);
			$json = ($json)?$json[0]:false;
			if($json['responseCode']){
				setcookie('j3c'.$mobile, ($OTP), time()+(30*300), '/');/// only 5 min
				return $json['responseCode'];
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function verifyOTP($mobile=false,$inputVal=false){
		if($mobile && $inputVal){
			if(!empty($_COOKIE['j3c'.$mobile])){
				$storeOTP = $_COOKIE['j3c'.$mobile];
				if($inputVal==$storeOTP){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
	}
}