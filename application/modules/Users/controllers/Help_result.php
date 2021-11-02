<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Help_result extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
         $this->load->helper(array('user'));
    }

	public function help_result($id,$status){
		if(is_user($this->session->userdata('user_id'))){
			$user = $this->Main_model->update('tbl_investment_links',['id' => $id],['status' => $status]);
	             $data = $this->Main_model->get_single_record('tbl_investment_links',array('id' => $id),'sender_id,amount,sender_investment_id');
	            
	             	$this->session->set_flashdata('message','You Approved this Link');
	            if($status == 3){
	             	$data1 = $this->Main_model->get_single_record('tbl_users',array('user_id' => $data['sender_id']),'user_id,disabled');
	                $user = $this->Main_model->get_single_record('tbl_investment',array('user_id' => $data['sender_id']),'alloted_amount');
                   
                    $Final = abs($user['alloted_amount'] - $data['amount']);

             	    $this->Main_model->update('tbl_investment',['id' => $data['sender_investment_id']],['alloted_amount' => $Final,'status' => '0']);
		            $this->Main_model->update('tbl_users',['user_id' => $data1['user_id']],['disabled' => $status]);
		            $this->session->set_flashdata('message','You Rejected this Link');

        		}
					redirect('Users/Dashboard/index/');

		}else{
          redirect('Users/Dashboard/login');
        }
	}

    public function sendProof_form($id){
    	if($this->input->server('REQUEST_METHOD') =='POST'){
           $data = $this->security->xss_clean($this->input->post());
           $this->form_validation->set_rules('pay','Payment Method','trim|required');
             if($this->form_validation->run() != FALSE){
             	 $config['upload_path'] = './uploads/';
          	     $config['allowed_types'] = 'jpg|png|jpeg';

                $this->load->library('upload',$config);
	              if($this->upload->do_upload('proof_img')){

	                  $data1 = array('image2' => $this->upload->data());
	                  $user = $this->Main_model->update('tbl_investment_links',array('id' => $id) ,['payment_method' => $data['pay'],'attechment' => $data1['image2']['file_name']]);
                      

	                  $this->session->set_flashdata('message','You Successfuly Send Proof');	
	         	  }else{
	                $error = $this->upload->display_errors();
	                $this->session->set_flashdata('message',$error);
	              }
             }
        }       
                $Bank_details['header'] = 'Send Proof Details';
                $SELECT = $this->Main_model->get_single_record('tbl_investment_links',array('id' => $id),'*');
                $Bank_details['bank'] = $this->Main_model->get_single_record('tbl_bank_details',array('user_id' => $SELECT['receiver_id']),'*');

        $this->load->view('sendProof_form',$Bank_details);
    }

    public function receive_proof($id){
    	if(is_user($this->session->userdata('user_id'))){

	    	$user['header'] = 'Receive Proof Details';
	    	$user['Users'] = $this->Main_model->get_records('tbl_investment_links',array('id' => $id),'*');
	    	$user['total'] = $this->Main_model->get_single_record('tbl_investment_links',['receiver_id' => $this->session->userdata('user_id')],'ifnull(sum(amount),0) as total');	
	        $this->load->view('receive_proof',$user); 
        }else{
          redirect('Users/Dashboard/login');
        }
    }

    public function provide_History(){
    	if(is_user($this->session->userdata('user_id'))){

	    	$users['header'] = 'Provide Help History';
	        $users['user'] = $this->Main_model->get_records('tbl_investment_links','sender_id = "'.$this->session->userdata('user_id').'"','*');
	        $users['total'] = $this->Main_model->get_single_record('tbl_investment_links',['sender_id' => $this->session->userdata('user_id')],'ifnull(sum(amount),0) as total');

       		$this->load->view('provide_help_History',$users);
       	}else{
          redirect('Users/Dashboard/login');
        }
    }


   public function receive_History(){
	  if(is_user($this->session->userdata('user_id'))){

			$users['header'] = 'Receive Proof Details';
		    $users['user'] = $this->Main_model->get_records('tbl_investment_links','receiver_id = "'.$this->session->userdata('user_id').'"','*');
		    $users['total'] = $this->Main_model->get_single_record('tbl_investment_links',['receiver_id' => $this->session->userdata('user_id')],'ifnull(sum(amount),0) as total');
		    $this->load->view('receive_help_History',$users);

	  }else{
          redirect('Users/Dashboard/login');
        }
   }


}