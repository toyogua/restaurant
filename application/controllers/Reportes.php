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

            $intervalo = null;
            $tipoIntervalo = null;


            if ( $this->input->post('intervalo') != null && $this->input->post('radio') )
            {
                $intervalo = $this->input->post('intervalo');
                $tipoIntervalo = $this->input->post('radio');
            }


            $fInicial   = null;
            $fFinal     = null;

            if ($this->input->post('txtFInicial') != null && $this->input->post('txtFFinal') != null)
            {
                $fInicial   = $this->input->post('txtFInicial');
                $fFinal     = $this->input->post('txtFFinal');

            }


            $total = 0;
            if ($tipoIntervalo != null || $tipoIntervalo != 0 )
            {

                if ($tipoIntervalo < 3 )
                {
                    //intervalo fijo
                    if ( $tipoIntervalo == 1)
                    {

                        if ($fInicial != null || $fFinal != null)
                        {
                            $this->session->set_flashdata('combinacion', 'Mala combinacion de rangos');
                            redirect('reportes/index');
                        }

                        $temp = $this->Reporte_model->IntervaloFijo( $intervalo, null, null );

                        if ($temp != FALSE){
                            $data['ventas'] = $temp;

                            for($i=0; $i<count($temp); $i++){

                                $total = $total + $temp[$i]->total;
                            }
                        }


                    }

                    //rango con fechas
                    if ( $tipoIntervalo == 2 )
                    {
                        if ($fInicial == null && $fInicial == null ){
                            $this->session->set_flashdata('fechas_vacias', 'Las fechas no pueden estar vacias');
                            redirect('reportes/index');
                        }

                        $temp = $this->Reporte_model->IntervaloFijo( null, $fInicial, $fFinal );

                        if ($temp != FALSE){
                            $data['ventas'] = $temp;

                            for($i=0; $i<count($temp); $i++){

                                $total = $total + $temp[$i]->total;
                            }
                        }


                    }

                }
            }else{
                $this->session->set_flashdata('campos_vacios', 'Debes seleccionar una opcion');
                redirect('reportes/index');
            }

            $titulo = " (Parece que no selecciono ningun rango )";
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


            $data['fInicial'] = $fInicial;
            $data['fFinal'] = $fFinal;
            $data['titulo'] = $titulo;
            $data['total'] =  $total;
            $data['main_view'] = "reportes/listar";

            $this->load->view('layouts/main', $data);
        }


        /**
         *Muestra los filtros de rangos para visualizar reportes de ordenes
         * return vista reportes/ordenes_view
         */
        public function filtrosOrdenes()
        {
            $data['main_view'] = "reportes/ordenes_view";

            $this->load->view('layouts/main', $data);
        }


        /**
         *Muestra los resultados encontrados en base a los intervalos enviados
         * param-name(tipointervalo) = 1 intervalo fijo || 2 rango dinamico (fechas)
         */
        public function ordenes()
        {
            $intervalo = $this->input->post('intervalo');
            $tipoIntervalo = $this->input->post('radio');

            $fInicial   = null;
            $fFinal     = null;

            if ($this->input->post('txtFInicial') != null && $this->input->post('txtFFinal') != null)
            {
                $fInicial   = $this->input->post('txtFInicial');
                $fFinal     = $this->input->post('txtFFinal');

            }


            $total = 0;
            if ($tipoIntervalo != null || $tipoIntervalo != 0 )
            {

                if ($tipoIntervalo < 3 )
                {
                    //intervalo fijo
                    if ( $tipoIntervalo == 1)
                    {
                        if ($fInicial != null || $fFinal != null)
                        {
                            $this->session->set_flashdata('combinacion', 'Mala combinacion de rangos');
                            redirect('reportes/filtrosOrdenes');
                        }


                        $temp = $this->Reporte_model->reporteOrdenes( $intervalo, null, null );

                        if ($temp != FALSE){

                            $data['ordenes'] = $temp;

                            //$datos = $data['ordenes'];

                            for($i=0; $i<count($temp); $i++){

                                $total = $total + $temp[$i]->totalOrden;
                            }
                        }

                    }

                    //rango con fechas
                    if ( $tipoIntervalo == 2 )
                    {
//

                        if ($fInicial == null && $fInicial == null ){
                            $this->session->set_flashdata('fechas_vacias', 'Las fechas no pueden estar vacias');
                            redirect('reportes/filtrosOrdenes');
                        }

                        $temp = $this->Reporte_model->reporteOrdenes( null, $fInicial, $fFinal );

                        if ($temp != FALSE){
                            $data['ordenes'] = $temp;

                            for($i=0; $i<count($temp); $i++){

                                $total = $total + $temp[$i]->totalOrden;
                            }
                        }


                    }

                }
            }else
            {
                $this->session->set_flashdata('campos_vacios', 'Debes seleccionar una opcion');
                redirect('reportes/filtrosOrdenes');

            }

            $titulo = " (Parece que no selecciono ningun rango )";
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


            $data['fInicial'] = $fInicial;
            $data['fFinal'] = $fFinal;
            $data['titulo'] = $titulo;
            $data['total'] =  $total;
            $data['main_view'] = "reportes/listar_reportes_ordenes_view";

            $this->load->view('layouts/main', $data);
        }
    }