<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("user_m");
		$this->load->model("main_m");
		$this->load->model("wallet_m");
		$this->load->model("plan_m");
		$this->load->model('enquiry_m');
		if(!$this->session->userdata("login")){
			delete_cookie("loginIn");
			redirect("main");
		}
		$userType = $this->default_m->getUserType();
		if($userType){
			foreach($userType as $usrtyp){
				$txt = $usrtyp['term'];
				define($txt,$usrtyp['id']);
			}
		}
	}
	public function index($userinfo=false){
		$data['page_title'] = "Home";
        $data['slider'] = true;
		$this->load->view($this->config->item("template_path").'header',$data);
		$this->load->view('public/index',$data);
		$this->load->view($this->config->item("template_path").'footer',$data);
	}
	public function sendSMS(){
		$message = 'Your Login Id - admin'.PHP_EOL.'Password - test1234';
		$this->sms->send('9795246784', $message);
	}
    public function sendOTP($mobile=false,$name=false){
        if($mobile && $name){
            $res = $this->sms->sendOTP($mobile,$name);
            echo $res?$res:false;
        }else{
            return false;
        }
    }
    public function verifyOTP($mobile=false,$val=false){
        if($mobile && $val){
            $res = $this->sms->verifyOTP($mobile,$val);
            echo $res?'OTP Verify!':false; 
        }else{
            return false;
        }
    }
	public function issueForm($cid=false,$apid=false){
		$data['page_title']='Issue Form';
		$data['no_banner']=true;
		$data['cid'] = $cid;
		$data['apid'] = $apid;
		$this->load->view ($this->config->item("template_path") . 'header', $data);
        $this->load->view ('public/issueForm', $data);
        $this->load->view ($this->config->item("template_path") . 'footer', $data);
	}
	public function issuesList($apid=false){
		if($apid){
			if(!empty($_COOKIE['just3click_cart'])){
				$orders = $_COOKIE['just3clickItems'];
				$orders = explode(',',$orders);
				$totalprice=0;$totaloffer=0;$price='';
				echo '<table class="table">
				<thead><th>Appliance</th><th>Issue</th><th></th></thead>
				<tbody>';
				if($orders){
					foreach($orders as $order){
						$items = explode('-',$order);
						if($items[0]==$apid){
							$appliance = $this->appliance_m->get_appliance($items[0]);
							$brand = $this->appliance_m->get_brands(false,$items[1]);
							$type = $this->appliance_m->get_appliance_types(false,$items[2]);
							$issue = $this->appliance_m->get_issues(false,$items[3]);
							echo '<tr>';
							echo '<td data-label="Appliance">'.$appliance['appliance_name'].'</td>';
							echo '<td data-label="Issue">'.$issue['issue_title'].'</td>';
							echo '<td><a href="javascript:void(0);" onclick="deleteCartItem(\''.$order.'\')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>';
							echo '</tr>';
							$price .= (($issue['offer_price'])?$issue['offer_price']:$issue['price']).',';
							$totalprice +=(($issue['offer_price'])?$issue['offer_price']:$issue['price']);
							$totaloffer +=$issue['offer_price'];
						}
					}
					$price = substr($price,0,-1);
					echo '<input type="hidden" name="items_price" value="'.$price.'" />';
					echo '<tr><td colspan="2" align="right">Charge : Rs. '.$totalprice.'</td><td></td></tr>';
				}
				echo '</tbody></table>';
			}
		}
	}
	public function issueInfo($id=false){
		if($id){
			$issue = $this->appliance_m->get_issues(false,$id);
			if($issue){
				echo '<span style="color:red;">*</span> <small>'.$issue['description'].'</small>';
			}
		}
	}
	public function enquiryBox(){
        $data['page_title'] = 'Enquiry';
		$data['no_banner']=true;
		$this->load->view ($this->config->item("template_path") . 'header', $data);
        $this->load->view ('public/enquiryBox', $data);
        $this->load->view ($this->config->item("template_path") . 'footer', $data);
	}
	public function finalCheckout(){
        $data['page_title'] = 'Final Checkout';
		$data['no_banner']=true;
		$res = $this->sms->sendOTP($this->session->userdata('login'),$this->session->userdata('name'));
		$this->load->view ($this->config->item("template_path") . 'header', $data);
        $this->load->view ('public/finalCheckout', $data);
        $this->load->view ($this->config->item("template_path") . 'footer', $data);
	}
	public function appOptions($id=false){
		if($id){
			$appliance = $this->appliance_m->get_appliances ($id);
			if($appliance){
				echo '<option value="">Select Appliance</option>';
				foreach($appliance as $app){
					echo '<option value="'.$app['appliance_id'].'">'.$app['appliance_name'].'</option>';
				}
			}
		}
	}
	public function createOptions($field=false,$id=false){
		if($field){
			switch ($field){
				case 'brand':
					$brands = $this->appliance_m->get_brands ($id);
					if($brands){
						echo '<option value="">Select Brand</option>';
						foreach($brands as $brand){
							echo '<option value="'.$brand['brand_id'].'">'.$brand['brand_name'].'</option>';
						}
					}
				break;
				case 'type':
					$types = $this->appliance_m->get_appliance_types ($id);
					if($types){
						echo '<option value="">Select Type</option>';
						foreach($types as $type){
							echo '<option value="'.$type['type_id'].'">'.$type['type_name'].'</option>';
						}
					}
				break;
				case 'issue':
					$issues = $this->appliance_m->get_issues ($id);
					if($issues){
						echo '<option value="">Select Issue</option>';
						foreach($issues as $issue){
							echo '<option value="'.$issue['issue_id'].'" >'.$issue['issue_title'].'</option>';
						}
					}
				break;
			}
		}
	}
	public function myBooking(){
        $data['page_title'] = 'My Booking';
		$data['enquiries'] = $this->enquiry_m->get_enquiries(false,array('customer_id'=>$this->session->userdata('id')));
		$this->load->view ($this->config->item("template_path") . 'header', $data);
        $this->load->view ('public/myBooking', $data);
        $this->load->view ($this->config->item("template_path") . 'footer', $data);
	}
	public function details($enc_id=false){
		$data['enc_id']=$enc_id;
		$data['enc'] = $this->enquiry_m->get_enquiries($enc_id);
		$data['page_title'] = 'Enquiry Details';
        $this->load->view ($this->config->item('template_path') . 'header', $data);
        $this->load->view ('public/details', $data);
        $this->load->view ($this->config->item('template_path') . 'footer');
	}
	public function search () {
        $this->form_validation->set_rules("customer_name","Customer Name","required");
        $this->form_validation->set_rules("mobile","Mobile","required");
        $this->form_validation->set_rules("location","Location","required");
        $this->form_validation->set_rules("map_location","Map Location","required");
        $this->form_validation->set_rules("address","Address","required");
        if($this->form_validation->run()==true){
            $user = $this->user_m->getUser(false,array("phone"=>$this->input->post('mobile')));
            $data['technicians'] = $technicians = $this->user_m->get_technicians ($this->input->post('appliance'),$this->input->post('location'));
            if(!$user){
                $pass = $this->default_m->genrateUniquiId(time(),6);
                $id = $this->user_m->saveCustomerInfo($pass);
                $user = $this->user_m->getUser($id);
                $mobile = $user['phone'];
                $message = 'You are register on just3click.com'.PHP_EOL.'Your id - '.$user['username'].PHP_EOL.'Password - '.$pass.PHP_EOL. 'Service Provider contact you soon. Thank You.';
                $res = $this->sms->send($mobile,$message);
            }else{
                $user = ($user)?$user[0]:false;
                $id = $user['id'];
                $mobile = $user['phone'];
                $message = 'You are already registered on just3click.com'.PHP_EOL. 'Service Provider contact you soon. Thank You.';
                $res = $this->sms->send($mobile,$message);
            }
            $_POST['items'] = $_COOKIE['just3clickItems'];
            $items = explode(",",$_POST['items']);
            $qty=false;$_POST['qty']='';
            if($items){
                foreach($items as $item){
                    $qty[] = 1;//$_POST['qty_'.$item];
                }
                $_POST['qty'] = implode(",",$qty);
            }
            $this->enquiry_m->save_enquiry($id);
            delete_cookie('just3click_cart');
            delete_cookie('just3clickItems');

            if($technicians){
                $contacts=false;
                foreach($technicians as $tech){
                    $contacts[]=$tech['phone'];
                }
                //print_r($contacts);exit;
                if($contacts){
                    $contacts = implode(",",$contacts);
                    $message = 'One query submited from your location from '.$user['name'].', check your customer query list.';
                    $res = $this->sms->send($contacts,$message);
                }
            }
            if ($remember == 1) {				
                setcookie('remember', md5($row->username), time()+12*3600, '/');
            }
            $this->session->set_userdata( array(
                            'login'			=> $user['username'],
                            'id'			=> $user['id'],
                            'name'			=> $user['name'],
                            'email'			=> $user['email'],
                            'role_id'		=> $user['status'],
                            'status'		=> $user['status'],
                            'isLoggedIn'	=> true
                            ));
            
            $this->message->set("Successfully signed in.","success", true);
			$this->session->set_userdata("group_id",$user['status']);
            redirect('public/main/myBooking/');
        }else{
			$this->message->set(((validation_errors())?validation_errors():"Please try again!"),"danger", true);
            redirect('public/main/finalCheckout');
		}
        //$this->load->view (INCLUDE_PATH . 'header', $data);
        //$this->load->view ('public/services/enquiryConfirm', $data);
        //$this->load->view (INCLUDE_PATH . 'footer', $data);
        /*$data['page_title'] = 'Search Result';
		$this->load->view (INCLUDE_PATH . 'header', $data);
        $this->load->view ('public/services/search', $data);
        $this->load->view (INCLUDE_PATH . 'footer', $data);*/
	}
	public function reviews(){
        $data['page_title'] = 'Review';
		$data['feedback'] = $this->main_m->getFeedback(false,array('mobile'=>$this->session->userdata('login')));
		$this->load->view ($this->config->item("template_path") . 'header', $data);
        $this->load->view ('public/reviews', $data);
        $this->load->view ($this->config->item("template_path") . 'footer', $data);
	}
	public function add_feedback($eid=false){
		$data['eid'] = $eid;
		if(!$this->session->userdata('id')){
			$this->form_validation->set_rules('cname', 'Name', 'required');
			$this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric');
			$this->form_validation->set_rules('email', 'Email', 'required');
		}
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('message', 'Message', 'required');
		
		if ($this->form_validation->run() == true)  {
			$this->main_m->addFeedback();
			redirect("public/main/reviews");
		}
		$data['page_title']="Review";
		$this->load->view($this->config->item('template_path') . 'header', $data);
		$this->load->view('public/newFeedback');
		$this->load->view($this->config->item('template_path') . 'footer', $data);
	}
	public function deleteFeedback($id=false){
		if($id){
			$this->main_m->deleteFeedback($id);
			$this->message->set("feedback delete successfully!","success",true);
		}
		redirect('public/main/reviews');
	}
	public function getRank($eid=false){
		if($eid){
			$enquiry = $this->enquiry_m->get_enquiries($eid);
			echo '<form method="post" id="rnkfrm">';
				echo '<div class="form-group">
					<label class="label-control col-md-4 col-sm-12 col-xs-12">Rank</label>
					<div class="col-md-8 col-sm-12 col-xs-12">
						<select name="rank" class="form-control" onchange="saveRank(this.value,'.$enquiry['technician_id'].')">
							<option value="1">1 Star</option>
							<option value="2">2 Star</option>
							<option value="3">3 Star</option>
							<option value="4">4 Star</option>
							<option value="5" selected>5 Star</option>
						</select>
					</div>
					<br clear="all" />
					</div>';
			echo '</form>';
		}
	}
	public function saveRank($rank=false,$tid=false){
		if($rank && $tid){
			$res = $this->main_m->saveRank($rank,$tid);
			if($res){
				echo 1;
			}else{
				false;
			}
		}
	}
	//==== add Profile pic ========
	public function addProfilePic($uid=false,$img=false,$folder=false){
		//===== image uploading code ======
		$img = ($img)?$img:$_POST['profile_pic'];
		if($img){
			$img = str_replace("[removed]","", $img);
			$img = str_replace(' ', '+', $img);

			$user = $this->user_m->getUser($uid);
			$folderName = ($folder)?$folder:'profile_pic';
			$imgpath = realpath($this->config->item('filemanager').$folderName)."/";
			$imgname = 'user_'.$user['id'] . '.png';

			$source = fopen($img, 'r');
			$destination = fopen($imgpath.$imgname, 'w');
			
			if(stream_copy_to_stream($source, $destination)){
				$imgdata = array("uid"=>$uid,"filename"=>$imgname,"type"=>"image/png");
				$this->user_m->addProfilePic($uid,$imgdata);
				$this->message->set("Action Completed Successfully!","success", true);
			}else{
				$this->message->set("Image not upload!","danger", true);
			}
			
			fclose($source);
			fclose($destination);

			/*$img = str_replace('data:image/png;base64,', '', $img);
			$data = base64_decode($img);
			$imgname = $user['ABO'] . '.png';
			$file = $imgpath . $imgname;
			$success = file_put_contents($file, $data);*/
		}else{
			$this->message->set("Please Select an Image for profile picture!","danger", true);
		}
	}
	public function editProfile(){
		$id = $this->session->userdata('id');
		$this->form_validation->set_rules("uname","Name","required");
		$this->form_validation->set_rules("gender","Gender","required");
		$this->form_validation->set_rules("address","Address","required");
		if($this->form_validation->run()==true){
			$this->user_m->create_user($id);
			if($_POST['profile_pic'] && $id){
				$this->addProfilePic($id,$_POST['profile_pic']);
			}
			$this->message->set("Profile Updation successfull!","success",true);
			redirect("public/main/userProfile");
		}
		$data['page_title'] = 'Update Profile';
		$data['me'] = $this->user_m->getUser($this->session->userdata('id'));
		$this->load->view ($this->config->item("template_path") . 'header', $data);
		$this->load->view ('public/editProfile', $data);
		$this->load->view ($this->config->item("template_path") . 'footer', $data);
	}
	public function userProfile(){
		$data['page_title'] = 'Profile';
		$data['me'] = $this->user_m->getUser($this->session->userdata('id'));
		$this->load->view ($this->config->item("template_path") . 'header', $data);
		$this->load->view ('public/userProfile', $data);
		$this->load->view ($this->config->item("template_path") . 'footer', $data);
	}
	public function changePassword(){
		$data['page_title'] = 'Change Password';
		$data['me'] = $this->user_m->getUser($this->session->userdata('id'));
		$this->load->view ($this->config->item("template_path") . 'header', $data);
		$this->load->view ('public/changePassword', $data);
		$this->load->view ($this->config->item("template_path") . 'footer', $data);
	}
}