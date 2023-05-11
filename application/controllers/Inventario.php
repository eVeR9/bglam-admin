<?php

/*
 * POSIBLE SOLUCION A ENTRADAS DE INVENTARIO CON DIFERENTE COSTO UNITARIO

  SELECT producto_id, 
  SUM(unidades),
  SUM(unidades*costo_unitario) as 'costo_total' 
  FROM inventario 
  GROUP BY producto_id;

  OR

  SELECT producto_id, 
  SUM(unidades), 
  SUM(unidades)*AVG(costo_unitario) as 'costo_total' 
  FROM inventario 
  GROUP BY producto_id

  SELECT * FROM inventario;
 * 
 */

class Inventario extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('inventario_model');

    }

    public function index(){

        $data['inventario'] = $this->inventario_model->getInventario();
        $data['view'] = 'inventario/list';
        $this->load->view('layout', $data);
    }

    public function add(){

        if($this->input->post('submit')){

            $this->form_validation->set_rules('producto_id', 'Producto', 'trim|required');
            $this->form_validation->set_rules('unidades', 'Unidades', 'trim|required');

            if($this->form_validation->run() == FALSE){

                echo validation_errors();
                $data['almacenes'] = $this->inventario_model->getAlmacenes();
                $data['productos'] = $this->inventario_model->getProductos();
                $data['view'] = 'inventario/add';
                $this->load->view('layout', $data);

            } else{

                $data = array(

                    'producto_id' => $this->input->post('producto_id'),
                    'almacen_id' => $this->input->post('almacen_id'),
                    'unidades' => $this->input->post('unidades'),
                    'costo_unitario' => $this->input->post('costo_unitario'),
                    'user_id' => 1,
                    'created_at' => date('Y-m-d : h:i:s')
                );

                //$data = $this->security->xss_clean($data);
                $result = $this->inventario_model->addInventario($data);

                if($result){
                    redirect('inventario/add');
                }
            }

        } else{

            $data['almacenes'] = $this->inventario_model->getAlmacenes();
            $data['productos'] = $this->inventario_model->getProductos();
            $data['view'] = 'inventario/add';
            $this->load->view('layout', $data);
        }
    }
}