
<?php
	if(!function_exists('is_admin')){

		function is_admin(){

			$CI = & get_instance();
			$CI->load->library('session');
			if(!empty($_SESSION['admin_id']) && $_SESSION['admin_id'] =='admin' && $_SESSION['is_admin'] === TRUE)
			{

				return TRUE;

			}else{

				return FALSE;

				}

		}

	}

	if(!function_exists('admin_info')){
		function admin_info(){
			$CI = & get_instance();
			$CI->load->library('session');
				$CI->load->model('Main_model');
				$data = $CI->Main_model->get_single_record('tbl_admin',['id' => '1'],'*');
				// print_r($data);
				// die('okk');
				return $data;
		}
	}

	if(!function_exists('incomes')){
		function incomes(){
			$CI = & get_instance();
			$CI->load->model('Main_model');
			$data = $CI->Main_model->get_records('tbl_incomes',array(''),'*');
			foreach ($data as $key => $value) {
				$data2 = explode(',', $value['type']);
				foreach ($data2 as $key2 => $value2) {
					$total_amount = $CI->Main_model->get_single_record($value['table'],array('type' => $value2), 'ifnull(sum(amount), 0) as total_amount');
					$type = $value2;
					$returnData[] = ['total_amount' => $total_amount['total_amount'],'type' => $type];
				}
			}

				return $returnData;
		}
	}


	 if(!function_exists('incomeType')){
	 	
	 	function incomeType(){
	 		$CI = & get_instance();
	 		$CI->load->model('Main_model');
	 		$data = $CI->Main_model->get_single_record('tbl_incomes',array('id' => 1),'type');
	 		return $data['type'];

	 	}

	 }

	 if(!function_exists('pr')){
	 	function pr($data,$die = 'false'){
	 		echo '<pre>';
	 		print_r($data);
	 		echo '</pre>';
	 		if($die === TRUE){
	 			die('OKK');
	 		}
	 	}

	 }

	

?>
