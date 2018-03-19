<?php
/**
 * Created by PhpStorm.
 * User: DELEON
 * Date: 31-Oct-17
 * Time: 2:57 PM
 */

class Products extends CI_Controller
{


   public function getCategoriaJson(){

       $categoria = $this->input->post('categoria');

       $data = $this->Categoria_model->getCategoria($categoria);

       if($data !== FALSE)
       {

           foreach($data as $fila)
           {
               ?>

               <ul id="respuesta" class="text-center" >

                   <li style="cursor: pointer; padding-top: 0px; padding-bottom: 0px;" class="list-group-item  encategorias" data-id="<?php echo $fila->idCategoria ?>" data-nombre="<?php echo $fila->categoria ?>" ><?php echo $fila->categoria ?></li>

               </ul>


               <?php
           }

           //en otro caso decimos que no hay resultados
       }else{
           ?>

           <p><?php echo 'No hay resultados' ?></p>

           <?php
       }


       //echo json_encode($data);
   }


    public  function obtener_productos_categoria()
    {
        $idCategoria    =   $this->input->post('id');
        $porpagina      =   $this->input->post('porpagina');
        $desde          =   $this->input->post('desde');
        if ($this->input->is_ajax_request()) {

            $data = $this->Producto_model->get_productos_categoria($idCategoria, $porpagina, $desde);
            echo json_encode($data);
        }
    }

    public function display(){
        $data['productos_data'] = $this->Producto_model->get_productos_info();
        $data['main_view'] = "productos/display_view";
        $this->load->view('layouts/main', $data);
    }

    public function get_producto($idProducto){
        if ($this->input->is_ajax_request()) {
            $data = $this->Producto_model->get_producto_info($idProducto);



            echo json_encode($data);
            //echo json_encode($data2);
        }
    }

    public function getProductoIngrediente($idProducto)
    {
        $data = $this->Producto_model->getIngredientesProducto($idProducto);
        echo json_encode($data);
    }

    public function create(){
        $lisingredientes = json_decode($_POST['ingredientes']);

        $ruta = './assets/img/productos/';

        $producto = $this->input->post('producto');
        $descripcion = $this->input->post('descripcion');
        $costo = $this->input->post('costo');
        $precio = $this->input->post('precio');
        $cantidad = $this->input->post('cantidad');
        $imagen = $_FILES['imagen']['name'];
        $categoria = $this->input->post('categoria');


        $temporal = $_FILES['imagen']['tmp_name']; //Obtenemos la ruta Original del archivo
        $Destino = $ruta.$imagen;	//Creamos una ruta de destino con la variable ruta y el nombre original del archivo

        move_uploaded_file($temporal, $Destino); //Movemos el archivo temporal a la ruta especificada


        $data = array(
            'producto'               => $producto,
            'descripcionProducto'    => $descripcion,
            'costoProducto'          => $costo,
            'precioProducto'         => $precio,
            'cantProducto'           => $cantidad,
            'idCategoria'            => $categoria,
            'imagen'                 => $Destino
        );

        $id = $this->Producto_model->insertProducto($data);

        foreach($lisingredientes as $ingrediente)
        {

            $dataingrediente = array(

                'idIngrediente'      => $ingrediente->idingrediente,
                'idProducto'         => $id,
                'cantIngrediente'    => $ingrediente->cantidad

            );

            $this->Producto_model->insertardetalleproducto($dataingrediente);
        }

        echo json_encode($id);

    }



    public function edit(){
        $lisingredientes = json_decode($_POST['ingredientes']);

        $idProducto = $this->input->post('idproducto');

        $ingredientesborrar = json_decode($_POST['ingredientesborrar']);

        if ($ingredientesborrar != NULL){
            foreach($ingredientesborrar as $ingrediente)
            {

                $this->Producto_model->deleteIngrediente($ingrediente->idingrediente, $idProducto);
            }
        }

        $ruta = './assets/img/productos/';

        $producto = $this->input->post('producto');
        $descripcion = $this->input->post('descripcion');
        $costo = $this->input->post('costo');
        $precio = $this->input->post('precio');
        $cantidad = $this->input->post('cantidad');
        $imagen = $_FILES['imagen']['name'];

        $imgcon = $this->input->post('imgcon');
        $categoria = $this->input->post('categoria');



       if ($imagen != NULL){
           $temporal = $_FILES['imagen']['tmp_name']; //Obtenemos la ruta Original del archivo
           $Destino = $ruta.$imagen;	//Creamos una ruta de destino con la variable ruta y el nombre original del archivo

           move_uploaded_file($temporal, $Destino); //Movemos el archivo temporal a la ruta especificada
       }else{
           $Destino = $imgcon;
       }

        $data = array(
            'producto'               => $producto,
            'descripcionProducto'    => $descripcion,
            'costoProducto'          => $costo,
            'precioProducto'         => $precio,
            'cantProducto'           => $cantidad,
            'idCategoria'            => $categoria,
            'imagen'                 => $Destino
        );

        $res = $this->Producto_model->edit_producto($idProducto, $data);

        foreach($lisingredientes as $item)
        {

            $dataingrediente = array(

                'idIngrediente'      => $item->idingrediente,
                'idProducto'         => $idProducto,
                'cantIngrediente'    => $item->cantidad

            );

            $this->Producto_model->insertardetalleproducto($dataingrediente);
        }


        echo json_encode($res);
    }

    public function delete($idProducto){
        $this->Producto_model->delete_producto($idProducto);
    }

    public function getListarTodos()
    {

        $data = $this->Producto_model->getListarTodos();

        echo json_encode($data);
    }

    public function getIngrediente()
    {
        $producto = $this->input->post('ingrediente');

        $data = $this->Producto_model->getIngredienteAjax($producto);

        if($data !== FALSE)
        {

            foreach($data as $fila)
            {
                ?>

<!--                <ul id="ingrediente" class="text-center" >-->
                    <div class="row ">
                        <div class="col-md-4">
                            <input id="txtingrediente" value="<?php echo $fila->ingrediente ?>" style="cursor: pointer; padding-top: 4px; padding-bottom: 4px;" class="list-group-item  eningrediente" data-id="<?php echo $fila->idIngrediente ?>" data-nombre="<?php echo $fila->ingrediente ?>" ></input>

                        </div>

                        <div class="col-md-4">
                            <span><input id="cantidadingrediente" type="number" required placeholder="Cantidad"></span>
                        </div>

                    </div>



<!--                </ul>-->


                <?php
            }

            //en otro caso decimos que no hay resultados
        }else{
            ?>

            <p><?php echo 'No hay resultados' ?></p>

            <?php
        }

    }

    public function getCountProducts()
    {
        $idcategoria = $this->input->post('id');
        $data = $this->Producto_model->countProductosCategoria( $idcategoria );

        echo json_encode($data);
    }



}