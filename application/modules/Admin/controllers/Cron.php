<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Cron extends CI_controller{
	
	public function __construct(){
		parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin'));
	}

	public function time_cron(){
		// $Arun = $this->Main_model->get_single_record('tbl_investment',array('mode' => 'auto', 'type' => 'get_help'),'created_at');
		// $time = "3days";
		// $SecondTime = date('Y-m-d H:i:s',strtotime($time,strtotime($Arun['created_at'])));
		// print_r($SecondTime);
		// die('fgeyg');
				
		$user = $this->Main_model->get_records('tbl_users',array('paid_status' => '1','package_id' => '1'),'user_id,topup_date');
		$help_time = $this->Main_model->get_single_record('tbl_package',array('id' => 1),'help_time');
		$now_help = explode(',', $help_time['help_time']);
		foreach ($user as $key => $value) {
			
			$user2 = $this->Main_model->get_single_record('tbl_investment',array('user_id' => $value['user_id'],'type' => 'provide_help' ,'status' => 1),'id,user_id,type,mode');
			$user3 = $this->Main_model->get_single_record('tbl_investment',array('user_id' => $value['user_id'], 'type' => 'get_help'),'id,user_id,type,mode');
			
			// print_r($User4);
			//die('Manish');
			if(!empty($user2)){
				$data = $this->Main_model->get_single_record('tbl_investment',array('mode' => 'auto', 'type' => 'get_help'),'count(id) as mode');
					if ($data['mode'] == 0) {
						 $time = $now_help[0];
						//add 1 hour to time
						$cenvertedTime = date('Y-m-d H:i:s',strtotime($time,strtotime($value['topup_date'])));
						if(date('Y-m-d H:i:s') >= $cenvertedTime){
							$this->Main_model->insert('tbl_investment',array('user_id' => $value['user_id'],'amount' => '2000','type' => 'get_help','mode' => 'auto'));
							
						}
					}
					if ($data['mode'] == 1) {
						$time = $now_help[1];
						 	$Arun = $this->Main_model->get_single_record('tbl_investment_links',array('receiver_investment_id' => $user3['id'],'status' => '1'),'*');

							$SecondTime = date('Y-m-d H:i:s',strtotime($time,strtotime($Arun['updated_at'])));
						 if(date('Y-m-d H:i:s') >= $SecondTime){
						 	
							$this->Main_model->insert('tbl_investment',array('user_id' => $value['user_id'],'amount' => '2000','type' => 'get_help','mode' => 'auto'));
						 }
					}
					if ($data['mode'] == 2) {
						$time = $now_help[2];

						$User4 = $this->Main_model->get_last_id('tbl_investmentA',array('type' => 'get_help','mode' => 'auto'));
						if ($User4['status'] > 0) {
							$user7 = $this->Main_model->get_single_record('tbl_investment_links',array('receiver_investment_id' => $User4['id'],'status' => 1),'*');
							
						  $ThirdTime = date('Y-m-d H:i:s',strtotime($time,strtotime($user7['updated_at'])));

							if(date('Y-m-d H:i:s') >= $ThirdTime){
								$this->Main_model->insert('tbl_investment',array('user_id' => $value['user_id'],'amount' => '2000','type' => 'get_help','mode' => 'auto'));
							}
						}
					}
			}
		}
		
		
	}

}