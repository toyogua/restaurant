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

        public function filtroTopVentas()
        {
            $data['main_view'] = "reportes/filtroTopVentas_view";

            $this->load->view('layouts/main', $data);
        }

        public function listarTopProductos()
        {
            $intervalo = null;
            $tipoIntervalo = null;
            $top = NULL;


            if ( $this->input->post('intervalo') != null && $this->input->post('radio') )
            {
                $intervalo = $this->input->post('intervalo');
                $tipoIntervalo = $this->input->post('radio');
            }

            if ( $this->input->post('top') != null ){

                $top = $this->input->post('top');
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

                        if ($fInicial != null || $fFinal != null  )
                        {
                            $this->session->set_flashdata('combinacion', 'Mala combinacion de rangos');
                            redirect('reportes/filtroTopVentas');
                        }

                        if ( $top == null )
                        {
                            $this->session->set_flashdata('top', 'Debes elegir alguna opcion Mas / Menos Vendidos');
                            redirect('reportes/filtroTopVentas');
                        }

                        $temp = $this->Reporte_model->topProductos( $intervalo, null, null, $top );

                        if ($temp != FALSE){
                            $data['productos'] = $temp;
                        }


                    }

                    //rango con fechas
                    if ( $tipoIntervalo == 2 )
                    {
                        if ($fInicial == null && $fInicial == null ){
                            $this->session->set_flashdata('fechas_vacias', 'Las fechas no pueden estar vacias');
                            redirect('reportes/filtroTopVentas');
                        }

                        if ( $top == null )
                        {
                            $this->session->set_flashdata('top', 'Debes elegir alguna opcion Mas / Menos Vendidos');
                            redirect('reportes/filtroTopVentas');
                        }

                        $temp = $this->Reporte_model->topProductos( null, $fInicial, $fFinal, $top );

                        if ($temp != FALSE){
                            $data['productos'] = $temp;

                        }


                    }

                }
            }else{
                $this->session->set_flashdata('campos_vacios', 'Debes seleccionar una opcion');
                redirect('reportes/filtroTopVentas');
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
            $data['main_view'] = "reportes/listarTopProductos_view";

            $this->load->view('layouts/main', $data);
        }

        public function filtroMesero()
        {
            $data['main_view'] = "reportes/filtroMesero_view";

            $this->load->view('layouts/main', $data);
        }

        public function listarRendimientoMesero()
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

                        if ($fInicial != null || $fFinal != null  )
                        {
                            $this->session->set_flashdata('combinacion', 'Mala combinacion de rangos');
                            redirect('reportes/filtroMesero');
                        }


                        $temp = $this->Reporte_model->topEmpleados( $intervalo, null, null );

                        if ($temp != FALSE){
                            $data['meseros'] = $temp;
                        }


                    }

                    //rango con fechas
                    if ( $tipoIntervalo == 2 )
                    {
                        if ($fInicial == null && $fInicial == null ){
                            $this->session->set_flashdata('fechas_vacias', 'Las fechas no pueden estar vacias');
                            redirect('reportes/filtroMesero');
                        }


                        $temp = $this->Reporte_model->topEmpleados( null, $fInicial, $fFinal );

                        if ($temp != FALSE){
                            $data['meseros'] = $temp;

                        }


                    }

                }
            }else{
                $this->session->set_flashdata('campos_vacios', 'Debes seleccionar una opcion');
                redirect('reportes/filtroMesero');
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
            $data['main_view'] = "reportes/listarRendimientoMesero_view";

            $this->load->view('layouts/main', $data);
        }

        public function cajas()
        {
            $data['main_view'] = "reportes/cajas_view";

            $this->load->view('layouts/main', $data);
        }

        public function listarMovimientosCaja()
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

                        if ($fInicial != null || $fFinal != null  )
                        {
                            $this->session->set_flashdata('combinacion', 'Mala combinacion de rangos');
                            redirect('reportes/cajas');
                        }


                        $temp = $this->Reporte_model->movimientos( $intervalo, null, null );

                        if ($temp != FALSE){
                            $data['movimientos'] = $temp;
                        }


                    }

                    //rango con fechas
                    if ( $tipoIntervalo == 2 )
                    {
                        if ($fInicial == null && $fInicial == null ){
                            $this->session->set_flashdata('fechas_vacias', 'Las fechas no pueden estar vacias');
                            redirect('reportes/cajas');
                        }


                        $temp = $this->Reporte_model->movimientos( null, $fInicial, $fFinal );

                        if ($temp != FALSE){
                            $data['movimientos'] = $temp;

                        }


                    }

                }
            }else{
                $this->session->set_flashdata('campos_vacios', 'Debes seleccionar una opcion');
                redirect('reportes/cajas');
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
            //$data['total'] =  $total;
            $data['main_view'] = "reportes/listarMovimientosCaja_view";

            $this->load->view('layouts/main', $data);
        }
    }