<?php

    class Marcas extends CI_Controller{

        public function __construct()
        {
            parent::__construct();
            $this->load->library('form_validation');
            $this->load->model('marcas_model', 'marcas');
        }

        public function index(){

            $data['view'] = 'marcas/list';
            $this->load->view('layout', $data);
        }

        public function add(){

            if($this->input->post('submit')){

                $this->form_validation->set_rules('marca', 'Marca de Producto', 'trim|required');

                if($this->form_validation->run() == FALSE){

                    echo validation_errors();
                    $data['view'] = 'marcas/add';
                    $this->load->view('layout', $data);

                } else{

                    $data = array('marca' => $this->input->post('marca'));

                    $data = $this->security->xss_clean($data);
                    $result = $this->marcas->add($data);

                    if($result){
                        redirect('marcas/add');
                    }
                }

            } else {

                $data['view'] = 'marcas/add';
                $this->load->view('layout', $data);
            }
        }
    }