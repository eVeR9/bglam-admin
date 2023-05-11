<?php
defined('BASEPATH') OR exit('No direct scripts access allowed');

class Upload extends CI_Controller{

    public function __construct(){

        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    public function index(){

        $this->load->view('pruebas/upload_form', array('error' => ''));
    }

    public function do_upload(){

        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 'none';
        $config['max_width']            = 'none';
        $config['max_height']           = 'none';

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('userfile')){

            $error = array('error' => $this->upload->display_errors(),
                            'hola' => 'HolaMundo');

            $this->load->view('pruebas/upload_form', $error);

        }
            else{
                $data = array('upload_data' => $this->upload->data());

                $this->load->view('pruebas/upload_success', $data);
        }
    }
}



?>