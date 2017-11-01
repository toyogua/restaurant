<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restuarante</title>

    <!-- JQuery -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-2.2.3.min.js"></script>

    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/tether.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>


    <!-- Font Awesome -->
    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">-->

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="<?php echo base_url();?>assets/css/mdb.min.css" rel="stylesheet">

    <!-- Your custom styles (optional) -->
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css">


</head>

<body>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/mdb.min.js"></script>
<div class="container col-lg-12">

    <!--    --><?php //if ($this->session->userdata('logged_admin')):?>

    <nav class="navbar navbar-toggleable-md  navbar-dark brown darken-2">
        <div class="container">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#collapseEx12" aria-controls="collapseEx2" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">HABITAT</a>
            <div class="collapse navbar-collapse" id="collapseEx12">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo base_url(); ?>">Usuarios <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item btn-group">
                        <a class="nav-link" href="<?php echo base_url();?>">Categorias</a>
                    </li>
                    <li class="nav-item btn-group">
                        <a class="nav-link" href="<?php echo base_url();?>">Mesas</a>
                    </li>
                    <li class="nav-item btn-group">
                        <a class="nav-link dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menu</a>
                        <div class="dropdown-menu dropdown-primary" aria-labelledby="dropdownMenu1">
                            <a class="dropdown-item" href="<?php echo base_url(); ?>">Ingredientes</a>
                            <a class="dropdown-item" href="<?php echo base_url(); ?>">Productos</a>
                        </div>
                    </li>
                    <li class="nav-item btn-group">
                        <a class="nav-link" href="<?php echo base_url();?>">Ordenes</a>
                    </li>
                    <li class="nav-item btn-group">
                        <a class="nav-link" href="<?php echo base_url();?>">Caja</a>
                    </li>

                    <li class="nav-item btn-group navbar-toggler-right">
                        <a class="nav-link dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Usuario</a>
                        <div class="dropdown-menu dropdown-primary" aria-labelledby="dropdownMenu1">
                            <a class="dropdown-item" href="<?php echo base_url(); ?>">Perfil</a>
                            <a class="dropdown-item" href="<?php echo base_url(); ?>">Cambiar clave</a>
                            <a class="dropdown-item" href="<?php echo base_url(); ?>">Salir</a>
                        </div>
                    </li>
                </ul>




            </div>
        </div>
    </nav>
    <br><div class="col col-lg-12">
        <?php $this->load->view($main_view); ?>
    </div>
</div>
</body>
</html>