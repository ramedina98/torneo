<?php
    include_once '../../includes/db/torneo.php';
    $data = new Torneo();
    $torneos = $data->getTorneos();

    // Verifica si la variable de participantes no es nula y tiene elementos
    if ($torneos !== null && !empty($torneos)) {
        foreach ($torneos as $torneo) {
?>
            <tr class="datos_rows">
                <th scope="row" class='id'><?php echo $torneo['idtorneo']; ?></th>
                <td>
                    <a href="#torneo<?php echo $torneo['idtorneo']; ?>" class="link_centro">
                        <?php echo $torneo['nombre_torneo']; ?>
                    </a>
                </td>
                <td><?php echo $torneo['nombre_deporte']; ?></td>
                <td><?php echo $torneo['limite']; ?></td>
                <td><?php echo $torneo['fechainicio']; ?></td>
                <td>
                    <a href="#centro<?php echo $torneo['idcentro']; ?>" class="link_centro">
                        <?php echo $torneo['nombre_centro']; ?>
                    </a>
                </td>
                <td>
                    <button type="button" class="btn btn-success edit_btn_torneo" data-idinscrito="<?php echo $torneo['idtorneo']; ?>">
                        <i class='bx bxs-edit-alt'></i>
                    </button>
                    <button type="button" class="btn btn-danger delete_btn_torneo" data-idinscrito="<?php echo $torneo['idtorneo']; ?>">
                        <i class='bx bxs-x-circle'></i>
                    </button>
                </td>
            </tr>
<?php
        }
    } else {
        echo "<div>No hay datos de torneos disponibles</div>";
    }
?>