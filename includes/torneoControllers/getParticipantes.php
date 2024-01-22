<?php
    include_once '../db/torneo.php';
    
    $torneo = new Torneo();
    $participantes = $torneo->getParticipantes();

    if ($participantes !== null && !empty($participantes)) {
        foreach ($participantes as $participante) {
            //tournament price...
            $precio = $participante['precio'];
            //how much the participant has paid...
            $cuota = $participante['cuota'];
            //how much  the participant owe...
            $debe = $precio - $cuota;

            if($participante['statusPago'] !== 1 && $debe == 0){
        ?>
                <tr class="datos_rows">
                    <th scope="row"><?php echo $participante['idinscritoTorneo']; ?></th>
                    <td><?php echo $participante['nombreSocio']; ?></td>
                    <td><?php echo $participante['apellidoP']; ?></td>
                    <td><?php echo $participante['apellidoM']; ?></td>
                    <td><?php echo $participante['nombreEquipo']; ?></td>
                    <td>
                        <a href="#torneo<?php echo $participante['idTorneo']; ?>" class="link_centro">
                            <?php echo $participante['nombreTorneo']; ?>
                        </a>
                    </td>
                    <td>$<?php echo $participante['precio'] ?></td>
                    <td style="color: rgba(103, 7, 7, 0.873);">$<?php echo $debe ?></td>
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
            } else{
?>
                <tr class="datos_rows">
                    <th scope="row" style="background-color: rgba(155, 0, 0, 0.442); color: white;"><?php echo $participante['idinscritoTorneo']; ?></th>
                    <td style="background-color: rgba(155, 0, 0, 0.442); color: white;"><?php echo $participante['nombreSocio']; ?></td>
                    <td style="background-color: rgba(155, 0, 0, 0.442); color: white;"><?php echo $participante['apellidoP']; ?></td>
                    <td style="background-color: rgba(155, 0, 0, 0.442); color: white;"><?php echo $participante['apellidoM']; ?></td>
                    <td style="background-color: rgba(155, 0, 0, 0.442); color: white;"><?php echo $participante['nombreEquipo']; ?></td>
                    <td style="background-color: rgba(155, 0, 0, 0.442);">
                        <a style="color: white;" href="#torneo<?php echo $participante['idTorneo']; ?>" class="link_centro">
                            <?php echo $participante['nombreTorneo']; ?>
                        </a>
                    </td>
                    <td style="background-color: rgba(155, 0, 0, 0.442); color: white;">$<?php echo $participante['precio'] ?></td>
                    <td style="background-color: rgba(155, 0, 0, 0.442); color: white;">$<?php echo $debe ?></td>
                    <td style="background-color: rgba(155, 0, 0, 0.442); color: white;">
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
        }
    } else {
        echo 'No hay datos de participantes disponibles.';
    }
?>