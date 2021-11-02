
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Withdraw extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email', 'pagination', 'Excel'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
//        require_once( APPPATH . 'modules/Admin/libraries/SimpleExcel/SimpleExcel.php');
//        if (file_exists(APPPATH . 'modules/Admin/libraries/SimpleExcel/SimpleExcel.php')) {
//            echo'file exist';
//        }
    }

    public function index() {
        if (is_admin()) {
            $where = array();
            $config['total_rows'] = $this->Main_model->get_sum('tbl_withdraw', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url('Admin/Withdraw/index');
            $config ['uri_segment'] = 4;
            $config['per_page'] = 10;
            $config['attributes'] = array('class' => 'page-link');
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li class="paginate_button page-item ">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="paginate_button page-item  active"><a href="#" class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li class="paginate_button page-item ">';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="paginate_button page-item next">';
            $config['last_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
            $config['prev_tag_open'] = '<li class="paginate_button page-item previous">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li  class="paginate_button page-item next">';
            $config['next_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['segament'] = $segment;
            $response['total_records'] = $config['total_rows'];
            $response['requests'] = $this->Main_model->get_limit_records('tbl_withdraw', $where, '*', $config['per_page'], $segment);
            
            foreach ($response['requests'] as $key => $request) {
                $response['requests'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $request['user_id']), 'id,first_name,name,last_name,sponser_id,email,phone');
                $response['requests'][$key]['bank'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $request['user_id']), '*');
            }
            $this->load->view('withdrawRequest', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    
    public function bank_transactions() {
        if (is_admin()) {
            $response = array();
            $response['records'] = $this->Main_model->get_records('tbl_money_transfer', array(), '*');;
            foreach($response['records'] as $key => $request){
                $response['records'][$key]['user'] = $this->Main_model->get_single_record('tbl_users',['user_id' => $request['user_id']],'name,phone');
            }
            $this->load->view('bank_transactions', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }


    public function withdrawSettings() {
        if (is_admin()) {
            $response = array();
            $response['records'] = $this->Main_model->get_records('tbl_withdraw_settings', array(), '*');

            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                     $array = array(
                        'status' => $data['status'],
                    );
                    $res = $this->Main_model->update('tbl_withdraw_settings', array(), $array);
                    if ($res) {
                        $this->session->set_flashdata('message', 'Request Submitted Successfully.');
                    } else {
                        $this->session->set_flashdata('error', 'Error while submit request.');
                    }
            }

            $this->load->view('withdrawSettings', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }


    public function EditWithdraw($id) {
        if (is_admin()) {
            $response = array();
            $response['record'] = $this->Main_model->get_single_record('tbl_withdraw_settings', array('id' => $id), '*');;
            $this->load->view('EditWithdraw', $response);
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                     $array = array(
                        'time_start' => $data['time_start'],
                        'time_stop' => $data['time_stop'],
                        'status' => $data['status'],
                    );
                    $res = $this->Main_model->update('tbl_withdraw_settings', array('id' => $id), $array);
                    if ($res) {
                        $this->session->set_flashdata('message', 'Successfully Edit Day '.$response['record']['day'].'');
                    } else {
                        $this->session->set_flashdata('error', 'Error while edit request');
                    }
            }
        } else {
            redirect('Admin/Management/login');
        }
    }


    public function Pending() {
        if (is_admin()) {
            // $response['requests'] = $this->Main_model->get_records('tbl_withdraw', array('status' => 0), '*');
            $where = array('status' => 0);
            $config['total_rows'] = $this->Main_model->get_sum('tbl_withdraw', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Withdraw/Pending';
            $config ['uri_segment'] = 4;
            $config['per_page'] = 10;
            $config['attributes'] = array('class' => 'page-link');
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li class="paginate_button page-item ">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="paginate_button page-item  active"><a href="#" class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li class="paginate_button page-item ">';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="paginate_button page-item next">';
            $config['last_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
            $config['prev_tag_open'] = '<li class="paginate_button page-item previous">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li  class="paginate_button page-item next">';
            $config['next_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['requests'] = $this->Main_model->get_limit_records('tbl_withdraw', $where, '*', $config['per_page'], $segment);
            foreach ($response['requests'] as $key => $request) {
                $response['requests'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $request['user_id']), 'id,name,first_name,last_name,sponser_id,email,phone');
                $response['requests'][$key]['bank'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $request['user_id']), '*');
            }
            $response['segament'] = $segment;
            $response['total_records'] = $config['total_rows'];
            $this->load->view('withdraw_requests', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function pendingWithdrawRequest() {
        if (is_admin()) {
            // $response['requests'] = $this->Main_model->get_records('tbl_withdraw', array('status' => 0), '*');
            $where = array('status' => 0);
            $config['total_rows'] = $this->Main_model->get_sum('tbl_withdraw', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Withdraw/Pending';
            $config ['uri_segment'] = 4;
            $config['per_page'] = 10;
            $config['attributes'] = array('class' => 'page-link');
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li class="paginate_button page-item ">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="paginate_button page-item  active"><a href="#" class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li class="paginate_button page-item ">';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="paginate_button page-item next">';
            $config['last_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
            $config['prev_tag_open'] = '<li class="paginate_button page-item previous">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li  class="paginate_button page-item next">';
            $config['next_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['requests'] = $this->Main_model->get_limit_records('tbl_withdraw', $where, '*', $config['per_page'], $segment);
            foreach ($response['requests'] as $key => $request) {
                $response['requests'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $request['user_id']), 'id,name,first_name,last_name,sponser_id,email,phone');
                $response['requests'][$key]['bank'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $request['user_id']), '*');
            }
            $response['segament'] = $segment;
            $response['total_records'] = $config['total_rows'];
            $this->load->view('withdrawRequest', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }


    public function excelList() {
        if (is_admin()) {
            $response['requests'] = $this->Main_model->get_records('tbl_withdraw', array('status' => 0), '*');
            foreach ($response['requests'] as $key => $request) {
                $response['requests'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $request['user_id']), 'id,first_name,name,last_name,sponser_id,email,phone');
                $response['requests'][$key]['bank'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $request['user_id']), '*');
            }
            $this->load->view('withdraw_excel', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function Approved() {
        if (is_admin()) {
            // $response['requests'] = $this->Main_model->get_records('tbl_withdraw', array('status' => 1), '*');
            $where =  array('status' => 1);
            $config['total_rows'] = $this->Main_model->get_sum('tbl_withdraw', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url('Admin/Withdraw/Approved');
            $config ['uri_segment'] = 4;
            $config['per_page'] = 10;
            $config['attributes'] = array('class' => 'page-link');
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li class="paginate_button page-item ">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="paginate_button page-item  active"><a href="#" class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li class="paginate_button page-item ">';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="paginate_button page-item next">';
            $config['last_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
            $config['prev_tag_open'] = '<li class="paginate_button page-item previous">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li  class="paginate_button page-item next">';
            $config['next_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['segament'] = $segment;
            $response['total_records'] = $config['total_rows'];
            $response['requests'] = $this->Main_model->get_limit_records('tbl_withdraw', $where, '*', $config['per_page'], $segment);
            
            foreach ($response['requests'] as $key => $request) {
                $response['requests'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $request['user_id']), 'id,first_name,name,last_name,sponser_id,email,phone');
                $response['requests'][$key]['bank'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $request['user_id']), '*');
            }
            foreach ($response['requests'] as $key => $request) {
                $response['requests'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $request['user_id']), 'id,name,first_name,last_name,sponser_id,email,phone');
                $response['requests'][$key]['bank'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $request['user_id']), '*');
            }
            $this->load->view('approvedWithdraw', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function Rejected() {
        if (is_admin()) {
            // $response['requests'] = $this->Main_model->get_records('tbl_withdraw', array('status' => 2), '*');
            $where =  array('status' => 2);
            $config['total_rows'] = $this->Main_model->get_sum('tbl_withdraw', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url('Admin/Withdraw/index');
            $config ['uri_segment'] = 4;
            $config['per_page'] = 10;
            $config['attributes'] = array('class' => 'page-link');
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li class="paginate_button page-item ">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="paginate_button page-item  active"><a href="#" class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li class="paginate_button page-item ">';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="paginate_button page-item next">';
            $config['last_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
            $config['prev_tag_open'] = '<li class="paginate_button page-item previous">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li  class="paginate_button page-item next">';
            $config['next_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['segament'] = $segment;
            $response['total_records'] = $config['total_rows'];
            $response['requests'] = $this->Main_model->get_limit_records('tbl_withdraw', $where, '*', $config['per_page'], $segment);
            
            foreach ($response['requests'] as $key => $request) {
                $response['requests'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $request['user_id']), 'id,first_name,name,last_name,sponser_id,email,phone');
                $response['requests'][$key]['bank'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $request['user_id']), '*');
            }
            foreach ($response['requests'] as $key => $request) {
                $response['requests'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $request['user_id']), 'id,name,first_name,last_name,sponser_id,email,phone');
                $response['requests'][$key]['bank'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $request['user_id']), '*');
            }
            foreach ($response['requests'] as $key => $request) {
                $response['requests'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $request['user_id']), 'id,name,first_name,last_name,sponser_id,email,phone');
                $response['requests'][$key]['bank'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $request['user_id']), '*');
            }
            $this->load->view('rejectedWithdraw', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function request($id) {
        if (is_admin()) {
            $response['request'] = $this->Main_model->get_single_record('tbl_withdraw', array('id' => $id), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($response['request']['status'] != 0) {
                    $this->session->set_flashdata('message', 'Status of this request already updated!');
                } else {
                    if ($data['status'] == 1) {
                        $wArr = array(
                            'status' => 1,
                            'remark' => $data['remark'],
                        );
                        $res = $this->Main_model->update('tbl_withdraw', array('id' => $id), $wArr);
                        if ($res) {
                            $this->session->set_flashdata('message', 'Withdraw request approved');
                        } else {
                            $this->session->set_flashdata('message', 'Error while apporing request');
                        }
                    } elseif ($data['status'] == 2) {
                        $wArr = array(
                            'status' => 2,
                            'remark' => $data['remark'],
                        );
                        $res = $this->Main_model->update('tbl_withdraw', array('id' => $id), $wArr);
                        if ($res) {
                            $productArr = array(
                                'user_id' => $response['request']['user_id'],
                                'amount' => $response['request']['amount'],
                                'type' => $response['request']['type'],
                                'description' => $data['remark'],
                            );
                            $this->Main_model->add('tbl_income_wallet', $productArr);
                            $this->session->set_flashdata('message', 'Withdraw request rejected');
                        } else {
                            $this->session->set_flashdata('message', 'Error while apporing rejection');
                        }
                    }
                }
            }
            $response['request'] = $this->Main_model->get_single_record('tbl_withdraw', array('id' => $id), '*');
            $response['user_details'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $response['request']['user_id']), 'id,name,first_name,last_name,sponser_id,email,phone');
            $this->load->view('request', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }



    public function request2($id, $action, $segmet) {
        if (is_admin()) {
            $response['request'] = $this->Main_model->get_single_record('tbl_withdraw', array('id' => $id), '*');
            if($action == 'approve'){
                if($response['request']['status'] == 0){
                    $wArr = array(
                            'status' => 1,
                            'remark' => 'Request Approved by Admin',
                        );
                        $res = $this->Main_model->update('tbl_withdraw', array('id' => $id), $wArr);
                        if ($res) {
                            $this->session->set_flashdata('message', 'Withdraw request approved');
                            redirect('Admin/Withdraw/index/'.$segmet);
                        } else {
                            $this->session->set_flashdata('message', 'Error while apporing request');
                            redirect('Admin/Withdraw/index/'.$segmet);
                        }
                }elseif($response['request']['status'] == 1){
                    $this->session->set_flashdata('message', 'This withdraw request is already Approved.');
                    redirect('Admin/Withdraw');
                }else{
                    $this->session->set_flashdata('message', 'This withdraw request is already Rejected.');
                    redirect('Admin/Withdraw');
                }
            }elseif($action == 'reject'){
                if($response['request']['status'] == 0){
                    $wArr = array(
                            'status' => 2,
                            'description' => 'Request Reject by Admin',
                        );
                        $res = $this->Main_model->update('tbl_withdraw', array('id' => $id), $wArr);
                        if ($res) {
                            $DirectIncome = array(
                            'user_id' => $response['request']['user_id'],
                            'amount' => $response['request']['amount'],
                            'type' => 'withdraw_request',
                            'description' => 'Withdraw Request Reject Amount Refund',
                        );
                        // pr($DirectIncome);
                        if($response['request']['remark'] == 'Pool Income Withdraw'){
                            $this->Main_model->add('tbl_pool_income', $DirectIncome);
                        }else{
                            $this->Main_model->add('tbl_income_wallet', $DirectIncome);
                        }

                            $this->session->set_flashdata('message', 'Withdraw request Rejected');
                            redirect('Admin/Withdraw/index/'.$segmet);
                        } else {
                            $this->session->set_flashdata('message', 'Error while apporing request');
                            redirect('Admin/Withdraw/index/'.$segmet);
                        }
                }elseif($response['request']['status'] == 1){
                    $this->session->set_flashdata('message', 'This withdraw request is already Approved.');
                    redirect('Admin/Withdraw/index/'.$segmet);
                }else{
                    $this->session->set_flashdata('message', 'This withdraw request is already Rejected.');
                    redirect('Admin/Withdraw/index/'.$segmet);
                }
            }else{
                $this->session->set_flashdata('message', 'Sorry this way is not vaild.');
                redirect('Admin/Withdraw/index/'.$segmet);
            }
            // header('Location: https://realbusinesslife.biz/Admin/Withdraw/pendingWithdrawRequest');
            redirect('Admin/Withdraw');
            //$this->load->view('withdrawRequest', $response);

        } else {
            redirect('Admin/Management/login');
        }
    }



    public function income() {
        if (is_admin()) {
            $type = $this->uri->segment('4');
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array('type' => $type,$field => $value);
            // pr($where,true);
            if (empty($where[$field]))
                $where = array('type' => $type);
            $response['header'] = ucwords(str_replace('_', ' ', $type));
            $config['base_url'] = base_url() . 'Admin/Withdraw/income/' . $type;
            $config['total_rows'] = $this->Main_model->get_sum('tbl_income_wallet', $where, 'ifnull(count(id),0) as sum');
            $config ['uri_segment'] = 5;
            $config['per_page'] = 50;
            $config['suffix'] = '?'.http_build_query($_GET);
            $config['attributes'] = array('class' => 'page-link');
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li class="paginate_button page-item ">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="paginate_button page-item  active"><a href="#" class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li class="paginate_button page-item ">';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="paginate_button page-item next">';
            $config['last_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
            $config['prev_tag_open'] = '<li class="paginate_button page-item previous">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li  class="paginate_button page-item next">';
            $config['next_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(5);
            $response['total_income'] = $this->Main_model->get_sum('tbl_income_wallet', $where, 'ifnull(sum(amount),0) as sum');
            $response['user_incomes'] = $this->Main_model->get_limit_records('tbl_income_wallet', $where, '*', $config['per_page'], $segment);
            foreach($response['user_incomes'] as $key => $users){
                $response['user_incomes'][$key]['user'] = $this->Main_model->get_single_record('tbl_users',array('user_id' => $users['user_id']),'name,sponser_id');
            }
            $response['url'] = 'Admin/Withdraw/income/';
            $response['type'] = $field;
            $response['value'] = $value;
            $response['incomeTYPE'] = $type;
            $response['segament'] = $segment;
            $this->load->view('incomes', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function tourismIncome() {
        if (is_admin()) {
            $type = 'tourism_income';
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array('type' => $type,$field => $value);
            // pr($where,true);
            if (empty($where[$field]))
                $where = array('type' => $type);
            $response['header'] = ucwords(str_replace('_', ' ', $type));
            $config['base_url'] = base_url() . 'Admin/Withdraw/tourismIncome';
            $config['total_rows'] = $this->Main_model->get_sum('tbl_tourism_wallet', $where, 'ifnull(count(id),0) as sum');
            $config ['uri_segment'] = 5;
            $config['per_page'] = 50;
            $config['suffix'] = '?'.http_build_query($_GET);
            $config['attributes'] = array('class' => 'page-link');
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li class="paginate_button page-item ">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="paginate_button page-item  active"><a href="#" class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li class="paginate_button page-item ">';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="paginate_button page-item next">';
            $config['last_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
            $config['prev_tag_open'] = '<li class="paginate_button page-item previous">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li  class="paginate_button page-item next">';
            $config['next_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(5);
            $response['total_income'] = $this->Main_model->get_sum('tbl_tourism_wallet', $where, 'ifnull(sum(amount),0) as sum');
            $response['user_incomes'] = $this->Main_model->get_limit_records('tbl_tourism_wallet', $where, '*', $config['per_page'], $segment);
            foreach($response['user_incomes'] as $key => $users){
                $response['user_incomes'][$key]['user'] = $this->Main_model->get_single_record('tbl_users',array('user_id' => $users['user_id']),'name,sponser_id');
            }
            $response['url'] = 'Admin/Withdraw/tourismIncome/';
            $response['type'] = $field;
            $response['value'] = $value;
            $response['incomeTYPE'] = $type;
            $response['segament'] = $segment;
            $this->load->view('incomes', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function incomeLedgar($type = '') {
        if (is_admin()) {
            //$type = $this->uri->segment('4');
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array($field => $value);
            // pr($where,true);
            if (empty($where[$field]))
            $where = array();
            $response['header'] = 'Income Ledgar';
            $config['base_url'] = base_url() . 'Admin/Withdraw/incomeLedgar';
            $config['total_rows'] = $this->Main_model->get_sum('tbl_income_wallet', $where, 'ifnull(count(id),0) as sum');
            $config ['uri_segment'] = 4;
            $config['per_page'] = 50;
            $config['suffix'] = '?'.http_build_query($_GET);
            $config['attributes'] = array('class' => 'page-link');
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li class="paginate_button page-item ">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="paginate_button page-item  active"><a href="#" class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li class="paginate_button page-item ">';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="paginate_button page-item next">';
            $config['last_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
            $config['prev_tag_open'] = '<li class="paginate_button page-item previous">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li  class="paginate_button page-item next">';
            $config['next_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            
            $response['total_income'] = $this->Main_model->get_sum('tbl_income_wallet',$where, 'ifnull(sum(amount),0) as sum');
            $response['user_incomes'] = $this->Main_model->get_limit_records('tbl_income_wallet',$where, '*', $config['per_page'], $segment);
            foreach($response['user_incomes'] as $key => $users){
                $response['user_incomes'][$key]['user'] = $this->Main_model->get_single_record('tbl_users',array('user_id' => $users['user_id']),'name,sponser_id');
            }
            $response['type'] = $field;
            $response['url'] = 'Admin/Withdraw/incomeLedgar';
            $response['value'] = $value;
            $response['incomeTYPE'] = $type;
            $response['segament'] = $segment;
            $this->load->view('incomes', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }


    public function voucherRequests() {
        if (is_admin()) {
            $where = array('status' => 0);
            $start_date = '';
            $end_date = '';
            // if ($this->input->server('REQUEST_METHOD') == 'POST') {
            //     $start_date = date_format(date_create($this->input->post('start_date')),"Y-m-d"); 
            //     $end_date = date_format(date_create($this->input->post('end_date')),"Y-m-d");; 
            //     $where = "  date(created_at) >= date('".$start_date."') and date(created_at) <= date('".$end_date."')";
            // }else{
            //     $where = array('kyc_status' => 1);
            // }
            $response['start_date'] = date_format(date_create($start_date), "m/d/Y");
            $response['end_date'] = date_format(date_create($end_date), "m/d/Y");
            $response['header'] = 'Voucher Achivers';
            $response['users'] = $this->Main_model->get_records('tbl_vouchers', $where, '*');

            $this->load->view('voucher', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function AddressRequests() {
        if (is_admin()) {
            $where = array('kyc_status' => 1);
            $start_date = '';
            $end_date = '';
            // if ($this->input->server('REQUEST_METHOD') == 'POST') {
            //     $start_date = date_format(date_create($this->input->post('start_date')),"Y-m-d"); 
            //     $end_date = date_format(date_create($this->input->post('end_date')),"Y-m-d");; 
            //     $where = "  date(created_at) >= date('".$start_date."') and date(created_at) <= date('".$end_date."')";
            // }else{
            //     $where = array('kyc_status' => 1);
            // }
            $response['start_date'] = date_format(date_create($start_date), "m/d/Y");
            $response['end_date'] = date_format(date_create($end_date), "m/d/Y");
            $response['header'] = 'Bank Address Requests';
            $response['users'] = $this->Main_model->get_records('tbl_bank_details', $where, '*');

            $this->load->view('AddressRequests', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function ApprovedAddressRequests() {
        if (is_admin()) {
            $where = array('kyc_status' => 2);
            $start_date = '';
            $end_date = '';
            // if ($this->input->server('REQUEST_METHOD') == 'GET') {
            //     $start_date = date_format(date_create($this->input->get('start_date')),"Y-m-d"); 
            //     $end_date = date_format(date_create($this->input->get('end_date')),"Y-m-d");; 
            //     $where = "kyc_status  = 2 and date(created_at) >= date('".$start_date."') and date(created_at) <= date('".$end_date."')";
            // }
            $response['start_date'] = date_format(date_create($start_date), "m/d/Y");
            $response['end_date'] = date_format(date_create($end_date), "m/d/Y");
            $response['header'] = 'Approved Bank Address Requests';
            $response['users'] = $this->Main_model->get_records('tbl_bank_details', $where, '*');

            $this->load->view('AddressRequests', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function RejectedAddressRequests() {
        if (is_admin()) {
            $where = array('kyc_status' => 3);
            $start_date = '';
            $end_date = '';
            // if ($this->input->server('REQUEST_METHOD') == 'GET') {
            //     $start_date = date_format(date_create($this->input->get('start_date')),"Y-m-d"); 
            //     $end_date = date_format(date_create($this->input->get('end_date')),"Y-m-d");; 
            //     $where = "kyc_status  = 3 and date(created_at) >= date('".$start_date."') and date(created_at) <= date('".$end_date."')";
            // }
            $response['start_date'] = date_format(date_create($start_date), "m/d/Y");
            $response['end_date'] = date_format(date_create($end_date), "m/d/Y");
            $response['header'] = 'Rejected Bank Address Requests';
            $response['users'] = $this->Main_model->get_records('tbl_bank_details', $where, '*');
            // pr($where,true);
            $this->load->view('AddressRequests', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function ApproveUserVoucher($id, $status) {
        if (is_admin()) {
            $data['success'] = 0;
            $res = $this->Main_model->update('tbl_vouchers', array('id' => $id), array('status' => $status));
            if ($res) {
                $data['message'] = 'Request Accepted Successfully';
                $data['success'] = 1;
            } else {
                $data['message'] = 'Error While Updating Status';
            }
            echo json_encode($data);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function ApproveUserAddressRequest($id, $status) {
        if (is_admin()) {
            $data['success'] = 0;
            $res = $this->Main_model->update('tbl_bank_details', array('id' => $id), array('kyc_status' => $status));
            if ($res) {
                $data['message'] = 'Request Accepted Successfully';
                $data['success'] = 1;
            } else {
                $data['message'] = 'Error While Updating Status';
            }
            echo json_encode($data);
        } else {
            redirect('Admin/Management/login');
        }
    }

}
