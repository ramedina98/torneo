<?php
    include_once '../db/torneo.php';
    
    $torneo = new Torneo();
    $participantes = $torneo->getParticipantes();

    if ($participantes !== null && !empty($participantes)) {
        foreach ($participantes as $participante) {
        ?>
            <tr class="datos_rows">
                <th scope="row"><?php echo $participante['idinscritoTorneo']; ?></th>
                <td><?php echo $participante['nombreSocio']; ?></td>
                <td><?php echo $participante['apellidoP']; ?></td>
                <td><?php echo $participante['apellidoM']; ?></td>
                <td><?php echo $participante['nombreEquipo']; ?></td>
                <td><?php echo $participante['nombreTorneo']; ?></td>
                <td><?php echo $participante['statusPago']; ?> - $<?php echo $participante['cuota']; ?></td>
                <td>
                    <button type="button" class="btn btn-success edit_btn_participantes" data-idinscrito="<?php echo $participante['idinscritoTorneo']; ?>">
                        <i class='bx bxs-edit-alt'></i>
                    </button>
                    <button type="button" class="btn btn-danger delete_btn_participante" data-idinscrito="<?php echo $participante['idinscritoTorneo']; ?>">
                        <i class='bx bxs-x-circle'></i>
                    </button>
                </td>
            </tr>
        <?php
        }
    } else {
        echo 'No hay datos de participantes disponibles.';
    }
?>