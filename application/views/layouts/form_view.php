<div  class="col-md-3">
    <div id="iconorefrescar" style="float: right; margin-right: 100px;"><a  href="<?php echo base_url().$controlador.$metodo; ?>"><i title="Limpiar" style="cursor: pointer" class="fa fa-refresh fa-2x text-primary"></i></a></div>
    <form  class="form-inline my-2 my-lg-0 ml-auto">
        <input data-metodo="<?php echo $metodo; ?>" data-controlador="<?php echo $controlador; ?>" data-buscador="<?php echo $buscador; ?>" data-campo="<?php echo $campo; ?>"  data-tabla="<?php echo $tabla; ?>" style="margin-bottom: 0" id="txtbuscador" class="form-control" type="search" placeholder="<?php echo $placeholder; ?>" aria-label="Search">
    </form>
    <p style="padding-top: 0" id="resultados">

    <p/>
</div>