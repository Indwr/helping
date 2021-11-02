<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Userfund_Request_Management extends CI_controller{
	
	public function __construct(){
		parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin'));
	}

	public function userFund_Request($status){
		if(is_admin()){
		   if($status == 0){
 				$where = array('status' => 0);
 				$data['header'] = 'Fund Requests';
		    }
		   if($status == 1){
		   		$where = array('status' => 1);
		   		$data['header'] = 'Approve Request';
		    }
		   if($status == 2){
		   		$where = array('status' => 2);
		   		$data['header'] = 'Reject Request';
		    }

			$data['user'] = $this->Main_model->get_records('tbl_payment_request',$where,'*');
		   $this->load->view('user_fundRequest',$data);
		}else{
			redirect('Admin/Dashboard/selfLogin');
		}

	}

	public function fund_management($status,$user_id,$id){
		if(is_admin()){
		    if($status == 1){
				$where = array('status' => 1);
				$data['header'] = 'Approve Request';
			 }
			if($status == 2){
				$where = array('status' => 2);
				$data['header'] = 'Reject Request';
			 }

		  $data = $this->Main_model->get_single_record('tbl_payment_request',array('user_id' => $user_id, 'id' => $id),'*');
		 if($data['status'] == 0){
		 	$data1 = $this->Main_model->insert('tbl_wallet',array('user_id' => $data['user_id'],'amount' => $data['amount'],'type' => 'admin_fund','remark' => 'Fund Approve by Admin'));
		  }
		    $data2 = $this->Main_model->update('tbl_payment_request',array('user_id' => $user_id, 'id' => $id),array('status' => $status));
		    redirect('Admin/Userfund_Request_Management/userFund_Request/'.$status);
		}else{
			redirect('Admin/Dashboard/selfLogin');
		 }

	}

}
