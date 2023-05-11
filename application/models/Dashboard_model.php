<?php

class Dashboard_model extends CI_Model {

    public function __construct(){

    }

    public function getAnalyticsToday(){

        $this->db->query("SET @pedidos_hoy = (SELECT IFNULL(SUM(total_pedido),0) FROM pedidos WHERE DATE_FORMAT(created_at, '%Y-%m-%d') = CURDATE() AND activo_inactivo = '1');");
        $query1 = $this->db->query(
        "SELECT ROUND(IFNULL((@pedidos_hoy - SUM(lp.costo_unitario*lp.unidades)),0) - 
        (SELECT IFNULL(SUM(monto),0) FROM gastos WHERE fecha = CURDATE()),2) as 'Utilidad' 
        FROM lineas_pedido lp 
        LEFT JOIN pedidos ped ON ped.id = lp.pedido_id 
        WHERE DATE_FORMAT(ped.created_at, '%Y-%m-%d') = DATE(NOW()) AND ped.activo_inactivo = '1'");

        /* Prototipo final
        SELECT (SUM(lp.precio_producto) - SUM(lp.costo_unitario*lp.unidades)) as 'costo_previo' 
        FROM lineas_pedido lp 
        WHERE DATE_FORMAT(lp.created_at, '%Y-%m-%d') = CURDATE()

        Query antiguo:
        SELECT ROUND((SUM(lp.precio_producto) - SUM(p.costo*lp.unidades)) - (SELECT IFNULL(SUM(monto),0) FROM gastos WHERE fecha = CURDATE()),2) as Utilidad 
        FROM productos p 
        LEFT JOIN lineas_pedido lp ON p.id = lp.producto_id 
        LEFT JOIN pedidos ped ON ped.id = lp.pedido_id 
        WHERE DATE_FORMAT(ped.created_at, '%Y-%m-%d') = DATE(NOW()) AND ped.activo_inactivo = '1'
        
        //prototipo funcional utilidad hoy solo con 1 producto
        "SELECT DISTINCT i.producto_id, lp.pedido_id, SUM(i.unidades), 
        (
        (SELECT SUM(lp2.precio_producto) FROM lineas_pedido lp2 LEFT JOIN pedidos pd2 ON lp2.pedido_id = pd2.id WHERE DATE_FORMAT(pd2.created_at, '%Y-%m-%d') = CURDATE()) -
        ((SELECT SUM(lp2.unidades) FROM lineas_pedido lp2 LEFT JOIN pedidos pd2 ON lp2.pedido_id = pd2.id WHERE DATE_FORMAT(pd2.created_at, '%Y-%m-%d') = CURDATE()) * AVG(i.costo_unitario))
        ) - (SELECT IFNULL(SUM(monto),0) FROM gastos WHERE fecha = CURDATE()) as 'costo_previo'
        FROM lineas_pedido as lp
        LEFT JOIN pedidos pd ON pd.id = lp.pedido_id
        LEFT JOIN inventario i ON lp.producto_id = i.producto_id
        WHERE DATE_FORMAT(pd.created_at, '%Y-%m-%d') = DATE(NOW())
        GROUP BY lp.producto_id, lp.pedido_id";
        */
        

        $this->db->query("SET @pedidos_ayer = (SELECT IFNULL(SUM(total_pedido),0) FROM pedidos WHERE DATE_FORMAT(created_at, '%Y-%m-%d') = CURDATE() - INTERVAL 1 DAY  AND activo_inactivo = '1');");
        $query2 = $this->db->query(
        "SELECT ROUND(IFNULL((@pedidos_ayer - SUM(lp.costo_unitario*lp.unidades)),0) - 
        (SELECT IFNULL(SUM(monto),0) FROM gastos WHERE fecha = CURDATE()- INTERVAL 1 DAY),2) as 'utilidadAyer' 
        FROM lineas_pedido lp 
        LEFT JOIN pedidos ped ON ped.id = lp.pedido_id 
        WHERE DATE_FORMAT(ped.created_at, '%Y-%m-%d') = CURDATE() - INTERVAL 1 DAY AND ped.activo_inactivo = '1'");

        /* Query antiguo
        SELECT ROUND((SUM(lp.precio_producto) - SUM(p.costo*lp.unidades)) - (SELECT SUM(monto) FROM gastos WHERE fecha = CURDATE() -1),2) as utilidadAyer 
        FROM productos p 
        LEFT JOIN lineas_pedido lp ON p.id = lp.producto_id 
        LEFT JOIN pedidos ped ON ped.id = lp.pedido_id 
        WHERE DATE_FORMAT(ped.created_at, '%Y-%m-%d') = DATE(NOW() - INTERVAL 1 DAY)
        */


        $query3 = $this->db->query("SELECT ROUND(IFNULL(SUM(total_pedido),0),2) as total_ventas_hoy FROM pedidos 
        WHERE DATE_FORMAT(created_at, '%Y-%m-%d') = DATE(CURDATE()) AND activo_inactivo = '1'");

        $query4 = $this->db->query("SELECT ROUND(IFNULL(SUM(total_pedido),0),2) as total_ventas_ayer FROM pedidos 
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

    public function getUtilidadTotal(){

        /*
        SELECT ROUND((SUM(lp.precio_producto) - SUM(p.costo)), 2) as Utilidad FROM productos p 
        LEFT JOIN lineas_pedido lp ON p.id = lp.producto_id 
        LEFT JOIN pedidos ped ON lp.pedido_id = ped.id WHERE DATE_FORMAT(ped.created_at, '%Y-%m-%d') = DATE(NOW())
        */

        $this->db->select('ROUND((SUM(lp.precio_producto) - SUM(p.costo)), 2) as Utilidad');
        $this->db->from('productos p');
        $this->db->join('lineas_pedido lp', 'p.id = lp.producto_id', 'left');
        $this->db->where('lp.created_at', 'CURDATE()');
        $query = $this->db->get();
        $utilidad = $query->row_array();

        return $utilidad;
    }

    public function getUtilidadTotalAyer(){

        $sql = "SELECT (SUM(lp.precio_producto) - SUM(p.costo)) as utilidadAyer FROM productos p
                LEFT JOIN lineas_pedido lp ON p.id = lp.producto_id 
                LEFT JOIN pedidos ped ON ped.id = lp.pedido_id
                WHERE DATE_FORMAT(ped.created_at, '%Y-%m-%d') = (DATE(NOW() - INTERVAL 1 DAY))";

        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        $utilidadAyer = $query->row_array();

        if($query->num_rows() > 0){

             return $utilidadAyer;

        } else {

            return "No hay valor registrado del dia de ayer";
        }
    }

    public function getUtilidadThisWeek(){

        /**
         * SELECT id, SUM(CASE WHEN WEEK(created_at, 2) = WEEK(CURDATE()) - 1 THEN total_pedido ELSE NULL END) 
         * as "lastWeekOrder", SUM(CASE WHEN WEEK(created_at) = WEEK(CURDATE()) THEN total_pedido ELSE NULL END) 
         * as "thisWeek", created_at FROM pedidos GROUP BY id
         * 
         * Esta semana y la pasada:
         * SELECT ROUND(SUM(CASE WHEN WEEK(created_at, 2) = WEEK(CURDATE()) - 1 THEN total_pedido ELSE NULL END), 2)
         *  as "lastWeekOrder", ROUND(SUM(CASE WHEN WEEK(created_at) = WEEK(CURDATE()) THEN total_pedido ELSE NULL 
         * END), 2) as "thisWeek" FROM pedidos
         * 
         * Ultimas dos semanas
         * SELECT ROUND(SUM(CASE WHEN WEEK(created_at, 2) = WEEK(CURDATE()) - 1 THEN total_pedido ELSE NULL END),2)
         * + ROUND(SUM(CASE WHEN WEEK(created_at) = WEEK(CURDATE()) THEN total_pedido ELSE NULL END), 2)
         *  as "lastTwoWeeks" FROM pedidos
         */

        $sql = "SELECT ROUND(SUM(CASE WHEN WEEK(created_at) = WEEK(CURDATE()) THEN total_pedido ELSE NULL 
                END), 2) as 'thisWeek' FROM pedidos";

               $query = $this->db->query($sql);
               $total = $query->row_array();
               //print_r($total);
               /*foreach($total as $row){
                echo $row['LastWeekOrd'];
               }*/
               return $total;
    }

    public function getUtilidadLastWeek(){

        $sql = "SELECT ROUND(SUM(CASE WHEN WEEK(created_at) = WEEK(CURDATE()) -1 THEN total_pedido ELSE NULL 
        END), 2) as 'lastWeek' FROM pedidos";

