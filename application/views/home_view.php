<h2 class="bg-danger">
    <?php if($this->session->flashdata('login_failed')): ?>
        <?php echo($this->session->flashdata('login_failed')); ?>
    <?php endif; ?>

    <?php if($this->session->flashdata('no_access')): ?>
        <?php echo($this->session->flashdata('no_access')); ?>
    <?php endif; ?>
</h2>

<h2 align="center" class="bg-success">
    <?php if($this->session->flashdata('login_success')): ?>
        <?php echo($this->session->flashdata('login_success')); ?>
    <?php endif; ?>
</h2>

<h2 align="center" class="bg-success">
    <?php if($this->session->flashdata('reset_pass')): ?>
        <?php echo($this->session->flashdata('reset_pass')); ?>
    <?php endif; ?>
</h2>

<?php if ($this->session->userdata('logged_admin')):?>


<?php endif; ?>