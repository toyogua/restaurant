<!--Pagination -->
<div class="col-md-4">

    <ul class="pagination pagination-circle pg-blue ">

        <!--First-->
        <li class="page-item "><a class="page-link" href="<?php echo base_url().$miurl.$porpagina;?>/<?php echo $res = generador( 0, $porpagina ); ?>">Primera</a></li>

        <!--Arrow left-->
        <li class="page-item ">
            <?php $paginaactual = 0; ?>
            <?php  ( $this->uri->segment(4) == 0)? $paginaactual = 0 : $paginaactual = $this->uri->segment(4) - $porpagina; ?>
            <a title="Anterior" href="<?php echo base_url().$miurl.$porpagina;?>/<?php echo $paginaactual; ?>" class="page-link" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Anterior</span>
            </a>

        </li>
        <?php for ($i = 0; $i <$paginas; $i++): ?>

            <!--Numbers-->
            <li class="page-item active"><a class="page-link" href="<?php echo base_url().$miurl.$porpagina;?>/<?php echo $res = generador( $i, $porpagina ); ?>"><?php echo $i + 1; ?></a></li>

        <?php endfor; ?>
        <?php if( $this->uri->segment(4) != $res): ?>
            <!--Arrow right-->
            <li class="page-item">
                <?php  ( $this->uri->segment(4) == 0)? $paginaactual = $this->uri->segment(4) + $porpagina : $paginaactual = $this->uri->segment(4) + $porpagina; ?>

                <a title="Siguiente" href="<?php echo base_url().$miurl.$porpagina;?>/<?php echo $paginaactual; ?>" class="page-link" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Siguiente</span>
                </a>
            </li>
        <?php endif; ?>

        <!--Last-->
        <li class="page-item"><a href="<?php echo base_url().$miurl.$porpagina;?>/<?php echo $res; ?>" class="page-link">Última</a></li>

    </ul>

</div>
<!--END Pagination -->