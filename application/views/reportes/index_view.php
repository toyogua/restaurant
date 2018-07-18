    <h1 style="padding-top: 5px; text-align: center;">Reporte de Ventas</h1>
    <hr>

    <form id="formReVentas" method="post" action="reportes/listar">


    <div class="row offset-3">
        <div class=" col-md-2">
            <input name="radio" value="1" type="radio" class="form-check-input" id="materialUnchecked" name="rdIntervalo">
            <label class="form-check-label" for="materialUnchecked">Intervalo Fijo</label>
        </div>



        <div class="btn-group col-md-3">
            <select name="intervalo"class="custom-select dropdown-toggle">
                <option class="dropdown-item" value="1" href="#">Hoy</option>
                <option class="dropdown-item" value="2" href="#">Ayer</option>
                <option class="dropdown-item" value="3" href="#">Esta semana</option>
                <option class="dropdown-item" value="4" href="#">La semana pasada</option>
                <option class="dropdown-item" value="5" href="#">Este mes</option>
                <option class="dropdown-item" value="6" href="#">Mes pasado</option>
                <option class="dropdown-item" value="7" href="#">Este año</option>
                <option class="dropdown-item" value="8" href="#">Año pasado</option>
            </select>
        </div>
    </div>
    <hr>
    <div class="row offset-3">
        <div class="col-md-2">
            <input name="radio" value="2" type="radio" class="form-check-input" id="materialUnchecked" name="rdIntervalo">
            <label class="form-check-label" for="materialUnchecked">Rango personalizado</label>
        </div>

        <!-- Grid column -->
        <div class="col-md-3">
            <!-- Default input -->
            <label class="sr-only" for="inlineFormInputGroup">Desde</label>
            <div class="input-group mb-2">
                <div class="input-group-addon">
                    <div class="input-group">Desde</div>
                </div>
                <input name="txtFInicial" type="date" class="form-control py-0" id="inlineFormInputGroup">
            </div>
        </div>
        <!-- Grid column -->

        <div class="col-md-3">
            <!-- Default input -->
            <label class="sr-only" for="inlineFormInputGroup">Hasta</label>
            <div class="input-group mb-2">
                <div class="input-group-addon">
                    <div class="input-group">Hasta</div>
                </div>
                <input name="txtFFinal" type="date" class="form-control py-0" id="inlineFormInputGroup">
            </div>
        </div>
        <!-- Grid column -->

    </div>
    <div class="col-md-2 offset-3">
        <input type="submit" style="cursor: pointer" id="btnReporteVentas" value="Ver Reporte" class="btn btn-primary">
    </div>

    </form>