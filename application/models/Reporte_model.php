<?php
/**
 * Created by PhpStorm.
 * User: JRAMIREZ
 * Date: 14/07/2018
 * Time: 10:01 AM
 */

class Reporte_model extends CI_Model
{

    /**
     * @param $intervalo
     * @return bool
     */
    public function IntervaloFijo($intervalo, $fInicial, $fFinal )
    {
        //1 - hoy
        //2 - ayer
        //3 - esta semana
        //4 - la semana pasada
        //5 - este mes
        //6 - mes pasado
        //7 - este a;o
        //8 - a;o pasado
        if ($intervalo != null ){
            if ($intervalo > 0 || $intervalo !=null) {
                //hoy
                if ($intervalo == 1) {
                    $query = $this->db->query('SELECT * FROM ventas WHERE DATE(fecha) = CURRENT_DATE');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;

                }
                //ayer
                if ($intervalo == 2) {
                    $query = $this->db->query('SELECT * FROM ventas WHERE DATE(fecha) = DATE(DATE(NOW())-1)');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;

                }

                //esta semana
                if ($intervalo == 3) {
                    $query = $this->db->query('SELECT * FROM ventas WHERE YEARWEEK(fecha) = YEARWEEK(CURDATE());');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;
                }

                //semana pasada
                if ($intervalo == 4) {
                    $query = $this->db->query('SELECT * FROM ventas WHERE fecha >= curdate() - INTERVAL DAYOFWEEK(curdate())+5 DAY  AND fecha < curdate() - INTERVAL DAYOFWEEK(curdate())-2 DAY');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;
                }

                //mes actual
                if ($intervalo == 5) {
                    $query = $this->db->query('SELECT *  FROM ventas WHERE fecha BETWEEN SUBDATE(CURDATE(),MONTH(CURDATE())) AND ADDDATE(CURDATE(),MONTH(CURDATE()))');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;
                }

                //mes pasado
                if ($intervalo == 6) {
                    $query = $this->db->query('SELECT *  FROM ventas WHERE MONTH(fecha) = MONTH(DATE_ADD(CURDATE(),INTERVAL -1 MONTH));');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;
                }

                //este anio
                if ($intervalo == 7) {
                    $query = $this->db->query('SELECT *  FROM ventas WHERE YEAR(fecha) = YEAR(CURDATE())');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;
                }

                //anio pasado
                if ($intervalo == 8) {
                    $query = $this->db->query('SELECT *  FROM ventas WHERE YEAR(fecha) = YEAR(NOW()) - 1');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;
                }
            }
        }
        else
            if ( $fInicial != null && $fFinal != null){
                $condition = "fecha BETWEEN " . "'" . $fInicial . "'" . " AND " . "'" . $fFinal . "'";



                $this->db->from('ventas');

                $this->db->where($condition);

                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    return $query->result();
                } else {
                    return FALSE;
                }
            }

    }

    public function reporteOrdenes( $intervalo, $fInicial, $fFinal)
    {
        //1 - hoy
        //2 - ayer
        //3 - esta semana
        //4 - la semana pasada
        //5 - este mes
        //6 - mes pasado
        //7 - este a;o
        //8 - a;o pasado


        if ($intervalo != null ){
            if ($intervalo > 0 || $intervalo !=null) {
                //hoy
                if ($intervalo == 1) {
                    $query = $this->db->query('SELECT * FROM orden WHERE DATE(fechaOrden) = CURRENT_DATE');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;

                }
                //ayer
                if ($intervalo == 2) {
                    $query = $this->db->query('SELECT * FROM orden WHERE DATE(fechaOrden) = DATE(DATE(NOW())-1)');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;

                }

                //esta semana
                if ($intervalo == 3) {
                    $query = $this->db->query('SELECT * FROM orden WHERE YEARWEEK(fechaOrden) = YEARWEEK(CURDATE());');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;
                }

                //semana pasada
                if ($intervalo == 4) {
                    $query = $this->db->query('SELECT * FROM orden WHERE fechaOrden >= curdate() - INTERVAL DAYOFWEEK(curdate())+5 DAY  AND fechaOrden < curdate() - INTERVAL DAYOFWEEK(curdate())-2 DAY');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;
                }

                //mes actual
                if ($intervalo == 5) {
                    $query = $this->db->query('SELECT *  FROM orden WHERE fechaOrden BETWEEN SUBDATE(CURDATE(),MONTH(CURDATE())) AND ADDDATE(CURDATE(),MONTH(CURDATE()))');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;
                }

                //mes pasado
                if ($intervalo == 6) {
                    $query = $this->db->query('SELECT *  FROM orden WHERE MONTH(fechaOrden) = MONTH(DATE_ADD(CURDATE(),INTERVAL -1 MONTH));');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;
                }

                //este anio
                if ($intervalo == 7) {
                    $query = $this->db->query('SELECT *  FROM orden WHERE YEAR(fechaOrden) = YEAR(CURDATE())');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;
                }

                //anio pasado
                if ($intervalo == 8) {
                    $query = $this->db->query('SELECT *  FROM orden WHERE YEAR(fechaOrden) = YEAR(NOW()) - 1');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;
                }
            }
        }
        else
            if ( $fInicial != null && $fFinal != null){
                $condition = "fechaOrden BETWEEN " . "'" . $fInicial . "'" . " AND " . "'" . $fFinal . "'";



                $this->db->from('orden');

                $this->db->where($condition);

                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    return $query->result();
                } else {
                    return FALSE;
                }
            }

    }

    public function topProductos( $intervalo, $fInicial, $fFinal, $top )
    {
        //1 - hoy
        //2 - ayer
        //3 - esta semana
        //4 - la semana pasada
        //5 - este mes
        //6 - mes pasado
        //7 - este a;o
        //8 - a;o pasado

        $orden = null;

        if( $top == 1)
        {
            $orden = "DESC";
        }else{

            $orden = "ASC";
        }
        if ($intervalo != null ){
            if ($intervalo > 0 || $intervalo !=null) {
                //hoy
                if ($intervalo == 1) {
                    $query = $this->db->query('SELECT producto.idProducto as idproducto, producto.producto as producto, ventas.idventa as idventa, ventas.fecha as 
                                                    fechaventa, SUM(detalleventas.cantidad) AS unidades 
                                                    FROM ventas 
                                                    INNER JOIN detalleventas on detalleventas.idventa = ventas.idventa 
                                                    INNER JOIN producto ON detalleventas.idproducto = producto.idProducto 
                                                    WHERE DATE(ventas.fecha) = CURRENT_DATE
                                                    GROUP BY detalleventas.idproducto
                                                    ORDER BY SUM(detalleventas.cantidad) '.$orden.'
                                                    LIMIT 0 , 10');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;

                }
                //ayer
                if ($intervalo == 2) {
                    $query = $this->db->query('SELECT producto.idProducto as idproducto, producto.producto as producto, ventas.idventa as idventa, ventas.fecha as 
                                                    fechaventa, SUM(detalleventas.cantidad) AS unidades 
                                                    FROM ventas 
                                                    INNER JOIN detalleventas on detalleventas.idventa = ventas.idventa 
                                                    INNER JOIN producto ON detalleventas.idproducto = producto.idProducto 
                                                    WHERE DATE(ventas.fecha) = DATE(DATE(NOW())-1)
                                                    GROUP BY detalleventas.idproducto
                                                    ORDER BY SUM(detalleventas.cantidad) '.$orden.'
                                                    LIMIT 0 , 10');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;

                }

                //esta semana
                if ($intervalo == 3) {
                    $query = $this->db->query('SELECT producto.idProducto as idproducto, producto.producto as producto, ventas.idventa as idventa, ventas.fecha as 
                                                    fechaventa, SUM(detalleventas.cantidad) AS unidades 
                                                    FROM ventas 
                                                    INNER JOIN detalleventas on detalleventas.idventa = ventas.idventa 
                                                    INNER JOIN producto ON detalleventas.idproducto = producto.idProducto 
                                                    WHERE YEARWEEK(ventas.fecha) = YEARWEEK(CURDATE())
                                                    GROUP BY detalleventas.idproducto
                                                    ORDER BY SUM(detalleventas.cantidad) '.$orden.'
                                                    LIMIT 0 , 10');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;
                }

                //semana pasada
                if ($intervalo == 4) {
                    $query = $this->db->query('SELECT producto.idProducto as idproducto, producto.producto as producto, ventas.idventa as idventa, ventas.fecha as 
                                                    fechaventa, SUM(detalleventas.cantidad) AS unidades 
                                                    FROM ventas 
                                                    INNER JOIN detalleventas on detalleventas.idventa = ventas.idventa 
                                                    INNER JOIN producto ON detalleventas.idproducto = producto.idProducto 
                                                    WHERE ventas.fecha >= curdate() - INTERVAL DAYOFWEEK(curdate())+5 DAY  AND ventas.fecha < curdate() - INTERVAL DAYOFWEEK
                                                    (curdate())-2 DAY
                                                    GROUP BY detalleventas.idproducto
                                                    ORDER BY SUM(detalleventas.cantidad) '.$orden.'
                                                    LIMIT 0 , 10');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;
                }

                //mes actual
                if ($intervalo == 5) {
                    $query = $this->db->query('SELECT producto.idProducto as idproducto, producto.producto as producto, ventas.idventa as idventa, ventas.fecha as 
                                                    fechaventa, SUM(detalleventas.cantidad) AS unidades 
                                                    FROM ventas 
                                                    INNER JOIN detalleventas on detalleventas.idventa = ventas.idventa 
                                                    INNER JOIN producto ON detalleventas.idproducto = producto.idProducto 
                                                    WHERE ventas.fecha BETWEEN SUBDATE(CURDATE(),MONTH(CURDATE())) AND ADDDATE(CURDATE(),MONTH(CURDATE()))
                                                    GROUP BY detalleventas.idproducto
                                                    ORDER BY SUM(detalleventas.cantidad) '.$orden.'
                                                    LIMIT 0 , 10');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;
                }

                //mes pasado
                if ($intervalo == 6) {
                    $query = $this->db->query('SELECT producto.idProducto as idproducto, producto.producto as producto, ventas.idventa as idventa, ventas.fecha as 
                                                    fechaventa, SUM(detalleventas.cantidad) AS unidades 
                                                    FROM ventas 
                                                    INNER JOIN detalleventas on detalleventas.idventa = ventas.idventa 
                                                    INNER JOIN producto ON detalleventas.idproducto = producto.idProducto 
                                                    WHERE MONTH(ventas.fecha) = MONTH(DATE_ADD(CURDATE(),INTERVAL -1 MONTH))
                                                    GROUP BY detalleventas.idproducto
                                                    ORDER BY SUM(detalleventas.cantidad) '.$orden.'
                                                    LIMIT 0 , 10');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;
                }

                //este anio
                if ($intervalo == 7) {
                    $query = $this->db->query('SELECT producto.idProducto as idproducto, producto.producto as producto, ventas.idventa as idventa, ventas.fecha as 
                                                    fechaventa, SUM(detalleventas.cantidad) AS unidades 
                                                    FROM ventas 
                                                    INNER JOIN detalleventas on detalleventas.idventa = ventas.idventa 
                                                    INNER JOIN producto ON detalleventas.idproducto = producto.idProducto 
                                                    WHERE YEAR(ventas.fecha) = YEAR(CURDATE())
                                                    GROUP BY detalleventas.idproducto
                                                    ORDER BY SUM(detalleventas.cantidad) '.$orden.' 
                                                    LIMIT 0 , 10');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;
                }

                //anio pasado
                if ($intervalo == 8) {
                    $query = $this->db->query('SELECT producto.idProducto as idproducto, producto.producto as producto, ventas.idventa as idventa, ventas.fecha as 
                                                    fechaventa, SUM(detalleventas.cantidad) AS unidades 
                                                    FROM ventas 
                                                    INNER JOIN detalleventas on detalleventas.idventa = ventas.idventa 
                                                    INNER JOIN producto ON detalleventas.idproducto = producto.idProducto 
                                                    WHERE YEAR(ventas.fecha) = YEAR(NOW()) - 1
                                                    GROUP BY detalleventas.idproducto
                                                    ORDER BY SUM(detalleventas.cantidad) '.$orden.'
                                                    LIMIT 0 , 10');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;
                }
            }
        }
        else
            if ( $fInicial != null && $fFinal != null){


                $query = $this->db->query('SELECT producto.idProducto as idproducto, producto.producto as producto, ventas.idventa as idventa, ventas.fecha as 
                                                    fechaventa, SUM(detalleventas.cantidad) AS unidades 
                                                    FROM ventas 
                                                    INNER JOIN detalleventas on detalleventas.idventa = ventas.idventa 
                                                    INNER JOIN producto ON detalleventas.idproducto = producto.idProducto 
                                                    WHERE ventas.fecha BETWEEN "'.$fInicial.'" AND "'.$fFinal.'"
                                                    GROUP BY detalleventas.idproducto
                                                    ORDER BY SUM(detalleventas.cantidad) '.$orden.'
                                                    LIMIT 0 , 10');
                if ($query->num_rows() > 0) {
                    return $query->result();
                }
                return FALSE;
            }
    }

    public function topEmpleados( $intervalo, $fInicial, $fFinal )
    {
        //1 - hoy
        //2 - ayer
        //3 - esta semana
        //4 - la semana pasada
        //5 - este mes
        //6 - mes pasado
        //7 - este a;o
        //8 - a;o pasado

        if ($intervalo != null ){
            if ($intervalo > 0 || $intervalo !=null) {
                //hoy
                if ($intervalo == 1) {
                    $query = $this->db->query('SELECT empleado.idEmpleado as idempleado, empleado.nombresEmpleado as nombres, 
empleado.apellidosEmpleado as apellidos, users.idUser as iduser,
                                                    SUM(orden.idEmpleado) as ordenes,
                                                    SUM(orden.totalOrden)as montos
                                                    FROM empleado 
                                                    INNER JOIN users on users.idEmpleado = empleado.idEmpleado 
                                                    INNER JOIN orden ON empleado.idEmpleado = orden.idEmpleado 
                                                    WHERE DATE(orden.fechaOrden) = CURRENT_DATE
                                                    AND (empleado.idEmpleado) > 1
                                                    GROUP BY empleado.idEmpleado
                                                    ORDER BY SUM(orden.totalOrden) DESC');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;

                }
                //ayer
                if ($intervalo == 2) {
                    $query = $this->db->query('SELECT empleado.idEmpleado as idempleado, empleado.nombresEmpleado as nombres, 
empleado.apellidosEmpleado as apellidos, users.idUser as iduser,
                                                    SUM(orden.idEmpleado) as ordenes,
                                                    SUM(orden.totalOrden)as montos
                                                    FROM empleado 
                                                    INNER JOIN users on users.idEmpleado = empleado.idEmpleado 
                                                    INNER JOIN orden ON empleado.idEmpleado = orden.idEmpleado 
                                                    WHERE DATE(orden.fechaOrden) = DATE(DATE(NOW())-1)
                                                    AND (empleado.idEmpleado) > 1
                                                    GROUP BY empleado.idEmpleado
                                                    ORDER BY SUM(orden.totalOrden) DESC');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;

                }

                //esta semana
                if ($intervalo == 3) {
                    $query = $this->db->query('SELECT empleado.idEmpleado as idempleado, empleado.nombresEmpleado as nombres, 
empleado.apellidosEmpleado as apellidos, users.idUser as iduser,
                                                    SUM(orden.idEmpleado) as ordenes,
                                                    SUM(orden.totalOrden)as montos
                                                    FROM empleado 
                                                    INNER JOIN users on users.idEmpleado = empleado.idEmpleado 
                                                    INNER JOIN orden ON empleado.idEmpleado = orden.idEmpleado 
                                                    WHERE YEARWEEK(orden.fechaOrden) = YEARWEEK(CURDATE())
                                                    AND (empleado.idEmpleado) > 1
                                                    GROUP BY empleado.idEmpleado
                                                    ORDER BY SUM(orden.totalOrden) DESC');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;
                }

                //semana pasada
                if ($intervalo == 4) {
                    $query = $this->db->query('SELECT empleado.idEmpleado as idempleado, empleado.nombresEmpleado as nombres, 
empleado.apellidosEmpleado as apellidos, users.idUser as iduser,
                                                    SUM(orden.idEmpleado) as ordenes,
                                                    SUM(orden.totalOrden)as montos
                                                    FROM empleado 
                                                    INNER JOIN users on users.idEmpleado = empleado.idEmpleado 
                                                    INNER JOIN orden ON empleado.idEmpleado = orden.idEmpleado 
                                                    WHERE orden.fechaOrden >= curdate() - INTERVAL DAYOFWEEK(curdate())+5 DAY  AND orden.fechaOrden < curdate() - INTERVAL DAYOFWEEK
                                                    (curdate())-2 DAY
                                                    AND (empleado.idEmpleado) > 1
                                                    GROUP BY empleado.idEmpleado
                                                    ORDER BY SUM(orden.totalOrden) DESC');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;
                }

                //mes actual
                if ($intervalo == 5) {
                    $query = $this->db->query('SELECT empleado.idEmpleado as idempleado, empleado.nombresEmpleado as nombres, 
                                                    empleado.apellidosEmpleado as apellidos, users.idUser as iduser,
                                                    SUM(orden.idEmpleado) as ordenes,
                                                    SUM(orden.totalOrden)as montos
                                                    FROM empleado 
                                                    INNER JOIN users on users.idEmpleado = empleado.idEmpleado 
                                                    INNER JOIN orden ON empleado.idEmpleado = orden.idEmpleado 
                                                    WHERE orden.fechaOrden BETWEEN SUBDATE(CURDATE(),MONTH(CURDATE())) AND ADDDATE(CURDATE(),MONTH(CURDATE()))
                                                    AND (empleado.idEmpleado) > 1
                                                    GROUP BY empleado.idEmpleado
                                                    ORDER BY SUM(orden.totalOrden) DESC');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;
                }

                //mes pasado
                if ($intervalo == 6) {
                    $query = $this->db->query('SELECT empleado.idEmpleado as idempleado, empleado.nombresEmpleado as nombres, 
                                                    empleado.apellidosEmpleado as apellidos, users.idUser as iduser,
                                                    SUM(orden.idEmpleado) as ordenes,
                                                    SUM(orden.totalOrden)as montos
                                                    FROM empleado 
                                                    INNER JOIN users on users.idEmpleado = empleado.idEmpleado 
                                                    INNER JOIN orden ON empleado.idEmpleado = orden.idEmpleado 
                                                    WHERE MONTH(orden.fechaOrden) = MONTH(DATE_ADD(CURDATE(),INTERVAL -1 MONTH))
                                                    AND (empleado.idEmpleado) > 1
                                                    GROUP BY empleado.idEmpleado
                                                    ORDER BY SUM(orden.totalOrden) DESC');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;
                }

                //este anio
                if ($intervalo == 7) {
                    $query = $this->db->query('SELECT empleado.idEmpleado as idempleado, empleado.nombresEmpleado as nombres, 
                                                    empleado.apellidosEmpleado as apellidos, users.idUser as iduser,
                                                    SUM(orden.idEmpleado) as ordenes,
                                                    SUM(orden.totalOrden)as montos
                                                    FROM empleado 
                                                    INNER JOIN users on users.idEmpleado = empleado.idEmpleado 
                                                    INNER JOIN orden ON empleado.idEmpleado = orden.idEmpleado 
                                                    WHERE YEAR(orden.fechaOrden) = YEAR(CURDATE())
                                                    AND (empleado.idEmpleado) > 1
                                                    GROUP BY empleado.idEmpleado
                                                    ORDER BY SUM(orden.totalOrden) DESC');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;
                }

                //anio pasado
                if ($intervalo == 8) {
                    $query = $this->db->query('SELECT empleado.idEmpleado as idempleado, empleado.nombresEmpleado as nombres, 
                                                    empleado.apellidosEmpleado as apellidos, users.idUser as iduser,
                                                    SUM(orden.idEmpleado) as ordenes,
                                                    SUM(orden.totalOrden)as montos
                                                    FROM empleado 
                                                    INNER JOIN users on users.idEmpleado = empleado.idEmpleado 
                                                    INNER JOIN orden ON empleado.idEmpleado = orden.idEmpleado 
                                                    WHERE YEAR(orden.fechaOrden) = YEAR(NOW()) - 1
                                                    AND (empleado.idEmpleado) > 1
                                                    GROUP BY empleado.idEmpleado
                                                    ORDER BY SUM(orden.totalOrden) DESC');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;
                }
            }
        }
        else
            if ( $fInicial != null && $fFinal != null){


                $query = $this->db->query('SELECT empleado.idEmpleado as idempleado, empleado.nombresEmpleado as nombres, 
                                                    empleado.apellidosEmpleado as apellidos, users.idUser as iduser,
                                                    SUM(orden.idEmpleado) as ordenes,
                                                    SUM(orden.totalOrden)as montos
                                                    FROM empleado 
                                                    INNER JOIN users on users.idEmpleado = empleado.idEmpleado 
                                                    INNER JOIN orden ON empleado.idEmpleado = orden.idEmpleado 
                                                    WHERE orden.fechaOrden BETWEEN "'.$fInicial.'" AND "'.$fFinal.'"
                                                    AND (empleado.idEmpleado) > 1
                                                    GROUP BY empleado.idEmpleado
                                                    ORDER BY SUM(orden.totalOrden) DESC');
                if ($query->num_rows() > 0) {
                    return $query->result();
                }
                return FALSE;
            }
    }

    public function ventasCierreCaja($fInicial, $fFinal, $idempleado )
    {
        if ( $fInicial != null && $fFinal != null){

            $this->db->select('SUM(ventas.total) as total');
            $condition = "fecha BETWEEN " . "'" . $fInicial . "'" . " AND " . "'" . $fFinal . "'";

            $this->db->from('ventas');

            $this->db->where($condition);
            $this->db->where('idempleado', $idempleado );
            $this->db->where('estado', 1);

            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return FALSE;
            }
        }
    }


    public function movimientos( $intervalo, $fInicial, $fFinal )
    {
        //1 - hoy
        //2 - ayer
        //3 - esta semana
        //4 - la semana pasada
        //5 - este mes
        //6 - mes pasado
        //7 - este a;o
        //8 - a;o pasado

        if ($intervalo != null ){
            if ($intervalo > 0 || $intervalo !=null) {
                //hoy
                if ($intervalo == 1) {
                    $query = $this->db->query('SELECT e.idEmpleado as idempleado, e.nombresEmpleado as nombres, 
                                                    e.apellidosEmpleado as apellidos, users.idUser as iduser,
                                                    movimientos_caja.id as idmovimiento, movimientos_caja. apertura,
                                                    movimientos_caja.cierre, movimientos_caja.montoApertura,
                                                    movimientos_caja.montoCierre
                                                   
                                                    FROM movimientos_caja
                                                    INNER JOIN empleado e on movimientos_caja.idEmpleado = e.idEmpleado
                                                    INNER JOIN users on users.idEmpleado = e.idEmpleado 
                                                  
                                                    WHERE DATE(movimientos_caja.apertura) = CURRENT_DATE
                                                    AND movimientos_caja.estado = 1 
                                                    AND (e.idEmpleado) = 1
                                                    GROUP BY movimientos_caja.apertura');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;

                }
                //ayer
                if ($intervalo == 2) {
                    $query = $this->db->query('SELECT e.idEmpleado as idempleado, e.nombresEmpleado as nombres, 
                                                    e.apellidosEmpleado as apellidos, users.idUser as iduser,
                                                    movimientos_caja.id as idmovimiento, movimientos_caja. apertura,
                                                    movimientos_caja.cierre, movimientos_caja.montoApertura,
                                                    movimientos_caja.montoCierre
                                                   
                                                    FROM movimientos_caja
                                                    INNER JOIN empleado e on movimientos_caja.idEmpleado = e.idEmpleado
                                                    INNER JOIN users on users.idEmpleado = e.idEmpleado 
                                                  
                                                    WHERE DATE(movimientos_caja.apertura) = DATE(DATE(NOW())-1)
                                                    AND movimientos_caja.estado = 1 
                                                    AND (e.idEmpleado) = 1
                                                    GROUP BY movimientos_caja.apertura');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;

                }

                //esta semana
                if ($intervalo == 3) {
                    $query = $this->db->query('SELECT e.idEmpleado as idempleado, e.nombresEmpleado as nombres, 
                                                    e.apellidosEmpleado as apellidos, users.idUser as iduser,
                                                    movimientos_caja.id as idmovimiento, movimientos_caja. apertura,
                                                    movimientos_caja.cierre, movimientos_caja.montoApertura,
                                                    movimientos_caja.montoCierre
                                                   
                                                    FROM movimientos_caja
                                                    INNER JOIN empleado e on movimientos_caja.idEmpleado = e.idEmpleado
                                                    INNER JOIN users on users.idEmpleado = e.idEmpleado 
                                                  
                                                    WHERE movimientos_caja.apertura >= curdate() - INTERVAL DAYOFWEEK(curdate())+5 DAY  AND movimientos_caja.apertura < curdate() - INTERVAL DAYOFWEEK
                                                    (curdate())-2 DAY
                                                    AND movimientos_caja.estado = 1 
                                                    AND (e.idEmpleado) = 1
                                                    GROUP BY movimientos_caja.apertura');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;
                }

                //semana pasada
                if ($intervalo == 4) {
                    $query = $this->db->query('SELECT e.idEmpleado as idempleado, e.nombresEmpleado as nombres, 
                                                    e.apellidosEmpleado as apellidos, users.idUser as iduser,
                                                    movimientos_caja.id as idmovimiento, movimientos_caja. apertura,
                                                    movimientos_caja.cierre, movimientos_caja.montoApertura,
                                                    movimientos_caja.montoCierre
                                                   
                                                    FROM movimientos_caja
                                                    INNER JOIN empleado e on movimientos_caja.idEmpleado = e.idEmpleado
                                                    INNER JOIN users on users.idEmpleado = e.idEmpleado 
                                                  
                                                    WHERE movimientos_caja.apertura >= curdate() - INTERVAL DAYOFWEEK(curdate())+5 DAY  AND movimientos_caja.apertura < curdate() - INTERVAL DAYOFWEEK
                                                    (curdate())-2 DAY
                                                    AND movimientos_caja.estado = 1 
                                                    AND (e.idEmpleado) = 1
                                                    GROUP BY movimientos_caja.apertura');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;
                }

                //mes actual
                if ($intervalo == 5) {
                    $query = $this->db->query('SELECT e.idEmpleado as idempleado, e.nombresEmpleado as nombres, 
                                                    e.apellidosEmpleado as apellidos, users.idUser as iduser,
                                                    movimientos_caja.id as idmovimiento, movimientos_caja. apertura,
                                                    movimientos_caja.cierre, movimientos_caja.montoApertura,
                                                    movimientos_caja.montoCierre
                                                   
                                                    FROM movimientos_caja
                                                    INNER JOIN empleado e on movimientos_caja.idEmpleado = e.idEmpleado
                                                    INNER JOIN users on users.idEmpleado = e.idEmpleado 
                                                  
                                                    WHERE movimientos_caja.apertura BETWEEN SUBDATE(CURDATE(),MONTH(CURDATE())) AND ADDDATE(CURDATE(),MONTH(CURDATE()))
                                                    AND movimientos_caja.estado = 1 
                                                    AND (e.idEmpleado) = 1
                                                    GROUP BY movimientos_caja.apertura');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;
                }

                //mes pasado
                if ($intervalo == 6) {
                    $query = $this->db->query('SELECT e.idEmpleado as idempleado, e.nombresEmpleado as nombres, 
                                                    e.apellidosEmpleado as apellidos, users.idUser as iduser,
                                                    movimientos_caja.id as idmovimiento, movimientos_caja. apertura,
                                                    movimientos_caja.cierre, movimientos_caja.montoApertura,
                                                    movimientos_caja.montoCierre
                                                   
                                                    FROM movimientos_caja
                                                    INNER JOIN empleado e on movimientos_caja.idEmpleado = e.idEmpleado
                                                    INNER JOIN users on users.idEmpleado = e.idEmpleado 
                                                  
                                                    WHERE MONTH(movimientos_caja.apertura) = MONTH(DATE_ADD(CURDATE(),INTERVAL -1 MONTH))
                                                    AND movimientos_caja.estado = 1 
                                                    AND (e.idEmpleado) = 1
                                                    GROUP BY movimientos_caja.apertura');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;
                }

                //este anio
                if ($intervalo == 7) {
                    $query = $this->db->query('SELECT e.idEmpleado as idempleado, e.nombresEmpleado as nombres, 
                                                    e.apellidosEmpleado as apellidos, users.idUser as iduser,
                                                    movimientos_caja.id as idmovimiento, movimientos_caja. apertura,
                                                    movimientos_caja.cierre, movimientos_caja.montoApertura,
                                                    movimientos_caja.montoCierre
                                                   
                                                    FROM movimientos_caja
                                                    INNER JOIN empleado e on movimientos_caja.idEmpleado = e.idEmpleado
                                                    INNER JOIN users on users.idEmpleado = e.idEmpleado 
                                                  
                                                    WHERE YEAR(movimientos_caja.apertura) = YEAR(CURDATE())
                                                    AND movimientos_caja.estado = 1 
                                                    AND (e.idEmpleado) = 1
                                                    GROUP BY movimientos_caja.apertura');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;
                }

                //anio pasado
                if ($intervalo == 8) {
                    $query = $this->db->query('SELECT e.idEmpleado as idempleado, e.nombresEmpleado as nombres, 
                                                    e.apellidosEmpleado as apellidos, users.idUser as iduser,
                                                    movimientos_caja.id as idmovimiento, movimientos_caja. apertura,
                                                    movimientos_caja.cierre, movimientos_caja.montoApertura,
                                                    movimientos_caja.montoCierre
                                                   
                                                    FROM movimientos_caja
                                                    INNER JOIN empleado e on movimientos_caja.idEmpleado = e.idEmpleado
                                                    INNER JOIN users on users.idEmpleado = e.idEmpleado 
                                                  
                                                    WHERE YEAR(movimientos_caja.apertura) = YEAR(NOW()) - 1
                                                    AND movimientos_caja.estado = 1 
                                                    AND (e.idEmpleado) = 1
                                                    GROUP BY movimientos_caja.apertura');
                    if ($query->num_rows() > 0) {
                        return $query->result();
                    }
                    return FALSE;
                }
            }
        }
        else
            if ( $fInicial != null && $fFinal != null){


                $query = $this->db->query('SELECT e.idEmpleado as idempleado, e.nombresEmpleado as nombres, 
                                                    e.apellidosEmpleado as apellidos, users.idUser as iduser,
                                                    movimientos_caja.id as idmovimiento, movimientos_caja. apertura,
                                                    movimientos_caja.cierre, movimientos_caja.montoApertura,
                                                    movimientos_caja.montoCierre
                                                   
                                                    FROM movimientos_caja
                                                    INNER JOIN empleado e on movimientos_caja.idEmpleado = e.idEmpleado
                                                    INNER JOIN users on users.idEmpleado = e.idEmpleado 
                                                  
                                                   WHERE movimientos_caja.apertura BETWEEN "'.$fInicial.'" AND "'.$fFinal.'"
                                                    AND movimientos_caja.estado = 1 
                                                    AND (e.idEmpleado) = 1
                                                    GROUP BY movimientos_caja.apertura');
                if ($query->num_rows() > 0) {
                    return $query->result();
                }
                return FALSE;
            }
    }

}