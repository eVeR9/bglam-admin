<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {

    public function __construct(){
        parent::__construct();
        //$this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('security');
        $this->load->library('form_validation');
        //$this->load->library('session');
        $this->load->library('cart');
        //$this->load->library('upload');
        //$this->load->database('bglamadmin');
        $this->load->model('productos_model', 'productos');
        //$this->output->delete_cache();

    }

    public function index(){
        $data['productos'] = $this->productos->getProductos();
        $data['view'] = 'productos/list';
        $this->load->view('layout', $data);
    }

    public function add(){

        if(isset($_POST['action']) == "Add"){

            $this->form_validation->set_rules('nombre', 'Nombre del producto', 'trim');
            //$this->form_validation->set_rules('descripcion', 'Desc del producto', 'trim');
            $this->form_validation->set_rules('codigo', 'Codigo del producto', 'trim');
            $this->form_validation->set_rules('estatus_id', 'Estatus del producto', 'trim');
            $this->form_validation->set_rules('costo', 'Costo', 'trim');
            $this->form_validation->set_rules('precio', 'Precio', 'trim');
            $this->form_validation->set_rules('stock', 'Cantidad a cargar', 'trim');
            $this->form_validation->set_rules('fecha', 'Fecha de registro', 'trim');
            //$this->form_validation->set_rules('imagen', 'Imagen', 'trim');

            if($this->form_validation->run() == FALSE){ 
                
                echo 'No se enviaron los datos';
                $data['marcas'] = $this->productos->getMarcas();
                $data['view'] = 'productos/add';
                $this->load->view('layout', $data);
                //$this->load->view('login');

            } else{

                $config = array(
                    'upload_path' => './public/uploads/imagenes_productos',
                    'allowed_types' => 'jpg|png',
                    'max_size' => 2000
                );

                $this->load->library('upload', $config);

                $this->upload->initialize($config);

                if(!$this->upload->do_upload('imagen')){

                    echo $this->upload->display_errors();

                } else{

                    $file = $this->upload->data();
                    $image = $file['file_name'];

                    $data = array(
                        'nombre' => $this->input->post('nombre'),
                        'marca_id' => $this->input->post('marca_id'),
                        'codigo' => $this->input->post('codigo'),
                        'estatus_id' => $this->input->post('estatus_id'),
                        'costo' => $this->input->post('costo'),
                        'precio' => $this->input->post('precio'),
                        'stock' => $this->input->post('stock'),
                        'fecha' => $this->input->post('fecha'),
                        'imagen' => $image
                    );
                    
                    $data = $this->security->xss_clean($data);
                    $result = $this->productos->add_producto($data);
                    //echo json_encode($result);

                    if($result){
                        //$this->session->set_flashdata('msg', 'Producto Agregado!');
                        $data['view'] = 'productos/add';
                        $this->load->view('layout', $data);
                        
                        //redirect(base_url('productos/list'));
                    }
                }
            }

        } else {
            
            $data['marcas'] = $this->productos->getMarcas();
            $data['view'] = 'productos/add';
            $this->load->view('layout', $data);
        }
    }

    public function edit($id=0){

        if($this->input->post('action')){

            $this->form_validation->set_rules('precio', 'Precio', 'trim');

            if($this->form_validation->run() == FALSE) {

                //$data['datos_producto'] = $this->productos->getProductosById($id);
                $data['view'] = 'productos/edit';
                $this->load->view('layout', $data);

            } else{

                $data = array(

                    'precio' => $this->input->post('precio')
                );

                $result = $this->productos->updateProductos($data, $id);

                if($result){
                    //redirect('productos/edit/'.$this->input->post('id'));
                    redirect('productos/');
                } else{

                    echo 'La actualizacion fallo';
                    exit();
                }
            }

        } else {

            $data['datos_producto'] = $this->productos->getProductosById($id);
            $data['view'] = 'productos/edit';
            $this->load->view('layout', $data);
        }
    }

    public function getDescuento(){

        $descuento = $this->input->get('descuento');
        $id = $this->input->get('id');

        $data = array('descuento' => $descuento);

        $data = $this->productos->updateDescuento($data, $id);

        echo json_encode($data);
    }

    /*
    public function do_upload(){

        //$path = './public/uploads/imagenes_productos/';

        $config['upload_path']       = './uploads/';
        $config['allowed_types']     = 'jpg|png';
        $config['max_size']          = 'none';
        $config['max_width']         = 'none';
        $config['max_height']        = 'none';
        
        $this->load->library('upload', $config);

        //$imagen = $this->input->post('imagen');

        if(!$this->upload->do_upload('imagen')) {

            $error = array('error' => $this->upload->display_errors());

            var_dump($error);
    }
    else
    {   
            $data = array('upload_data' => $this->upload->data('file_name'));

            var_dump($data);
    }
    }*/

}



