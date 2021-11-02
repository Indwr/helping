<?php

defined('BASEPATH') OR exit('No direct script access allowed');

 class Email_controller extends CI_controller{
  
  public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('user'));
    }

  public function Email_page(){
  	$data=array();
		// $mesg = $this->load->view('template/email',$data,true);
		// or
		$mesg = $this->load->view('Email_page',$data,true);


		$config=array(
		'charset'=>'utf-8',
		'wordwrap'=> TRUE,
		'mailtype' => 'html'
		);

		$this->email->initialize($config);
    //$this->email->initialize($config);
        
        $this->email->from('ak4633343@gmail.com', 'Rejected Shayer');
        $this->email->to('ak4633343@gmail.com');
        $this->email->subject('Check Mail');
        $this->email->message($mesg);

        $this->email->send();

  	$this->load->view('Email_page');
  }

 }