<div class="offset-3 col-5 col-lg-6">

    <?php $attributes = array('id' => 'updatepass_form', 'class' => 'form_horizontal'); ?>

    <?php echo validation_errors("<p class='bg-danger'>"); ?>

    <?php echo form_open('users/update_pass', $attributes); ?>

    <br>
    <div class="card">
        <div class="card-block">
            <!--Header-->
            <br><div class="form-header  blue">
                <h3><i class="fa fa-lock"></i> CAMBIO DE CONTRASEÑA</h3>
            </div>
            <div class="col col-lg-12">
                <h6 style="font-weight: bold;">Nueva Contraseña</h6>
                <?php

                $data = array(

                    'class'         => 'form-control',
                    'name'          => 'nuevapass',
                    'placeholder'   => 'Ingrese la nueva contraseña',
                    'value'         => set_value('nuevapass')
                );

                ?>
                <?php echo form_password($data); ?>
            </div><br>

            <div align="center" class="col-lg-12">
                <?php

                $data = array(

                    'class'         => 'btn btn-primary',
                    'name'          => 'submit',
                    'value'         => 'MODIFICAR'

                );

                ?>

                <?php echo form_submit($data); ?>
            </div>
        </div><br><br>
    </div>
</div>
