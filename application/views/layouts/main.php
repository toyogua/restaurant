<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurante</title>

    <!-- JQuery -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-3.1.1.min.js"></script>

    <script src="<?php echo base_url();?>assets/js/orden.js"></script>
    <script src="<?php echo base_url();?>assets/js/categoria.js"></script>
    <script src="<?php echo base_url();?>assets/js/ingrediente.js"></script>
    <script src="<?php echo base_url();?>assets/js/producto.js"></script>
    <script src="<?php echo base_url();?>assets/js/crudCategorias.js"></script>
    <script src="<?php echo base_url();?>assets/js/crudEmpleados.js"></script>
    <script src="<?php echo base_url();?>assets/js/crudMesas.js"></script>
    <script src="<?php echo base_url();?>assets/js/ventas.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/formAnimado.js"></script>
    <script src="<?php echo base_url();?>assets/js/TweenLite.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/TweenMax.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/permisos.js"></script>


    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/tether.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/alertify.min.js"></script>

    <!-- Font Awesome -->
    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">-->

    <link href="<?php echo base_url();?>assets/css/datatables.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/jquery-ui.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/stilosFormAnimado.css" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="<?php echo base_url();?>assets/css/mdb.min.css" rel="stylesheet">

    <!-- Your custom styles (optional) -->
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/sweetalert.css">

    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/alertify.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/themes/default.min.css" />



</head>

<body>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/mdb.min.js"></script>
<div class="container col-lg-12">

    <?php  if ($this->session->userdata("idempleado")):?>

        <nav class="navbar navbar-toggleable-md  navbar-dark brown darken-2">
        <div class="container">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#collapseEx12" aria-controls="collapseEx2" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">CAFÉ Y RESTAURANTE</a>
            <div class="collapse navbar-collapse" id="collapseEx12">
                <ul class="navbar-nav mr-auto">
                    <?php if( $res= obtenerPermisos($this->session->userdata('idempleado'), "Ordenes", "Ordenar")): ?>
                    <li class="nav-item btn-group">
                        <a class="nav-link" href="<?php echo base_url();?>orders">Ordenar</a>
                    </li>
                    <?php endif;?>
                    <?php if( $res= obtenerPermisos($this->session->userdata('idempleado'), "Ordenes", "Mostrar")): ?>
                    <li class="nav-item btn-group">
                        <a class="nav-link" href="<?php echo base_url();?>orders/display">Ordenes</a>
                    </li>
                    <?php endif;?>
                    <?php if( $res= obtenerPermisos($this->session->userdata('idempleado'), "Empleados", "Mostrar")): ?>
                    <li class="nav-item btn-group">
                        <a class="nav-link" href="<?php echo base_url(); ?>users/display">Empleados</a>
                    </li>
                    <?php endif;?>
                    <?php if( $res= obtenerPermisos($this->session->userdata('idempleado'), "Mesas", "Mostrar")): ?>
                    <li class="nav-item btn-group">
                        <a class="nav-link" href="<?php echo base_url();?>mesas/listar">Mesas</a>
                    </li>
                    <?php endif;?>
                    <?php if( $res= obtenerPermisos($this->session->userdata('idempleado'), "Menu", "Mostrar")): ?>
                    <li class="nav-item btn-group">
                        <a class="nav-link dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menu</a>
                        <div class="dropdown-menu dropdown-primary" aria-labelledby="dropdownMenu1">
                            <?php if( $res= obtenerPermisos($this->session->userdata('idempleado'), "Ingredientes", "Mostrar")): ?>
                            <a class="dropdown-item" href="<?php echo base_url(); ?>ingredientes/display">Ingredientes</a>
                            <?endif; ?>
                            <?php if( $res= obtenerPermisos($this->session->userdata('idempleado'), "Productos", "Mostrar")): ?>
                            <a class="dropdown-item" href="<?php echo base_url(); ?>Products/display">Productos</a>
                            <?endif;?>
                            <?php if( $res= obtenerPermisos($this->session->userdata('idempleado'), "Categorias", "Mostrar")): ?>
                            <a class="dropdown-item" href="<?php echo base_url(); ?>Categorias/listarCategorias">Subcategorías</a>
                            <?endif;?>
                        </div>
                    </li>
                    <?php endif;?>
                    <?php if( $res= obtenerPermisos($this->session->userdata('idempleado'), "Ventas", "Mostrar")): ?>
                    <li class="nav-item btn-group">
                        <a class="nav-link" href="<?php echo base_url();?>ventas">Caja</a>
                    </li>
                    <?endif;?>
                    <?php if( $res= obtenerPermisos($this->session->userdata('idempleado'), "Permisos", "Mostrar")): ?>
                    <li class="nav-item btn-group">
                        <a class="nav-link" href="<?php echo base_url();?>permisos">Permisos</a>
                    </li>
                    <?endif;?>
                    <?php  if ($this->session->userdata("idempleado")):?>
                    <li class="nav-item btn-group navbar-toggler-right">
                        <a class="nav-link dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Usuario</a>
                        <div class="dropdown-menu dropdown-primary" aria-labelledby="dropdownMenu1">
                            <a class="dropdown-item" href="<?php echo base_url(); ?>">Perfil</a>
                            <a class="dropdown-item" href="<?php echo base_url(); ?>">Cambiar clave</a>
                            <a class="dropdown-item" href="<?php echo base_url(); ?>users/logout">Salir</a>
                        </div>
                    </li>
                    <?php endif;?>
                </ul>

           </div>
        </div>
    </nav>
    <br><div class="col col-lg-12">
        <?php $this->load->view($main_view); ?>
    </div>


    <?php else: ?>
        <br>
        <br>
        <br><div  class="col-md-12">
            <?php $this->load->view($main_view); ?>
        </div>


        <div class="col-md-12">
            <?php $this->load->view('users/login_view'); ?>
        </div>

    <?php endif; ?>
</div>


</body>
</html>