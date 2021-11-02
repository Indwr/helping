<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        // $this->load->model(array('Main_model'));
        // $this->load->helper(array('site'));
    }

    public function index() {
        $this->load->view('index.php');
    }
}
