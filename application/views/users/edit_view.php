<?php $attributes = array('id' => 'register_form', 'class' => 'form_horizontal');?>

<?php echo validation_errors("<p class='bg-danger'>"); ?>

<?php echo form_open('users/edit/'.$user_data->id.'', $attributes);?>


<!--Form with header-->
<br><br><div class="card offset-3 col col-lg-6">
    <div class="card-block">

        <!--Header-->
        <div class="form-header blue-gradient">
            <h3><i class="fa fa-user"></i> Editar Usuario:</h3>
        </div>

        <div class="col col-xs-3">
            <?php echo form_label('NOMBRES'); ?>
            <?php

            $data = array(

                'class'         => 'form-control',
                'name'          => 'nombres',
                'value'         => $user_data->nombres

            );

            ?>
            <?php echo form_input($data); ?>
        </div>

        <div class="col col-xs-3">

            <?php echo form_label('APELLIDOS'); ?>

            <?php

            $data = array(

                'class'         => 'form-control',
                'name'          => 'apellidos',
                'value'         => $user_data->apellidos

            );

            ?>

            <?php echo form_input($data); ?>
        </div>

        <div class="col col-xs-3">

            <?php echo form_label('NOMBRE DE USUARIO'); ?>

            <?php

            $data = array(

                'class'         => 'form-control',
                'name'          => 'username',
                'value'         => $user_data->username

            );

            ?>

            <?php echo form_input($data); ?>
        </div>

        <div class="col col-xs-3">

            <?php echo form_label('CORREO ELECTRONICO'); ?>

            <?php

            $data = array(

                'class'         => 'form-control',
                'name'          => 'email',
                'value'         => $user_data->email

            );

            ?>

            <?php echo form_input($data); ?>
        </div>

        <div class="text-center">
            <button class="btn btn-indigo">Editar</button>
        </div>

    </div>
</div>
<!--/Form with header-->


<?php form_close();?>
