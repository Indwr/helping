	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Incomes extends CI_Controller{

	public function __construct(){

		parent::__construct();
		$this->load->helper(array('admin'));
		$this->load->model(array('Main_model'));
		$this->load->library('pagination');
	}

	public function incomeTable($type){
		if(is_admin()){

			$data['header'] = ucfirst(str_replace('_', ' ', $type));
			$data['user'] = $this->Main_model->get_records('tbl_income_wallet',array('type' => $type),'*');

			$this->load->view('users_income',$data);

		}

	}

	public function scriptData(){

		$user['header'] = 'Script Show Data';
		$user['data'] = $this->Main_model->get_records('tbl_users',array(),'*');

		$this->load->view('scriptdata',$user);
		  json_encode($user);
		 	// print_r($user);
		 	// die('OKK');
		 		return $user;
	}

}