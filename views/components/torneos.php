<div>
    <div class="container_btn_add">
        <button type="button" class="btn btn-primary" id="btn_add">
            <i class='bx bxs-plus-circle'></i> 
        </button>
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
    <?php 
        include_once '../../includes/torneo.php';
        $torneo = new Torneo();
        $Torneos = $torneo->getTorneos();

        // Verifica si la variable de participantes no es nula y tiene elementos
        if ($Torneos !== null && !empty($Torneos)) {
            ?>
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

                <tbody class="table-group-divider">
                    <?php
                    // Itera sobre cada participante e imprime una fila en la tabla
                    foreach ($Torneos as $t) {
                    ?>
                        <tr class="datos_rows">
                            <th scope="row"><?php echo $t['idtorneo']; ?></th>
                            <td><?php echo $t['nombre_torneo']; ?></td>
                            <td><?php echo $t['nombre_deporte']; ?></td>
                            <td><?php echo $t['limite']; ?></td>
                            <td><?php echo $t['fechainicio']; ?></td>
                            <td>
                                <a href="?id=<?php echo $t['idcentro']; ?>#centro" class="link_centro">
                                    <?php echo $t['nombre_centro']; ?>
                                </a>
                            </td>
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