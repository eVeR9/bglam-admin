<?php
defined('BASEPATH') OR exit('No direct scripts access allowed');

class Dashboard extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('dashboard_model', 'infoPedidos');
    
    }

    public function index(){

        $data['analytics_today'] = $this->infoPedidos->getAnalyticsToday();
        $data['utilidad_ayer'] = $this->infoPedidos->getUtilidadTotalAyer();
        $data['utilidad_fecha'] = $this->infoPedidos->getFechaUtilidad();
        $data['pedidos'] = $this->infoPedidos->getPedidos();
        $data['utilidad_total'] = $this->infoPedidos->getUtilidadTotal();
        $data['info_pedidos'] = $this->infoPedidos->getInfoPedidos();
        $data['total_venta_ayer'] = $this->infoPedidos->getInfoPedidosYesterday();
        $data['utilidad_this_week'] = $this->infoPedidos->getUtilidadThisWeek();
        $data['utilidad_last_week'] = $this->infoPedidos->getUtilidadLastWeek();
        $data['utilidad_this_last_two_weeks'] = $this->infoPedidos->getUtilidadThisLastTwoWeeks();
        //redirect(base_url('login'));
        $data['view'] = 'dashboard/index';
        $this->load->view('layout', $data);
    }
}



?>