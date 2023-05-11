<?php

class Tests_model extends CI_Model{

    public function getItems(){

        $this->db->select('*');
        $this->db->from('productos');
        $this->db->order_by('id', 'ASC');
        $this->db->limit('10');

        $query = $this->db->get();
        
        if($query->num_rows() > 1){

            $items = $query->result();
        } else {

            $items = "Nothing";
        }

        return $items;
    }

    public function addPedidos($data = array()){

        $this->db->insert_batch('lineas_pedido', $data);
        return true;
    }
}


?>



