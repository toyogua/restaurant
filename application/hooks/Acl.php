<?php
defined("BASEPATH") or die("Acceso prohibido");

class Acl
{

    /**
     * @desc - obtenemos la instancia de ci
     */
    public function __get($var)
    {
        return get_instance()->$var;


    }

    /**
     * @desc - obtenemos la instancia de ci sin tender que crearla
     */
    public function __construct()
    {
        !$this->load->library('session') ? $this->load->library('session') : false;
        !$this->load->helper('url') ? $this->load->helper('url') : false;
    }

    /**
     * @desc - devuelve un array con los roles y las zonas de acceso
     * @return array
     */
    private function roles_access()
    {
        return array(
            //rutas para el admin
            "Administrador" => array("home", "Products", "orders", "users","Categorias", "Categorias/edit", "bills","login","register", "dashboard"),
            //rutas para el bartender
            "Bartender" => array("dashboard","control_panel","my_providers"),
            //rutas para mesero
            "Mesero"    => array("home"),
            //rutas para cocinero
            "Cocinero"  => array("home"),
            //rutas para el invitado
            "guest"	=>	array("login","register","home")
        );
    }

    /**
     * @desc - por defecto, si no existe la sesión de usuario es guest
     * @return - string - sesión por defecto
     */
//    private function _defaultRole()
//    {
//        return !$this->session->userdata("role") ?
//            $this->session->set_userdata("role","guest") :
//            $this->session->userdata("role");
//    }

    /**
     * @desc - comprobamos si el usuario tiene acceso a una zona,
     * si no lo tiene lo dejamos en la primera de su rol con un mensaje
     */
    public function auth()
    {
//        $this->_defaultRole();

//
        foreach($this->roles_access() as $role => $areas)
        {
            if($this->session->userdata("role") == $role)
            {
                if(!in_array($this->uri->segment(1),$areas))
                {
                    $this->session->set_flashdata("denegado","Tu usuario no tiene acceso a esta area");
                    //redirect($areas[0],"refresh");
                    redirect($areas[0]);
                }
            }
        }
    }

}
//Hooks: end application/hooks/acl.php