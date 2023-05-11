<?php
defined('BASEPATH') OR exit('No direct scripts access allowed');

class Login extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        //charge libraries, helpers, hooks and DBs
    }

    public function index(){
        $this->load->view('login');
    }
}




?>