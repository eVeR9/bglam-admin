<?php

    class Gastos_model extends CI_Model {

        private $gastos_table = 'gastos';
        private $metodos_de_pago_table = 'metodos_de_pago';

        public function __construct() {
            parent::__construct();
        }

        function add_gastos($data) {

            $this->db->insert($this->gastos_table, $data);
            return true;
        }

        function get_gastos(){

            $this->db->select('g.id, g.fecha, g.motivo, g.monto, mp.metodo as forma_de_pago');
            $this->db->from($this->gastos_table . ' g');
            $this->db->join($this->metodos_de_pago_table . ' mp', 'g.forma_de_pago = mp.id', 'left');
            $this->db->order_by('id', 'DESC');

            $response = $this->db->get();
            $result = $response->result_array();
            return $result;
        }

        function get_metodos_de_pago() {

            $this->db->select('id, metodo');
            $this->db->from($this->metodos_de_pago_table);
            $this->db->order_by('metodo', 'ASC');

            $response = $this->db->get();
            $result = $response->result_array();
            return $result;
        }

        
    }