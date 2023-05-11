<?php

class Pedidos_model extends CI_Model{
    
    private $inventario = 'inventario';

    public function __construct()
    {
        parent::__construct();
        //$this->load->database('bglamadmin');
    }

    public function addInventario($data){

        $this->db->insert($this->inventario, $data);
        return true;
    }

    public function addNewProductFromEdit($data){

        $this->db->insert('lineas_pedido', $data);
    }

    public function deleteLineaPedido($id){

        $this->db->where('id', $id);
        $this->db->delete('lineas_pedido');
    }

    public function disablePedido($data ,$id){

        $this->db->where('id', $id);
        $this->db->update('pedidos', $data);
        return true;
    }

    public function getPedidos()
    {
        $this->db->select('p.id, CONCAT(cl.nombre, " ", cl.apellidos) as cliente_id, p.metodo_de_pago, SUM(lp.precio_producto) as total_pedido, 
        p.created_at');
        $this->db->from('pedidos p');
        $this->db->join('clientes cl', 'p.cliente_id = cl.id', 'left');
        $this->db->join('lineas_pedido lp', 'p.id = lp.pedido_id', 'left');
        $this->db->where('activo_inactivo', 1);
        $this->db->group_by('p.id');

        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function getPedidosEdit($id){

        $this->db->select('lp.id as lineaPedido, p.id, p.total_pedido, lp.producto_id, prod.nombre, c.nombre as cliente, lp.unidades, lp.precio_producto, p.metodo_de_pago');
        $this->db->from('pedidos p');
        $this->db->join('lineas_pedido lp', 'p.id = lp.pedido_id', 'left');
        $this->db->join('productos prod', 'lp.producto_id = prod.id', 'left');
        $this->db->join('clientes c', 'p.cliente_id = c.id', 'left');
        $this->db->where('p.id', $id);

        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }

    
    public function getClientePedidosEdit($id){

        $this->db->select('c.*, SUM(lp.precio_producto) as total');
        $this->db->from('pedidos p');
        $this->db->join('clientes c', 'p.cliente_id = c.id', 'left');
        $this->db->join('lineas_pedido lp', 'p.id = lp.pedido_id', 'left');
        $this->db->where('p.id', $id);

        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    public function getProductos(){

        $this->db->select('id as productoId, nombre as productoNombre');
        $this->db->from('productos');
        $query = $this->db->get();

        $result = $query->result_array();
        return $result;
        
    }

    public function getInfoProductos($id){

        $this->db->select('*');
        $this->db->from('productos');
        $this->db->where('id', $id);
        $query = $this->db->get();

        $result = $query->row_array();
        return $result;
        
    }
    
}
