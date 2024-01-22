<div>
    <div class="container_btn_add">
        <a href="#agregar_participante" type="button" class="btn btn-primary" id="btn_add">
        <i class="bi bi-person-fill-add"></i>
        </a>
        <!--input to search by name--> 
        <div class="input-group mb-3" id="cont_inputSearch">
            <button class="btn btn-outline-secondary" type="button" id="button-addon1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>
            </button>
            <input type="text" class="form-control" placeholder="Buscar participante" aria-label="Example text with button addon" aria-describedby="button-addon1" id="searchInput">
        </div>
    </div>
    <table class="table">
        <thead class="datos_rows">
            <tr>
                <th scope="col">Id T</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido P</th>
                <th scope="col">Apellido M</th>
                <th scope="col">N. Equipo</th>
                <th scope="col">Torneo</th>
                <th scope="col">Precio</th>
                <th scope="col">Adeuda</th>
                <th scope="col">Acción</th>
            </tr>
        </thead>

        <tbody class="table-group-divider" id="tbody_participantes">
            <tr class="table-secondary">
                <th scope="col"></th>
                <td></td>
                <td></td>
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
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <div class="cont_form_add_participantes modal" tabindex="-1" id="edit_form_participantes">

    </div>

    <script>
        //this script is to perform the dynamic search with the search input...
        $(document).ready(function(){
            //handle the load of the data in the table...
            function dataParticipantesTable() {
                $('#tbody_participantes tr').show();
                // Perform a new AJAX request to fetch the updated data for the table
                $.ajax({
                    type: 'GET', // Assuming you have a separate PHP file to fetch the table data
                    url: 'includes/torneoControllers/getParticipantes.php', // Change this to the actual URL
                    success: function(data){
                        $('#tbody_participantes tr').hide();
                        // Assuming 'data' is the HTML content for the updated table
                        $('.table-group-divider').html(data);
                    },
                    error: function(error){
                        alert('Error fetching updated table data: ' + error.responseText);
                    }
                });
            }

            dataParticipantesTable();

            //here we search the requiered data in the table...
            const searchData = (data) => {
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

            //here we handle the btn delete...
            $(document).on('click', '.delete_btn_participante', function() {
                //we obtain the id of the register...
                var idinscritoTorneo = $(this).data('idinscrito');
                //AJAX request...
                $.ajax({
                    type: 'POST',
                    url: 'includes/torneoControllers/deleteParticipante.php',
                    data: {id: idinscritoTorneo},
                    success: function(response){
                        dataParticipantesTable();
                    }, 
                    error: function(error){
                        alert('Error:' + $(error).text());
                    }
                });
            });

            //function to handle the update btn...
            $(document).on('click', '.edit_btn_participantes', function(){
                //we obtain the id of the register...
                var idinscritoTorneo = $(this).data('idinscrito');

                //the container of the form to edit information appears...
                $('#edit_form_participantes').css('display', 'flex');

                //we get the data...
                $.ajax({
                    type: 'GET',
                    url: 'includes/torneoControllers/getParticipante.php',
                    data: {id: idinscritoTorneo},
                    success: function(response){
                        $('#edit_form_participantes').html(response);
                    }, 
                    error: function(error){
                        alert('Error:' + $(error).text());
                    }
                });
            });

            //handle the edit btn of the form...
            $('body').on('click', '#agregar_participantes_btn', function(event) {
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
                        idinscritoTorneo: $('#idstorneo').val(),
                        idsocio: $('#inputSocio').val(),
                        cuota: $('#inputCuota').val(),
                        estatus: $('#select_Es_pago').val(),
                        nombreEquipo: $('#nombreEquipo').val(),
                        torneo: $('#select_torneo').val()
                    }

                    //AJAX request...
                    $.ajax({
                    type: 'POST',
                    url: 'includes/torneoControllers/updateParticipanteData.php',
                    data: {data: data},
                    success: function(response){
                        //we hide the element...
                        $('#edit_form_participantes').css('display', 'none');
                        dataParticipantesTable();
                    },
                    error: function(error){
                        alert($(error).text());
                    }
                })
                } else {
                    console.log('No puede haber ningun campo vacio');
                }
            });

            //handle the cancel btn of the form...
            $('body').on('click', '#cancelar_participante_btn', function(event){
                event.preventDefault();
                //the container of the form to edit information appears...
                $('#edit_form_participantes').css('display', 'none');
            })
        })
    </script>
</div>