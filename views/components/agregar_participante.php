<div class="cont_form_add_participantes">
    <form class="form_participantes_add">
        <div class="mb-3" id="cont_cuota_idSocio">
            <div class="mb-3 l">
                <label for="exampleInputEmail1" class="form-label">Id Socio</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Nombre: </div>
            </div>
            <div class="mb-3 l">
                <label for="exampleInputEmail1" class="form-label">Cuota</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
        </div>

        <div class="mb-3" id="cont_pago_equipo">
            <div class="mb-3 l">
                <label for="exampleInputEmail1" class="form-label">Estatus de pago</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>None</option>
                    <option value="1">1</option>
                    <option value="2">0</option>
                </select>
            </div>
            <div class="mb-3 l">
                <!--TODO: realizar el auto completado-->
                <label for="exampleInputEmail1" class="form-label">Nombre del equipo</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
        </div>
        <!--TODO: continuar con los demás campos-->
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>