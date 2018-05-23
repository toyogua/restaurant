<?php
class Permisos_model extends CI_Model
{
    public function todos()
    {
        $get_data = $this->db->get('modulos');

        if ($get_data->num_rows() < 1){
            return FALSE ;
        }
        return $get_data->result();
    }

    public function acciones()
    {
        $get_data = $this->db->get('acciones_modulos');

        if ($get_data->num_rows() < 1){
            return FALSE ;
        }
        return $get_data->result();
    }

    public function accionesOrdenes()
    {
        $this->db->order_by('accion','asc');
        $this->db->where('id_modulo', "Ordenes");

        $res = $this->db->get('acciones_modulos');
            if( $res->num_rows() < 1)
            {
                return FALSE;
            }

            return $res->result();
    }

    public function accionesEmpleados()
    {
        $this->db->order_by('accion','asc');
        $this->db->where('id_modulo', "Empleados");
        $res = $this->db->get('acciones_modulos');
        if( $res->num_rows() < 1)
        {
            return FALSE;
        }

        return $res->result();
    }

    public function accionesMesas()
    {
        $this->db->order_by('accion','asc');
        $this->db->where('id_modulo', "Mesas");
        $res = $this->db->get('acciones_modulos');
        if( $res->num_rows() < 1)
        {
            return FALSE;
        }

        return $res->result();
    }

    public function accionesVentas()
    {
        $this->db->order_by('accion','asc');
        $this->db->where('id_modulo', "Ventas");
        $res = $this->db->get('acciones_modulos');
        if( $res->num_rows() < 1)
        {
            return FALSE;
        }

        return $res->result();
    }

    public function crear( $data )
    {
        $this->db->insert('permisos_acciones', $data);
        return TRUE;
    }

    public function permisosExistentes( $idempleado )
    {
        $this->db->where('id_empleado', $idempleado );
        $res = $this->db->get('permisos_acciones');
        if ( $res->num_rows() < 1){
            return FALSE;
        }

        return $res->result();
    }

    public function eliminar( $idempleado, $idmodulo, $idaccion)
    {
        $this->db->where('id_empleado', $idempleado);
        $this->db->where('id_modulo', $idmodulo);
        $this->db->where('accion', $idaccion);
        $this->db->delete('permisos_acciones');

        return TRUE;
    }
}