<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">CoreFury Gym</h1>
        <p class="lead">Instalaciones: <span id="gym_name"></span></p>
    </div>
</div>

<div id="centro_main_cont">
    <div class="ul">
        <ul>
            <li>Numero: <span>+52 33 26 93 93 06</span></li>
            <li>Horario: <span>24hrs</span></li>
            <li>Dirección: <span id="direccion_text"></span></li>
            <li>Ciudad y estado: <span id="ciudadEstado_text"></span></li>
        </ul>
    </div>
    <div class="ul">
        <ul>
            <li class="btn_li">
                <a href="#torneos" id="btn_back_centro">Regresar</a>
            </li>
            <li><i class='bx bxl-gmail'></i> <a href="mailto:rmedinamartindelcampo@gmail.com" target="_blank">rmedinamartindelcampo@gmail.com</a></li>
            <li><i class='bx bx-link-alt' ></i> <a href="https://ricardomedina.website/" target="_blank">Richard Medina</a></li>
        </ul>
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
                    $('#gym_name').text(data.nombre);
                    //center address...
                    $('#direccion_text').text(data.calle + ' #' + data.numExt + ', ' + data.colonia);
                    //city and state where is the center...
                    $('#ciudadEstado_text').text(data.municipio + ', ' + data.estado)
                },
                error: function (error) {
                    console.error('Error en la solicitud AJAX:', error);
                }
            });
        }
        const id = idCentro();
        dataCenter(id);
        //the end...
    })
</script>