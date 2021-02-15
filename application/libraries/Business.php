<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Business:: a library for giving business function for MLM
 *
 * @author  Raghvendra pal singh
 * @url http://www.wwebtech.com/
 * @version 2.0
 */

class Business {
    var $CI;
    var $messages = array();
    var $wrapper = array('', '');

    function __construct(){    
        $this->CI =& get_instance();        
        $this->CI->load->model('product_m');
        $this->CI->load->model('mlm_m');
        $this->CI->load->model('default_m');
        
        //if($this->CI->session->flashdata('_messages')) $this->messages = $this->CI->session->flashdata('_messages');
        //if(isset($config['wrapper'])) $this->wrapper = $config['wrapper'];
    }
	
	public function like_match($pattern, $subject)
	{
		$pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
		return (bool) preg_match("/^{$pattern}$/i", $subject);
	}
    	
	public function binaryTreeView($userId=false,$view_type=BINARY){
		if($userId){
			$user = $this->CI->user_m->getUser($userId);
			$users = $this->CI->user_m->getUser(false,array("status"=>STATUS_CUSTOMER));
			if($user){
				$bvlabel='';$legs=false;
				$uprow = $this->CI->user_m->getUser(false, array("ABO"=>$user['sponser_id']));
				$uprow = ($uprow)?$uprow[0]:false;
				$uparw = ($user['sponser_id'] && $user['id']!=$this->CI->session->userdata("id"))?' <i class="icon-arrow-up text-default"></i>':'';
				$rootlnk = ($user['sponser_id'] && $user['id']!=$this->CI->session->userdata("id"))?site_url("admin/mlm/downlineTreeView/".$view_type."/".$uprow['id']):'javascript:void(0);';
				$prdct=false;
				//$fif = $this->CI->mlm_m->getUserProduct($user['id']);
				//$prdct = $this->CI->mlm_m->get_product_detail($fif['product_id']);
				$prdct = ($prdct)?$prdct[0]:false;
				$actvt = $user['activate'];
				$actvt = ($actvt)?'class="green-bg"':'class="red-bg"';
				$selPKG = $this->CI->product_m->userSelectPackage($user['id']);
				$legs =$this->countLeg($user['ABO'],$users,'enable');
				$bvlabel=br(1).'<label class="label label-danger">LT. Leg. ('.$legs['leftLG'].')</label> <label class="label label-danger">RT. Leg. ('.$legs['rightLG'].')</label>';
				//if($user['activate']){
					//if($selPKG){
						//$bvamt = $selPKG['bv'];
						$ltbv=$legs['leftBV'];
						$rtbv=$legs['rightBV'];
						$bvlabel .= br(1).'<label class="label label-warning">LT. BV. ('.$ltbv.')</label> <label class="label label-warning">RT. BV. ('.$rtbv.')</label>';
					//}
				//}
				$img1 = "<img class='img-circle img-responsive' src='".base_url($this->CI->config->item("backend_path").'plugins/tree/user.png')."' />";
				$no_user = "<img class='img-circle img-responsive' src='".base_url($this->CI->config->item("backend_path").'plugins/tree/no_user.png')."' />";
				echo '<div class="familytree">
						<ul>
							<li>
								<a href="'.$rootlnk.'" '.$actvt.'>'.($img1.$user['name'].$uparw.$bvlabel.br(1).'('.$user['ABO'].')').'</a>';
								$downline1 = $this->CI->user_m->getUser(false,array('sponser_id'=>$user['ABO']),"leg ASC");
								if($downline1){
									if(count($downline1)==1 && $downline1[0]['leg']==RIGHT) {
										$downline1 = array_merge(array(array("id"=>"?","username"=>"None","name"=>"Blank Leg","leg"=>LEFT)),$downline1); 
									}else if(count($downline1)==1 && $downline1[0]['leg']==LEFT) {
										$downline1 = array_merge($downline1,array(array("id"=>"?","username"=>"None","name"=>"Blank Leg","leg"=>RIGHT))); 
									}
									echo '<ul>';
									foreach($downline1 as $dwn1){
										if($dwn1['id']!="?"){
											$lgsts=($dwn1['leg']==LEFT)?'<i class="icon-arrow-left text-3x"></i>':'<i class="icon-arrow-right text-3x"></i>';
											//$fif = $this->CI->mlm_m->getUserProduct($dwn1['id']);
											//$prdct = $this->CI->mlm_m->get_product_detail($fif['product_id']);
											$prdct=false;
											$prdct = ($prdct)?$prdct[0]:false;

											$actvt = $dwn1['activate'];//$this->CI->default_m->selectedPkgAmt($dwn1['id']);
											$actvt = ($actvt)?'class="green-bg"':'class="red-bg"';

											$bvlabel='';
											/*$selPKG = $this->CI->product_m->userSelectPackage($dwn1['id']);
											$legs =$this->countLeg($dwn1['ABO'],$users,'enable');
											$bvlabel=br(1).'<label class="label label-danger">LT. Leg. ('.$legs['leftLG'].')</label> <label class="label label-danger">RT. Leg. ('.$legs['rightLG'].')</label>';
											if($dwn1['activate']){
												if($selPKG){
													$bvamt = $selPKG['bv'];
													$ltbv=$legs['leftBV'];
													$rtbv=$legs['rightBV'];
													$bvlabel .= br(1).'<label class="label label-warning">LT. BV. ('.$ltbv.')</label> <label class="label label-warning">RT. BV. ('.$rtbv.')</label>';
												}
											}*/

											echo '<li><a href="'.site_url("admin/mlm/downlineTreeView/".$view_type."/".$dwn1['id']).'" '.$actvt.'>'.($img1.$dwn1['name'].$bvlabel.br(1).'('.$dwn1['ABO'].')').br(1).$lgsts.'</a>';
											$downline2 = $this->CI->user_m->getUser(false,array('sponser_id'=>$dwn1['ABO']),"leg ASC");
											if($downline2){
												if(count($downline2)==1 && $downline2[0]['leg']==RIGHT) {
													$downline2 = array_merge(array(array("id"=>"?","username"=>"None","name"=>"Blank Leg","leg"=>LEFT)),$downline2); 
												}else if(count($downline2)==1 && $downline2[0]['leg']==LEFT) {
													$downline2 = array_merge($downline2,array(array("id"=>"?","username"=>"None","name"=>"Blank Leg","leg"=>RIGHT))); 
												}
												echo '<ul>';
												foreach($downline2 as $dwn2){
													if($dwn2['id']!="?"){
														$lgsts=($dwn2['leg']==LEFT)?'<i class="icon-arrow-left text-3x"></i>':'<i class="icon-arrow-right text-3x"></i>';
														//$fif = $this->CI->mlm_m->getUserProduct($dwn2['id']);
														//$prdct = $this->CI->mlm_m->get_product_detail($fif['product_id']);
														$prdct=false;
														$prdct = ($prdct)?$prdct[0]:false;
				
														$actvt = $dwn2['activate'];//$this->CI->default_m->selectedPkgAmt($dwn2['id']);
														$actvt = ($actvt)?'class="green-bg"':'class="red-bg"';

														$bvlabel='';
														/*$selPKG = $this->CI->product_m->userSelectPackage($dwn2['id']);
														$legs =$this->countLeg($dwn2['ABO'],$users,'enable');
														$bvlabel=br(1).'<label class="label label-danger">LT. Leg. ('.$legs['leftLG'].')</label> <label class="label label-danger">RT. Leg. ('.$legs['rightLG'].')</label>';
														if($dwn2['activate']){
															if($selPKG){
																$bvamt = $selPKG['bv'];
																$ltbv=$legs['leftBV'];
																$rtbv=$legs['rightBV'];
																$bvlabel .= br(1).'<label class="label label-warning">LT. BV. ('.$ltbv.')</label> <label class="label label-warning">RT. BV. ('.$rtbv.')</label>';
															}
														}*/

														echo '<li><a href="'.site_url("admin/mlm/downlineTreeView/".$view_type."/".$dwn2['id']).'" '.$actvt.'>'.($img1.$dwn2['name'].$bvlabel.br(1).'('.$dwn2['ABO'].')').br(1).$lgsts.'</a>';
														$downline3 = $this->CI->user_m->getUser(false,array('sponser_id'=>$dwn2['ABO']),"leg ASC");
														if($downline3){
															if(count($downline3)==1 && $downline3[0]['leg']==RIGHT) {
																$downline3 = array_merge(array(array("id"=>"?","username"=>"None","name"=>"Blank Leg","leg"=>LEFT)),$downline3); 
															}else if(count($downline3)==1 && $downline3[0]['leg']==LEFT) {
																$downline3 = array_merge($downline3,array(array("id"=>"?","username"=>"None","name"=>"Blank Leg","leg"=>RIGHT))); 
															}
															echo '<ul>';
															foreach($downline3 as $dwn3){
																if($dwn3['id']!="?"){
																	$lgsts=($dwn3['leg']==LEFT)?'<i class="icon-arrow-left text-2x"></i>':'<i class="icon-arrow-right text-2x"></i>';
																	$prdct=false;
																	$prdct = ($prdct)?$prdct[0]:false;
							
																	$actvt = $dwn3['activate'];//$this->CI->default_m->selectedPkgAmt($dwn3['id']);
																	$actvt = ($actvt)?'class="green-bg"':'class="red-bg"';

																	$bvlabel='';
																	/*$selPKG = $this->CI->product_m->userSelectPackage($dwn3['id']);
																	$legs =$this->countLeg($dwn3['ABO'],$users,'enable');
																	$bvlabel=br(1).'<label class="label label-danger">LT. Leg. ('.$legs['leftLG'].')</label> <label class="label label-danger">RT. Leg. ('.$legs['rightLG'].')</label>';
																	if($dwn3['activate']){
																		if($selPKG){
																			$bvamt = $selPKG['bv'];
																			$ltbv=$legs['leftBV'];
																			$rtbv=$legs['rightBV'];
																			$bvlabel .= br(1).'<label class="label label-warning">LT. BV. ('.$ltbv.')</label> <label class="label label-warning">RT. BV. ('.$rtbv.')</label>';
																		}
																	}*/

																	echo '<li><a href="'.site_url("admin/mlm/downlineTreeView/".$view_type."/".$dwn3['id']).'" '.$actvt.'>'.($img1.$dwn3['name'].$bvlabel.br(1).'('.$dwn3['ABO'].')').br(1).$lgsts.'</a>';
																	/*$downline4 = $this->CI->user_detail->get_detail(false,array('sponser_id'=>$dwn3['id']));
																	if($downline4){
																		echo '<ul>';
																		foreach($downline4 as $dwn4){
																			echo '<li><a href="'.site_url("mlm/downlineTreeView/".$dwn4['id']).'">'.$dwn4['name'].'</a></li>';
																		}
																		echo '</ul>';
																	}*/
																	echo '</li>';
																}else{
																	$lgsts=($dwn3['leg']==LEFT)?'<i class="icon-arrow-left text-danger text-2x"></i>':'<i class="icon-arrow-right text-danger text-2x"></i>';
																	echo '<li><a href="javascript:void(0);">'.($no_user.$dwn3['name'].br(1).'(------)').br(1).$lgsts.'</a>';
																	echo '</li>';
																}
															}
															echo '</ul>';
														}else{
															echo '<ul><li><a href="javascript:void(0);">'.($no_user.'Blank Leg'.br(1).'(------)').br(1).'<i class="icon-arrow-left text-danger text-2x"></i></a>';
															echo '</li>';
															echo '<li><a href="javascript:void(0);">'.($no_user.'Blank Leg'.br(1).'(------)').br(1).'<i class="icon-arrow-left text-danger text-2x"></i></a>';
															echo '</li></ul>';
														}
														echo '</li>';
													}else{
														$lgsts=($dwn2['leg']==LEFT)?'<i class="icon-arrow-left text-danger text-2x"></i>':'<i class="icon-arrow-right text-danger text-2x"></i>';
														echo '<li><a href="javascript:void(0);">'.($no_user.$dwn2['name'].br(1).'(------)').br(1).$lgsts.'</a>';
															echo '<ul><li><a href="javascript:void(0);">'.($no_user.'Blank Leg'.br(1).'(------)').br(1).'<i class="icon-arrow-left text-danger text-2x"></i></a>';
															echo '</li>';
															echo '<li><a href="javascript:void(0);">'.($no_user.'Blank Leg'.br(1).'(------)').br(1).'<i class="icon-arrow-left text-danger text-2x"></i></a>';
															echo '</li></ul>';
														echo '</li>';
													}
												}
												echo '</ul>';
											}else{
												echo '<ul><li><a href="javascript:void(0);">'.($no_user.'Blank Leg'.br(1).'(------)').br(1).'<i class="icon-arrow-left text-danger text-2x"></i></a>';
												echo '</li>';
												echo '<li><a href="javascript:void(0);">'.($no_user.'Blank Leg'.br(1).'(------)').br(1).'<i class="icon-arrow-left text-danger text-2x"></i></a>';
												echo '</li></ul>';
											}
											echo '</li>';
										}else{
											$lgsts=($dwn1['leg']==LEFT)?'<i class="icon-arrow-left text-danger text-2x"></i>':'<i class="icon-arrow-right text-danger text-2x"></i>';
											echo '<li><a href="javascript:void(0);">'.($no_user.$dwn1['name'].br(1).'(------)').br(1).$lgsts.'</a>';
												echo '<ul><li><a href="javascript:void(0);">'.($no_user.'Blank Leg'.br(1).'(------)').br(1).'<i class="icon-arrow-left text-danger text-2x"></i></a>';
												echo '</li>';
												echo '<li><a href="javascript:void(0);">'.($no_user.'Blank Leg'.br(1).'(------)').br(1).'<i class="icon-arrow-left text-danger text-2x"></i></a>';
												echo '</li></ul>';
											echo '</li>';
										}
									}
									echo '</ul>';
								}
							echo '</li>';
						echo '</ul>
					  </div>';
			}else{
				return false;	
			}
		}else{
			return false;	
		}
	}
	public function genericTreeView($userId=false,$view_type=BINARY){
		if($userId){
			$users = $this->CI->user_m->getUser($userId);
			if($users){
				$uprow = $this->CI->user_m->getUser(false, array("ABO"=>$users['sponser_id']));
				$uprow = ($uprow)?$uprow[0]:false;
				$uparw = ($users['sponser_id'] && $users['id']!=$this->CI->session->userdata("id"))?' <i class="icon-arrow-up"></i>':'';
				$rootlnk = ($users['sponser_id'] && $users['id']!=$this->CI->session->userdata("id"))?site_url("admin/mlm/downlineTreeView/".$view_type."/".$uprow['id']):'javascript:void(0);';
				
				//$fif = $this->CI->mlm_m->getUserProduct($users['id']);
				//$prdct = $this->CI->mlm_m->get_product_detail($fif['product_id']);
				$prdct=false;
				$prdct = ($prdct)?$prdct[0]:false;
				
				$img1 = "<img class='img-circle img-responsive' src='".base_url($this->CI->config->item("backend_path").'plugins/tree/user.png')."' />";
				$selPKG = $this->CI->default_m->selectedPkgAmt($users['id']);
				$selPKG = ($selPKG)?'class="green-bg"':'';
				echo '<div class="familytree">
						<ul>
							<li>
								<a href="'.$rootlnk.'" '.$selPKG.'>'.($img1.$users['name'].$uparw.br(1).'('.$users['ABO'].')').'</a>';
								$downline1 = $this->CI->user_m->getUser(false,array('parent'=>$users['ABO']));
								if($downline1){
									echo '<ul>';
									foreach($downline1 as $dwn1){

										//$fif = $this->CI->mlm_m->getUserProduct($dwn1['id']);
										//$prdct = $this->CI->mlm_m->get_product_detail($fif['product_id']);
										$prdct=false;
										$prdct = ($prdct)?$prdct[0]:false;

										$selPKG = $this->CI->default_m->selectedPkgAmt($dwn1['id']);
										$selPKG = ($selPKG)?'class="green-bg"':'';
										echo '<li><a href="'.site_url("admin/mlm/downlineTreeView/".$view_type."/".$dwn1['id']).'" '.$selPKG.'>'.($img1.$dwn1['name'].br(1).'('.$dwn1['ABO'].')').'</a>';
										$downline2 = $this->CI->user_m->getUser(false,array('parent'=>$dwn1['ABO']));
										if($downline2){
											echo '<ul>';
											foreach($downline2 as $dwn2){

												//$fif = $this->CI->mlm_m->getUserProduct($dwn2['id']);
												//$prdct = $this->CI->mlm_m->get_product_detail($fif['product_id']);
												$prdct=false;
												$prdct = ($prdct)?$prdct[0]:false;
		
												$selPKG = $this->CI->default_m->selectedPkgAmt($dwn2['id']);
												$selPKG = ($selPKG)?'class="green-bg"':'';
												echo '<li><a href="'.site_url("admin/mlm/downlineTreeView/".$view_type."/".$dwn2['id']).'" '.$selPKG.'>'.($img1.$dwn2['name'].br(1).'('.$dwn2['ABO'].')').'</a>';
												$downline3 = $this->CI->user_m->getUser(false,array('parent'=>$dwn2['ABO']));
												if($downline3){
													echo '<ul>';
													foreach($downline3 as $dwn3){
		
														//$fif = $this->CI->mlm_m->getUserProduct($dwn3['id']);
														//$prdct = $this->CI->mlm_m->get_product_detail($fif['product_id']);
														$prdct=false;
														$prdct = ($prdct)?$prdct[0]:false;
				
														$selPKG = $this->CI->default_m->selectedPkgAmt($dwn3['id']);
														$selPKG = ($selPKG)?'class="green-bg"':'';
														echo '<li><a href="'.site_url("admin/mlm/downlineTreeView/".$view_type."/".$dwn3['id']).'" '.$selPKG.'>'.($img1.$dwn3['name'].br(1).'('.$dwn3['ABO'].')').'</a>';
														/*$downline4 = $this->CI->user_detail->get_detail(false,array('parent'=>$dwn3['id']));
														if($downline4){
															echo '<ul>';
															foreach($downline4 as $dwn4){
																echo '<li><a href="'.site_url("mlm/downlineTreeView/".$dwn4['id']."/".GENERIC).'">'.$dwn4['name'].'</a></li>';
															}
															echo '</ul>';
														}*/
														echo '</li>';
													}
													echo '</ul>';
												}
												echo '</li>';
											}
											echo '</ul>';
										}
										echo '</li>';
									}
									echo '</ul>';
								}
				echo '		</li>
						</ul>
					  </div>';
			}else{
				return false;	
			}
		}else{
			return false;	
		}
	}
	
