<?php

	if(!function_exists('is_user')){

		function is_user($user_id){
		$CI = & get_instance();
		$CI->load->library('session');

			if(!empty($_SESSION['user_id']) && $_SESSION['user_id'] == $user_id && $_SESSION['is_user'] === TRUE){

				return TRUE;
			}else{

				return FALSE;
			}

		}
	}

  if(!function_exists('pr')){
	function pr($data,$die =false){
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		if($die === TRUE){
			die('OKK');
		}
	}

  }

	if(!function_exists('user_info')){
		function user_info(){
			$CI = & get_instance();
			$CI->load->library('session');
			if(is_user($CI->session->userdata['user_id'])){
				$CI->load->model('Main_model');
				$data = $CI->Main_model->get_single_record('tbl_users',['user_id' => $CI->session->userdata('user_id')],'*');
				return $data;
			}
		}
	}

	if(!function_exists('incomes')){
	 function incomes(){
		    $CI = get_instance();
		    $CI->load->model('Main_model');
		    $CI->load->library('session');
	
		if(is_user($CI->session->userdata['user_id'])){
		    $user = $CI->Main_model->get_single_record('tbl_incomes', array('id' => 1), '*');
		    $incomes = explode(',', $user['type']);
		    foreach ($incomes as $key => $value) {
		    	$amount = $CI->Main_model->get_single_record($user['table'], array('type' => $value, 'user_id' => $CI->session->userdata('user_id')), 'ifnull(sum(amount),0) as total_amount');

		    	$data[] = ['amount' => $amount['total_amount'],'type' => ''.$value.''];	
		    }
		    return $data;
		}
	 }
	 
   }

   if(!function_exists('incomeType')){
	 	
	 	function incomeType(){
	 		$CI = & get_instance();
	 		$CI->load->model('Main_model');
	 		$CI->load->library('session');

	 		$data = $CI->Main_model->get_single_record('tbl_incomes',array('id' => 1),'type');
	 		return $data['type'];

	 	}

	 }

?>
