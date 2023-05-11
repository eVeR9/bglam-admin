<?php

defined('BASEPATH') OR exit('No direct scripts allowed');

class Pedidos extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('pedidos_model');
        //$this->load->helper('url');
    }

    public function index(){
        
        $data['pedidos'] = $this->pedidos_model->getPedidos();
        $data['view'] = 'pedidos/list';
        $this->load->view('layout', $data);
    }

    public function addNewProductFromEditForm(){

        if($this->input->post('submit')){

            $this->form_validation->set_rules('pedido_id', 'ID de Pedido', 'trim|required');
            $this->form_validation->set_rules('id_del_producto', 'Productoooo', 'trim|required');
            $this->form_validation->set_rules('unidades', 'Unidades', 'trim|required');
            $this->form_validation->set_rules('precio_producto', 'Total', 'trim|required');


            if($this->form_validation->run() == FALSE){

                echo validation_errors(); 
                echo 'Error en el formulario! ;(';
                var_dump($_POST);
                
            } else{

            $data = array(

                'pedido_id' => $this->input->post('pedido_id'),
                'producto_id' => $this->input->post('id_del_producto'),
                'unidades' => $this->input->post('unidades'),
                'precio_producto' => $this->input->post('precio_producto'),
                'created_at' => date('Y-m-d - h:i:s')
            );

            $data2 = array(
                'producto_id' => $this->input->post('id_del_producto'),
                'almacen_id' => 1,
                'unidades' => $this->input->post('unidades') * (-1)
            );

            $this->pedidos_model->addNewProductFromEdit($data);
            $this->pedidos_model->addInventario($data2);

            //echo 'Se han guardado los datos! :D';
            redirect('pedidos/edit/'.$this->input->post('pedido_id'));

            }

        } else{

            echo 'Error al Guardar! :(';
        }

    }

    public function delete($id){

        $this->pedidos_model->deleteLineaPedido($id);

    }

    public function disablePedidoFromController($id){

        $data = array('activo_inactivo' => '0');

        $this->pedidos_model->disablePedido($data, $id);
    }

    public function edit($id=0){

        //if($this->input->post('submit')){

            //$this->form_validation->set_rules();


        //} else{

            $data['productos'] = $this->pedidos_model->getProductos();
            $data['cliente_detalle'] = $this->pedidos_model->getClientePedidosEdit($id);
            $data['pedidos_detalle'] = $this->pedidos_model->getPedidosEdit($id);
            $data['view'] = 'pedidos/edit';
            $this->load->view('layout', $data);

        }
    //}

    public function getInfoPedidoForAddProduct($id){

        $data = $this->pedidos_model->getInfoProductos($id);
        echo json_encode($data);
    }


}




?>