	public function countLeg($userId=false, $users=false, $status='enable', $dateLike=false){
		if($userId){
			$spnsr_id=$userId;$legs=2;$totalLeftLG=0;$totalRightLG=0;$prvLeftLG=0;$prvRightLG=0;$lftBV=0;$rtBV=0;
			$ltProBus = 0;$rtProBus=0;
			$users = ($users)?$users:$this->CI->user_m->getUser(false, array('status'=>STATUS_CUSTOMER));
			$allusersPKG = $this->CI->mlm_m->getAllUsersPKG();
			$packages = $this->CI->product_m->products(false,PKG);
			if($users){
				$cntLG=0;$dateCond=(!$dateLike)?true:false;
				$orders = $this->CI->product_m->getOrderList();
				foreach($users as $usr){
					if($userId==$usr['sponser_id']){
						$spnsr_id=$usr['ABO'];
						if($usr['leg']==LEFT){
							if($dateLike){$dateCond=$this->like_match($dateLike[1].'%',$usr[$dateLike[0]]);}
							if($usr[$status] && $dateCond){
								$totalLeftLG++;
							}
							$totalLeftLG += $this->checkTotalLeg($users, $spnsr_id,$status,$dateLike);
							//====Count B.V=======
							if($usr['activate']){
								$pkg = $packages[array_search($allusersPKG[$usr['id']], array_column($packages, 'id'))];
								$lftBV +=$pkg['bv'];
							}
							$lftBV += $this->calculateBusinessValue($users, $spnsr_id, $allusersPKG, $packages);

							$ltProBus = $this->calculateProductBusiness($users, $spnsr_id,$orders);
						}
						if($usr['leg']==RIGHT){
							if($dateLike){$dateCond=$this->like_match($dateLike[1].'%',$usr[$dateLike[0]]);}
							if($usr[$status] && $dateCond){
								$totalRightLG++;
							}
							$totalRightLG += $this->checkTotalLeg($users, $spnsr_id,$status,$dateLike);
							//====Count B.V=======
							if($usr['activate']){
								$pkg = $packages[array_search($allusersPKG[$usr['id']], array_column($packages, 'id'))];
								$rtBV +=$pkg['bv'];
							}
							$rtBV += $this->calculateBusinessValue($users, $spnsr_id,$allusersPKG, $packages);

							$rtProBus = $this->calculateProductBusiness($users, $spnsr_id,$orders);
												}
					}
				}
				/*foreach($users as $usr){
					if($userId==$usr['sponser_id']){
						$spnsr_id=$usr['ABO'];
						if($usr['leg']==RIGHT){
							$totalRightLG++;
							$totalRightLG += $this->checkTotalLeg($users, $spnsr_id);
							$rtHUUsr += $this->checkAllHUUsers($users, $spnsr_id,$allusersPKG);
						}
					}
				}*/
				
				return array("leftLG"=>$totalLeftLG,"rightLG"=>$totalRightLG,"leftBV"=>$lftBV,"rightBV"=>$rtBV,"leftProBus"=>$ltProBus,"rightProBus"=>$rtProBus);
			}else{
				return false;	
			}	
		}
	}
	public function checkTotalLeg($users=false, $spnsrID=false,$status='enable', $dateLike=false){
		$spnsr_id=$spnsrID;$totalLG=0;$cntLG=0;$flg=false;
		if($users){
			$cntLG=0;$dateCond=(!$dateLike)?true:false;
			foreach($users as $usr){
				if($usr['sponser_id']==$spnsrID){
					$spnsr_id=$usr['ABO'];
					if($dateLike){$dateCond=$this->like_match($dateLike[1].'%',$usr[$dateLike[0]]);}
					if($usr[$status] && $dateCond){$cntLG++;}
					$totalLG = $this->checkTotalLeg($users,$spnsr_id,$status,$dateLike);
					$cntLG +=($totalLG)?$totalLG:0;
				}
			}
			
			return $cntLG;
		}else{
			return $cntLG;
		}
	}
	public function calculateBusinessValue($users=false, $spnsrID=false, $usrPKG=false, $pkgs=false){
		$allBV=0;$cntBV=0;$flg=0;
		if($users){
			$cntLG=0;
			foreach($users as $usr){
				if($usr['sponser_id']==$spnsrID){
					$spnsr_id=$usr['ABO'];
					$allBV = $this->calculateBusinessValue($users,$spnsr_id,$usrPKG,$pkgs);
					if($allBV){
						//$pkg = $pkgs[array_search($usrPKG[$usr['id']], array_column($pkgs, 'id'))];
						$cntBV +=$allBV;

					}
					
					if($usr['activate']){
						$pkg = $pkgs[array_search($usrPKG[$usr['id']], array_column($pkgs, 'id'))];
						$cntBV +=$pkg['bv'];
					}
					$flg=1;
				}
			}
			
			return $cntBV;
		}else{
			return $cntBV;
		}
	}
	public function calculateProductBusiness($users=false, $spnsrID=false, $orders=false){
		$allBV=0;$cntBV=0;$flg=0;
		if($users){
			$cntLG=0;
			foreach($users as $usr){
				if($usr['sponser_id']==$spnsrID){
					$spnsr_id=$usr['ABO'];
					$allBV = $this->calculateProductBusiness($users,$spnsr_id,$orders);
					if($allBV){
						$cntBV +=$allBV;
					}
					if($orders){
						foreach($orders as $order){
							if($order['uid']==$usr['id']){
								$cntBV +=$order['bv'];
							}
						}
					}
					$flg=1;
				}
			}
			
			return $cntBV;
		}else{
			return $cntBV;
		}
	}
	
