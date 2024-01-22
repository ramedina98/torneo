<div class="cont_form_add_participantes">

    <div class="cont_btn_regresar">
        <a href="#participantes" class="btn btn-light">Regresar</a>
    </div>

    <form class="form_participantes_add">
        <div class="mb-3" id="cont_cuota_idSocio">
            <div class="mb-3 l">
                <label for="inputSocio" class="form-label">Id Socio</label>
                <input type="text" class="form-control" id="inputSocio" aria-describedby="emailHelp" placeholder="Agregue el numero de socio" name="inputSocio">
                <div id="emailHelp" class="form-text">Nombre: <span id="showName_span"></span> </div>
            </div>
            <div class="mb-3 l">
                <label for="exampleInputPassword1" class="form-label">Torneo</label>
                <select class="form-select" aria-label="Default select example" id="select_torneo">
                    <?php 
                        //*this code is to get all the tournament options that are avilable...
                        include_once '../../includes/db/torneo.php';
                        $torneo = new Torneo();

                        // Get all the data from the corresponding table...
                        $data = $torneo->getTorneos();

                        // Check if the input parameter was received...
                        if ($data !== null) {
                            
                            // Show the suggestions as HTML elements...
                            foreach ($data as $dTorneo) {
                                $limite = $dTorneo['limite'];
                                $inscritos = $dTorneo['inscritos'];
                                
                                //if there is still space, we still let people sign up for this tournament...
                                if($limite !== $inscritos){
                                    // Present the options as select options...
                                    echo '<option value="' . htmlspecialchars($dTorneo['idtorneo']) . '">' . htmlspecialchars($dTorneo['nombre_torneo']) . ' - $' . htmlspecialchars($dTorneo['precio']) . '</option>';
                                }
                            }
                        } else{
                            echo '<option value="0">No hay torneos</option>';
                        }
                    ?>
                </select>
                <div id="emailHelp" class="form-text">Datos del torneo: nombre y precio.</div>
            </div>
        </div>

        <div class="mb-3" id="cont_pago_equipo">
            <div class="mb-3 l">
                <label for="inputCuota" class="form-label">Cuota</label>
                <input type="text" class="form-control" id="inputCuota" aria-describedby="emailHelp" placeholder="Agregue paga" name="inputCuota">
            </div>
            <div class="mb-3 l">
                <label for="exampleInputEmail1" class="form-label">Estatus de pago</label>
                <select class="form-select" aria-label="Default select example" id="select_Es_pago">
                    <option selected>None</option>
                    <option value="1">1</option>
                    <option value="0">0</option>
                </select>
                <div id="emailHelp" class="form-text">0 = saldado / 1 = pendiente </div>
            </div>
            <div class="mb-3 l" id="cont_n_equipo">
                <label for="nombreEquipo" class="form-label">Nombre del equipo</label>
                <input type="text" class="form-control" id="nombreEquipo" maxlength="50 " name="nombreEquipo" aria-describedby="emailHelp" placeholder="Agregue el nombre del equipo">
                <!--this div will contain all the suggestions (team name)-->
                <div id="sugerencias"></div>
            </div>

            <div class="mb-3 l" id="cont_n_equipo">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" pattern=".+@example\.com" size="30" required class="form-control" id="email" maxlength="50" name="email" aria-describedby="emailHelp" placeholder="Agregue el @email">
                <!--this div will contain all the suggestions (team name)-->
                <div id="sugerencias"></div>
            </div>
        </div>

        <div class="mb-3 cont_btns_participantes_form">
            <button type="submit" class="btn btn-primary b" id="agregar_participantes_btn">Enviar</button>
            <a href="#participantes" class="btn btn-danger b">Cancelar</a>
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
            
            //here we handle the send btn...
            $('#agregar_participantes_btn').on('click', function(event){
                event.preventDefault();
                
                const form = $('form');
                const labels = $('form label');
                let emptyInputs = false; 

                //check if any input is empty...
                form.find('input').each(function(){
                    const currentInput = $(this);
                    if (currentInput.val().trim() === '') {
                         //if there is an empty input, emptyInput = true...
                        emptyInputs = true;
                        /*we quickly go through each empty input label indicating that
                        it cannot be empty...*/
                        const label = form.find('label[for="' + currentInput.attr('id') + '"]');
                        label.text('No puede estar vacío');
                        
                        // add the class...
                        currentInput.addClass('shake');
                        
                        // remove the class after the animation is finished...
                        currentInput.one('animationend', function(){
                            currentInput.removeClass('shake');
                        });
                    }
                });
                
                if(!emptyInputs){
                    //creamos un array...
                    const data = {
                        idsocio: $('#inputSocio').val(),
                        cuota: $('#inputCuota').val(),
                        estatus: $('#select_Es_pago').val(),
                        nombreEquipo: $('#nombreEquipo').val(),
                        torneo: $('#select_torneo').val(), 
                        correo: $('#email').val()
                    }

                    //AJAX request...
                    $.ajax({
                    type: 'POST',
                    url: 'includes/torneoControllers/postParticipanteData.php',
                    data: {data: data},
                    success: function(response){
                        //return to participantes component...
                        window.location.hash = 'participantes';
                    }
                })
                } else {
                    console.log('No puede haber ningun campo vacio');
                }
            })

            /*here we have the necessary code to make the validation of all the
            inputs of the add participant form...*/
            const regularExpressions = {
                onlyNumbers: /^\d+$/,
                onlyLetters: /^[a-zA-Z]+(?: [a-zA-Z]+)*$/, 
                emailFormat: /^[^\s@]+@[^\s@]+\.[^\s@]+$/
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
            //here we do the validation with a key up event...
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

            const emailValidator = (name, value, label) => {
                //this input can only accept letters...
                if(regularExpressions.emailFormat.test(value)){
                    $(`#${name}`).removeClass('shake');
                    label.text('Correo electrónico');
                    label.removeClass('shakeLabel');
                    $('#agregar_participantes_btn').fadeIn();
                } else{
                    $(`#${name}`).addClass('shake');
                    label.text('Email invalido');
                    label.addClass('shakeLabel');
                    $('#agregar_participantes_btn').hide();
                }
            }
            //here we do the validation of the email with a blur event...
            $('#email').on('blur', function(event){
                //obtain the value of the input...
                var inputValue = $(this).val();
                //obtain the name of the input...
                var inputName = $(this).attr('name');
                //obtain the corresponding label of the input...
                var labelForInput = $('form label[for="' + inputName + '"]');
                //this function hleps up to make the validation of the corresponding input...
                emailValidator(inputName, inputValue, labelForInput);
            });
        })
    </script>
</div>