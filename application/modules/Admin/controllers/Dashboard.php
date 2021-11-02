<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
         $this->load->helper(array('admin'));
    }

    public function index() {
        if(is_admin()){

            $data['total'] = $this->Main_model->get_count(array(),'tbl_users');
            $data['paid'] = $this->Main_model->get_count(array('paid_status' => '1'),'tbl_users');
            $data['unpaid'] = $this->Main_model->get_count(array('paid_status' => '0'),'tbl_users');
            $data['block'] = $this->Main_model->get_count(array('disabled' => '1'),'tbl_users');
            $data['total_provide_help'] = $this->Main_model->get_single_record('tbl_investment',['type' => 'provide_help'],'ifnull(sum(amount),0) as amount');
            $data['total_get_help'] = $this->Main_model->get_single_record('tbl_investment',['type' => 'get_help'],'ifnull(sum(amount),0) as amount');

            $this->load->view('index.php',$data);
         }else{
            redirect('Admin/Dashboard/selfLogin');
         }   
    }

      public function adminLogin(){ 
        // if($this->input->server('REQUEST_METHOD') == 'POST'){
        // $data = $this->security->xss_clean($this->input->post());
        //   $this->form_validation->set_rules('admin_id','Admin ID','required|trim');
        //   $this->form_validation->set_rules('pass','password','required|trim');
        //     if($this->form_validation->run() != FALSE){
         
              // $user = $this->Main_model->get_single_record('tbl_admin',array('user_id' => $data['admin_id']),'user_id,password');
                // if(!empty($user)){
                    // if($data['admin_id'] == $user['user_id']){
                    //   if($data['pass'] == $user['password']){
                        $Array = array(
                                'admin_id' => 'admin',
                                'password' => 'admin',
                                'is_admin' => TRUE
                              );
                                $this->session->set_userdata($Array);
                                redirect('Admin/Dashboard/index');
            //           }else{

            //                 $this->session->set_flashdata('message','Invalid Password!');
            //                 }

            //         }else{

            //             $this->session->set_flashdata('message','Invalid User id!');
            //             }

            // }else{
            //   $this->session->set_flashdata('message','Plz Fillout Column Proper!');
            // }

        // }

        $this->load->view('login');
    }

    public function selfLogin(){ 
        if($this->input->server('REQUEST_METHOD') == 'POST'){
        $data = $this->security->xss_clean($this->input->post());
          $this->form_validation->set_rules('admin_id','Admin ID','required|trim');
          $this->form_validation->set_rules('pass','password','required|trim');
            if($this->form_validation->run() != FALSE){
         
              // $user = $this->Main_model->get_single_record('tbl_admin',array('user_id' => $data['admin_id']),'user_id,password');
                // if(!empty($user)){
                    if($data['admin_id'] == 'admin'){
                      if($data['pass'] == 'mlm_company'){
                        $Array = array(
                                'admin_id' => 'admin',
                                'password' => 'mlm_company',
                                'is_admin' => TRUE
                              );
                                $this->session->set_userdata($Array);
                                redirect('Admin/Dashboard/index');
                      }else{

                            $this->session->set_flashdata('message','Invalid Password!');
                            }

                    }else{

                        $this->session->set_flashdata('message','Invalid User id!');
                        }

            }else{
              $this->session->set_flashdata('message','Plz Fillout Column Proper!');
            }

        }

        $this->load->view('login');
    }

    public function uLogin() {
        // if (is_admin()) {
        $data = array(
                  'user_id' => 'admin',
                  'password' => 'admin',
                  'is_user' => TRUE
                   );
            $this->session->set_userdata($data);
            redirect('Users/Dashboard/index');
        // } else {
        //     redirect('Admin/Management/login');
        // }
    }

    public function logout(){

        $this->session->sess_destroy();
          redirect('Admin/Dashboard/logout2');
    }

     public function logout2(){

        $this->session->sess_destroy();
          redirect('https://gnisoftsolutions.com/portfolio/demo.php');
    }

    public function userName($user_id=''){

        $data = $this->Main_model->get_single_record('tbl_users',array('user_id' => $user_id),'name');
            if(!empty($data)){

                echo $data['name'];

            }else{
                echo "Invalid User Id!";
                }

    }

   public function allusers($status){
      if(is_admin()){

      		$users['searcher'] = 'Search User';
            $type = $this->input->get('type');
            $value = $this->input->get('value');
            if(!empty($type) ){
           // $search = array($type => $value);
        
            $users['status'] = $status;
            if($status == 0){
                $where = array('paid_status'=> 0,$type => $value);
                $users['header'] = 'All Users';
                $data['base_url'] = base_url('Admin/Dashboard/allusers/'.$status);
            }
            if($status == 1){
                $where = array('paid_status'=> 1,$type => $value);
                $users['header'] = 'Paid Users';
                $data['base_url'] = base_url('Admin/Dashboard/allusers/'.$status);
            }
            if($status == 2){
                $where = array('paid_status'=> 2,$type => $value);
                $users['header'] = 'Unpaid Users';
                $data['base_url'] = base_url('Admin/Dashboard/allusers/'.$status);
            }
            if($status == 3){
                $where = array('disabled'=> 3,$type => $value);
                $users['header'] = 'Block Users';
                $data['base_url'] = base_url('Admin/Dashboard/allusers/'.$status);
            }
        }else{
            $users['status'] = $status;
            if($status == 0){
                $where = array();
                $users['header'] = 'All Users';
                $data['base_url'] = base_url('Admin/Dashboard/allusers/'.$status);
            }
            if($status == 1){
                $where = array('paid_status >'=> 0);
                $users['header'] = 'Paid Users';
                $data['base_url'] = base_url('Admin/Dashboard/allusers/'.$status);
            }
            if($status == 2){
                $where = array('paid_status'=> 0);
                $users['header'] = 'Unpaid Users';
                $data['base_url'] = base_url('Admin/Dashboard/allusers/'.$status);
            }
            if($status == 3){
                $where = array('disabled >'=> 0);
                $users['header'] = 'Block Users';
                $data['base_url'] = base_url('Admin/Dashboard/allusers/'.$status);
            }
        }
        // $this->load->library('pagination');
        $config['base_url'] = $data['base_url'];
        $users['total_rows'] = $this->Main_model->get_count($where,'tbl_users');
        $config['total_rows'] = $users['total_rows'];
        $config['per_page'] = 10; 
        $config['uri_segment'] = 5;
        $config['full_tag_open'] = '<div class="dataTables_paginate paging_simple_numbers" id="default-datatable_paginate"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></div>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="paginate_button page-item active">';
        $config['first_tag_close'] = '</li>';
        $config['first_url'] = '';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="paginate_button page-item ">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li class="paginate_button page-item ">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li class="paginate_button page-item ">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="paginate_button page-item ">';
        $config['cur_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li class="paginate_button page-item ">';
        $config['num_tag_close'] = '</li>';
        //$config['attributes'] = array('class' => 'myclass');
        $this->pagination->initialize($config);
        $users['segment'] = $this->uri->segment(5);
        $users['user'] = $this->Main_model->get_limit_records('tbl_users', $where , '*',$config['per_page'],$users['segment']);

        $this->load->view('allusers',$users);
        }
        
    }

    public function user_login($user_id){
        if(is_admin()){
            $data = $this->Main_model->get_single_record('tbl_users',array('user_id' => $user_id),'user_id');
                if(!empty($data)){
                    $user = array(
                     'user_id' => $data['user_id'],
                     'password' => $data['password'],
                     'is_user' => TRUE
                    );
                    $this->session->set_userdata($user);
                    redirect('Users/Dashboard/index');
                }else{
                    redirect('Admin/Dashboard/selfLogin');
                 }

        }else{
            redirect('Admin/Dashboard/selfLogin');
          }

    }

    public function block_user($user_id,$status, $redirect_status){
        if(is_admin()){
            $data = $this->Main_model->get_single_record('tbl_users',array('user_id' => $user_id),'*');
             $data1 = $this->Main_model->update('tbl_users',['user_id' => $user_id],['disabled' => $status]);
               if($status > 0){
                $this->session->set_flashdata('message','Block User' .$user_id);

               }else{
                   $this->session->set_flashdata('message','Unblock User' .$user_id);

                 }
                redirect('Admin/Dashboard/allusers/'.$redirect_status);

        }else{
            redirect('Admin/Dashboard/selfLogin');
          }
 
    }

    public function edit_user($user_id){
        if(is_admin()){

            $users['header'] = 'Edit Form';
            $users['user'] = $this->Main_model->get_single_record('tbl_users',array('user_id' => $user_id),'*');
                if($this->input->server('REQUEST_METHOD') == 'POST'){
                   $data = $this->security->xss_clean($this->input->post());
                   $this->form_validation->set_rules('userName','User Name','trim|required');
                   $this->form_validation->set_rules('phone','Phone','trim|required');
                   $this->form_validation->set_rules('email','Email','trim|required');
                        if($this->form_validation->run() != FALSE){

                        $data = $this->Main_model->update('tbl_users',array('user_id' => $user_id),['name' => $data['userName'],'phone' => $data['phone'],'email' => $data['email']]);

                              $this->session->set_flashdata('message','Successfully Edit Details');
                              redirect('Admin/Dashboard/edit_user/'.$user_id);
                        }else{
                          $this->session->set_flashdata('message','Error');

                          }

                }

            $this->load->view('editform.php',$users);
        }else{
            redirect('Admin/Dashboard/selfLogin');
          }

    }

    public function admin_Profile(){
        if(is_admin()){

            $user = $this->Main_model->get_single_record('tbl_admin',array('id' => '1'),'*');

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|png|jpeg';

              $this->load->library('upload',$config);
             
            if($this->upload->do_upload('admin_proile')){

                  $data1 = array('image2' => $this->upload->data());
                  // $user = $this->Main_model->get_single_record('tbl_admin',array('id' => '1'),'*');
                      $error = $this->upload->display_errors();
                      $this->session->set_flashdata('message',$error);
                     print_r($data1);
                     die('OKk');
                     $this->Main_model->update('tbl_admin',['user_id' => $user['user_id']],['image' => $data1['image2']['file_name'],]);
                     $this->session->set_flashdata('message','Successfully Updated');
                   redirect('Admin/Dashboard/index');  
            }   
        }else{
            redirect('Admin/Dashboard/selfLogin');
          }
          // redirect('Admin/Dashboard/index');
    }


}
