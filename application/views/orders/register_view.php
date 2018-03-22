
<div class="row">
    <div  class="col-lg-6">
        <h6><strong>Seleccionar Mesero:</strong></h6>
        <?php if(isset($meseros_data)): ?>
            <div class="btn-group mr-4" data-toggle="buttons">
                <?php foreach($meseros_data as $mesero): ?>
                    <label style="cursor: pointer;" class="btn orange btn-sm accent-2 mesero" data-id="<?php echo $mesero->idEmpleado;?>" data-nombre="<?php echo $mesero->nombresEmpleado;?>">
                        <input type="checkbox" autocomplete="off"> <?php echo $mesero->nombresEmpleado ?>
                    </label>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No se encontraron meseros registrados!</p>
        <?php endif; ?>
    </div>

    <div class="col-lg-6">
        <h6><strong>Seleccionar Mesa:</strong></h6>
        <?php if(isset($meseros_data)): ?>
            <div class="btn-group mr-4" data-toggle="buttons">
                <?php foreach($mesas_data as $mesa): ?>
                    <label style="cursor: pointer;" class="btn btn-danger btn-sm mesa" data-id="<?php echo $mesa->idMesa;?>" data-nombre="<?php echo $mesa->noMesa;?>" >
                        <input type="checkbox" autocomplete="off"> <?php echo $mesa->noMesa ?>
                    </label>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No se encontraron mesas registrados!</p>
        <?php endif; ?>
    </div>
</div><br>



<div class="row">

    <div class="col-lg-2 jumbotron" id="categorias" align="center">
        <h2>Categorias</h2>
        <hr>

        <div>
            <button id="btnBebida" style="cursor: pointer; margin-bottom: 10px;" type="button" class="btn success-color accent-2 btn-lg btn-block"> Bebidas </button>

        </div>
        <div id="contenedorBebida">
            <?php foreach($categorias_bebida as $bebida): ?>
                <button style="cursor: pointer;" type="button" class="btn orange accent-2 btn-lg btn-block btnCategorias" data-id="<?php echo $bebida->idCategoria;?>" data-categoria="<?php echo $bebida->categoria;?>"><?php echo $bebida->categoria ?></button>
            <?php endforeach; ?>
        </div>
        <div>
            <button  id="btnComida" style="cursor: pointer; margin-top: 10px; margin-bottom: 10px;" type="button" class="btn success-color accent-2 btn-lg btn-block"> Comida </button>
        </div>
        <div id="contenedorComida">
            <?php foreach($categorias_comida as $comida): ?>
                <button style="cursor: pointer;" type="button" class="btn orange accent-2 btn-lg btn-block btnCategorias" data-id="<?php echo $comida->idCategoria;?>" data-categoria="<?php echo $comida->categoria;?>"><?php echo $comida->categoria ?></button>
            <?php endforeach; ?>
        </div>
        <div>

        </div>

    </div>

    <div class="col-lg-7 jumbotron" id="menu" align="center">

        <h3>Menú</h3>

            <span id="opsiguiente" title="Siguiente" style="float: right; cursor:pointer; " class="fa fa-chevron-circle-right fa-2x  "></span>
            <span  id="opanterior" title="Anterior" style="float: left; cursor:pointer; " class="fa fa-chevron-circle-left fa-2x"></span>

        <br>



        <hr>
        <div id="contenedor_productos">

        </div>
    </div>

    <div class="col-lg-3 jumbotron" id="orden" align="center">
        <h2>Orden</h2>
        <hr>
        <div id="contenedor_total"></div>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td style="width: 5%">Cant</td>
                <td>Producto</td>
                <td>Notas</td>
            </tr>
            </thead>

            <tbody id="tblRegistros">

            </tbody>
        </table>

        <div id="contenedor_productos_orden"></div>
        <br>
        <div id="btn_ordenar"></div>
    </div>
</div>

<div class="modal fade" data-backdrop="static" data-keyboard="false"  id="mCapturaMeseroMesa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <!--Modal: Contact form-->
    <div class="modal-dialog cascading-modal" role="document">

        <!--Content-->
        <div class="modal-content">

            <!--Header-->
            <div class="modal-header brown darken-2 white-text">
                <h4 class="title">
                    <i class="fa fa-pencil "></i>Selecciona Mesero y Mesa</h4>
            </div>
            <!--Body-->
            <div class="modal-body">
                <div class="row">
                <!-- Material input name -->
                <div style="margin-right: 145px;" class="col-md-4 md-form form-sm">
                    <!-- Split button -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger">Meseros</button>
                        <button style="cursor: pointer;" type="button" class="btn btn-danger dropdown-toggle px-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <?php foreach($meseros_data as $mesero): ?>
                                <a class="dropdown-item mesero" data-id="<?php echo $mesero->idEmpleado; ?>" data-nombre="<?php echo $mesero->nombresEmpleado; ?>" href="#"><?php echo $mesero->nombresEmpleado;?></a>

                            <?php endforeach; ?>

                        </div>
                    </div>
                    <div class="md-form"><label id="divInformaMeseroSeleccionado"></label></div>
                </div>

                <!-- Material input email -->
                <div class="col-md-4 md-form form-sm">
                    <!-- Split button -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger">Mesas</button>
                        <button style="cursor: pointer;" type="button" class="btn btn-danger dropdown-toggle px-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <?php foreach($mesas_data as $mesa): ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="dropdown-item mesa" data-id="<?php echo $mesa->idMesa; ?>" data-nombre="<?php echo $mesa->noMesa; ?>" href="#"> <?php echo $mesa->noMesa;?></a>
                                </div>
                                <div class="col-md-6">
                                    <input class="txtAliasMesa" type="text">
                                </div>
                            </div>



                            <?php endforeach; ?>

                        </div>
                    </div>
                    <div class="md-form"><label id="divInformaMesaSeleccionada" ></label></div>
                </div>
<!--                    fin row-->
                </div>


                <div class="text-center mt-4 mb-2">
                    <button style="cursor: pointer;" id="btnEntrarEmpleado" class="btn success-color accent-2" >Listo
                        <i class="fa fa-send ml-2"></i>
                    </button>

                </div>
        </div>
        <!--/.Content-->
    </div>
    <!--/Modal: Contact form-->
</div>
