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

            if ($this->input->post('txtFInicial') != "" && $this->input->post('txtFFinal') != "")
            {
                $fInicial = $this->input->post('txtFInicial');
                $fFinal = $this->input->post('txtFFinal');

                $data['fInicial'] = $fInicial;
                $data['fFinal'] = $fFinal;
            }


            $total = 0;
            if ($tipoIntervalo != null || $tipoIntervalo != 0 )
            {

                if ($tipoIntervalo < 3 )
                {
                    //intervalo fijo
                    if ( $tipoIntervalo == 1)
                    {


                        $data['ventas'] = $this->Reporte_model->IntervaloFijo( $intervalo, null, null );

                        if ($data['ventas'] != FALSE){
                            $datos = $data['ventas'];

                            for($i=0; $i<count($datos); $i++){

                                $total = $total + $datos[$i]->total;
                            }
                        }
                    }

                    //rango con fechas
                    if ( $tipoIntervalo == 2 )
                    {
                        $data['ventas'] = $this->Reporte_model->IntervaloFijo( null, $fInicial, $fFinal );

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
                case  4 :
                    $titulo = "DE LA SEMANA PASADA";
                    break;
                case 5:
                    $titulo = "DE ESTE MES";
                    break;
                case 6:
                    $titulo = "DEL MES PASADO";
                    break;
                case 7:
                    $titulo = "DEL AÑO ACTUAL";
                    break;
                case 8:
                    $titulo = "DEL AÑO PASADO";
                    break;
            }

            if ($tipoIntervalo == 2)
            {
                $titulo = "ENTRE FECHAS";
            }


            $data['titulo'] = $titulo;
            $data['total'] =  $total;
            $data['main_view'] = "reportes/listar";

            $this->load->view('layouts/main', $data);
        }
    }