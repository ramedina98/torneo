<div class="cont_form_add_participantes">

    <div class="cont_btn_regresar">
        <a href="#torneos" class="btn btn-light">Regresar</a>
    </div>

    <form class="form_participantes_add">
        <div class="mb-3" id="cont_cuota_idSocio">
            <div class="mb-3 l">
                <label for="inputNomTorneo" class="form-label">Nombre del Torneo</label>
                <input type="text" class="form-control" id="inputNomTorneo" aria-describedby="emailHelp" placeholder="Agregue un nombre" name="inputNomTorneo">
                <div id="emailHelp" class="form-text">Un nombre con fuerza.</div>
            </div>
            <div class="mb-3 l">
                <label for="select_deporte" class="form-label">Deporte</label>
                <select class="form-select" aria-label="Default select example" id="select_deporte">
                    
                </select>
            </div>
        </div>

        <div class="mb-3" id="cont_pago_equipo">
            <div class="mb-3 l">
                <label for="inputLimite" class="form-label">Limite</label>
                <input type="number" class="form-control" id="inputLimite" aria-describedby="emailHelp" placeholder="100" name="inputLimite">
                <div id="emailHelp" class="form-text">Numero maximo de participantes</div>
            </div>
            <div class="mb-3 l" id="cont_n_equipo">
                <label for="inputFecha" class="form-label">Fecha de inicio</label>
                <input type="datetime-local" class="form-control" id="inputFecha" name="inputFecha" aria-describedby="emailHelp">
            </div>

            <div class="mb-3 l">
                <label for="exampleInputPassword1" class="form-label">Instalaciones centro</label>
                <select class="form-select" aria-label="Default select example" id="select_centro">
                    
                </select>
            </div>

            <div class="mb-3 l" id="cont_n_equipo">
                <label for="inputPrecioTorneo" class="form-label">Precio del torneo</label>
                <input type="text" placeholder="Ingrese el precio del torneo" class="form-control" id="inputPrecioTorneo" name="inputPrecioTorneo" aria-describedby="emailHelp">
            </div>
        </div>

        <div class="mb-3 cont_btns_participantes_form">
            <button type="submit" class="btn btn-primary b" id="agregar_centro_btn">Enviar</button>
            <a href="#torneos" class="btn btn-danger b">Cancelar</a>
        </div>
    </form>
    <script>
        $(document).ready(function(){
            //here we handle the select of deportes...
            const deportesOptions = () => {
                $.ajax({
                    type: 'GET', // Assuming you have a separate PHP file to fetch the table data
                    url: 'includes/torneoControllers/getDeportes.php', // Change this to the actual URL
                    success: function(data){
                        // Assuming 'data' is the HTML content for the updated table
                        $('#select_deporte').html(data);
                    },
                    error: function(error){
                        alert('Error fetching updated table data: ' + error.responseText);
                    }
                });
            }
            deportesOptions();
            //here we handle the select of centros...
            const centrosOptions = () => {
                $.ajax({
                    type: 'GET', // Assuming you have a separate PHP file to fetch the table data
                    url: 'includes/torneoControllers/getCentro.php', // Change this to the actual URL
                    success: function(data){
                        // Assuming 'data' is the HTML content for the updated table
                        $('#select_centro').html(data);
                    },
                    error: function(error){
                        alert('Error fetching updated table data: ' + error.responseText);
                    }
                });
            }
            centrosOptions();

            //here we handle the send btn...
            const formatData = (dateString) => {
                // El valor del input de datetime-local es una cadena en formato ISO 8601
                const fecha = new Date(dateString);

                const year = fecha.getFullYear();
                const month = String(fecha.getMonth() + 1).padStart(2, '0');
                const day = String(fecha.getDate()).padStart(2, '0');

                const hours = String(fecha.getHours()).padStart(2, '0');
                const minutes = String(fecha.getMinutes()).padStart(2, '0');

                // Puedes omitir los segundos si no son necesarios en tu aplicación
                // const seconds = String(fecha.getSeconds()).padStart(2, '0');

                return `${year}-${month}-${day} ${hours}:${minutes}`;
            };

            $('#agregar_centro_btn').on('click', function(event){
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
                    //formateamos la fecha... 
                    var date = formatData($('#inputFecha').val());
                    //new array with all the data...
                    const data = {
                        nombre: $('#inputNomTorneo').val(),
                        deporte: $('#select_deporte').val(),
                        limite: $('#inputLimite').val(),
                        fechainicio: date, 
                        instalacionesCentro: $('#select_centro').val(), 
                        precioTorneo: $('#inputPrecioTorneo').val()
                    }

                    //AJAX request...
                    $.ajax({
                    type: 'POST',
                    url: 'includes/torneoControllers/postTorneo.php',
                    data: {data: data},
                    success: function(response){
                        //return to participantes component...
                        window.location.hash = 'torneos';
                    }
                })
                } else {
                    alert('No puede haber ningun campo vacio');
                }
            });

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
                    case 'inputPrecioTorneo':
                        //this input can only accept letters...
                        if(regularExpressions.onlyNumbers.test(value)){
                            $(`#${name}`).removeClass('shake');
                            label.text('Precio del torneo');
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
                       //
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
</div>