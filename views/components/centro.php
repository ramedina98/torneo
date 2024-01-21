<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">CoreFury Gym</h1>
        <p class="lead">Instalaciones: <span id="gym_name"></span></p>
    </div>
</div>

<div class="section contact">

    <div class="colum col-md-8 mx-auto mt-5">

        <button type="button" class="btn btn-secondary" id="btn_regresar" style="margin-bottom: 1em; background-color: rgb(0, 62, 105);">Regresar</button>

        <div class="col-xl-20">

            <div class="row">
                <div class="col-lg-6">
                    <div class="info-box card">
                        <i class="bi bi-geo-alt"></i>
                        <h3>Dirección </h3>
                        <p id="text_direccion"></p>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="info-box card">
                        <i class="bi bi-telephone"></i>
                        <h3>Llamanos</h3>
                        <p id="tel_info"></p>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="info-box card">
                        <i class="bi bi-envelope"></i>
                        <h3>Email</h3>
                        <a href="mailto:rmedinamartindelcampo@gmail.com" style="text-decoration: none; color:black;" id="email_text"></a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="info-box card">
                        <i class="bi bi-clock"></i>
                        <h3>Horario</h3>
                        <p id="horario_text"></p>
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
                url: 'includes/torneoControllers/getInstalacion.php',
                type: 'GET',
                data: { id: id},
                dataType: 'json',
                success: function (data) {
                    //center name
                    $('#gym_name').text(data.nombre_centro);
                    
                    //center address...
                    var direccion = data.calle_centro + ' ' + data.numExt_centro;
                    var estadoCiudad = data.municipio_centro + ', ' + data.estado_centro;
                    $('#text_direccion').html(`${direccion}, <br> ${estadoCiudad}`);

                    //center number...
                    $('#tel_info').text(data.telefono);

                    //center email... 
                    $('#email_text').text(data.email);

                    //gym schedule... 
                    var horas = data.horario;
                    var days = data.dias_abierto;
                    $('#horario_text').html(`${days} <br>${horas}`);
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