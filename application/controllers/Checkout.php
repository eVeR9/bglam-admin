<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller{
    
    function  __construct(){
        parent::__construct();
        
        // Load form library & helper
        $this->load->library('form_validation');
        $this->load->helper('form');
        
        // Load cart library
        $this->load->library('cart');
        
        // Load product model
        $this->load->model('product');
        
        $this->controller = 'checkout';
    }

    function index(){
        // Redirect if the cart is empty
        if($this->cart->total_items() <= 0){
            redirect('productos/');
        }
        
        $custData = $data = array();
        //print_r($_SESSION); This could produce header error
        
        // If order request is submitted
        $submit = $this->input->post('placeOrder');
        if(isset($submit)){
            // Form field validation rules
            $this->form_validation->set_rules('nombre', 'Nombre', 'required');
            $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
            $this->form_validation->set_rules('telefono', 'Telefono', 'required');
            //$this->form_validation->set_rules('phone', 'Phone', 'required');
            //$this->form_validation->set_rules('address', 'Address', 'required');
            
            // Prepare customer data
            $custData = array(
                'nombre'     => strip_tags($this->input->post('nombre')),
                'apellidos'     => strip_tags($this->input->post('apellidos')),
                'telefono'     => strip_tags($this->input->post('telefono'))
            );
            
            // Validate submitted form data
            if($this->form_validation->run() == true){
                // Insert customer data
                $insert = $this->product->insertCustomer($custData);
                
                // Check customer data insert status
                if($insert){
                    // Insert order
                    $order = $this->placeOrder($insert);
                    
                    // If the order submission is successful
                    if($order){
                        $this->session->set_userdata('success_msg', 'Order placed successfully.');
                        redirect($this->controller.'/orderSuccess/'.$order);
                    }else{
                        $data['error_msg'] = 'Algo salio mal con el pedido, vuelve a intentarlo';
                    }
                }else{
                    $data['error_msg'] = 'Algo salio mal, vuelve a intentarlo';
                }
            }
        }
        
        // Customer data
        $data['custData'] = $custData;
        
        // Retrieve cart data from the session
        $data['cartItems'] = $this->cart->contents();

        // Payment Methods
        //$data['payment_methods'] = $this->product->getPaymentMethods($id = '');
        //$data['payment_methods'] = $this->product->getMetodoPago();
        
        //$data['prueba'] = $this->product->getMethodsCompare($data);

        // Pass products data to the view
        $data['cupones'] = $this->product->showCuponesDeDescuento();
        $data['view'] = $this->controller.'/index';
        $this->load->view('layout', $data);
    }
    
    function placeOrder($custID){
        // Insert order data
        $ordData = array(
            'cliente_id' => $custID,
            'total_pedido' => $this->input->post('totalAntesde'), //$this->cart->total(),
            'metodo_de_pago' => strip_tags($this->input->post('metodo_de_pago'))
        );
        $insertOrder = $this->product->insertOrder($ordData);
        
        if($insertOrder){
            // Retrieve cart data from the session
            $cartItems = $this->cart->contents();
            
            // Cart items
            $ordItemData = array();
            $ordItemMovimiento = array();
            $i=0;
            foreach($cartItems as $item){
                $costo = array();
                $query = "SELECT ROUND(AVG(costo_unitario),2) FROM inventario WHERE producto_id = '{$item['id']}'";
                $query = $this->db->query($query);
                $costo = $query->row_array();

                $ordItemData[$i]['pedido_id']     = $insertOrder;
                $ordItemData[$i]['producto_id']     = $item['id'];
                $ordItemData[$i]['unidades']     = $item['qty'];
                $ordItemData[$i]['precio_producto']     = $item["subtotal"];
                $ordItemData[$i]['costo_unitario'] = implode($costo);
                $i++;
            }

            foreach($cartItems as $item){

                $costo = array();
                $query = "SELECT ROUND(AVG(costo_unitario),2) FROM inventario WHERE producto_id = '{$item['id']}'";
                $query = $this->db->query($query);
                $costo = $query->row_array();

                $ordItemMovimiento[$i]['producto_id'] = $item['id'];
                $ordItemMovimiento[$i]['unidades'] = $item['qty'] * (-1);
                $ordItemMovimiento[$i]['almacen_id'] = 1;
                $ordItemMovimiento[$i]['costo_unitario'] = implode($costo);
                $i++;
            }
            
            if(!empty($ordItemData)){
                // Insert order items
                $insertOrderItems = $this->product->insertOrderItems($ordItemData);
                $insertOrderItemsMov = $this->product->insertOrderItemsMov($ordItemMovimiento);
                
                if($insertOrderItems){
                    // Remove items from the cart
                    $this->cart->destroy();
                    
                    // Return order ID
                    return $insertOrder;
                }
            }
        }
        return false;
    }

    function orderSuccess($ordID){
        // Fetch order data from the database
        $data['order'] = $this->product->getOrder($ordID);
        
        // Load order details view
        $data['view'] = $this->controller.'/order-success';
        $this->load->view('layout', $data);
    }

    function getValueMetodoDePago(){

        //$metodo = $this->input->get('metodo');
        $id = $this->input->get('id');

        $data = $this->product->getMetodoPago($id);
        echo json_encode($data);
    }

    function getValueCuponesDeDescuento(){

        $id = $this->input->post('cuponId');

        $data = $this->product->getCuponDeDescuento($id);
        echo json_encode($data);
    }

}

?>