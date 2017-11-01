<?php $attributes = array('id' => 'login_form', 'class' => 'form_horizontal');?>

<?php if($this->session->flashdata('errors')): ?>

    <?php echo $this->session->flashdata('errors'); ?>

<?php endif; ?>


<?php echo form_open('users/login', $attributes);?>

<!--Form with header-->
<div class="col col-lg-4">
    <div class="card">
        <div class="card-block">

            <div class="col col-lg-3">

            </div>
            <!--Header-->
            <div class="form-header  blue">
                <h3><i class="fa fa-lock"></i> Ingresar al Sistema:</h3>
            </div>

            <!--Body-->
            <div class="md-form">
                <i class="fa fa-user prefix"></i>
                <input type="text" name="username" id="username" class="form-control">
                <label for="form2">Ingresa tu usuario</label>
            </div>

            <div class="md-form">
                <i class="fa fa-lock prefix"></i>
                <input type="password" name="password" id="password" class="form-control">
                <label for="form4">Ingresa tu contraseña</label>
            </div>

            <div class="text-center">
                <button class="btn btn-primary" name="submit" id="submit">ENTRAR</button>
            </div>

        </div>

        <!--Footer-->
        <!--    <div class="modal-footer">-->
        <!--        <div class="options">-->
        <!--            <p>Not a member? <a href="#">Sign Up</a></p>-->
        <!--            <p>Forgot <a href="#">Password?</a></p>-->
        <!--        </div>-->
        <!--    </div>-->

    </div>
    <!--/Form with header-->
</div>

<?php form_close();?>

