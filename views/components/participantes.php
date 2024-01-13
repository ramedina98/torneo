<div>
    <div class="container_btn_add">
        <a href="#agregar_participante" type="button" class="btn btn-primary" id="btn_add">
            <i class='bx bxs-plus-circle'></i> 
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
    <?php 
        include_once '../../includes/torneo.php';
        $torneo = new Torneo();
        $participantes = $torneo->getParticipantes();

        // Verifica si la variable de participantes no es nula y tiene elementos
        if ($participantes !== null && !empty($participantes)) {
            ?>
            <table class="table">
                <thead class="datos_rows">
                    <tr>
                        <th scope="col">Id T</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido P</th>
                        <th scope="col">Apellido M</th>
                        <th scope="col">N. Equipo</th>
                        <th scope="col">Torneo</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>

                <tbody class="table-group-divider">
                    <?php
                    // Itera sobre cada participante e imprime una fila en la tabla
                    foreach ($participantes as $participante) {
                    ?>
                        <tr class="datos_rows">
                            <th scope="row"><?php echo $participante['idinscritoTorneo']; ?></th>
                            <td><?php echo $participante['nombreSocio']; ?></td>
                            <td><?php echo $participante['apellidoP']; ?></td>
                            <td><?php echo $participante['apellidoM']; ?></td>
                            <td><?php echo $participante['nombreEquipo']; ?></td>
                            <td><?php echo $participante['nombreTorneo']; ?></td>
                            <td>
                                <button type="button" class="btn btn-success">
                                    <i class='bx bxs-edit-alt'></i>
                                </button>
                                <button type="button" class="btn btn-danger">
                                    <i class='bx bxs-x-circle'></i>
                                </button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        } else {
            echo 'No hay datos de participantes disponibles.';
        }

    ?>
    <script>
        //this script is to perform the dynamic search with the search input...
        $(document).ready(function(){
            //handle event keyup of the search input...
            $('#searchInput').keyup(function(){
                var searchText = $(this).val().toLowerCase();

                //filter the table rows...
                $('.datos_rows').each(function(){
                    var rowData = $(this).text().toLowerCase();
                    if(rowData.indexOf(searchText) === -1){
                        $(this).hide(); //hide the rows that do not match...
                    } else{
                        $(this).show(); //Show the rows that match...
                    }
                })
            })
        })
    </script>
</div>