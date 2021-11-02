<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('user'));
    }

    public function index() {
      if(is_user($this->session->userdata('user_id'))){

        $user['total'] = $this->Main_model->get_count(array(),'tbl_users');
        $user['helper'] = $this->Main_model->get_records('tbl_investment_links','status = "0" AND sender_id = "'.$this->session->userdata('user_id').'" OR receiver_id = "'.$this->session->userdata('user_id').'"','*');
        foreach ($user['helper'] as $key => $value) {
        	$user['helper'][$key]['sender_details'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $value['sender_id']),'name,phone');
        	$user['helper'][$key]['receiver_details'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $value['receiver_id']),'name,phone');
        }
          // $user2['helper']['bank_details'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $value['receiver_id']),'bank_name,bank_account_number');
          //   print_r($user2);
          //   die('okk');
        // $data = $this->Main_model->get_records('tbl_investment',array('user_id' => $this->session->userdata['user_id']),'*');

        // $data1 = $this->Main_model->get_records('tbl_investment_links',array('sender_id' => $data['user_id']),'*');
        // // print_r($data1);
        // // die('OKK');
        // $user2['bank_details'] = $this->Main_model->get_records('tbl_bank_details',array('user_id' => $data1['user_id']),'*');
        // $user2['help'] = $this->Main_model->get_records('tbl_users',array('user_id' => $this->session->userdata('user_id')),'*');

          $this->load->view('index.php',$user);
      }else{
          redirect('Users/Dashboard/login');
          }

    }

    public function login(){
        if($this->input->server('REQUEST_METHOD') =='POST'){
           $data = $this->security->xss_clean($this->input->post());
           $this->form_validation->set_rules('user_id','User ID','trim|required');
           $this->form_validation->set_rules('pass','User ID','trim|required');
             if($this->form_validation->run() != FALSE){

                $user = $this->Main_model->get_single_record('tbl_users',array('user_id' => $data['user_id']),'user_id,password,disabled');
                    // if(!empty($user)){
                    if($data['user_id'] == $user['user_id']){
                        if($data['pass'] == $user['password']){
                              if($user['disabled'] <= 0){
                                $data = array(
                                  'user_id' => $data['user_id'],
                                  'password' => $data['pass'],
                                  'is_user' => TRUE
                                   );

                                $this->session->set_userdata($data);
                                  redirect('Users/Dashboard/index');

                              }else{
                                $this->session->set_flashdata('message','This User is Block!');
                               }
                        }else{

                          $this->session->set_flashdata('message','Invalid Password!');
                          }
                    }else{

                        $this->session->set_flashdata('message','Invalid User id!');
                     }

             }else{

                $this->session->set_flashdata('message','Plz Fillout All Fields Proper!');
              }

        }

      $this->load->view('login');
    }

    public function logout(){

        $this->session->sess_destroy();
            redirect('Users/Dashboard/login');
    }

    // public function logout2(){

    //     $this->session->sess_destroy();
    //      redirect('https://gnisoftsolutions.com/portfolio/demo.php');

    // }

    // public function success($response){

    //     $this->load->view('Users/success',$response);
        
    // }

    public function register(){
        if($this->input->server('REQUEST_METHOD') == 'POST'){
          $data = $this->security->xss_clean($this->input->post());
           $this->form_validation->set_rules('sponser_id','Sponser Id','required|trim');
           $this->form_validation->set_rules('username','User Name','required|trim');
           $this->form_validation->set_rules('email','Email','required|trim');
           $this->form_validation->set_rules('phone','Phone','required|min_length[10]|max_length[10]');
           $this->form_validation->set_rules('epin','Epin','required|trim');

               if($this->form_validation->run() != FALSE){
                  // if (!preg_match('/^[6-9][0-9]{9,9}$/', $data['phone'])){
                    
                     $data1 = $this->Main_model->get_single_record('tbl_epins',array('epin' => $data['epin']),'*');
                      if($data['epin'] == $data1['epin']){
                          if($data1['status'] == 0){
                            $user_id = $this->randUser_id();
                            $password = $this->password();
                            $masterkey = rand(10000,99999);
                            $this->Email_page($data['email'],'Dear'.$data['username'].'Your User ID : '.$user_id.', Password : '.$password.', Transation PIN : '.$masterkey. '.');
                            $user = $this->Main_model->insert('tbl_users',array( 

                               'sponser_id' => $data['sponser_id'],
                               'name' => $data['username'],
                               'epin' => $data['epin'],
                               'email' => $data['email'],
                               'phone' => $data['phone'],
                               'user_id' => $user_id,
                               'password' => $password,
                               'master_key' => $masterkey

                            ));

                            $users = $this->Main_model->get_single_record('tbl_users',array('user_id' => $data['sponser_id']),'*');
                            // $Add_Direct = $users['directs']+1;
                            
                            $this->Main_model->update('tbl_users',array('user_id' => $users['user_id']),['directs' => $users['directs']+1]);

                            $user1 = $this->Main_model->update('tbl_epins',array('epin' => $data['epin']),array('status' => 1,'used_for' => $user_id));
                            $user2 = $this->Main_model->get_single_record('tbl_package',array('id' => 1),'*');
                             $data2 = explode(',', $user2['provide_help']);
                             if($user2['provide_status'] == 0){
                                foreach ($data2 as $key => $value) {
                                    $this->Main_model->insert('tbl_investment',array('user_id' => $user_id,'amount' => $value,'type' => 'provide_help','mode' => 'auto')); 
                                }
                              }

                              $this->countdownline($user_id,$user_id,$level = '1');

                              $response['msg'] = $user_id.','.$password.','.$masterkey;

                            $this->load->view('Users/success',$response);
                         }else{

                              $this->session->set_flashdata('message','Invalid Epin!');
                          
                            }    

                          }else{

                              $this->session->set_flashdata('message','Epin Not Matched!');
                             
                            }

                      // }else{

                      //    $this->session->set_flashdata('message','Fillout Valid Phone Number!');
                             
                      //  }

               }else{

                    $this->session->set_flashdata('message','Plz Fillout Proper Column!');
                 }

        }
        $this->load->view('Site/register');
    }

     public function Email_page($to,$msg){
    $data=array();
    // $mesg = $this->load->view('template/email',$data,true);
    // or
    // $mesg = $this->load->view('Email_page',$data,true);


    $config=array(
    'charset'=>'utf-8',
    'wordwrap'=> TRUE,
    'mailtype' => 'html'
    );

    $this->email->initialize($config);
    //$this->email->initialize($config);
        
        $this->email->from('ak4633343@gmail.com', 'Rejected Shayer');
        $this->email->to($to);
        $this->email->subject('Check Mail');
        $this->email->message($msg);

        $this->email->send();

    //$this->load->view('Email_page');
  }



    public function countdownline($user_id,$downline_id,$level){

        $user = $this->Main_model->get_single_record('tbl_users',array('user_id' => $user_id),'sponser_id,user_id');

          if(!empty($user['sponser_id'])){

              $data = $this->Main_model->insert('tbl_downline_count',array('user_id' => $user['sponser_id'],'downline_id' => $downline_id,'level' => $level,'created_at' => date('Y-m-d H:i:s')));

              $user_id = $user['sponser_id'];
              
              $this->countdownline($user_id ,$downline_id,$level+1);
          }

    }

    public function password() {

    $chars = array(
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
        'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
        'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' 
       
    );

    shuffle($chars);

        $num_chars = count($chars) - 56;
        $token = '';

        for ($i = 0; $i < $num_chars; $i++){ // <-- $num_chars instead of $len
            $token .= $chars[mt_rand(0, $num_chars)];
        }

        return $token;
    }

    public function sponser_name($user_id=''){

        $data = $this->Main_model->get_single_record('tbl_users',array('user_id' => $user_id),'name');
            if(!empty($data)){

                echo $data['name'];

            }else{
                echo "Invalid User Id!";
                }

    }

    public function check_epin($epin=''){

        $data = $this->Main_model->get_single_record('tbl_epins',array('epin' => $epin,'status' =>0),'epin');
            if(!empty($data)){

                echo "valid Epin";

            }else{
                echo "Invalid Epin!";
                }

    }

  public function edit_profile(){
      if(is_user($this->session->userdata('user_id'))){

        $users['header'] = 'Edit Form';
        $users['user'] = $this->Main_model->get_single_record('tbl_users',array('user_id' => $this->session->userdata('user_id')),'*');
          if($this->input->server('REQUEST_METHOD') == 'POST'){
            $data = $this->security->xss_clean($this->input->post());
             $this->form_validation->set_rules('userName','User Name','trim');
             $this->form_validation->set_rules('phone','Phone','trim|max_length[10]|min_length[10]|numeric');
             $this->form_validation->set_rules('email','Email','trim');
             $this->form_validation->set_rules('city','City','trim');

            	   if($this->form_validation->run() != FALSE){
                     $config = ['upload_path' => './uploads/',
                               'allowed_types' => 'jpg|png|jpeg'];
                             $this->load->library('upload',$config);
                             $this->upload->do_upload('profile_img');
                             $data1 = array('image2' => $this->upload->data());
                              // $post['image_path'] = $image_path;
                        $user = $this->Main_model->update('tbl_users',['user_id' => $this->session->userdata('user_id')],['name' => $data['userName'],'phone' => $data['phone'],'email' => $data['email'],'city' => $data['city'],'image' => $data1['image2']['file_name'],]);
                           $this->session->set_flashdata('message','Successfully Updated');
                           redirect('Users/Dashboard/edit_profile');
                      // } 
                      // else{
                      //       $error = $this->upload->display_errors();
                      //     $this->session->set_flashdata('message',$error);
                      // } 
                  }else{

                    $this->session->set_flashdata('message','Plx Fillout Field Proper!');
                   }

          }

         $this->load->view('editprofile',$users);
      }else{
          redirect('Users/Dashboard/login');
        }
  }

  public function add_bank_Details(){
      if(is_user($this->session->userdata('user_id'))){

          $users['header'] = 'ADD Bank Details';
          $users['user'] = $this->Main_model->get_single_record('tbl_bank_details',array('user_id' => $this->session->userdata('user_id')),'*');
            if($this->input->server('REQUEST_METHOD') == 'POST'){
              $data = $this->security->xss_clean($this->input->post());
                 $this->form_validation->set_rules('accHolder_Name','Account Holder Name','trim');
                 $this->form_validation->set_rules('bank_Name','Bank Name','trim');
                 $this->form_validation->set_rules('acc_Numbr','Account Number','trim');
                 $this->form_validation->set_rules('ifsc_code','IFSC Code','trim');
                 $this->form_validation->set_rules('aadhar_Numbr','Aadhar Number','trim');

               if($this->form_validation->run() != FALSE){
                          // $Add = array(
                          //     'user_id' => $this->session->userdata('user_id'),
                          //     'bank_Name' => $data['bank_Name'],
                          //     'bank_account_number' => $data['acc_Numbr'],
                          //     'account_holder_name' => $data['accHolder_Name'],
                          //     'ifsc_code' => $data['ifsc_code'],
                          //     'aadhar' => $data['aadhar_Numbr']
                          //    );
                     $this->Main_model->update('tbl_bank_details',['user_id' => $this->session->userdata('user_id')],['bank_Name' => $data['bank_Name'],'bank_account_number' => $data['acc_Numbr'],'account_holder_name' => $data['accHolder_Name'],'ifsc_code' => $data['ifsc_code'],'aadhar' => $data['aadhar_Numbr']]);
                          // $this->Main_model->insert('tbl_bank_details',$Add);
                     $this->session->set_flashdata('message','ADD Bank Details Successfully');
                   		redirect('Users/Dashboard/add_bank_Details');
                }else{
                   $this->session->set_flashdata('message','Plx Fillout Field Proper!');
                 }

            }

          $this->load->view('add_bank_Details',$users);
      }else{
          redirect('Users/Dashboard/login');
        }
  }

  public function randUser_id(){

      $usrid = 'AK'.rand(1000,9999);
      $data = $this->Main_model->get_records('tbl_users',array('user_id' => $usrid),'*');
        if(!empty($data)){
          return randUser_id();
        }else{
          return $usrid;
          }

  }

  public function randEpin(){

      $epin = strtoupper(md5(rand(100000,999999)));
      $data = $this->Main_model->get_records('tbl_epins',array('epin' => $epin),'*');
        if(!empty($data)){
          return randEpin();
        }else{
          return $epin;
          }

  }

  public function transfer_epin(){

      if(is_user($this->session->userdata('user_id'))){
        if($this->input->server('REQUEST_METHOD') == 'POST'){
          $data = $this->security->xss_clean($this->input->post());
           $this->form_validation->set_rules('user_id','User Id','required|trim');
           $this->form_validation->set_rules('nepins','No. of Epins','required|trim');
           $this->form_validation->set_rules('txnpass','Transation Password','required|trim');
              if($this->form_validation->run() != FALSE){

                $user = $this->Main_model->get_single_record('tbl_users',array('user_id' => $this->session->userdata('user_id')),'user_id,master_key');
                $user1 = $this->Main_model->get_single_record('tbl_epins',array('user_id' => $this->session->userdata('user_id'),'status' => 0),'count(epin) as epins');
                
	              if($data['txnpass'] == $user['master_key']){
	              	if($data['nepins'] == $user1['epins']){
  		                for ($i=1; $i <= $data['nepins'] ; $i++) { 
  		                  
  		                    $user2 = $this->Main_model->get_single_record('tbl_epins',array('user_id' => $this->session->userdata('user_id'),'status' => 0),'*');

  		                    $updaTE = $this->Main_model->update('tbl_epins',array('user_id' => $this->session->userdata('user_id'),'id' => $user2['id']),['status' => '2', 'used_for' => $data['user_id']]);

  		                    $user3 = $this->Main_model->update('tbl_epins',array('user_id' => $data['user_id'],'epin' => $this->randEpin(), 'sender_id' => $this->session->userdata['user_id']));

  		                        $this->session->set_flashdata('success','E-pin Transfer Successfully');

  		                }
  		            }else{
  	                   $this->session->set_flashdata('error','Insufficient NO. of E-Pins');
  	               	  }
	              }else{
	                 $this->session->set_flashdata('error','Transaction password is Not Matched');
	               }

              }else{
                  $this->session->set_flashdata('error','Plz Fillout All Fields Proper');
              }

        }

      }

      $this->load->view('transfer_epin');
  }

  public function epinsHistory($status){
     if(is_user($this->session->userdata('user_id'))){

        $user['status'] = $status;

          if($status == 0){
            $where = array('status' => 0);
            $user['header'] = 'Available Epins';
            $data = base_url('Users/Dashboard/epins_History/'.$status);
          }
          if($status == 1){
            $where = array('status' => 1);
            $user['header'] = 'Used Epins';
            $data = base_url('Users/Dashboard/epinsHistory/'.$status);
          }
          if($status == 2){
            $where = array('status' => 2);
            $user['header'] = 'Transfer Epins History';
            $data = base_url('Users/Dashboard/epinsHistory/'.$status);
          }

        $user['data1'] = $this->Main_model->get_records('tbl_epins',$where,'*');
        // $user['total'] = $this->Main_model->get_single_record('tbl_epins',array('status' => $status),'ifnull(sum(epin),0) as total');
      
        $this->load->view('epins_History',$user);
        
     }else{
        redirect('Users/Dashboard/login');
       }
  }

  public function incomeTable($type){
      if(is_user($this->session->userdata('user_id'))){

          $data['header'] = ucfirst(str_replace('_', ' ', $type));
          $data['user'] = $this->Main_model->get_records('tbl_income_wallet',array('type' => $type,'user_id' => $this->session->userdata('user_id')),'*');

             $this->load->view('incomes',$data);

       }else{
            redirect('Users/Dashboard/login');
          }

    }

    
}
