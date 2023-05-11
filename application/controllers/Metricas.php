<?php


class Metricas extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('metricas_model', 'metricas');
    }
    
    public function index(){

        $data['ultimos_15_dias'] = $this->metricas->getAnalyticsLastWeek();
        //$data['analytics_yesterday'] = $this->metricas->getAnalyticsYesterday();
        $data['analytics_today'] = $this->metricas->getAnalyticsToday();
        $data['ticket_promedio'] = $this->metricas->getTicketPromedio();
        $data['pedidos_al_dia_de_hoy'] = $this->metricas->getTotalPedidosHoy();
        $data['venta_al_dia_de_ayer'] = $this->metricas->getVentasAyer();
        $data['venta_al_dia_de_hoy'] = $this->metricas->getVentasHoy();
        $data['utilidad_al_dia_de_ayer'] = $this->metricas->getUtilidadAyer();
        $data['utilidad_al_dia_de_hoy'] = $this->metricas->getUtilidadHoy();
        $data['view'] = 'metricas/index';
        $this->load->view('layout', $data);
    }

    public function getAnalyticsYesterdayController(){

        $data = $this->metricas->getAnalyticsYesterday();
        echo json_encode($data);

    }

    public function getAnalyticsThisWeekController(){

        $data = $this->metricas->getAnalyticsThisWeek();
        echo json_encode($data);
    }

    public function getAnalyticsLastWeekController(){

        $data = $this->metricas->getAnalyticsLastWeek();
        echo json_encode($data);
    }

    public function getAnalyticsLastWeekControllerPrueba(){

        $data = $this->metricas->getAnalyticsLastWeekPrueba();
        echo json_encode($data);
    }

    public function getAnalyticsOfMonth(){

        $data = $this->metricas->getAnalyticsOfMonth();
        echo json_encode($data);
    }
}