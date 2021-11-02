<?php

 defined('BASEPATH') OR exit('No direct script access allowed');

class Management_epin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
         $this->load->helper(array('admin'));
    }

     public function randepin(){

        $epin = strtoupper(md5(rand(100000,999999)));

        $data = $this->Main_model->get_records('tbl_epins',array('epin' => $epin),'*');
          if(!empty($data)){
                return randepin();
          }else{
             return $epin;
           }

    }

    public function genrateepin(){
        if(is_admin()){

            $user['package'] = $this->Main_model->get_records('tbl_package',array(),'id,title,price');
            $user['header'] = 'Genrate Epins';
            if($this->input->server('REQUEST_METHOD') == 'POST'){
              $data = $this->security->xss_clean($this->input->post());
               $this->form_validation->set_rules('user_id','User Id','required|trim');
               $this->form_validation->set_rules('package','package','required|trim');
               $this->form_validation->set_rules('nepins','No. of Epins','required|trim');
                    if($this->form_validation->run() != FALSE){

                        $user = $this->Main_model->get_single_record('tbl_users',array('user_id' => $data['user_id']),'user_id');
                          if(!empty($user)){
                            for ($i=1; $i <= $data['nepins'] ; $i++) { 
                               $value = array(
                                'user_id' => $data['user_id'],
                                'amount' => $data['package'],
                                'epin' => $this->randepin()
                               );
                               
                               $user1 = $this->Main_model->insert('tbl_epins',$value);
                            }
                            
                            $this->session->set_flashdata('message','Epin Genrated Successfuly');
                            redirect('Admin/Management_epin/genrateepin');

                          }else{
                            $this->session->set_flashdata('message','User Id Not Found!');
                           }

                    }else{
                      $this->session->set_flashdata('message','Plz Fill up All Fields Proper!');
                    }

            }

            $this->load->view('genrateepin',$user);
        }else{
            redirect('Admin/Dashboard/selfLogin');
         }
    }

    public function epinHistory($status){

      $users['status'] = $status;
      if($status == 0){

        $where = array('status' => 0);
        $users['header'] = 'Available Epins';
        $data['base_url'] = base_url('Admin/Management_epin/epinHistory/'.$status);
      }
      if($status == 1){

        $where = array('status' => 1);
        $users['header'] = 'Used Epins';
        $data['base_url'] = base_url('Admin/Management_epin/epinHistory/'.$status);
      }
      if($status == 2){

        $where = array('status' => 2);
        $users['header'] = 'Transfer Epins';
        $data['base_url'] = base_url('Admin/Management_epin/epinHistory/'.$status);
      }

       $users['user'] = $this->Main_model->get_records('tbl_epins',$where,'*');

      $this->load->view('epinhistory',$users);
    }

}