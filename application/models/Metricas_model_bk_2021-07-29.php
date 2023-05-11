<?php


/**
 * TRATAR DE TRBABAJAR BAJO LA BASE DE ESTE QUERY EN CUANTO A RESULTADOS DE DIAS y SEMANAS ANTERIORES
 * 
 * SELECT ROUND(SUM(total_pedido),2) as total_ventas_esta_semana 
 * FROM pedidos 
 * WHERE created_at BETWEEN CURDATE() - INTERVAL 15 DAY AND CURDATE()
 * 
 * 
 * /////////////////////////////////////////////////////////////////////////////////////
 * PROCESO PARA LLEGAR AL TOTAL DE PEDIDOS DE LOS 15 DIAS ANTERIORES A LOS ULTIMOS 15 DIAS
 * #SELECT SUM(total_pedido) as 'total_hace_30' 
 * #FROM pedidos 
 * #WHERE created_at BETWEEN '2021-06-12' AND '2021-06-27';

 * #validado del 12 de junio al 10 de Julio
 * SET @pedidos_30 = (SELECT SUM(total_pedido)
 * FROM pedidos 
 * WHERE created_at BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE());

 * #SELECT SUM(total_pedido) as '15_dias' 
 * #FROM pedidos 
 * #WHERE created_at BETWEEN '2021-06-27' AND CURDATE()

 * #validado del 27 de junio al 10 de julio
 * SET @pedidos_15 = (SELECT SUM(total_pedido) 
 * FROM pedidos 
 * WHERE created_at BETWEEN CURDATE() - INTERVAL 14 DAY AND CURDATE());

 * SELECT SUM(total_pedido) as 'acum_30_dias'
 * FROM pedidos 
 * WHERE created_at BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE();

 * SELECT SUM(total_pedido) as 'acum_15_dias'
 * FROM pedidos 
 * WHERE created_at BETWEEN CURDATE() - INTERVAL 14 DAY AND CURDATE();

 * SELECT @pedidos_30 - @pedidos_15;

 * SELECT SUM(total_pedido) FROM pedidos WHERE created_at BETWEEN '2021-06-12' AND '2021-06-28'
 */

