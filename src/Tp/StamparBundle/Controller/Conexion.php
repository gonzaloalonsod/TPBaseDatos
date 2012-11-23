<?php
namespace Tp\StamparBundle\Controller;

use Tp\StamparBundle\Entity\Pedido;

class Conexion {
    private $link;
    //ACA SE DECIDE CUANTOS RESULTADOS MOSTRAR POR PÁGINA , EN EL EJEMPLO PONGO 15
    private $rows_per_page = 10;
    private $page;
    
    public function __construct() {
        $this->link = mysql_connect('localhost', 'root', 'root');
        mysql_select_db('tpbd', $this->link);
        //AL PRINCIPIO COMPRUEBO SI HICIERON CLICK EN ALGUNA PÁGINA
        if(isset($_GET['page'])){
            $this->page= $_GET['page'];
        }else{
        //SI NO DIGO Q ES LA PRIMERA PÁGINA
            $this->page=1;
        }
    }
    
    public function buscarPedidosPorEmpleado($nomyape){
        $pedidos = array();
        
        $consulta = mysql_query('SELECT e.nombre, e.apellido, p.id, p.fecha from Pedido AS p
                                    INNER JOIN Empleado AS e
                                        ON p.id_empleado = e.id
                                    WHERE e.nombre LIKE "%'.$nomyape.'%" OR e.apellido LIKE "%'.$nomyape.'%"
                                ');
//        $res = mysql_fetch_array($consulta);
        while ($value = mysql_fetch_object($consulta)) {
            //$local = new local($r["codLoc"], $r["Nomb"], $r["Direccion"], $r["BeterinarioResp"]);
            var_dump($value);
            echo '<br>';
//            $pedido = new Pedido();
//            $pedido->setId($value['id']);
//            $pedido->setFecha($value['fecha']);
            array_push($pedidos, $value);
        }
//        die;
//        $c->cerrar();
//        return $local;
        return $pedidos;
    }
    
    public function buscarClientesPorNomyape($nomyape){
        $clientes = array();

        $consulta = mysql_query('SELECT c.id, c.direccion, c.telefono, p.dni, p.nombre, p.apellido from Cliente AS c
                                    INNER JOIN Persona AS p
                                        ON c.id = p.id_cliente
                                    WHERE p.nombre LIKE "%'.$nomyape.'%" OR p.apellido LIKE "%'.$nomyape.'%"
                                ');
        while ($value = mysql_fetch_object($consulta)) {
            var_dump($value);
            echo '<br>';
            array_push($clientes, $value);
        }

        return $clientes;
    }
    
    public function buscarComprasDeCliente($dni){
        $compras = array();

        $consulta = mysql_query('SELECT f.id, f.fecha, f.total from Factura AS f
                                    INNER JOIN Cliente AS c
                                        ON f.id_cliente = c.id
                                    INNER JOIN Persona AS p
                                        ON c.id = p.id_cliente
                                    WHERE p.dni = '.$dni.'
                                ');
        while ($value = mysql_fetch_object($consulta)) {
            var_dump($value);
            echo '<br>';
            array_push($compras, $value);
        }

        return $compras;
    }
    
    public function totalComprasDeCliente($dni){
        $consulta = mysql_query('SELECT SUM(f.total) from Factura AS f
                                    INNER JOIN Cliente AS c
                                        ON f.id_cliente = c.id
                                    INNER JOIN Persona AS p
                                        ON c.id = p.id_cliente
                                    WHERE p.dni = '.$dni.'
                                ');

        return mysql_fetch_row($consulta);
    }
    
    public function buscarFacturasMayor($valor){
        $facturas = array();

        $consulta = mysql_query('SELECT f.id_cliente, f.id, f.fecha, f.total from Factura AS f
                                    INNER JOIN Cliente AS c
                                        ON f.id_cliente = c.id                                   
                                    WHERE f.total > 1000
                                ');
        while ($value = mysql_fetch_object($consulta)) {
            var_dump($value);
            echo '<br>';
            array_push($facturas, $value);
        }

        return $facturas;
    }

//    public function findAllLocal(){
//        $consulta = mysql_query('SELECT * from local');
//        $resultado = $this->paginar($consulta);
//        return $resultado;
//    }
//    
//    public function findAllMascota(){
//        $consulta = mysql_query('SELECT * from mascota');
//        $resultado = $this->paginar($consulta);
//        return $resultado;
//    }
//    
//    public function paginar($consulta){
//        //MIRO CUANTOS DATOS FUERON DEVUELTOS
//        $num_rows = mysql_num_rows($consulta);
//        //CALCULO LA ULTIMA PÁGINA
//        $lastpage = ceil($num_rows / $this->rows_per_page);
//        //COMPRUEBO QUE EL VALOR DE LA PÁGINA SEA CORRECTO Y SI ES LA ULTIMA PÁGINA
//        $page=(int)$this->page;
//        if($page > $lastpage){
//            $page= $lastpage;
//        }
//        if($page < 1){
//            $page=1;
//        }
//        
//        return $consulta;
//    }
//    
//    public function findMascota($cod){
//        $consulta = mysql_query('SELECT * from mascota WHERE Cod = '.$cod);
//        $resultado =  mysql_fetch_row($consulta);
//        return $resultado;
//    }
}
?>