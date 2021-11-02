<?php

 defined('BASEPATH') OR exit('No direct script access allowed');


 class Provide_help extends CI_controller{
 	
public function __construct(){
 		parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin'));
 }

 	public function provide_helpers(){
 		if(is_admin()){

 		   $users['header'] = 'Provide Help Users';
 		   $users['user'] = $this->Main_model->get_records('tbl_investment', 'type = "provide_help" AND amount != alloted_amount','*');
 		  

 		    $this->load->view('provideHelp_users',$users);

 		 }else{

 		    redirect('Admin/Dashboard/selfLogin');
 		   }

 	}

 	public function get_Help(){
 		if(is_admin()){

 		   $users['header'] = 'Get Help Users';
 		   $users['user'] = $this->Main_model->get_records('tbl_investment',array('type' => 'get_help'),'*');

 		  $this->load->view('gethelp_History',$users);
 		}

 	}

 	public function get_helper_form(){
 		if(is_admin()){

 		$users['header'] = 'Get Helping Form';
 			if($this->input->server('REQUEST_METHOD') == 'POST'){
 			  $data = $this->security->xss_clean($this->input->post());
 			    $this->form_validation->set_rules('user_id','User ID','required|trim');
 			    $this->form_validation->set_rules('helpamount','Amount','required|trim|numeric');
 			   	 //print_r($data);
 			    // die('okk');
 			       if($this->form_validation->run() != FALSE){
 			       		if($data['helpamount'] > 0){
 			       	    	$user = $this->Main_model->get_single_record('tbl_users',array('user_id' => $data['user_id']),'user_id');
	 			       	      if($user['user_id'] == $data['user_id']){

			 			       	 $users = $this->Main_model->insert('tbl_investment',array(

			 			       	 		'user_id' => $data['user_id'],
			 			       	 		'amount' => $data['helpamount'],
			 			       	 		'type' => 'get_help',
			 			       	 		'mode' => 'manual'

			 			       	  ));

	 			       	  				redirect('Admin/Provide_help/get_Help');

	 			       		  }else{
	 			       	 		$this->session->set_flashdata('message','Invalid User Id!');
	 			       	    	}
	 			       	 }else{
	 			       	 	$this->session->set_flashdata('message','Enter Some Amount!');
	 			       	    }

 			       }else{
 			       		$this->session->set_flashdata('message','Error');
 			        }

 			}
 		  

 		   $this->load->view('get_Helper',$users);
 		}else{
 			redirect('Admin/Dashboard/selfLogin');
 		 }

 	}

 	public function help_Action($id){
 	   if(is_admin()){
 	   	 $users['first'] = 'Provide Help User Details';
  	   	 $users['data'] = $this->Main_model->get_records('tbl_bank_details',array('id' => $id),'*');
  	   	   $users['second'] = 'Provide Help History';
 	 	   $users['data1'] = $this->Main_model->get_records('tbl_investment_links',array('id' => $id),'*');
 	 	  
 	 	   $users['third'] = 'Get Action';
	 	   $users['user'] = $this->Main_model->get_records('tbl_investment','type = "get_help" AND amount != alloted_amount','*');


		 	     if($this->input->server('REQUEST_METHOD') == 'POST'){
		 			$data = $this->security->xss_clean($this->input->post());
		 			$this->form_validation->set_rules('id[]','Select','required');
		 			$this->form_validation->set_rules('amount[]','Select','required');
	 			       if($this->form_validation->run() != FALSE){
	 			       
			            	$Payer_amount = $this->Main_model->get_single_record('tbl_investment',array('id' => $id),'*');
			            	$link_amount = 0;

	 			            	foreach ($data['id'] as $key => $receiver) {
	 			           			$provide_amount = $this->Main_model->get_single_record('tbl_investment',array('id' => $id, 'type' => 'provide_help'),'user_id,amount,alloted_amount');
	  			       				$Receive_amount[$key] = $this->Main_model->get_single_record('tbl_investment',array('id' => $receiver, 'type' => 'get_help'),'*');
	  			       				$data['id'] = $Receive_amount[$key];

	  			       				$link_amount = $link_amount + $Receive_amount[$key]['amount'];	
	  			       			}

	  			       				$sender_amount = $Payer_amount['amount'] - $Payer_amount['alloted_amount'];

	  			       				if($link_amount <= $sender_amount){

	  			       				  foreach ($Receive_amount as $key => $invesments) {
	  			       				  	
		  			       				 $sender = $this->Main_model->get_single_record('tbl_users', array('user_id' => $provide_amount['user_id']), 'id,user_id,name,phone');
										 $receiver = $this->Main_model->get_single_record('tbl_investment', array('id' => $invesments['id']), '*');
										 	
										 	$Add = array(

										 			'sender_id' => $sender['user_id'],
										 			'receiver_id' => $invesments['user_id'],
										 			'amount' => $invesments['amount'],
										 			'sender_investment_id' => $id,
										 			'receiver_investment_id' => $invesments['id']
										 	  	 );
										 		
										 	$New = $this->Main_model->insert('tbl_investment_links',$Add);


										 	$provide_amount = $this->Main_model->get_single_record('tbl_investment',array('id' => $id, 'type' => 'provide_help'),'user_id,amount,alloted_amount');
	  			       						$Receive_amount = $this->Main_model->get_single_record('tbl_investment',array('id' => $receiver['id'], 'type' => 'get_help'),'*');

	  			       						$pAmount = ($provide_amount['alloted_amount']+$invesments['amount']);
	  			       						$gAmount = ($Receive_amount['alloted_amount']+$Receive_amount['amount']);
										 	$this->Main_model->update('tbl_investment',['id' =>$receiver['id']],['alloted_amount' => $gAmount]);
											$this->Main_model->update('tbl_investment',['id' =>$id],['alloted_amount'=>$pAmount]);
										 	
											$this->session->set_flashdata('message','Links Generated Successfully');
											
											$status = $this->Main_model->get_single_record('tbl_investment',['id' => $id],'ifnull(sum(amount),0) as amount');
										    $status1 = $this->Main_model->get_single_record('tbl_investment',['id' => $id],'ifnull(sum(alloted_amount),0) as alloted_amount');
										    $Rvstatus = $this->Main_model->get_single_record('tbl_investment',['id' => $Receive_amount['id']],'ifnull(sum(amount),0) as amount');
										    $Rvstatus1 = $this->Main_model->get_single_record('tbl_investment',['id' => $Receive_amount['id']],'ifnull(sum(alloted_amount),0) as alloted_amount');
										       if($status['amount'] == $status1['alloted_amount']){
										       		if($Rvstatus['amount'] == $Rvstatus1['alloted_amount']){	
										       		$this->Main_model->update('tbl_investment',['id' => $id],['status' => '1']);
										       		$this->Main_model->update('tbl_investment',['id' => $Receive_amount['id']],['status' => '1']);
										   			}
										       }
	  			       				  }
	  			       				}else {
										
										$this->session->set_flashdata('message','Links Amount Should Not Match');
	 			          			  }

		 	    		}
		 		 }

	 	   $this->load->view('help_Action',$users);
 	 	}


 	}

 
   public function Sent_Email(){
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$data = $this->security->xss_clean($this->input->post());
				$this->form_validation->set_rules('email','Email','required');
				$this->form_validation->set_rules('msg','Message','required');
				$this->form_validation->set_rules('sender','Email','required');

			       if($this->form_validation->run() != FALSE){
			       	 $user=array();
			
						$mesg = $this->load->view('Email_page/email',$user,true);

							$config=array(
									'charset'=>'utf-8',
									'wordwrap'=> TRUE,
									'mailtype' => 'html'
								);

							$this->email->initialize($config);
						 		
								$this->email->from($data['email'], 'Rejected Shayer');
								$this->email->to($data['sender']);
								$this->email->subject('Check Mail');
								$this->email->message($data['msg']);

								$this->email->send();
				
					}

	   }
		$this->load->view('arun');
	
   }

}