<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Centro: <a id="gym" style="text-decoration: none; color: white;"></a></h1>
        <p class="lead">Torneo: <span id="tournament_name"></span></p>
    </div>
</div>

<div class="section contact">
    <button type="button" class="btn btn-secondary" id="btn_regresar" style="margin-bottom: 1em; background-color: rgb(0, 62, 105);">Regresar</button>
    <div class="row gy-4">
        <div class="col-xl-5">
            <div class="row">
                <div class="col-lg-6">
                    <div class="info-box card">
                        <i class="bi bi-calendar-week"></i>
                        <h3>Fecha</h3>
                        <p id="date_text"></p>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="info-box card">
                        <i class="bi bi-people-fill"></i>
                        <h3>Limite</h3>
                        <p id="limite"></p>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="info-box card">
                        <i class="bi bi-person-arms-up"></i>
                        <h3>Inscritos</h3>
                        <p id="inscritos"></p>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="info-box card">
                        <i class="bi bi-shadows"></i>
                        <h3>Deporte</h3>
                        <p id="deporte"></p>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="info-box card">
                        <i class="bi bi-building"></i>
                        <h3>Centro</h3>
                        <a id="centro" style="text-decoration: none; color: black;"></a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="info-box card">
                        <i class="bi bi-cash-coin"></i>
                        <h3>Precio</h3>
                        <p id="precio"></p>
                    </div>
                </div>
            </div>

        </div>
        
        <div class="col-xl-7">
            <div class="card p-4" id="cont_table_participants">
                <h3 style="border-bottom:1px solid black; color:rgb(0, 62, 105); margin-bottom: 1em;">Participantes</h3>
                <table class="table table-ligth table-striped">
                    <thead class="datos_rows">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">A. Paterno</th>
                            <th scope="col">A. Materno</th>
                            <th scope="col">N. Equipo</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody id="table_body_participantes_torneo">
                        <tr class="table-secondary skeleton_tr">
                            <th scope="col"></th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="table-secondary skeleton_tr">
                            <th scope="col"></th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="table-secondary skeleton_tr">
                            <th scope="col"></th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="table-secondary skeleton_tr">
                            <th scope="col"></th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        //with this function we obtain the id of the url...
        const idTournament = () => {
            let id = ''; //variable...

            //we get what is after the #
            const rutaAfterHash = window.location.hash;

            //we separate the required...
            const ruta = rutaAfterHash.match(/([a-zA-Z]+)(\d+)/);
            
            //here we extract the id of the center...
            if(ruta){
                id = ruta[2]; //center if... 
            }

            return id;
        }
        //print table data...
        const printTableData = (data) => {
            //we have to insert the participants in the table...
            const participantesTableBody = $('#table_body_participantes_torneo');
            // check if there are participants or not
            if (data.torneo.participantes && data.torneo.participantes.length > 0) {
                // iterate over the participants and add rows to the table...
                data.torneo.participantes.forEach((participante, index) => {
                    //if the value is diferent from null...
                    if(participante.nombre_socio !== null && 
                    participante.apellido_paterno !== null &&
                    participante.apellido_materno !== null){
                        const rowHtml = `
                        <tr class="datos_rows">
                            <th scope="row">${index + 1}</th>
                            <td>${participante.nombre_socio}</td>
                            <td>${participante.apellido_paterno}</td>
                            <td>${participante.apellido_materno}</td>
                            <td>${participante.equipo}</td>
                            <td>
                                <button type="button" class="btn btn-danger delete_btn_participante_vista_torneo" data-idinscrito="${participante.idregistro}">
                                    <i class='bx bxs-x-circle'></i>
                                </button>
                            </td>
                        </tr>
                        `;
                        participantesTableBody.append(rowHtml);
                    } else{ //if the value is null...
                        const noDataHtml = `
                            <tr>
                                <td colspan="4">No hay participantes en este torneo.</td>
                            </tr>
                        `;
                        participantesTableBody.append(noDataHtml);
                    }
                });
            } else {
                //If there are not participants we print a message in the table...
                const noDataHtml = `
                    <tr>
                        <td colspan="4">No hay participantes en este torneo.</td>
                    </tr>
                `;
                participantesTableBody.append(noDataHtml);
            }
        }
        //data of the tournament
        const dataTournament = (id) => {
            $('#table_body_participantes_torneo .skeleton_tr').show();
            //ajax call...
            $.ajax({
                url: 'includes/torneoControllers/getTorneoJson.php',
                type: 'GET',
                data: { id: id},
                dataType: 'json',
                success: function (data) {
                    console.log('Datos', data.torneo)
                    $('#table_body_participantes_torneo .skeleton_tr').hide();
                    //center name...
                    $('#gym').attr('href', `#centro${data.torneo.idcentro}`).text(data.torneo.nombre_centro);
                    //tournament name...
                    $('#tournament_name').text(data.torneo.nombre);
                    
                    //center address...
                    $('#date_text').text(data.torneo.fechainicio);

                    //center number...
                    $('#limite').text(data.torneo.limite + ' participantes');

                    //
                    $('#inscritos').text(data.torneo.inscritos + ' inscrios');

                    //center email... 
                    $('#deporte').text(data.torneo.nombre_deporte);

                    //gym schedule... 
                    $('#centro').attr('href', `#centro${data.torneo.idcentro}`).text(data.torneo.nombre_centro);

                    //tournament price...
                    $('#precio').text('$' + data.torneo.precio)

                    //print table data...
                    printTableData(data);
                },
                error: function (error) {
                    console.error('Error en la solicitud AJAX:', error);
                }
            });
        }
        const id = idTournament();
        dataTournament(id);
        //the end...

        //here i handle the btn back...
        $('#btn_regresar').on('click', function(){
            window.history.back();
        })

        //here we handle the btn delete...
        $(document).on('click', '.delete_btn_participante_vista_torneo', function() {
                //we obtain the id of the register...
                var idinscritoTorneo = $(this).data('idinscrito');
                //AJAX request...
                $.ajax({
                    type: 'POST',
                    url: 'includes/torneoControllers/deleteParticipante.php',
                    data: {id: idinscritoTorneo},
                    success: function(response){
                        $('#table_body_participantes_torneo').empty();
                        const id = idTournament();
                        dataTournament(id);
                    }, 
                    error: function(error){
                        alert('Error:' + $(error).text());
                    }
                });
            });
        })
</script>