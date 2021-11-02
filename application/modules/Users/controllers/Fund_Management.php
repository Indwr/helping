<?php

defined('BASEPATH') OR exit('No direct script access allowed');

 class Fund_Management extends CI_controller{
  
  public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('user'));
    }

  public function fund_request(){
    if(is_user($this->session->userdata('user_id'))){

	 	 if ($this->input->server('REQUEST_METHOD') == 'POST'){

	 	 $data = $this->security->xss_clean($this->input->post());
		 	 	 $this->form_validation->set_rules('pay', 'Payment Method', 'required|trim');
				 $this->form_validation->set_rules('amount', 'Amount','required|trim');
				 $this->form_validation->set_rules('txn_id', 'Transation id', 'required|trim');
         // $this->form_validation->set_rules('proof_img','Proof','required|trim');
        // print_r($data);

				if($this->form_validation->run() != FALSE){
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|png|jpeg';

                $this->load->library('upload',$config);
               if($this->upload->do_upload('proof_img')){

                  $data1 = array('image2' => $this->upload->data());
                  $this->Main_model->insert('tbl_payment_request',

                    array(
                      
                        'user_id' => $this->session->userdata('user_id'),
                        'payment_method' => $data['pay'],
                        'amount' => $data['amount'],
                        'transation_id' => $data['txn_id'],
                        'image' => $data1['image2']['file_name'],
                        'remarks' => 'fund_request'

                  ));

                    $this->session->set_flashdata('message','success');

               }else{
                  $error = $this->upload->display_errors();
                   $this->session->set_flashdata('message',$error);
                 }

          }else{
          		//$error = $this->upload->display_errors();
               $this->session->set_flashdata('message','Error');
            
           }

       }
      $this->load->view('request_fund');
    }else{
      redirect('Users/Dashboard/login');
    }

  }

  public function fund_History(){
  	  if(is_user($this->session->userdata('user_id'))){

  	  	 $data['header'] = 'Fund History';
  	  	 $data['user'] = $this->Main_model->get_records('tbl_payment_request',array('user_id' => $this->session->userdata('user_id')),'*');

  		$this->load->view('fund_History',$data);
  	  }
  }

}
