<div>
    <div class="container_btn_add">
        <button type="button" class="btn btn-primary" id="btn_add">
            <i class='bx bxs-plus-circle'></i> 
        </button>
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
</div>