	public function findDownlines($users=false, $spnsrID=false,$column='ABO'){
		$spnsr_id=$spnsrID;$totalLG=0;$cntLG=0;$flg=false;
		$downlines=false;
		if($users && $spnsrID){
			$cntLG=0;
			if(is_array($spnsrID)){
				foreach($users as $usr){
					if(in_array($usr['sponser_id'],$spnsrID)){
						$spnsr_id=$usr['ABO'];
						$downlines[] = $usr[$column];
						$cntLG++;
					}
					if($downlines && $cntLG==(count($spnsrID)*2)){break;}
				}
				$totalLG = ($downlines)?$this->findDownlines($users,$downlines,$column):false;
				$downlines =($totalLG)?array_merge($downlines,$totalLG):$downlines;
			}else{
				foreach($users as $usr){
					if($usr['sponser_id']==$spnsrID){
						$spnsr_id=$usr['ABO'];
						$downlines[] = $usr[$column];
						$cntLG++;
					}
					if($cntLG==2){break;}
				}
				$totalLG = $this->findDownlines($users,$downlines,$column);
				$downlines =($totalLG)?array_merge($downlines,$totalLG):$downlines;
			}
			
			return ($downlines)?$downlines:false;
		}else{
			return $downlines;
		}
	}
	public function findDirectDownlines($users=false, $parentID=false,$column='ABO'){
		$spnsr_id=$parentID;$totalLG=0;$cntLG=0;$flg=false;
		$downlines=false;
		if($users){
			$cntLG=0;
			foreach($users as $usr){
				if($usr['parent']==$parentID){
					$prant_id=$usr['ABO'];
					$downlines[$usr[$column]] = $usr[$column];
					$totalLG = $this->findDirectDownlines($users,$prant_id,$column);
					$downlines =($totalLG)?array_merge($totalLG,$downlines):$downlines;
				}
			}
			
			return ($downlines)?$downlines:0;
		}else{
			return $downlines;
		}
	}
	public function findEmptyLeg($users=false,$sids=false){
		$flg=0;$spnser_id=false;$temp_sid=false;
		if($users && $sids){
			foreach($sids as $sid){
				$legCount=0;
				foreach($users as $user){
					if($user['ABO']!=$sid){
						if($user['sponser_id']==$sid){
							$temp_sid[]=$user['ABO'];
							$legCount++;		
						}
					}
				}
				if($legCount<2){
					$sponser_id=$sid;
					$flg=1;
					break;
				}
			}
			if(!$flg){
				$sponser_id = $this->findEmptyLeg($users,$temp_sid);
			}
			return $sponser_id;
		}else{
			return false;	
		}
	}
	public function updateSAI($users=false)
	{
		/*$date = date('Y-m');
		$eligibleUsers=false;
		$isupdated = $this->CI->mlm_m->query('select * from '.TABLE_PREFIX.'rewards where type='.SAI_INCOME.' like "'.$date.'%"');
		if(!$isupdated){
			$SAIstruct = $this->CI->config->item('SAI');
			$newUsers = $this->CI->mlm_m->query('select * from '.TABLE_PREFIX.'user where status="'.STATUS_CUSTOMER.'" AND activate=1 AND reg_date Like "'.$date.'%"');
			$numUsers = count($newUsers);
			$totalSAIAmt = ($SAIstruct['amount']*$numUsers);//=======amount for distribution
			$allUsers = $this->CI->mlm_m->query('select * from '.TABLE_PREFIX.'user where id IN (select uid from '.TABLE_PREFIX.'user_package where amount="3000")');
			if($allUsers){
				foreach($allUsers as $allusr){
					$isEligible = $this->CI->user_m->getUser(false,array("parent"=>$allusr['ABO'],"activate"=>1));
					if($isEligible){
						if(count($isEligible)>=2){
							$eligibleUsers[]=$allusr;
						}
					}///=====Star Associate User ========
				}

				if($eligibleUsers){
					$qry='insert into '.TABLE_PREFIX.'rewards (uid,pair,reward,type) values ';
					$SAIamtperuser = $totalSAIAmt/count($eligibleUsers);
					foreach($eligibleUsers as $eu){
						$qry .= '('.$eu['id'].','.$numUsers.','.$SAIamtperuser.','.SAI_INCOME.'),';
					}
					$qry = substr($qry,0,-1).';';
					$this->CI->mlm_m->query($qry,'insert');
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}else{
			$this->CI->message->set("SAI already updated for this month.","danger",true);
			return false;
		}*/
		return false;
	}
	public function updateCTO(){
		/*$date = date('Y-m');
		$eligibleUsers=false;
		$isupdated = $this->CI->mlm_m->query('select * from '.TABLE_PREFIX.'rewards where type='.CTO_INCOME.' like "'.$date.'%"');
		if(!$isupdated){
			$CTOstruct = $this->CI->config->item('CTO');
			$newUsers = $this->CI->mlm_m->query('select * from '.TABLE_PREFIX.'user where status="'.STATUS_CUSTOMER.'" AND activate=1 AND reg_date Like "'.$date.'%"');
			$numUsers = count($newUsers);
			$totalCTOAmt = ($CTOstruct['amount']*$numUsers);//=======amount for distribution
			$allUsers = $this->CI->mlm_m->query('select * from '.TABLE_PREFIX.'user where id IN (select uid from '.TABLE_PREFIX.'user_package where amount="3000")');
			if($allUsers){
				foreach($allUsers as $allusr){
					$isCTOUser = $this->CI->mlm_m->getRewards($allusr['id'],false,CTO_INCOME);
					if(!$isCTOUser){
						$isEligible = $this->CI->user_m->getUser(false,array("parent"=>$allusr['ABO'],"activate"=>1));
						if($isEligible){
							if(count($isEligible)>=5){
								$eligibleUsers[]=$allusr;
							}
						}
					}else{
						$isEligible = $this->CI->mlm_m->query('select * from '.TABLE_PREFIX.'user where parent='.$allusr['ABO'].' and reg_date like "'.$date.'%"');
						if($isEligible){
							$eligibleUsers[]=$allusr;
						}else{
							$isTeam = $this->countLeg($allusr['ABO'], $allUsers, $status='activate', $date);
							if($isTeam){
								if(min($isTeam['leftLG'],$isTeam['rightLG'])>=10){
									$eligibleUsers[]=$allusr;
								}
							}
						}
					}///=====CTO user ========
				}

				if($eligibleUsers){
					$qry='insert into '.TABLE_PREFIX.'rewards (uid,pair,reward,type) values ';
					$CTOamtperuser = $totalCTOAmt/count($eligibleUsers);
					foreach($eligibleUsers as $eu){
						$qry .= '('.$eu['id'].','.$numUsers.','.$CTOamtperuser.','.CTO_INCOME.'),';
					}
					$qry = substr($qry,0,-1).';';
					$this->CI->mlm_m->query($qry,'insert');
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}else{
			$this->CI->message->set("CTO already updated for this month.","danger",true);
			return false;
		}*/
		return false;
	}
	public function calculateLevelMembers($users=false,$sids=false,$lvl=1)
	{
		$lvl_structure=array();
		while(1){
			$flg=false;$temp_sid=false;
			//$structure[$lvl] = $this->countLevelMember($users,$sids,$lvl);
			foreach($sids as $sid){
				$legCount=0;
				foreach($users as $user){
					if($user['sponser_id']==$sid){
						$temp_sid[]=$user['ABO'];
						if($user['activate']){
							$lvl_structure[$lvl][]=$user['ABO'];
						}
						$flg=1;		
					}
				}
			}

			if(!$temp_sid){
				break;
			}
			$sids = $temp_sid;
			$lvl++;
		}
		return $lvl_structure;
	}

