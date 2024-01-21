<?php 
    /*Here we have the necessary code to show in the inputs the data of the 
    tournament to be update*/
    include_once '../db/torneo.php';

    if(isset($_GET['id'])){
        $torneo = new Torneo();
        $id = $_GET['id'];
        $data = $torneo->getTorneo($id);

        if($data !== null && !empty($data)){
?>
            <form class="form_participantes_add">
                <input type="hidden" value="<?= $data['idtorneo'] ?>" id="idtorneo">
                <div class="mb-3" id="cont_cuota_idSocio">
                    <div class="mb-3 l">
                        <label for="inputNomTorneo" class="form-label">Nombre del Torneo</label>
                        <input type="text" class="form-control" id="inputNomTorneo" value="<?= $data['nombre'] ?>" aria-describedby="emailHelp" placeholder="Agregue un nombre" name="inputNomTorneo">
                        <div id="emailHelp" class="form-text">Un nombre con fuerza.</div>
                    </div>
                    <div class="mb-3 l">
                        <label for="select_deporte" class="form-label">Deporte</label>
                        <select class="form-select" aria-label="Default select example" id="select_deporte">
                            <?php 
                                include_once '../../includes/db/torneo.php';
                                $torneo = new Torneo();
                                $sports = $torneo->getDeportes();

                                if($sports !== null && !empty($sports)){
                                    //Show all the sports...
                                    foreach ($sports as $sport) {
                                        // Present the options as select options...
                                        echo '<option ' . ($sport['iddeporte'] == $data['deporte'] ? 'selected' : '') . ' value="' . htmlspecialchars($sport['iddeporte']) . '">' . htmlspecialchars($sport['nombre']) . '</option>';
                                    }
                                } else{
                                    echo '<option value="0">No hay opciones</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3" id="cont_pago_equipo">
                    <div class="mb-3 l">
                        <label for="inputLimite" class="form-label">Limite</label>
                        <input type="number" class="form-control" id="inputLimite" value="<?= $data['limite'] ?>" aria-describedby="emailHelp" placeholder="100" name="inputLimite">
                        <div id="emailHelp" class="form-text">Numero maximo de participantes</div>
                    </div>
                    <div class="mb-3 l" id="cont_n_equipo">
                        <label for="inputFecha" class="form-label">Fecha de inicio</label>
                        <input type="datetime-local" class="form-control" id="inputFecha" value="<?= $data['fechainicio'] ?>" name="inputFecha" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3 l">
                        <label for="exampleInputPassword1" class="form-label">Instalaciones centro</label>
                        <select class="form-select" aria-label="Default select example" id="select_centro">
                        <?php 
                                include_once '../../includes/db/torneo.php';
                                $torneo = new Torneo();
                                $centros = $torneo->getCentro();

                                if($centros !== null && !empty($centros)){
                                    //Show all the sports...
                                    foreach ($centros as $centro) {
                                        // Present the options as select options...
                                        echo '<option ' . ($centro['idinstalacionesCentro'] == $data['instalacionesCentro'] ? 'selected' : '') . ' value="' . htmlspecialchars($centro['idinstalacionesCentro']) . '">' . htmlspecialchars($centro['nombre_centro']) . '</option>';
                                    }
                                } else{
                                    echo '<option value="0">No hay opciones</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3 cont_btns_participantes_form">
                    <button type="submit" class="btn btn-primary b" id="update_centro_btn">Editar</button>
                    <button class="btn btn-danger b" id="cancelar_centro_btn">Cancelar</button>
                </div>
            </form>
            <script>
                $(document).ready(function(){
                    /*here we have the necessary code to make the validation of all the
                    inputs of the add participant form...*/
                    const regularExpressions = {
                        onlyNumbers: /^\d+$/,
                        onlyLetters: /^[a-zA-Z]+(?: [a-zA-Z]+)*$/,
                        onlyDate: /^[dma0-9\/]*$/
                    }

                    const validator = (name, value, label) => {
                        switch(name){
                            case 'inputNomTorneo':
                                //this input can only accept letters...
                                if(regularExpressions.onlyLetters.test(value)){
                                    $(`#${name}`).removeClass('shake');
                                    label.text('Nombre del Torneo');
                                    label.removeClass('shakeLabel');
                                    $('#agregar_centro_btn').fadeIn();
                                } else{
                                    $(`#${name}`).addClass('shake');
                                    label.text('Solo letras');
                                    label.addClass('shakeLabel');
                                    $('#agregar_centro_btn').hide();
                                }
                            break;
                            case 'inputLimite': 
                                //this input can only accept letters...
                                if(regularExpressions.onlyNumbers.test(value)){
                                    $(`#${name}`).removeClass('shake');
                                    label.text('Limite');
                                    label.removeClass('shakeLabel');
                                    $('#agregar_centro_btn').fadeIn();
                                } else{
                                    $(`#${name}`).addClass('shake');
                                    label.text('Solo numeros');
                                    label.addClass('shakeLabel');
                                    $('#agregar_centro_btn').hide();
                                }
                            break;
                            default:
                                console.log('There is any problem');
                            break;
                        }
                    }
                    
                    $('form input').on('input', function(event){
                        //obtain the value of the input...
                        var inputValue = $(this).val();
                        //obtain the name of the input...
                        var inputName = $(this).attr('name');
                        //obtain the corresponding label of the input...
                        var labelForInput = $('form label[for="' + inputName + '"]');
                        //this function hleps up to make the validation of the corresponding input...
                        validator(inputName, inputValue, labelForInput);
                    });
                })
            </script>
<?php
        } else{
            ?>
            <div>Ha ocurrido un error</div>
            <?php
        }
    }
?>