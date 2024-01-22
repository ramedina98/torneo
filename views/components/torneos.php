<div>
    <div class="container_btn_add">
        <a href="#agregar_torneo" type="button" class="btn btn-primary" id="btn_add">
            <i class='bx bxs-plus-circle'></i> 
        </a>
        <!--input to search by name--> 
        <div class="input-group mb-3" id="cont_inputSearch">
            <button class="btn btn-outline-secondary" type="button" id="button-addon1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>
            </button>
            <input type="text" class="form-control" placeholder="Buscar torneo" aria-label="Example text with button addon" aria-describedby="button-addon1" id="searchInput">
        </div>
    </div>
    <table class="table">
        <thead class="datos_rows">
            <tr>
                <th scope="col">Id T</th>
                <th scope="col">Nombre</th>
                <th scope="col">Deporte</th>
                <th scope="col">Limite</th>
                <th scope="col">Inicio</th>
                <th scope="col">Centro</th>
                <th scope="col">Acción</th>
            </tr>
        </thead>

        <tbody class="table-group-divider" id="table_torneos">
            <tr class="table-secondary">
                <th scope="col"></th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="table-secondary">
                <th scope="col"></th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="table-secondary">
                <th scope="col"></th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="table-secondary">
                <th scope="col"></th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="table-secondary">
                <th scope="col"></th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr><tr class="table-secondary">
                <th scope="col"></th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="table-secondary">
                <th scope="col"></th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="table-secondary">
                <th scope="col"></th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="table-secondary">
                <th scope="col"></th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <div class="cont_form_add_participantes modal" id="edit_form_participantes">

    </div>

    <script>
        //this script is to perform the dynamic search with the search input...
        $(document).ready(function(){
            //here we search the requiered data in the table...
            const searchData = (data) => {
                console.log('estamos en serach data: ' + data)
                //filter the table rows...
                $('.datos_rows').each(function(){
                    var rowData = $(this).text().toLowerCase();
                    if(rowData.indexOf(data) === -1){
                        $(this).hide(); //hide the rows that do not match...
                    } else{
                        $(this).show(); //Show the rows that match...
                    }
                })
            }

            //handle event keyup of the search input...
            $('#searchInput').keyup(function(){
                var searchText = $(this).val().toLowerCase();
                searchData(searchText);
            })

            //here we handle the information that we choose from the tournament table...
            function dataTournamentTable() {
                // Perform a new AJAX request to fetch the updated data for the table
                $.ajax({
                    type: 'GET', // Assuming you have a separate PHP file to fetch the table data
                    url: 'includes/torneoControllers/getTorneos.php', // Change this to the actual URL
                    success: function(data){
                        // Assuming 'data' is the HTML content for the updated table
                        $('#table_torneos').html(data);
                    },
                    error: function(error){
                        alert('Error fetching updated table data: ' + error.responseText);
                    }
                });
            }

            dataTournamentTable();

            //here we handle the btn delete function...
            $(document).on('click', '.delete_btn_torneo', function() {

                //we obtain the id of the register...
                var idTorneo = $(this).data('idinscrito');
                //AJAX request...
                $.ajax({
                    type: 'POST',
                    url: 'includes/torneoControllers/deleteTorneo.php',
                    data: {id: idTorneo},
                    success: function(response){
                        dataTournamentTable();
                    }, 
                    error: function(error){
                        alert('Error:' + $(error).text());
                    }
                });
            });

            //handle the btn edit...
            $(document).on('click', '.edit_btn_torneo', function(){
                //we obtain the id of the register...
                var idinscritoTorneo = $(this).data('idinscrito');

                //the container of the form to edit information appears...
                $('#edit_form_participantes').css('display', 'flex');

                //we get the data...
                $.ajax({
                    type: 'GET',
                    url: 'includes/torneoControllers/getTorneo.php',
                    data: {id: idinscritoTorneo},
                    success: function(response){
                        $('#edit_form_participantes').html(response);
                    }, 
                    error: function(error){
                        alert('Error:' + $(error).text());
                    }
                });
            });
            
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

            //handle the update btn of the form...
            $('body').on('click', '#update_centro_btn', function(event){
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
                        idtorneo: $('#idtorneo').val(),
                        nombre: $('#inputNomTorneo').val(),
                        deporte: $('#select_deporte').val(),
                        limite: $('#inputLimite').val(),
                        fechainicio: date, 
                        instalacionesCentro: $('#select_centro').val()
                    }

                    //AJAX request...
                    $.ajax({
                    type: 'POST',
                    url: 'includes/torneoControllers/updateTorneo.php',
                    data: {data: data},
                    success: function(response){
                        //we hide the element...
                        console.log('Estamos en el succes: ' + response);
                        $('#edit_form_participantes').css('display', 'none');
                        dataTournamentTable();
                    }, 
                    error: function(error){
                        alert($(error).text());
                    }
                })
                } else {
                    alert('No puede haber ningun campo vacio');
                }
            });

            //handle the cancel btn of the form...
            $('body').on('click', '#cancelar_centro_btn', function(event){
                event.preventDefault();
                //the container of the form to edit information appears...
                $('#edit_form_participantes').css('display', 'none');
            });
        })
    </script>
</div>