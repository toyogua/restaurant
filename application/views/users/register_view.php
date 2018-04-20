<?php $attributes = array('id' => 'register_form', 'class' => 'form_horizontal');?>

<?php echo validation_errors("<p class='bg-danger'>"); ?>

<?php echo form_open('users/register', $attributes);?>


    <!--Form with header-->
    <br><br><div class="card offset-3 col col-lg-6">
        <div class="card-block">

            <!--Header-->
            <div class="form-header blue-gradient">
                <h3><i class="fa fa-user"></i> Registrar Usuario:</h3>
            </div>

            <!--Body-->
            <div class="md-form">
                <i class="fa fa-user prefix"></i>
                <input type="text" id="nombres" name="nombres" class="form-control">
                <label for="form3">Ingresa tus nombres</label>
            </div>

            <div class="md-form">
                <i class="fa fa-user prefix"></i>
                <input type="text" id="apellidos" name="apellidos" class="form-control">
                <label for="form3">Ingresa tus apellidos</label>
            </div>

            <div class="md-form">
                <i class="fa fa-envelope prefix"></i>
                <input type="text" id="email" name="email" class="form-control">
                <label for="form2">Ingresa tu correo electronico</label>
            </div>

            <div class="md-form">
                <i class="fa fa-user prefix"></i>
                <input type="text" id="username" name="username" class="form-control">
                <label for="form3">Ingresa tu nombre de usuario</label>
            </div>

            <div class="md-form">
                <i class="fa fa-lock prefix"></i>
                <input type="password" id="password" name="password" class="form-control">
                <label for="form4">Ingresa tu contraseña</label>
            </div>

            <div class="md-form">
                <i class="fa fa-lock prefix"></i>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                <label for="form4">Confirma tu contraseña</label>
            </div>

            <div class="text-center">
                <button class="btn btn-indigo">Registrar</button>
            </div>

        </div>
    </div>
    <!--/Form with header-->


<?php form_close();?>