class Metricas_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getUtilidadHoy()
    {

        /*
        $this->db->select('(SUM(lp.precio_producto) - SUM(p.costo)) as Utilidad');
        $this->db->from('productos p');
        $this->db->join('lineas_pedido lp', 'p.id = lp.producto_id', 'left');
        $this->db->join('pedidos ped', 'ped.id = lp.pedido_id', 'left');
        $this->db->where('DATE_FORMAT(ped.created_at, "%Y-%m-%d")', $fecha);
        */
        $sql = "SELECT ROUND((SUM(lp.precio_producto) - SUM(p.costo*lp.unidades)),2) as Utilidad 
                FROM productos p 
                LEFT JOIN lineas_pedido lp ON p.id = lp.producto_id 
                LEFT JOIN pedidos ped ON ped.id = lp.pedido_id 
                WHERE DATE_FORMAT(ped.created_at, '%Y-%m-%d') = DATE(NOW())";

        $query = $this->db->query($sql);
        $utilidadHoy = $query->row_array();

        if ($utilidadHoy != "") {

            return $utilidadHoy;
        } else {

            return null;
        }
    }

    public function getUtilidadAyer()
    {

        /*
        $this->db->select('(SUM(lp.precio_producto) - SUM(p.costo)) as Utilidad');
        $this->db->from('productos p');
        $this->db->join('lineas_pedido lp', 'p.id = lp.producto_id', 'left');
        $this->db->join('pedidos ped', 'ped.id = lp.pedido_id', 'left');
        $this->db->where('DATE_FORMAT(ped.created_at, "%Y-%m-%d")', $fecha);
        */
        $sql = "SELECT ROUND((SUM(lp.precio_producto) - SUM(p.costo*lp.unidades)),2) as Utilidadayer 
                FROM productos p 
                LEFT JOIN lineas_pedido lp ON p.id = lp.producto_id 
                LEFT JOIN pedidos ped ON ped.id = lp.pedido_id 
                WHERE DATE_FORMAT(ped.created_at, '%Y-%m-%d') = DATE(NOW() - INTERVAL 1 DAY)";

        $query = $this->db->query($sql);
        $utilidadAyer = $query->row_array();

        if ($utilidadAyer != "") {

            return $utilidadAyer;
        } else {

            return null;
        }
    }

    public function getVentasHoy()
    {

        $sql = "SELECT ROUND(SUM(total_pedido),2) as total_pedido_hoy 
                FROM pedidos 
                WHERE DATE_FORMAT(created_at, '%Y-%m-%d') = DATE(CURDATE())";

        $query = $this->db->query($sql);
        $ventaHoy = $query->row_array();

        if ($ventaHoy != "") {

            return $ventaHoy;
        } else {

            return null;
        }
    }

    public function getVentasAyer()
    {

        $sql = "SELECT ROUND(SUM(total_pedido),2) as total_pedido_ayer 
                FROM pedidos 
                WHERE DATE_FORMAT(created_at, '%Y-%m-%d') = DATE(CURDATE() - INTERVAL 1 DAY)";

        $query = $this->db->query($sql);
        $ventaHoy = $query->row_array();

        if ($ventaHoy != "") {

            return $ventaHoy;
        } else {

            return null;
        }
    }

    public function getTotalPedidosHoy()
    {

        $sql = "SELECT COUNT(id) as total_pedidos FROM pedidos WHERE DATE_FORMAT(created_at, '%Y-%m-%d') = DATE(CURDATE())";

        $query = $this->db->query($sql);
        $totalPedidosHoy = $query->row_array();

        if ($totalPedidosHoy != "") {

            return $totalPedidosHoy;
        } else {

            return null;
        }
    }

    public function getTicketPromedio()
    {

        $sql = "SELECT (SUM(total_pedido)/COUNT(id)) as ticket_promedio 
                FROM pedidos 
                WHERE DATE_FORMAT(created_at, '%Y-%m-%d') = DATE(CURDATE())";

        $query = $this->db->query($sql);
        $ticketPromedio = $query->row_array();

        if ($ticketPromedio != "") {

            return $ticketPromedio;
        } else {

            return null;
        }
    }

    public function getAnalyticsToday(){

        $query1 = $this->db->query(
        "SELECT ROUND((SUM(lp.precio_producto) - SUM(lp.costo_unitario*lp.unidades)) - 
        (SELECT IFNULL(SUM(monto),0) FROM gastos WHERE fecha = CURDATE()),2) as 'Utilidad' 
        FROM lineas_pedido lp 
        LEFT JOIN pedidos ped ON ped.id = lp.pedido_id 
        WHERE DATE_FORMAT(ped.created_at, '%Y-%m-%d') = DATE(NOW()) AND ped.activo_inactivo = '1'");

        $query2 = $this->db->query(
        "SELECT ROUND((SUM(lp.precio_producto) - SUM(lp.costo_unitario*lp.unidades)) - 
        (SELECT IFNULL(SUM(monto),0) FROM gastos WHERE fecha = CURDATE()- INTERVAL 1 DAY),2) as 'utilidadAyer' 
        FROM lineas_pedido lp 
        LEFT JOIN pedidos ped ON ped.id = lp.pedido_id 
        WHERE DATE_FORMAT(ped.created_at, '%Y-%m-%d') = CURDATE() - INTERVAL 1 DAY AND ped.activo_inactivo = '1'");

        $query3 = $this->db->query("SELECT ROUND(SUM(total_pedido),2) as total_ventas_hoy FROM pedidos 
        WHERE DATE_FORMAT(created_at, '%Y-%m-%d') = DATE(CURDATE()) AND activo_inactivo = '1'");

        $query4 = $this->db->query("SELECT ROUND(SUM(total_pedido),2) as total_ventas_ayer FROM pedidos 
        WHERE DATE_FORMAT(created_at, '%Y-%m-%d') = DATE(CURDATE() - INTERVAL 1 DAY) AND activo_inactivo = '1'");

        $query5 = $this->db->query("SELECT COUNT(id) as total_pedidos FROM pedidos 
        WHERE DATE_FORMAT(created_at, '%Y-%m-%d') = DATE(CURDATE()) AND activo_inactivo = '1'"); 

        $query6 = $this->db->query("SELECT ROUND((SUM(total_pedido)/COUNT(id)),2) as ticket_promedio FROM pedidos 
        WHERE DATE_FORMAT(created_at, '%Y-%m-%d') = DATE(CURDATE()) AND activo_inactivo = '1'");

        $utilidadHoy = $query1->row_array();
        $utilidadAyer = $query2->row_array();
        $ventasHoy = $query3->row_array();
        $ventasAyer = $query4->row_array();
        $totalPedidosHoy = $query5->row_array();
        $ticketPromedio = $query6->row_array();

        $ayer_y_hoy = array_merge($utilidadHoy, $utilidadAyer, $ventasHoy, $ventasAyer, $totalPedidosHoy, $ticketPromedio);

        //print_r($ayer_y_hoy);

        return $ayer_y_hoy;
    }

    public function getAnalyticsYesterday(){

        $query1 = $this->db->query(
        "SELECT ROUND((SUM(lp.precio_producto) - SUM(lp.costo_unitario*lp.unidades)) - 
        (SELECT IFNULL(SUM(monto),0) FROM gastos WHERE fecha = CURDATE() - INTERVAL 1 DAY),2) as 'utilidad_ayer' 
        FROM lineas_pedido lp 
        LEFT JOIN pedidos ped ON ped.id = lp.pedido_id 
        WHERE DATE_FORMAT(ped.created_at, '%Y-%m-%d') = CURDATE() - INTERVAL 1 DAY AND ped.activo_inactivo = '1'");

        $query2 = $this->db->query(
        "SELECT ROUND((SUM(lp.precio_producto) - SUM(lp.costo_unitario*lp.unidades)) - 
        (SELECT IFNULL(SUM(monto),0) FROM gastos WHERE fecha = CURDATE() - INTERVAL 2 DAY),2) as 'utilidad_antier' 
        FROM lineas_pedido lp 
        LEFT JOIN pedidos ped ON ped.id = lp.pedido_id 
        WHERE DATE_FORMAT(ped.created_at, '%Y-%m-%d') = CURDATE() - INTERVAL 2 DAY AND ped.activo_inactivo = '1'");

        $query3 = $this->db->query("SELECT ROUND(SUM(total_pedido),2) as total_ventas_ayer FROM pedidos WHERE DATE_FORMAT(created_at, '%Y-%m-%d') = DATE(CURDATE() - INTERVAL 1 DAY) AND activo_inactivo = '1'");
        $query4 = $this->db->query("SELECT ROUND(SUM(total_pedido),2) as total_ventas_antier FROM pedidos WHERE DATE_FORMAT(created_at, '%Y-%m-%d') = DATE(CURDATE() - INTERVAL 2 DAY) AND activo_inactivo = '1'");

        $query5 = $this->db->query("SELECT COUNT(id) as total_pedidos_ayer FROM pedidos 
        WHERE DATE_FORMAT(created_at, '%Y-%m-%d') = DATE(CURDATE() -1) AND activo_inactivo = '1'");

        $query6 = $this->db->query("SELECT ROUND((SUM(total_pedido)/COUNT(id)),2) as ticket_promedio_ayer FROM pedidos 
        WHERE DATE_FORMAT(created_at, '%Y-%m-%d') = DATE(CURDATE() -1) AND activo_inactivo = '1'");

        $utilidadAyer = $query1->row_array();
        $utilidadAntier = $query2->row_array();
        $ventasAyer = $query3->row_array();
        $ventasAntier = $query4->row_array();
        $totalPedidosAyer = $query5->row_array();
        $ticketPromedioAyer = $query6->row_array();

        $ayer_y_antier = array_merge($utilidadAyer, $utilidadAntier, $ventasAyer, $ventasAntier, $totalPedidosAyer, $ticketPromedioAyer);

        return $ayer_y_antier;

    }

    public function getAnalyticsThisWeek(){

        //analizar este query
        $query1 = $this->db->query(
            "SELECT ROUND((SUM(lp.precio_producto) - SUM(lp.costo_unitario*lp.unidades)) - 
            (SELECT IFNULL(SUM(monto),0) FROM gastos WHERE WEEK(fecha,1) = WEEK(CURDATE())),2) as 'utilidad_esta_semana' 
            FROM lineas_pedido lp 
            LEFT JOIN pedidos ped ON ped.id = lp.pedido_id 
            WHERE WEEK(ped.created_at, 1) = WEEK(CURDATE()) AND ped.activo_inactivo = '1'"
            );

        /* Query antiguo
        "SELECT ROUND((SUM(lp.precio_producto) - SUM(p.costo*lp.unidades)),2) as utilidad_esta_semana 
         FROM productos p LEFT JOIN lineas_pedido lp ON p.id = lp.producto_id LEFT JOIN pedidos ped ON ped.id = lp.pedido_id 
         WHERE WEEK(ped.created_at, 1) = WEEK(CURDATE())"
         */

        $query2 = $this->db->query(
            "SELECT ROUND((SUM(lp.precio_producto) - SUM(lp.costo_unitario*lp.unidades)) - 
            (SELECT IFNULL(SUM(monto),0) FROM gastos WHERE WEEK(fecha,1) = WEEK(CURDATE())-1),2) as 'utilidad_semana_pasada' 
            FROM lineas_pedido lp 
            LEFT JOIN pedidos ped ON ped.id = lp.pedido_id 
            WHERE WEEK(ped.created_at, 1) = WEEK(CURDATE())-1 AND ped.activo_inactivo = '1'"
            );

        /* Query antiguo
        "SELECT ROUND((SUM(lp.precio_producto) - SUM(p.costo*lp.unidades)),2) as utilidad_semana_pasada 
        FROM productos p LEFT JOIN lineas_pedido lp ON p.id = lp.producto_id LEFT JOIN pedidos ped ON ped.id = lp.pedido_id 
        WHERE WEEK(ped.created_at, 1) = WEEK(CURDATE())-1"
         */

        $query3 = $this->db->query("SELECT ROUND(SUM(total_pedido),2) as total_ventas_esta_semana FROM pedidos 
        WHERE WEEK(created_at, 1) = WEEK(CURDATE()) AND activo_inactivo = '1'");

        $query4 = $this->db->query("SELECT ROUND(SUM(total_pedido),2) as total_ventas_semana_pasada FROM pedidos 
        WHERE WEEK(created_at, 1) = WEEK(CURDATE()) -1 AND activo_inactivo = '1'");

        $query5 = $this->db->query("SELECT COUNT(id) as total_pedidos_esta_semana FROM pedidos 
        WHERE WEEK(created_at, 1) = WEEK(CURDATE()) AND activo_inactivo = '1'");

        $query6 = $this->db->query("SELECT ROUND((SUM(total_pedido)/COUNT(id)),2) as ticket_promedio_esta_semana FROM pedidos 
        WHERE WEEK(created_at, 1) = WEEK(CURDATE()) AND activo_inactivo = '1'");

        $utilidadEstaSemana = $query1->row_array();
        $utilidadSemanaPasada = $query2->row_array();
        $ventasEstaSemana = $query3->row_array();
        $ventasSemanaPasada = $query4->row_array();
        $totalPedidosEstaSemana = $query5->row_array();
        $ticketPromedioEstaSemana = $query6->row_array();

        $esta_semana_semana_pasada = array_merge($utilidadEstaSemana, $utilidadSemanaPasada, $ventasEstaSemana, $ventasSemanaPasada, $totalPedidosEstaSemana, $ticketPromedioEstaSemana);
        return $esta_semana_semana_pasada;
    }

    public function getAnalyticsLastWeek(){

        /*
           SELECT SUM(CASE WHEN WEEK(ped.created_at, 1) = WEEK(CURDATE()) 
           THEN (lp.precio_producto - p.costo*lp.unidades) END) as utilidad_esta_semana 
           FROM productos p 
           LEFT JOIN lineas_pedido lp ON p.id = lp.producto_id 
           LEFT JOIN pedidos ped ON ped.id = lp.pedido_id

           output: 2771 utilidad esta semana
         */

        //ultimos15Dias
        $query1 = $this->db->query(        
        "SELECT ROUND((SUM(lp.precio_producto) - SUM(lp.costo_unitario*lp.unidades)) - 
        (SELECT IFNULL(SUM(monto),0) FROM gastos WHERE fecha BETWEEN CURDATE() - INTERVAL 15 DAY AND CURDATE()),2) as 'ultimos15Dias' 
        FROM lineas_pedido lp 
        LEFT JOIN pedidos ped ON ped.id = lp.pedido_id 
        WHERE ped.created_at BETWEEN CURDATE() - INTERVAL 15 DAY AND CURDATE() AND ped.activo_inactivo = '1'"
        );

        /*Query antiguo
        SELECT ROUND(SUM(lp.precio_producto) - SUM((p.costo*lp.unidades)),2) as ultimos15Dias  
        FROM productos p 
        LEFT JOIN lineas_pedido lp ON p.id = lp.producto_id 
        LEFT JOIN pedidos ped ON ped.id = lp.pedido_id
        WHERE ped.created_at BETWEEN CURDATE() - INTERVAL 15 DAY AND CURDATE()
         */

        /*
        SECOND FORM, THIS WORKS
;

        FIRST FORM DOESN'T WORK
        SELECT SUM(CASE WHEN WEEK(ped.created_at, 1) = WEEK(CURDATE()) 
        THEN lp.precio_producto - (p.costo*lp.unidades) END) + SUM(CASE WHEN WEEK(ped.created_at, 1) = WEEK(CURDATE()) -1
        THEN lp.precio_producto - (p.costo*lp.unidades) END) as ultimos15Dias 
        FROM productos p 
        LEFT JOIN lineas_pedido lp ON p.id = lp.producto_id 
        LEFT JOIN pedidos ped ON ped.id = lp.pedido_id
         */

        //PENDIENTE quinceDiasAnterioresALosUltimos15Dias
        $this->db->query(
        "SET @utilidad_ultimos_30dias = (SELECT ROUND((SUM(lp.precio_producto) - SUM(lp.costo_unitario*lp.unidades)) - 
        (SELECT IFNULL(SUM(monto),0) FROM gastos WHERE fecha BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()),2) as 'ultimos30Dias' 
        FROM lineas_pedido lp 
        LEFT JOIN pedidos ped ON ped.id = lp.pedido_id 
        WHERE ped.created_at BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() AND ped.activo_inactivo = '1');"
        );

        $this->db->query(
        "SET @utilidad_ultimos_15dias = (SELECT ROUND( IFNULL((SUM(lp.precio_producto) - SUM(lp.costo_unitario*lp.unidades)),0) - 
        (SELECT IFNULL(SUM(monto),0) FROM gastos WHERE fecha BETWEEN CURDATE() - INTERVAL 14 DAY AND CURDATE()),2) as 'ultimos15Dias' 
        FROM lineas_pedido lp 
        LEFT JOIN pedidos ped ON ped.id = lp.pedido_id 
        WHERE ped.created_at BETWEEN CURDATE() - INTERVAL 14 DAY AND CURDATE() AND ped.activo_inactivo = '1');"
        );

        $query2 = $this->db->query("SELECT ROUND(@utilidad_ultimos_30dias - @utilidad_ultimos_15dias,2) as 'quinceDiasAnterioresALosUltimos15Dias'");

        /*Query antiguo 
        "SELECT SUM(CASE WHEN WEEK(ped.created_at, 1) = WEEK(CURDATE()) -3
        THEN lp.precio_producto - (p.costo*lp.unidades) END) + SUM(CASE WHEN WEEK(ped.created_at, 1) = WEEK(CURDATE()) -2
        THEN lp.precio_producto - (p.costo*lp.unidades) END) as quinceDiasAnterioresALosUltimos15Dias 
        FROM productos p 
        LEFT JOIN lineas_pedido lp ON p.id = lp.producto_id 
        LEFT JOIN pedidos ped ON ped.id = lp.pedido_id"
        */

        $query3 = $this->db->query("SELECT ROUND(SUM(total_pedido),2) as VentasTotalesUltimos15Dias
        FROM pedidos 
        WHERE created_at BETWEEN CURDATE() - INTERVAL 15 DAY AND CURDATE() AND activo_inactivo = '1';");

        //PENDIENTE ventasQuinceDiasAnterioresALosUltimos15Dias (NO FUNCIONO)
        /*
        "SET @pedidos_hace_15_dias = (SELECT SUM(total_pedido) FROM pedidos WHERE DATE_FORMAT(created_at, '%Y-%m-%d') = CURDATE() - INTERVAL 15 DAY); 
        SET @interval_15_days = (CURDATE() - INTERVAL 15 DAY); 
        SELECT ROUND(SUM(total_pedido) - @pedidos_hace_15_dias,2) as ventasQuinceDiasAnterioresALosUltimos15Dias 
        FROM pedidos 
        WHERE DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN @interval_15_days - INTERVAL 14 DAY AND @interval_15_days"
         */

        $this->db->query(
            "SET @pedidos_ultimos_30Dias = (SELECT SUM(total_pedido)
            FROM pedidos 
            WHERE created_at BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() AND activo_inactivo = 1);"
        );

        $this->db->query(
            "SET @pedidos_ultimos_15Dias = IFNULL((SELECT SUM(total_pedido) 
            FROM pedidos 
            WHERE created_at BETWEEN CURDATE() - INTERVAL 14 DAY AND CURDATE() AND activo_inactivo = 1),0);"
        );
    
        $query4 = $this->db->query("SELECT ROUND(@pedidos_ultimos_30Dias - @pedidos_ultimos_15Dias,2) as 'ventasQuinceDiasAnterioresALosUltimos15Dias'");

        $query5 = $this->db->query("SELECT COUNT(id) as total_pedidos_semana_pasada FROM pedidos WHERE WEEK(created_at, 1) = WEEK(CURDATE()) -1 AND activo_inactivo = '1'");

        $query6 = $this->db->query("SELECT ROUND((SUM(total_pedido)/COUNT(id)),2) as ticket_promedio_semana_pasada FROM pedidos WHERE WEEK(created_at, 1) = WEEK(CURDATE()) -1 AND activo_inactivo = '1'");

        $utilidadUltimos15Dias = $query1->row_array();
        $utilidad15DiasAnterioresAlosUltimos15 = $query2->row_array();
        $ventasUltimos15Dias = $query3->row_array();
        $ventasQuinceDiasAnterioresALosUltimos15Dias = $query4->row_array();
        $totalPedidosUltimos15Dias = $query5->row_array();
        $ticketPromedioUltimos15Dias = $query6->row_array();

        $ultimos15Dias = array_merge($utilidadUltimos15Dias, $utilidad15DiasAnterioresAlosUltimos15, $ventasUltimos15Dias, $ventasQuinceDiasAnterioresALosUltimos15Dias, $totalPedidosUltimos15Dias, $ticketPromedioUltimos15Dias);
                            
        return $ultimos15Dias;
    }

    public function getAnalyticsLastWeekPrueba(){

        //resultado $8,280

        $this->db->query(
            "SET @pedidos_ultimos_30Dias = (SELECT SUM(total_pedido)
            FROM pedidos 
            WHERE created_at BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() AND activo_inactivo = 1);");
            $this->db->query(
            "SET @pedidos_ultimos_15Dias = (SELECT SUM(total_pedido) 
            FROM pedidos 
            WHERE created_at BETWEEN CURDATE() - INTERVAL 14 DAY AND CURDATE() AND activo_inactivo = 1);");
    
            $query = $this->db->query("SELECT (@pedidos_ultimos_30Dias - @pedidos_ultimos_15Dias) as 'ventasQuinceDiasAnterioresALosUltimos15Dias'");

        $response = $query->row_array();
        return $response;

    }

    public function getAnalyticsOfMonth(){

        /*
         * SELECT ROUND(SUM(lp.precio_producto) - SUM(p.costo*lp.unidades),2) as utilidadDelMes 
         * FROM productos p 
         * LEFT JOIN lineas_pedido lp ON p.id = lp.producto_id
         * LEFT JOIN pedidos ped ON ped.id = lp.pedido_id 
         * WHERE MONTH(DATE_FORMAT(ped.created_at, '%Y-%m-%d')) = MONTH(NOW()) 
         * #WHERE DATE_FORMAT(ped.created_at, '%Y-%m-%d') = DATE(NOW()) GROUP BY ped.created_at
         */

        $query1 = $this->db->query(
        "SELECT ROUND((SUM(lp.precio_producto) - SUM(lp.costo_unitario*lp.unidades)) - 
        (SELECT IFNULL(SUM(monto),0) FROM gastos WHERE MONTH(fecha) = MONTH(CURDATE())),2) as 'utilidadTotalDelMes' 
        FROM lineas_pedido lp 
        LEFT JOIN pedidos ped ON ped.id = lp.pedido_id 
        WHERE MONTH(DATE_FORMAT(ped.created_at, '%Y-%m-%d')) = MONTH(CURDATE()) AND ped.activo_inactivo = '1'"
        ); //falta utlidad total del mes pasado

        /*Query antiguo utilidad mes y mes pasado
        "SELECT ROUND(SUM(CASE WHEN MONTH(ped.created_at) = MONTH(CURDATE()) 
        THEN lp.precio_producto - (p.costo*lp.unidades) END), 2) as utilidadTotalDelMes, ROUND(SUM(CASE WHEN MONTH(ped.created_at) = MONTH(CURDATE()) -1
        THEN lp.precio_producto - (p.costo*lp.unidades) END),2) as utilidadTotalDelMesPasado 
        FROM productos p 
        LEFT JOIN lineas_pedido lp ON p.id = lp.producto_id 
        LEFT JOIN pedidos ped ON ped.id = lp.pedido_id"
        */

        $query5 = $this->db->query(
        "SELECT ROUND((SUM(lp.precio_producto) - SUM(lp.costo_unitario*lp.unidades)) - 
        (SELECT IFNULL(SUM(monto),0) FROM gastos WHERE MONTH(fecha) = MONTH(CURDATE())-1),2) as 'utilidadTotalDelMesPasado' 
        FROM lineas_pedido lp 
        LEFT JOIN pedidos ped ON ped.id = lp.pedido_id 
        WHERE MONTH(DATE_FORMAT(ped.created_at, '%Y-%m-%d')) = MONTH(CURDATE()) -1 AND ped.activo_inactivo = '1'");

        //SELECT SUM(p.total_pedido) FROM pedidos p WHERE MONTH(DATE_FORMAT(created_at, '%Y-%m-%d')) = MONTH(CURDATE())
        $query2 = $this->db->query("SELECT ROUND(SUM(CASE WHEN MONTH(created_at) = MONTH(CURDATE()) AND activo_inactivo = '1' THEN total_pedido ELSE NUll END),2) as ventasTotalDelMes, 
        ROUND(SUM(CASE WHEN MONTH(created_at) = MONTH(CURDATE()) -1 AND activo_inactivo = '1' THEN total_pedido ELSE NULL END),2) as ventasTotalDelMesPasado
        FROM pedidos"); 

        $query3 = $this->db->query("SELECT COUNT(id) as total_pedidos_mes_actual FROM pedidos WHERE MONTH(created_at) = MONTH(CURDATE()) AND activo_inactivo = '1'");
        
        $query4 = $this->db->query("SELECT ROUND((SUM(total_pedido)/COUNT(id)),2) as ticket_promedio_mes_actual FROM pedidos WHERE MONTH(created_at) = MONTH(CURDATE()) AND activo_inactivo = '1'");

        $utilidadMesActual = $query1->row_array();
        $ventasMesActualMesPasado = $query2->row_array();
        $totalPedidosMesActual = $query3->row_array();
        $ticketPromedioMesActual = $query4->row_array();
        $utilidadMesPasado = $query5->row_array();

        $mesActualMesPasado = array_merge($ventasMesActualMesPasado, $utilidadMesActual, $totalPedidosMesActual, $ticketPromedioMesActual, $utilidadMesPasado );

        return $mesActualMesPasado;
    }
}
