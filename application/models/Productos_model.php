<?php

class Productos_model extends CI_Model {

    private $marcas = 'marcas';
    private $productos = 'productos';

    public function __construct()
    {
        parent::__construct();
        //$this->load->database('bglamadmin');
    }

    public function add_producto($data){
        $this->db->insert('productos', $data);
        return true;
    }

    function changeEstatus($id, $switchVal){

        $this->db->where('id', $id);
        $this->db->update($this->productos, $switchVal);
        
        return true;

    }

    public function getMarcas(){
        $this->db->order_by('marca', 'ASC');
        $query = $this->db->get($this->marcas);
        
        return $query->result_array();
    }

    public function getProductos(){
        //$this->db->order_by('id', 'desc');
        //$query = $this->db->get('productos');
        $this->db->select('p.*, SUM(i.unidades) as inventario');
        $this->db->from('productos as p');
        $this->db->join('inventario as i', 'p.id = i.producto_id');
        $this->db->group_by('p.id');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function getProductosById($id=null){

        $this->db->select('*');
        $this->db->from($this->productos);
        $this->db->where('id', $id);

        $query = $this->db->get();
        $response = $query->row_array();

        return $response;
    }

    public function updateDescuento($data, $id){
        $this->db->where('id', $id);
        $this->db->update('productos', $data);
        return true;
    }

    public function updateProductos($data, $id){
        $this->db->where('id', $id);
        $this->db->update($this->productos, $data);
        return true;
    }


}


?>