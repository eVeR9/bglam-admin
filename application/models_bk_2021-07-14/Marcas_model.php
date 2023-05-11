<?php 

    class Marcas_model extends CI_Model{

        private $marcas = 'marcas';

        public function __construct()
        {
            parent::__construct();
        }

        public function add($data){

            $this->db->insert($this->marcas, $data);
            return true;
        }
    }