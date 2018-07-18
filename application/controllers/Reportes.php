    <?php
    /**
     * Created by PhpStorm.
     * User: JRAMIREZ
     * Date: 14/07/2018
     * Time: 9:57 AM
     */

    class Reportes extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();

            $this->load->helper('utilidades');
            $this->load->model('Reporte_model');


            if (!$this->session->userdata('logueado')){
                //$this->session->set_flashdata('no_access', 'Debes iniciar sesión para acceder a esta área.');
                redirect('home');
            }
        }



        /**
         *Pantalla principal para los reportes
         */
        public function index()
        {

            $data['main_view'] = "reportes/index_view";

            $this->load->view('layouts/main', $data);
        }



        /**
         *muestra los resultados en base a lo seleccionado por el usuario
         */
        public function listar()
        {
            $intervalo = $this->input->post('intervalo');
            $tipoIntervalo = $this->input->post('radio');


            $total = 0;
            if ($tipoIntervalo != null || $tipoIntervalo != 0 )
            {
                if ($tipoIntervalo < 3 )
                {
                    //hoy
                    if ( $tipoIntervalo == 1)
                    {
                        //1 - hoy
                        //2 - ayer
                        //3 - esta semana
                        //4 - la semana pasada
                        //5 - este mes
                        //6 - mes pasado
                        //7 - este a;o
                        //8 - a;o pasado

                        $data['ventas'] = $this->Reporte_model->IntervaloFijo( $intervalo );

                        if ($data['ventas'] != FALSE){
                            $datos = $data['ventas'];

                            for($i=0; $i<count($datos); $i++){

                                $total = $total + $datos[$i]->total;
                            }
                        }

                        }
                     //ayer
                    if ( $tipoIntervalo == 2){
                        $data['ventas'] = $this->Reporte_model->IntervaloFijo( $intervalo );

                        if ($data['ventas'] != FALSE){
                            $datos = $data['ventas'];

                            for($i=0; $i<count($datos); $i++){

                                $total = $total + $datos[$i]->total;
                            }
                        }

                    }
                }
            }

            $data['total'] =  $total;
            $data['main_view'] = "reportes/listar";

            $this->load->view('layouts/main', $data);
        }
    }