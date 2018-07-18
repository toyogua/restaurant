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
         * param-name(tipointervalo) = 1 intervalo fijo || 2 rango dinamico (fechas)
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
                    //intervalo fijo
                    if ( $tipoIntervalo == 1)
                    {


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

            switch ($intervalo) {
                case 1:
                    $titulo = "HOY";
                    break;
                case 2:
                    $titulo = "AYER";
                    break;
                case 3:
                    $titulo= "DE ESTA SEMANA";
                    break;
            }

            $data['titulo'] = $titulo;
            $data['total'] =  $total;
            $data['main_view'] = "reportes/listar";

            $this->load->view('layouts/main', $data);
        }
    }