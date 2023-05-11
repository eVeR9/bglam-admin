<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Gastos extends CI_Controller{

        public function __construct()
        {
            parent::__construct();
            $this->load->library('form_validation');
            $this->load->library('session');
            $this->load->helper('security');
            $this->load->model('gastos_model', 'gastos');
        }

        public function index(){

            $data['gastos_list'] = $this->gastos->get_gastos();
            $data['view'] = 'gastos/list';
            $this->load->view('layout', $data);
        }

        public function add(){

            if ($this->input->post('action')) {

                $this->form_validation->set_rules('motivo','Motivo','trim|required');
                $this->form_validation->set_rules('monto','Monto','trim|required');
                $this->form_validation->set_rules('forma_de_pago','Forma de Pago','trim|required');

                if($this->form_validation->run() == FALSE){

                    echo validation_errors();
                    $data['metodos_de_pago'] = $this->gastos->get_metodos_de_pago();
                    $data['view'] = 'gastos/add';
                    $this->load->view('layout', $data);

                }else{

                    $data = array(

                        'fecha' => $this->input->post('fecha'),
                        'motivo' => $this->input->post('motivo'),
                        'monto' => $this->input->post('monto'),
                        'forma_de_pago' => $this->input->post('forma_de_pago'),
                        'created_at' => date('Y-m-d : h:i:s')
                        //'created_by' => $_SESSION['id']
                    );

                    $secure_data = $this->security->xss_clean($data);
                    $result = $this->gastos->add_gastos($secure_data);

                    if ($result) {

                        $this->session->set_flashdata('msg', 'Registro Agregado!');
                        redirect('gastos/add');
                    }
                }

            } else {

                $data['metodos_de_pago'] = $this->gastos->get_metodos_de_pago();
                $data['view'] = 'gastos/add';
                $this->load->view('layout', $data);
            }
        }

        public function list(){

            $data['view'] = 'gastos/list';
            $this->load->view('layout', $data);
        }





       
    }


