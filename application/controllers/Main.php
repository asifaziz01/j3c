<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("user_m");
		$this->load->model("main_m");
		$this->load->model("plan_m");
		$this->load->model("enquiry_m");
		if(!$this->session->userdata("login")){
			delete_cookie("loginIn");	
		}else{
			if($this->session->userdata("status")==STATUS_CUSTOMER){
				redirect('public/main');
			}else{
				redirect('admin/main');
			}
		}
		$userType = $this->default_m->getUserType();
		if($userType){
			foreach($userType as $usrtyp){
				$txt = $usrtyp['term'];
				define($txt,$usrtyp['id']);
			}
		}
	}
	public function showStates($country_id=false){
		$states = $this->default_m->getStates(false,$country_id);
		//$this->load->view("default/states", $data);
		echo '<!--<label>Select State</label>
				<select class="form-control" onChange=getData("'.site_url("default/functions/showCity").'/"+this.value+"/'.$country_id.'","city");>-->
				<option value="0">Select</option>';
				foreach($states as $state){
					echo '<option value="'.$state["id"].'">'.$state["name"].'</option>';
				}
		echo '<!--</select>-->';
	}
	
	public function showCity($state_id=false, $url_val=false){
		$cities = $this->default_m->getCity($state_id,false);
		//$url = site_url("main/doctorsList")."/".$url_val."/".$state_id;
		//$this->load->view("default/city", $data);
		//echo '<label>Select State</label>
				//<select class="form-control" onChange="javascript:document.location.href=\''.$url.'/\'+this.value">
				echo '<option value="0">Select</option>';
					foreach($cities as $city){
						echo '<option value="'.$city["id"].'">'.$city["name"].'</option>';
					}
		//echo '</select>';
	}
    public function index () {
		/*$data['technicians'] = $this->technicians_model->get_technicians ();
		$data['tech_categories'] = $this->technicians_model->get_technician_categories ();
		$data['locations'] = $this->common_model->get_locations ();*/
		$data['appliances'] = $this->appliance_m->get_appliances ();
        $data['page_title'] = 'Home';
        $data['slider'] = true;
		$this->load->view ($this->config->item("template_path") . 'header', $data);
        $this->load->view ('index', $data);
        $this->load->view ($this->config->item("template_path") . 'footer', $data);
	}
    public function sendOTP($mobile=false,$name=false){
        if($mobile){
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
    public function services () {
		$lid = ($this->input->post('location'))?$this->input->post('location'):false;
		$cat = ($this->input->post('category'))?$this->input->post('category'):false;
		$data['locations'] = $this->common_model->get_locations ();
		$data['tech_categories'] = $this->technicians_model->get_technician_categories ();
		
        $data['page_title'] = 'Services';
		$data['no_banner']=true;
		$data['technicians'] = $this->appliance_m->get_technicians (false,$lid,$cat);
		$this->load->view ($this->config->item("template_path") . 'header', $data);
        $this->load->view ('services', $data);
        $this->load->view ($this->config->item("template_path") . 'footer', $data);
	}
	public function issueForm($cid=false,$apid=false){
		$data['page_title']='Issue Form';
		$data['no_banner']=true;
		$data['cid'] = $cid;
		$data['apid'] = $apid;
		$this->load->view ($this->config->item("template_path") . 'header', $data);
        $this->load->view ('issueForm', $data);
        $this->load->view ($this->config->item("template_path") . 'footer', $data);
	}
	public function enquiryBox(){
        $data['page_title'] = 'Enquiry';
		$data['no_banner']=true;
		$this->load->view ($this->config->item("template_path") . 'header', $data);
        $this->load->view ('enquiryBox', $data);
        $this->load->view ($this->config->item("template_path") . 'footer', $data);
	}
	public function finalCheckout(){
        $data['page_title'] = 'Final Checkout';
		$data['no_banner']=true;
		$this->load->view ($this->config->item("template_path") . 'header', $data);
        $this->load->view ('finalCheckout', $data);
        $this->load->view ($this->config->item("template_path") . 'footer', $data);
	}
	public function privecy_policy(){
		$data['page_title']='Privecy & Policy';
		$data['no_banner']=true;
		$this->load->view ($this->config->item("template_path") . 'header', $data);
        $this->load->view ('privecy_policy', $data);
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
	public function showCart(){
		if(!empty($_COOKIE['just3click_cart'])){
			$orders = $_COOKIE['just3clickItems'];
			$orders = explode(',',$orders);
			$totalprice=0;$totaloffer=0;$price='';
			echo '<table>
					<thead><th>Appliance</th><th>Brand</th><th>Type</th><th>Issue</th><th>Qty.</th><th>Price</th><th>Offer</th><th>Amt</th><th></th></thead>
					<tbody>';
					if($orders){
						foreach($orders as $order){
							$items = explode('-',$order);
							$appliance = $this->appliance_m->get_appliance($items[0]);
							$brand = $this->appliance_m->get_brands(false,$items[1]);
							$type = $this->appliance_m->get_appliance_types(false,$items[2]);
							$issue = $this->appliance_m->get_issues(false,$items[3]);
							echo '<tr>';
							echo '<td data-label="Appliance">'.$appliance['appliance_name'].'</td>';
							echo '<td data-label="Brand">'.$brand['brand_name'].'</td>';
							echo '<td data-label="Type">'.$type['type_name'].'</td>';
							echo '<td data-label="Issue">'.$issue['issue_title'].'</td>';
							echo '<td data-label="Qty."><input type="number" onchange="if(this.value<=0){this.value=1;}else{calculatePrice(this.value,\''.$issue['offer_price'].'\',\''.$order.'\')}" name="qty_'.$order.'" value="1" style="width:50px;" /></td>';
							echo '<td align="right" data-label="Price"><strike>'.$issue['price'].'</strike></td>';
							echo '<td align="right" data-label="Offer">'.$issue['offer_price'].'</td>';
							echo '<td align="right" id="'.$order.'_amt" data-label="Amt">'.$issue['offer_price'].'</td>';
							echo '<td><a href="javascript:void(0);" onclick="deleteCartItem(\''.$order.'\')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>';
							echo '</tr>';
							$price .= $issue['offer_price'].',';
							$totalprice +=$issue['price'];
							$totaloffer +=$issue['offer_price'];
						}
						$price = substr($price,0,-1);
						echo '<input type="hidden" name="items_price" value="'.$price.'" />';
						echo '<tr><td colspan="5"></td><td align="right" data-label="Tot. Price"><strike>'.$totalprice.'</strike></td><td align="right" data-label="Tot. Offer">'.$totaloffer.'</td><td id="tamt" align="right" data-label="Tot. Amt">'.$totaloffer.'</td><td></td></tr>';
						echo '<tr><td colspan="9" onclick="isGST()" style="cursor:pointer;"><i id="isGSTcheck" class="fa fa-remove text-danger"></i> Want to GST bill?</td></tr>';
					}
			echo '</tbody></table>';
		}else{
			echo false;
		}
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
	public function getAutoAddressByCoord($lat=false,$lng=false){
		if($lat && $lng){
			$link = 'http://apis.mapmyindia.com/advancedmaps/v1/'.MAP_API.'/rev_geocode?lat='.$lat.'&lng='.$lng;
			$contents = file_get_contents($link);
			$data = json_decode($contents);
			$results = ($data->responseCode=='200')?$data->results[0]:false;
			$results = ($results)?json_encode($results):false;
			echo $results;
		}
	}
	public function contact()
	{
		$data['page_title']="Contact Us";
		
		$this->load->view($this->config->item('template_path') . 'header', $data);
		$this->load->view('contact_us');
		$this->load->view($this->config->item('template_path') . 'footer', $data);
	}
	public function add_feedback(){
		if(!$this->session->userdata('login')){
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric');
			$this->form_validation->set_rules('email', 'Email', 'required');
		}
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('message', 'Message', 'required');
		$this->form_validation->run();
		if ($this->form_validation->run() == true)  {
			$this->main_m->addFeedback();
			$this->message->set("Action completed successfully!","success",true);
		}
		redirect("main");
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
            redirect('main/finalCheckout');
		}
        //$this->load->view (INCLUDE_PATH . 'header', $data);
        //$this->load->view ('public/services/enquiryConfirm', $data);
        //$this->load->view (INCLUDE_PATH . 'footer', $data);
        /*$data['page_title'] = 'Search Result';
		$this->load->view (INCLUDE_PATH . 'header', $data);
        $this->load->view ('public/services/search', $data);
        $this->load->view (INCLUDE_PATH . 'footer', $data);*/
	}
}
