<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Activation extends CI_controller{
	
	public function __construct(){
		parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin'));
	}

	public function activation($user_id,$status){

		$user = $this->Main_model->get_records('tbl_investment',array('user_id' => $user_id , 'type' => 'provide_help'),'*');
		// print_r($user);
		// die('Arun');
		if(!empty($user)){
			$data1 = $this->Main_model->get_single_record('tbl_investment',['user_id' => $user_id],'ifnull(sum(amount),0) as amount');
			$data2 = $this->Main_model->get_single_record('tbl_investment',['user_id' => $user_id],'ifnull(sum(alloted_amount),0) as alloted_amount');

				if($data1['amount'] == $data2['alloted_amount']){
					$this->Main_model->update('tbl_users',['user_id' => $user_id],['paid_status' => '1','package_id' => '1','package_amount' => $data1['amount'],'topup_date' => date('Y-m-d H:i:s')]);
					$this->session->set_flashdata('message','This User ID '.$user_id.' Activated Successfully');
					redirect('Admin/Dashboard/allusers/'.$status);
				}else{
					$this->session->set_flashdata('message','This User ID '.$user_id.' Not Complete Provide Help!');
					redirect('Admin/Dashboard/allusers/'.$status);
				}

		}else{
			$this->session->set_flashdata('message','This User ID '.$user_id.' Not Eligible To Activate!');
			redirect('Admin/Dashboard/allusers/'.$status);
		}
	}



}
