<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller{
    
    function  __construct(){
        parent::__construct();
        
        // Load cart library
        $this->load->library('cart');
        
        // Load product model
        $this->load->model('product');
    }
    
    function index(){
        $data = array();
        
        // Fetch products from the database
        $data['products'] = $this->product->getRows();
        
        // Load the product list view
        $data['view'] = 'products/index';
        $this->load->view('layout', $data);
    }
    
    function addToCart($proID){
        
        // Fetch specific product by ID
        $product = $this->product->getRows($proID);
        $stock = $this->product->getInventory($proID);

        if($product['estatus_id'] == 0){

            echo "<script type=\"text/javascript\">alert('Este producto se encuentra deshabilitado')</script>";
            echo "<script type=\"text/javascript\">history.go(-1)</script>";
            return 0;

        } else if($stock['total_inventario_por_id'] == 0){

            echo "<script type=\"text/javascript\">alert('No hay inventario suficiente de este producto')</script>";
            echo "<script type=\"text/javascript\">history.go(-1)</script>";
            return 0;
        
        }
        
        // Add product to the cart
        $data = array(
            'id'    => $product['id'],
            'qty'    => 1,
            'precio'    => $product['precio'] = ($product['precio'] - ($product['precio'] * $product['descuento']/100)),
            'nombre'    => $product['nombre'],
            'imagen' => $product['imagen'],
            'descuento' => $product['descuento'],
            'inventario' => $stock['total_inventario_por_id']
        );
        $this->cart->insert($data);
        
        // Redirect to the cart page
        redirect(base_url('productos/'));
    }
    
}