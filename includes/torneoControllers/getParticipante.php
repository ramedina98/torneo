<?php 
    /*This is the code necessary to obtain the information of a participant...*/
    include_once '../db/torneo.php';

    if(isset($_GET['id'])){
        $torneo = new Torneo();
        $id = $_GET['id'];
        $response = $torneo->getParticipante($id);

        if ($response !== null && !empty($response)) {
        ?>
            <form class="form_participantes_add">
                <input type="hidden" value="<?= $response['idinscritoTorneo'] ?>" id="idstorneo">
                <div class="mb-3" id="cont_cuota_idSocio">
                    <div class="mb-3 l">
                        <label for="inputSocio" class="form-label">Id Socio</label>
                        <input type="text" class="form-control" id="inputSocio" name="inputSocio" aria-describedby="emailHelp" value="<?= $response['socio'] ?>" placeholder="Agregue el numero de socio">
                        <div id="emailHelp" class="form-text">Nombre: <span id="showName_span"></span> </div>
                    </div>
                    <div class="mb-3 l">
                        <label for="inputCuota" class="form-label">Cuota</label>
                        <input type="text" class="form-control" id="inputCuota" name="inputCuota" aria-describedby="emailHelp" value="<?= $response['cuota'] ?>" placeholder="Agregue pago">
                    </div>
                </div>

                <div class="mb-3" id="cont_pago_equipo">
                    <div class="mb-3 l">
                        <label for="exampleInputEmail1" class="form-label">Estatus de pago</label>
                        <select class="form-select" aria-label="Default select example" id="select_Es_pago">
                            <option <?= $response['statusPago'] == 1 ? 'selected' : '' ?> value="1">1</option>
                            <option <?= $response['statusPago'] == 0 ? 'selected' : '' ?> value="0">0</option>
                        </select>
                        <div id="emailHelp" class="form-text">0 = saldado / 1 = pendiente </div>
                    </div>
                    <div class="mb-3 l" id="cont_n_equipo">
                        <label for="nombreEquipo" class="form-label">Nombre del equipo</label>
                        <input type="text" class="form-control" id="nombreEquipo" name="nombreEquipo" maxlength="50" aria-describedby="emailHelp" value="<?= $response['nombreEquipo'] ?>" placeholder="Agregue el nombre del equipo">
                        <!-- This div will contain all the suggestions (team name) -->
                        <div id="sugerencias"></div>
                    </div>

                    <div class="mb-3 l">
                        <label for="exampleInputPassword1" class="form-label">Torneo</label>
                        <select class="form-select" aria-label="Default select example" id="select_torneo">
                            <?php 
                                // * This code is to get all the tournament options that are available...
                                include_once '../../includes/db/torneo.php';
                                $torneo = new Torneo();

                                // Get all the data from the corresponding table...
                                $data = $torneo->getTorneos();

                                // Check if the input parameter was received...
                                if ($data !== null) {
                                    // Show the suggestions as HTML elements...
                                    foreach ($data as $dTorneo) {
                                        // Present the options as select options...
                                        echo '<option ' . ($response['torneo'] == $dTorneo['idtorneo'] ? 'selected' : '') . ' value="' . htmlspecialchars($dTorneo['idtorneo']) . '">' . htmlspecialchars($dTorneo['nombre_torneo']) . '</option>';
                                    }
                                } else {
                                    echo '<option value="0">No hay torneos</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3 cont_btns_participantes_form">
                    <button type="submit" class="btn btn-primary b" id="agregar_participantes_btn">Editar</button>
                    <button type="button" class="btn btn-danger b" id="cancelar_participante_btn">Cancelar</button>
                </div>
            </form>
            <script>
                $(document).ready(function(){
                    /*here we handle the partner verification with the partnet id,
                    in the input partnet id...*/
                    $('#inputSocio').on('input', function(){
                        //we chached the id...
                        var id = $(this).val();

                        //AJAX request...
                        $.ajax({
                            type: 'POST',
                            url: 'includes/torneoControllers/idExistente.php',
                            data: {id: id},
                            success: function(response){
                                if(id !== ''){
                                    //show the info...
                                    $('#showName_span').html(response).show();
                                } else{
                                    $('#showName_span').hide();
                                }
                            }
                        })
                    });

                    //handle input "nombre equipo"...
                    $('#nombreEquipo').on('input', function(){
                        var inputText = $(this).val();

                        //AJAX request...
                        $.ajax({
                            type: 'POST',
                            url: 'includes/torneoControllers/suggestions_team_names.php',
                            data: {inputText: inputText},
                            success: function(response){
                                if(inputText !== ''){
                                    //show the suggestions...
                                    $('#sugerencias').html(response).show();
                                } else{
                                    $('#sugerencuas').hide();
                                }
                            }
                        })
                    }); 

                    //handle click on a suggestion...
                    $('#sugerencias').on('click', '.sugerencia_item', function(){
                        // place the value of the suggestion in the input field...
                        $('#nombreEquipo').val($(this).text());

                        // hide the suggestions...
                        $('#sugerencias').hide();
                    });

                    /*here we have the necessary code to make the validation of all the
                    inputs of the add participant form...*/
                    const regularExpressions = {
                        onlyNumbers: /^\d+$/,
                        onlyLetters: /^[a-zA-Z]+(?: [a-zA-Z]+)*$/
                    }

                    const validator = (name, value, label) => {
                        switch(name){
                            case 'inputSocio':
                                //this input can only accept numbers...
                                if(regularExpressions.onlyNumbers.test(value)){
                                    $(`#${name}`).removeClass('shake');
                                    label.text('Id Socio');
                                    label.removeClass('shakeLabel');
                                    $('#agregar_participantes_btn').fadeIn();
                                } else{
                                    $(`#${name}`).addClass('shake');
                                    label.text('Solo numeros');
                                    label.addClass('shakeLabel');
                                    $('#agregar_participantes_btn').hide();
                                }
                            break;
                            case 'inputCuota':
                                //this input can only accept numbers...
                                if(regularExpressions.onlyNumbers.test(value)){
                                    $(`#${name}`).removeClass('shake');
                                    label.text('Cuota');
                                    label.removeClass('shakeLabel');
                                    $('#agregar_participantes_btn').fadeIn();
                                } else{
                                    $(`#${name}`).addClass('shake');
                                    label.text('Solo numeros');
                                    label.addClass('shakeLabel');
                                    $('#agregar_participantes_btn').hide();
                                }
                            break;
                            case 'nombreEquipo':
                                //this input can only accept letters...
                                if(regularExpressions.onlyLetters.test(value)){
                                    $(`#${name}`).removeClass('shake');
                                    label.text('Nombre del equipo');
                                    label.removeClass('shakeLabel');
                                    $('#agregar_participantes_btn').fadeIn();
                                } else{
                                    $(`#${name}`).addClass('shake');
                                    label.text('Solo letras');
                                    label.addClass('shakeLabel');
                                    $('#agregar_participantes_btn').hide();
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
        } else {
        ?>
            <div class="modal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Error</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Ha ocurrido un error, posiblemente en la solicitud a la base de datos</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                    </div>
                </div>
            </div>
        <?php
        }
    } else{
        echo 'Error';
    }
?>