<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Centro: <a id="gym" style="text-decoration: none; color: white;"></a></h1>
        <p class="lead">Torneo: <span id="tournament_name"></span></p>
    </div>
</div>

<div class="section contact">

    <div class="colum col-md-8 mx-auto mt-5">
        <div class="col-xl-20">

            <button type="button" class="btn btn-secondary" id="btn_regresar" style="margin-bottom: 1em; background-color: rgb(0, 62, 105);">Regresar</button>

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
            </div>

        </div>
    </div>
    
</div>
<script>
    $(document).ready(function(){
        //with this function we obtain the id of the url...
        const idCentro = () => {
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
        //
        const dataCenter = (id) => {
            //ajax call...
            $.ajax({
                url: 'includes/torneoControllers/getTorneoJson.php',
                type: 'GET',
                data: { id: id},
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    $('#gym').attr('href', `#centro${data.idcentro}`).text(data.nombre_centro);
                    //tournament name...
                    $('#tournament_name').text(data.nombre);
                    
                    //center address...
                    $('#date_text').text(data.fechainicio);

                    //center number...
                    $('#limite').text(data.limite + ' participantes');

                    //center email... 
                    $('#deporte').text(data.nombre_deporte);

                    //gym schedule... 
                    $('#centro').attr('href', `#centro${data.idcentro}`).text(data.nombre_centro);
                },
                error: function (error) {
                    console.error('Error en la solicitud AJAX:', error);
                }
            });
        }
        const id = idCentro();
        dataCenter(id);
        //the end...

        //here i handle the btn back...
        $('#btn_regresar').on('click', function(){
            window.history.back();
        })
    })
</script>