	public function calculateUserBusiness($uid=false){
		$walletVal=false;$levelSts=false;$flg=false;$walletStr="";$levelStr="";
		$admin = $this->CI->session->userdata('ABO');
		$user = $this->CI->user_m->getUser($uid);
		$users = $this->CI->user_m->getUser();
		$isCalculate = $this->CI->wallet_m->getWallet($uid,array("date"=>date("Y-m-d"),"pair >"=>"0"));
		$calculateID=false;$detail=false;$grndflg=0;
		$products = $this->CI->product_m->products(false,PKG);
		
		$getAdminChrg = $this->CI->default_m->getDefaultConfig('admin_charge');

		$walletStr = "INSERT INTO ".TABLE_PREFIX."wallet (uid, amount, admin_charge_per, admin_charge, pair, BV, transaction_type, wallet_type, income_type, status) VALUES ";
		$levelStr = "INSERT INTO ".TABLE_PREFIX."level_status (u_id, left_leg, right_leg, total_pair, prev_l_bv, prev_r_bv, bv) VALUES ";

		//foreach($users as $user){
			if($user['status']!=STATUS_ADMIN && !$isCalculate){
				$amount=0;$earning=0;$pair=0;
				$levelStatus = $this->CI->mlm_m->getLevelStatus($user['id']);
				$lastPaidPair=($levelStatus)?$levelStatus['total_pair']:0;

				$vfc = $this->mlm_m->validateFirstCalculation($me['ABO']);
				
				$detail = $this->countLeg($user['ABO'],$users,'activate');
				$pkg = $this->CI->user_m->selectedPkg($user['id'],'calculate,uid,pid,amount');
				$prd = $this->CI->custom_define->search($products,array("id"=>$pkg['pid']));
				$prd = $prd[0];
				if(CALCULATION_TYPE!=2){
					if(!$pkg['calculate']){ //if first calculation of user (2:1)
						if($vfc==2 && (($detail['leftLG']>=2 && $detail['rightLG']>=1) || ($detail['leftLG']>=1 && $detail['rightLG']>=2))){
							if($detail['leftLG']>$detail['rightLG']){
								$leftLeg = $detail['rightLG']+1;
								$rightLeg = $detail['rightLG'];
								$pair = $rightLeg;
							}else if($detail['leftLG']<$detail['rightLG']){
								$leftLeg = $detail['leftLG'];
								$rightLeg = $detail['leftLG']+1;
								$pair = $leftLeg;
							}else if($detail['leftLG']==$detail['rightLG']){
								$leftLeg = $detail['leftLG'];
								$rightLeg = $detail['leftLG']-1;
								$pair = $rightLeg;
							}
							
							if($pair>0 && $lastPaidPair<$pair){
								if($prd['income_type']=='rs'){
									$pair = ($pair>$prd['pair_caping'])?$prd['pair_caping']:$pair;
									$amount=$pair*$prd['pair_income_rs'];
									$admincharge = $this->adminCharge($amount);
									$earning = ($amount-$admincharge);
								}else if($prd['income_type']=='pr'){
									$pair = ($pair>$prd['pair_caping'])?$prd['pair_caping']:$pair;
									$amount=$pair*(($prd['bv']*$prd['pair_income_pr'])/100);
									$admincharge = $this->adminCharge($amount);
									$earning = ($amount-$admincharge);
								}

								$walletStr .= '('.$user['id'].','.$earning.','.$getAdminChrg['value'].','.$admincharge.','.$pair.','.CREDIT.','.WORKING_WALLET.','.BINARY_INCOME.','.(($user['activate'])?1:0).'),';
								$levelStr .= '('.$user['id'].','.$leftLeg.','.$rightLeg.','.$pair.'),';
								$calculateID[]=$user['id'];
								$flg=true;
							}
						}
					}else{//if next calculation of user (1:1)
						$currentLevel = $this->CI->mlm_m->getLevelStatus($user['id']);
						$leftLeg = $detail['leftLG']-$currentLevel['left_leg'];
						$rightLeg = $detail['rightLG']-$currentLevel['right_leg'];
						$pair = min($leftLeg,$rightLeg);

						if($pair>0 && $lastPaidPair<$pair){
							if($prd['income_type']=='rs'){
								$pair = ($pair>$prd['pair_caping'])?$prd['pair_caping']:$pair;
								$amount=$pair*$prd['pair_income_rs'];
								$admincharge = $this->adminCharge($amount);
								$earning = ($amount-$admincharge);
							}else if($prd['income_type']=='pr'){
								$pair = ($pair>$prd['pair_caping'])?$prd['pair_caping']:$pair;
								$amount=$pair*(($prd['bv']*$prd['pair_income_pr'])/100);
								$admincharge = $this->adminCharge($amount);
								$earning = ($amount-$admincharge);
							}
							$walletStr .= '('.$user['id'].','.$earning.','.$getAdminChrg['value'].','.$admincharge.','.$pair.','.CREDIT.','.WORKING_WALLET.','.BINARY_INCOME.','.(($user['activate'])?1:0).'),';
							$levelStr .= '('.$user['id'].','.($currentLevel['left_leg']+$pair).','.($currentLevel['right_leg']+$pair).','.(($currentLevel['total_pair']+$pair)).'),';

							$flg=true;
						}else{
							$levelStr .= '('.$user['id'].','.$currentLevel['left_leg'].','.$currentLevel['right_leg'].','.$currentLevel['total_pair'].'),';
						}
					}
				}else{
					$currentLevel = $this->CI->mlm_m->getLevelStatus($user['id']);

					$leftLeg = $detail['leftLG']-$currentLevel['left_leg'];
					$rightLeg = $detail['rightLG']-$currentLevel['right_leg'];
					$pair = min($leftLeg,$rightLeg);

					$leftBV = $detail['leftBV']-$currentLevel['bv'];
					$rightBV = $detail['rightBV']-$currentLevel['bv'];
					$BV = min($leftBV,$rightBV);

					$amount=(($BV*$prd['pair_income_pr'])/100);
					$admincharge = $this->adminCharge($amount);
					$earning = ($amount-$admincharge);
					$earning = ($earning>$prd['caping'])?$prd['caping']:$earning;//check caping condition on earn

					$walletStr .= '('.$user['id'].','.$earning.','.$getAdminChrg['value'].','.$admincharge.','.$pair.','.$BV.','.CREDIT.','.WORKING_WALLET.','.BINARY_INCOME.','.(($user['activate'])?1:0).'),';
					$levelStr .= '('.$user['id'].','.($currentLevel['left_leg']+$pair).','.($currentLevel['right_leg']+$pair).','.(($currentLevel['total_pair']+$pair)).','.$detail['leftBV'].','.$detail['rightBV'].','.(min($detail['leftBV'],$detail['rightBV'])).'),';

					$flg=true;
				}
				
				if($flg){
					$walletStr = substr($walletStr,0,-1);
					$levelStr = substr($levelStr,0,-1);
					$this->CI->wallet_m->query($walletStr,'insert');// insert value in wallet table
					$this->CI->mlm_m->truncateTable('level_status');
					$this->CI->wallet_m->query($levelStr,'insert');
					$this->CI->mlm_m->setUpgradeDate();
					if($calculateID){
						$this->CI->wallet_m->query("UPDATE ".TABLE_PREFIX."user_package set calculate=1 WHERE uid IN (".implode(",",$calculateID).")","udate");
					}
					//$grndflg=1;
				}
			}
		//}
	}
	public function directIncomeDistribute($abo=false, $prdType=array('id'=>false,'type'=>PKG)){
		if($abo){
			$transaction_id = $this->CI->default_m->genrateUniquiId('di'.time(),8);
			$products = $this->CI->product_m->products(false,PKG);
			$user = $this->CI->default_m->getUserByABO($abo);
			$parent = $this->CI->user_m->getParent($abo);
			$pkg = $this->CI->user_m->selectedPkg($user['id'],'calculate,uid,pid,amount');
			$prd = $this->CI->custom_define->search($products,array("id"=>$pkg['pid']));
			$prd = $prd[0];
			if($prd['direct_ins']>0){
				$insentive = (($prd['bv']*$prd['direct_ins'])/100);
				$adminChrg = $this->adminCharge($insentive);
				$insentive = $insentive-$adminChrg;
				$income = array(
								"uid"			=> $parent['id'],
								"amount"		=> $insentive,
								"wallet_type"	=> WORKING_WALLET,
								"income_type"	=> DIRECT_INCOME,
								"transaction_id"=> $transaction_id,
								"transaction_type"=>CREDIT,
								"transfer_by"	=> $user['id']
								);
				$this->CI->wallet_m->directInsentive($income);
			}
		}
	}
	public function walletCredit($uid=false,$wallet_type=false){
		$balance = 0;
		if($uid && $wallet_type){
			$clause="(uid='".$uid."'"." AND wallet_type IN (".$wallet_type.") AND transaction_type='".CREDIT."')";
			$walletDetail = $this->CI->wallet_m->query("SELECT * FROM ".TABLE_PREFIX."wallet WHERE ".$clause);
			if($walletDetail){
				foreach($walletDetail as $wd){
					$balance +=$wd['amount'];
				}
			}
		}
		return $balance;
	}
	public function walletDebit($uid=false,$wallet_type=false,$transWaltype=false){
		$balance = 0;
		if($uid && $wallet_type){
			$clause=($transWaltype)?"((transfer_by='".$uid."' AND transfer_wallet_type='".$transWaltype."'))":"((transfer_by='".$uid."' AND wallet_type='".TOPUP_WALLET."'))";
			$clause .=" OR (transaction_type=".DEBIT." AND uid=".$uid.")".(($transWaltype)?" AND transfer_wallet_type='".$transWaltype."'":'');
			$walletDetail = $this->CI->wallet_m->query("SELECT * FROM ".TABLE_PREFIX."wallet WHERE ".$clause);
			if($walletDetail){
				foreach($walletDetail as $wd){
					$balance +=$wd['amount'];
				}
			}
		}
		return $balance;
	}
	//==== admin charges for =====
	public function adminCharge($amount=0){
		$adminChrg = $this->CI->default_m->getDefaultConfig('admin_charge');
		$value=0;
		if($amount){
			$value = ($amount*$adminChrg['value'])/100;
			return $value;
		}else{
			return 0;
		}
	}
	//daily calculation of business of all users
	public function calculateBusiness(){
		$walletVal=false;$levelSts=false;$flg=false;$walletStr="";$levelStr="";
		$admin = $this->CI->session->userdata('ABO');
		$users = $this->CI->user_m->getUser();
		$calculateID=false;$detail=false;$grndflg=0;
		$products = $this->CI->product_m->products(false,PKG);
		$getAdminChrg = $this->CI->default_m->getDefaultConfig('admin_charge');
		if($users){
			$walletStr = "INSERT INTO ".TABLE_PREFIX."wallet (uid, amount, admin_charge_per, admin_charge, pair, BV, transaction_type, wallet_type, income_type, status) VALUES ";
			$levelStr = "INSERT INTO ".TABLE_PREFIX."level_status (u_id, left_leg, right_leg, total_pair, prev_l_bv, prev_r_bv, bv) VALUES ";
			foreach($users as $user){
				if($user['status']!=STATUS_ADMIN && $user['status']!=STATUS_SUPER){
					$amount=0;$earning=0;
					$levelStatus = $this->CI->mlm_m->getLevelStatus($user['id']);
					$lastPaidPair=($levelStatus)?$levelStatus['total_pair']:0;

					$detail = $this->countLeg($user['ABO'],$users,'activate');
					$pkg = $this->CI->user_m->selectedPkg($user['id'],'calculate,uid,pid,amount,upgrade_roi');
					$prd = ($pkg)?$this->CI->custom_define->search($products,array("id"=>$pkg['pid'])):false;
					$prd = ($prd)?$prd[0]:false;
					if($prd){
						if(CALCULATION_TYPE!=2){
							if(!$pkg['calculate']){ //if first calculation of user (2:1)
								$validateCalcu = $this->CI->mlm_m->validateFirstCalculation($user['ABO']);
								if(($detail['leftLG']>=2 && $detail['rightLG']>=1) || ($detail['leftLG']>=1 && $detail['rightLG']>=2)){
									if($detail['leftLG']>$detail['rightLG']){
										$leftLeg = $detail['rightLG']+1;
										$rightLeg = $detail['rightLG'];
										$pair = $rightLeg;
									}else if($detail['leftLG']<$detail['rightLG']){
										$leftLeg = $detail['leftLG'];
										$rightLeg = $detail['leftLG']+1;
										$pair = $leftLeg;
									}else if($detail['leftLG']==$detail['rightLG']){
										$leftLeg = $detail['leftLG'];
										$rightLeg = $detail['leftLG']-1;
										$pair = $rightLeg;
									}
									
									if($pair>0 && $lastPaidPair<$pair){
										if($prd['income_type']=='rs'){
											$pair = ($pair>$prd['pair_caping'])?$prd['pair_caping']:$pair;
											$amount=$pair*$prd['pair_income_rs'];
											$admincharge = $this->adminCharge($amount);
											$earning = ($amount-$admincharge);
										}else if($prd['income_type']=='pr'){
											$pair = ($pair>$prd['pair_caping'])?$prd['pair_caping']:$pair;
											$amount=$pair*(($prd['bv']*$prd['pair_income_pr'])/100);
											$admincharge = $this->adminCharge($amount);
											$earning = ($amount-$admincharge);
										}

										$walletStr .= '('.$user['id'].','.$earning.','.$getAdminChrg['value'].','.$admincharge.','.$pair.','.CREDIT.','.WORKING_WALLET.','.BINARY_INCOME.','.(($user['activate'])?1:0).'),';
										$levelStr .= '('.$user['id'].','.$leftLeg.','.$rightLeg.','.$pair.'),';
										$calculateID[]=$user['id'];
										$flg=true;
									}
								}
							}else{//if next calculation of user (1:1)
								$currentLevel = $this->CI->mlm_m->getLevelStatus($user['id']);
								$leftLeg = $detail['leftLG']-$currentLevel['left_leg'];
								$rightLeg = $detail['rightLG']-$currentLevel['right_leg'];
								$pair = min($leftLeg,$rightLeg);
								if($pair>0 && $lastPaidPair<$pair){
									if($prd['income_type']=='rs'){
										$pair = ($pair>$prd['pair_caping'])?$prd['pair_caping']:$pair;
										$amount=$pair*$prd['pair_income_rs'];
										$admincharge = $this->adminCharge($amount);
										$earning = ($amount-$admincharge);
									}else if($prd['income_type']=='pr'){
										$pair = ($pair>$prd['pair_caping'])?$prd['pair_caping']:$pair;
										$amount=$pair*(($prd['bv']*$prd['pair_income_pr'])/100);
										$admincharge = $this->adminCharge($amount);
										$earning = ($amount-$admincharge);
									}
									$walletStr .= '('.$user['id'].','.$earning.','.$getAdminChrg['value'].','.$admincharge.','.$pair.','.CREDIT.','.WORKING_WALLET.','.BINARY_INCOME.','.(($user['activate'])?1:0).'),';
									$levelStr .= '('.$user['id'].','.($currentLevel['left_leg']+$pair).','.($currentLevel['right_leg']+$pair).','.(($currentLevel['total_pair']+$pair)).'),';

									$flg=true;
								}else{
									$levelStr .= '('.$user['id'].','.$currentLevel['left_leg'].','.$currentLevel['right_leg'].','.$currentLevel['total_pair'].'),';
								}
							}
						}else{
							$currentLevel = $this->CI->mlm_m->getLevelStatus($user['id']);

							$leftLeg = $detail['leftLG']-$currentLevel['left_leg'];
							$rightLeg = $detail['rightLG']-$currentLevel['right_leg'];
							$pair = min($leftLeg,$rightLeg);

							$leftBV = $detail['leftBV']-$currentLevel['bv'];
							$rightBV = $detail['rightBV']-$currentLevel['bv'];
							$BV = min($leftBV,$rightBV);

							/*$ltProBus = $detail['ltProBus']-$currentLevel['pro_bus']; /// implement for product income
							$rtProBus = $detail['rtProBus']-$currentLevel['pro_bus'];
							$proBus = min($ltProBus,$rtProBus);*/

							$amount=(($BV*$prd['pair_income_pr'])/100);
							/*if($proBus){ /// implement for product income
								$amount +=(($proBus*$prd['pair_income_pr'])/100);
							}*/

							$admincharge = $this->adminCharge($amount);
							$earning = ($amount-$admincharge);

							//=====check if plan upgrade ========
							if($pkg['upgrade_roi']==1){
								$upgrdPlan = $this->CI->mlm_m->getUpgradePKGDetail(false,array("uid"=>$user['id']));
								if($upgrdPlan){
									$newpkg = $upgradePlan[count($upgradePlan)-1];
									$tempprd = ($pkg)?$this->CI->custom_define->search($products,array("id"=>$newpkg['pid'])):false;
									$tempprd = ($tempprd)?$tempprd[0]:false;
									$prd['caping'] = $tempprd['caping'];
								}
							}
							//====================================

							$earning = ($earning>$prd['caping'])?$prd['caping']:$earning;//check caping condition on earn

							$walletStr .= '('.$user['id'].','.$earning.','.$getAdminChrg['value'].','.$admincharge.','.$pair.','.$BV.','.CREDIT.','.WORKING_WALLET.','.BINARY_INCOME.','.(($user['activate'])?1:0).'),';
							$levelStr .= '('.$user['id'].','.($currentLevel['left_leg']+$pair).','.($currentLevel['right_leg']+$pair).','.(($currentLevel['total_pair']+$pair)).','.$detail['leftBV'].','.$detail['rightBV'].','.(min($detail['leftBV'],$detail['rightBV'])).'),';

							$flg=true;
						}
					}
				}
				$this->calculateROI($user['id']);
			}
			
			if($flg){
				$walletStr = substr($walletStr,0,-1);
				$levelStr = substr($levelStr,0,-1);
				$this->CI->wallet_m->query($walletStr,'insert');// insert value in wallet table
				$this->CI->mlm_m->truncateTable('level_status');
				$this->CI->wallet_m->query($levelStr,'insert');
				$this->CI->mlm_m->setUpgradeDate();
				if($calculateID){
					$this->CI->wallet_m->query("UPDATE ".TABLE_PREFIX."user_package set calculate=1 WHERE uid IN (".implode(",",$calculateID).")","udate");
				}
				$grndflg=1;
			}

		}
		if($grndflg==1){
			return $grndflg;
		}else{
			return false;
		}
	}
	public function calculateROI($uid=false){
		if($uid){
			$totIns=0;$ROIVal=false;
			$user = $this->CI->user_m->getUser($uid);
			$products = $this->CI->product_m->products(false,PKG);
			$pkg = $this->CI->user_m->selectedPkg($uid,'calculate,uid,pid,amount,upgrade_roi');
			if($user['activate']==1 && $pkg){
				if($pkg['upgrade_roi']){
					$this->cashbackROI($uid);
				}else{
					$prd = $this->CI->custom_define->search($products,array("id"=>$pkg['pid']));
					$prd = ($prd)?$prd[0]:false;
					$planAmt = ($prd['bv']>0)?$prd['bv']:$prd['cost'];
					if($prd['pkg_roi']){
						$totalROI = $this->CI->wallet_m->countTotalROI($uid);
						if(!$totalROI || ($totalROI && count($totalROI)<=$prd['roi_days'])){

							$totIns = ($planAmt*$prd['roi_ins'])/100;
							$allROI = $this->CI->wallet_m->getWallet(false,array('uid'=>$uid,'income_type'=>ROI_INCOME,'is_cashback'=>'0'));
							$startDate = ($allROI)?$allROI[(count($allROI)-1)]['date']:date('Y-m-d',strtotime($user['appr_date']));
							$startDate = date('Y-m-d',strtotime($startDate. '+1 days'));
							
							$endDate = date('Y-m-d');
							
							$dates = $this->CI->default_m->createDateRangeArray($startDate,$endDate,array('key'=>'D','val'=>array('Mon','Tue','Wed','Thu','Fri')));
							$flg=false;
							if($dates){
								$str = 'INSERT INTO '.TABLE_PREFIX.'wallet (uid,amount,plan_amount,roi_ins,transaction_type,wallet_type,income_type,date,status) values';
								foreach($dates as $date){
									$str .= '('.$user['id'].','.$totIns.','.$planAmt.','.$prd['roi_ins'].','.CREDIT.','.NONWORKING_WALLET.','.ROI_INCOME.',"'.$date.'",'.(($user['activate'])?1:0).'),';
									$flg=true;
								}
								if($flg){
									$str = substr($str,0,-1).';';
									$this->CI->wallet_m->query($str,'insert');// insert value in wallet table
									return true;
								}else{
									return false;
								}
							}else{
								return false;
							}
						}else{
							return false;
						}
					}else{
						return false;
					}
				}
			}else{
				return false;
			}
		}
	}
	public function cashbackROI($uid=false){
		if($uid){
			$totIns=0;$ROIVal=false;
			$user = $this->CI->user_m->getUser($uid);
			if($user['activate']==1){
				$products = $this->CI->product_m->products(false,PKG);
				$pkg = $this->CI->user_m->selectedPkg($uid,'calculate,uid,pid,amount,upgrade_roi');
				if($pkg['upgrade_roi']){
					$upgrdPlan = $this->CI->mlm_m->getUpgradePKGDetail(false,array("uid"=>$user['id']));
					if($upgrdPlan){
						$str = 'INSERT INTO '.TABLE_PREFIX.'wallet (uid,amount,plan_amount,roi_ins,is_cashback,transaction_type,wallet_type,income_type,date,status) values';
						$ugpl = $upgrdPlan[count($upgrdPlan)-1];
						//foreach($upgrdPlan as $ugpl){
							$totalROI = $this->CI->wallet_m->countTotalROI($uid,array('plan_amount'=>$ugpl['bv']));
							if(!$totalROI || ($totalROI && count($totalROI)<=$ugpl['roi_days'])){
								$totIns = ($ugpl['bv']*$ugpl['roi_ins'])/100;
								$allROI = $this->CI->wallet_m->getWallet(false,array('uid'=>$uid,'income_type'=>ROI_INCOME,'plan_amount'=>$ugpl['bv']));
								$startDate = ($allROI)?$allROI[(count($allROI)-1)]['date']:(($pkg['upgrade_roi'])?date('Y-m-d',strtotime($ugpl['date'])):date('Y-m-d',strtotime($user['appr_date'])));
								$startDate = date('Y-m-d',strtotime($startDate. '+1 days'));
								
								$endDate = date('Y-m-d');
								
								$dates = $this->CI->default_m->createDateRangeArray($startDate,$endDate,array('key'=>'D','val'=>array('Mon','Tue','Wed','Thu','Fri')));
								$flg=false;
								if($dates){
									foreach($dates as $date){
										$str .= '('.$user['id'].','.$totIns.','.$ugpl['bv'].',"'.$ugpl['roi_ins'].'",1,'.CREDIT.','.NONWORKING_WALLET.','.ROI_INCOME.',"'.$date.'",'.(($user['activate'])?1:0).'),';
										$flg=true;
									}
								}
							}
						//}
						if($flg){
							$str = substr($str,0,-1).';';
							$this->CI->wallet_m->query($str,'insert');// insert value in wallet table
						}
					}
				}
			}
		}
	}
	//======= reward processing ==================
	public function rewardProcess($date=false){
		$date = ($date)?$date : date('Y-m');$valflg=false;
		$users = $this->CI->user_m->getUser(false,array('status'=>STATUS_CUSTOMER));
		$rewardStr = "INSERT INTO ".TABLE_PREFIX."rewards (uid,left_leg,right_leg,pairs,level,reward) VALUES ";
		$rewardstuct = $this->CI->config->item("REWARDS");
		
		if($users){
			foreach($users as $user){
				$prevDetail = $this->CI->default_m->Query("select SUM(left_leg) as lft,SUM(right_leg) as rgt,SUM(pairs) as pair from m_rewards WHERE uid='".$user['id']."'");
				$legs = $this->countLeg($user['ABO'],$users,'activate',array('reg_date',$date));
				if($prevDetail && $legs){
					$prevDetail=$prevDetail[0];
					$legs['leftLG'] = ($prevDetail['pair'])?$legs['leftLG']-$prevDetail['lft']:$legs['leftLG'];
					$legs['rightLG'] = ($prevDetail['pair'])?$legs['rightLG']-$prevDetail['rgt']:$legs['rightLG'];
				}
				
				if($legs && $pair = min($legs['leftLG'],$legs['rightLG'])){
					for($a=0;$a<count($rewardstuct);$a++){
						if($a==(count($rewardstuct)-1)){
							if($pair>=$rewardstuct[$a][0]){
								$rewardStr .='('.$user['id'].','.$pair.','.$pair.','.$pair.','.($a+1).',\''.$rewardstuct[$a][1].'\'),';
								$valflg=true;
								break;
							}
						}else{
							if($pair>=$rewardstuct[$a][0] && $pair<$rewardstuct[$a+1][0]){
								$rewardStr .='('.$user['id'].','.$pair.','.$pair.','.$pair.','.($a+1).',\''.$rewardstuct[$a][1].'\'),';
								$valflg=true;
								break;
							}
						}
					}
				}
			}
			
			if($valflg){
				$rewardStr = substr($rewardStr,0,-1);
				$this->CI->default_m->Query($rewardStr,'insert');
				return true;
			}else{
				return false;
			}
		}
	}
	//============================================
}