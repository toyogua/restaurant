<?php
/**
 * Created by PhpStorm.
 * User: DELEON
 * Date: 10-Nov-17
 * Time: 2:17 PM
 */

class Ingredientes extends CI_Controller
{

    public function display(){
        $data['ingredientes_data'] = $this->Ingrediente_model->get_ingredientes_info();

        $data['main_view'] = "ingredientes/display_view";
        $this->load->view('layouts/main', $data);
    }

    public function get_ingrediente($idIngrediente){
        if ($this->input->is_ajax_request()) {
            $data = $this->Ingrediente_model->get_ingrediente_info($idIngrediente);
            echo json_encode($data);
        }
    }

    public function create(){
        $listaIngredientes = json_decode($_POST['ingredientes']);

        $data = array(
            'ingrediente'               => $listaIngredientes->ingrediente,
            'descripcionIngrediente'    => $listaIngredientes->ingredienteDescripcion,
            'costoIngrediente'          => $listaIngredientes->costoIngrediente,
            'cantIngrediente'           => $listaIngredientes->cantIngrediente,
            'fechaIngreso'              => $listaIngredientes->fechaIngreso,
            'medida'                    => $listaIngredientes->medida
        );

        $res = $this->Ingrediente_model->insertIngredientes($data);
        echo json_encode($res);
    }


    public function edit(){
        $listaIngredientes = json_decode($_POST['ingredientes']);

        $data = array(
            'ingrediente'               => $listaIngredientes->ingrediente,
            'descripcionIngrediente'    => $listaIngredientes->ingredienteDescripcion,
            'costoIngrediente'          => $listaIngredientes->costoIngrediente,
            'cantIngrediente'           => $listaIngredientes->cantIngrediente,
            'fechaIngreso'              => $listaIngredientes->fechaIngreso,
            'medida'                    => $listaIngredientes->medida
        );

        $res = $this->Ingrediente_model->edit_ingrediente($listaIngredientes->idingrediente, $data);
        echo json_encode($res);
    }

    public function delete($idIngrediente){
        $this->Ingrediente_model->delete_ingrediente($idIngrediente);
    }


}