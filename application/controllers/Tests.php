<?php

class Tests extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('tests_model', 'tests_model');

    }

    public function index(){

        $submit = $this->input->post('submit');
        $fail = $this->form_validation->run() === FALSE;

        if($submit){

            $this->form_validation->set_rules('nombre', 'Nombre del producto', 'required');
            //$this->form_validation->set_rules('sku', 'SKU', 'required');
            $this->form_validation->set_rules('precio', 'Precio', 'required');
            $this->form_validation->set_rules('cliente_id', 'ID de cliente', 'required');

            if($fail){

                echo 'Somethings wrong!';
                $data['view'] = 'tests/list';
                $this->load->view('layout', $data );
            }

            $data = array(

                'pedido_id' => 2,
                'producto_id' => $_POST['producto_id_2'],
                'unidades' => $this->input->post('unidades_2'),
                'precio_producto' => $this->input->post('precio_producto_2')

            );

            $data = $this->security->xss_clean($data);
            $result = $this->tests_model->addPedidos($data);

            if($result){
                var_dump($_POST);
                //redirect(base_url('tests'));
            }

        } else{
            var_dump($_POST);
            echo 'data before send';
            //json_encode($data);
            $data['view'] = 'tests/list';
            $this->load->view('layout', $data );
        }
    }

    public function testProductos(){

        $data = $this->tests_model->getItems();
        echo json_encode($data);

    }

    public function test_2(){

        $this->load->view('canasta');
    }

}



?>