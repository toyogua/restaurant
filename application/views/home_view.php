
<h2 class="text-danger text-center">
    <?php if($this->session->flashdata('login_failed')): ?>
        <?php echo($this->session->flashdata('login_failed')); ?>
    <?php endif; ?>

    <?php if($this->session->flashdata('no_access')): ?>
        <?php echo($this->session->flashdata('no_access')); ?>
    <?php endif; ?>

    <?php if($this->session->flashdata('denegado')): ?>
        <?php echo($this->session->flashdata('denegado')); ?>
    <?php endif; ?>
</h2>


<h2 class="text-success text-center">
    <?php if($this->session->flashdata('login_success')): ?>
        <?php echo($this->session->flashdata('login_success')); ?>
    <?php endif; ?>
</h2>

<h2 class="text-success text-center">
    <?php if($this->session->flashdata('reset_pass')): ?>
        <?php echo($this->session->flashdata('reset_pass')); ?>
    <?php endif; ?>
</h2>


<?php //if ($this->session->userdata('logged_admin')):?>
<!---->
<!---->
<?php //endif; ?>