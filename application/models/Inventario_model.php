<?php

class Inventario_model extends CI_Model{

    private $productos = 'productos';
    private $almacenes = 'almacenes';
    private $inventario = 'inventario';

    public function __construct(){

        parent::__construct();
    }

    public function addInventario($data){

        $this->db->insert($this->inventario, $data);
        return true;
    }

    public function getAlmacenes(){

        $this->db->select('*');
        $this->db->from($this->almacenes);
        $this->db->order_by('nombre', 'ASC');

        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    public function getInventario(){

        $this->db->select('p.nombre as producto_id, SUM(i.unidades) as inventario, a.nombre as almacen, p.imagen, ROUND(SUM(i.unidades)*AVG(i.costo_unitario),2) as costo_total');
        $this->db->from($this->inventario .' i');
        $this->db->join( $this->productos .' p', 'i.producto_id = p.id','left');
        $this->db->join( $this->almacenes .' a', 'i.almacen_id = a.id','left');
        $this->db->group_by('p.id');
        $this->db->group_by('a.nombre');

        $query = $this->db->get();
        $result = $query->result_array();
        return $result;

    }

    public function getProductos(){

        $this->db->select('*');
        $this->db->from($this->productos);
        $this->db->order_by('nombre', 'ASC');

        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

}