        $query = $this->db->query($sql);
        $lastWeek = $query->row_array();

        return $lastWeek;
    }

    public function getUtilidadThisLastTwoWeeks(){

        $sql = "SELECT ROUND(SUM(CASE WHEN WEEK(created_at, 2) = WEEK(CURDATE()) - 1 THEN total_pedido 
                ELSE NULL END),2) + ROUND(SUM(CASE WHEN WEEK(created_at) = WEEK(CURDATE()) 
                THEN total_pedido ELSE NULL END), 2) as 'lastTwoWeeks' FROM pedidos";

                $query = $this->db->query($sql);
                $thisLastTwoWeeks = $query->row_array();
                return $thisLastTwoWeeks;
    }

    public function getFechaUtilidad(){
  
        /*
        $this->db->select('(SUM(lp.precio_producto) - SUM(p.costo)) as Utilidad');
        $this->db->from('productos p');
        $this->db->join('lineas_pedido lp', 'p.id = lp.producto_id', 'left');
        $this->db->join('pedidos ped', 'ped.id = lp.pedido_id', 'left');
        $this->db->where('DATE_FORMAT(ped.created_at, "%Y-%m-%d")', $fecha);
        */
        $sql = "SELECT (SUM(lp.precio_producto) - SUM(p.costo)) as Utilidad FROM productos p 
                LEFT JOIN lineas_pedido lp ON p.id = lp.producto_id 
                LEFT JOIN pedidos ped ON ped.id = lp.pedido_id 
                WHERE ped.created_at = CURDATE()";

        $query = $this->db->query($sql);
        $fechaUtilidad = $query->row_array();

        if($fechaUtilidad != ""){

            return $fechaUtilidad;
        }else{

            return 0;
        }
    }

    public function getInfoPedidos(){
        $this->db->select('COUNT(Distinct pedido_id) as pedidosT, ROUND(SUM(precio_producto), 2) as ventaT');
        $query = $this->db->get('lineas_pedido');
        $ventaNeta = $query->row_array();
        return $ventaNeta;
    }

    public function getInfoPedidosYesterday(){

        $sql = "SELECT ROUND(SUM(precio_producto), 2) as ventaAyer FROM lineas_pedido WHERE created_at = CURDATE() -1";

        /*
        $this->db->select('ROUND(SUM(precio_producto), 2) as ventaAyer');
        $this->db->where('DAY(created_at) = DAY(CURDATE()) - 1');
        $query = $this->db->get('lineas_pedido');
        */
        //echo $this->db->last_query();

        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result;
    }

    public function getPedidos(){

        $this->db->select('p.id, CONCAT(c.nombre, " ", c.apellidos) as cliente_id, p.created_at, 
        p.total_pedido, GROUP_CONCAT(" ", prod.nombre) as producto_id');
        $this->db->from('pedidos p');
        $this->db->join('clientes c', 'p.cliente_id = c.id', 'left');
        $this->db->join('lineas_pedido lp', 'p.id = lp.pedido_id', 'left');
        $this->db->join('productos prod', 'lp.producto_id = prod.id');
        $this->db->group_by('p.id');
        $this->db->order_by('p.id', 'DESC');
        $this->db->limit(3);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    /**
     * SELECT p.id, CONCAT(c.nombre, " ", c.apellidos) as cliente_id, p.created_at, p.total_pedido, 
     * GROUP_CONCAT(prod.nombre) as producto_id FROM pedidos p 
     * LEFT JOIN clientes c ON p.cliente_id = c.id 
     * LEFT JOIN lineas_pedido lp ON p.id = lp.pedido_id 
     * LEFT JOIN productos prod ON lp.producto_id = prod.id GROUP BY p.id
     */

}


