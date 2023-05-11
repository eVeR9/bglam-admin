<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Model{
    
    function __construct() {
        $this->proTable = 'productos';
        $this->custTable = 'clientes';
        $this->ordTable = 'pedidos';
        $this->ordItemsTable = 'lineas_pedido';
        $this->metodosPTable = 'metodos_de_pago';
        $this->cuponesTable = 'cupones';
        $this->inventario = 'inventario';
    }

    public function getInventory($proID = '') {

        /*
        $sql = "SELECT SUM(i.unidades) as total_inventario_por_id 
        FROM productos as p
        INNER JOIN inventario as i ON p.id = i.producto_id 
        WHERE i.producto_id = '".$proID."'";
        */

        $query = $this->db->query("SELECT SUM(i.unidades) as total_inventario_por_id 
        FROM productos as p
        INNER JOIN inventario as i ON p.id = i.producto_id 
        WHERE i.producto_id = '".$proID."'");

        //$query = $this->db->get('productos');
        $result = $query->row_array();
        //$this->db->last_query();
        return $result;
    }
    
    /*
     * Fetch products data from the database
     * @param id returns a single record if specified, otherwise all records
     */
    public function getRows($id = ''){
        $this->db->select('*');
        $this->db->from($this->proTable . " as p");
        //$this->db->where('status', '1');
        if($id){
            $this->db->where('id', $id);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            $this->db->order_by('nombre', 'asc');
            $query = $this->db->get();
            $result = $query->result_array();
        }
        
        // Return fetched data
        return !empty($result)?$result:false;
    }
    
    /*
     * Fetch order data from the database
     * @param id returns a single record of the specified ID
     */
    public function getOrder($id){
        $this->db->select('o.*, c.nombre, c.apellidos, c.telefono');
        $this->db->from($this->ordTable.' as o');
        $this->db->join($this->custTable.' as c', 'c.id = o.cliente_id', 'left');
        $this->db->where('o.id', $id);
        $query = $this->db->get();
        $result = $query->row_array();
        
        // Get order items
        $this->db->select('i.*, p.imagen, p.nombre, p.precio'); //(p.precio * p.descuento/100) as t_desc
        $this->db->from($this->ordItemsTable.' as i');
        $this->db->join($this->proTable.' as p', 'p.id = i.producto_id', 'left');
        $this->db->where('i.pedido_id', $id);
        $query2 = $this->db->get();
        $result['items'] = ($query2->num_rows() > 0)?$query2->result_array():array();
        
        // Return fetched data
        return !empty($result)?$result:false;
    }

    public function getPaymentMethods($id = ''){

        $this->db->select('*');
        $this->db->from($this->metodosPTable);

        if($id){
            $this->db->where('id', $id);
            $query = $this->db->get();
            $result = $query->row_array();

        }else{
            //$this->db->order_by('metodo', 'ASC');
            $query = $this->db->get();
            $result = $query->result_array();
        }

        return !empty($result)?$result:FALSE;
    }

    public function getMetodoPago($id){

        $this->db->select('*');
        $this->db->from($this->metodosPTable);
        $this->db->where('id', $id);

        $query = $this->db->get();
        $result = $query->row_array();

        return $result;
    }

    public function showCuponesDeDescuento(){

        $this->db->select('*');
        $this->db->from($this->cuponesTable);
        $query = $this->db->get();
        $cupones = $query->result_array();
        return $cupones;
    } 

    public function getCuponDeDescuento($id){

        $this->db->select('*');
        $this->db->from($this->cuponesTable);
        $this->db->where('id', $id);

        $query = $this->db->get();
        $result = $query->row_array();
        //echo $this->db->last_query();

        return $result;
    }
    
    /*
     * Insert customer data in the database
     * @param data array
     */
    public function insertCustomer($data){
        // Add created and modified date if not included
        if(!array_key_exists("created_at", $data)){
            $data['created_at'] = date("Y-m-d H:i:s");
        }
        if(!array_key_exists("modified", $data)){
            $data['modified'] = date("Y-m-d H:i:s");
        }
        
        // Insert customer data
        $insert = $this->db->insert($this->custTable, $data);

        // Return the status
        return $insert?$this->db->insert_id():false;
    }
    
    /*
     * Insert order data in the database
     * @param data array
     */
    public function insertOrder($data){
        // Add created and modified date if not included
        if(!array_key_exists("created_at", $data)){
            $data['created_at'] = date("Y-m-d H:i:s");
        }
        if(!array_key_exists("modified", $data)){
            $data['modified'] = date("Y-m-d H:i:s");
        }
        
        // Insert order data
        $insert = $this->db->insert($this->ordTable, $data);

        // Return the status
        return $insert?$this->db->insert_id():false;
    }
    
    /*
     * Insert order items data in the database
     * @param data array
     */
    public function insertOrderItems($data = array()) {
        
        // Insert order items
        $insert = $this->db->insert_batch($this->ordItemsTable, $data);

        // Return the status
        return $insert?true:false;
    }

    public function insertOrderItemsMov($data = array()){

        $insert = $this->db->insert_batch($this->inventario, $data);

        return $insert?true:false;
    }
    
}