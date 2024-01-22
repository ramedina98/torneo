<?php
    include_once '../../includes/db/torneo.php';
    $data = new Torneo();
    $torneos = $data->getTorneos();

    // Verifica si la variable de participantes no es nula y tiene elementos
    if ($torneos !== null && !empty($torneos)) {
        foreach ($torneos as $torneo) {
            //we check if the number of regitered participants is already equal to the limit...
            $limite = $torneo['limite'];
            $inscritos = $torneo['inscritos'];

            if($limite !== $inscritos){
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
                    <td style="color: rgba(103, 7, 7, 0.873); font-weight: 600;"><?php echo $torneo['inscritos']; ?></td>
                    <td>$<?php echo $torneo['precio']; ?></td>
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
            } else{
?>
                <tr class="datos_rows">
                    <th scope="row" class='id' style="background-color: rgba(155, 0, 0, 0.442); color: white;"><?php echo $torneo['idtorneo']; ?></th>
                    <td style="background-color: rgba(155, 0, 0, 0.442);">
                        <a href="#torneo<?php echo $torneo['idtorneo']; ?>" class="link_centro" style="color: white;">
                            <?php echo $torneo['nombre_torneo']; ?>
                        </a>
                    </td>
                    <td style="background-color: rgba(155, 0, 0, 0.442); color: white;"><?php echo $torneo['nombre_deporte']; ?></td>
                    <td style="background-color: rgba(155, 0, 0, 0.442); color: white;"><?php echo $torneo['limite']; ?></td>
                    <td style="font-weight: 600; background-color: rgba(155, 0, 0, 0.442); color: white;"><?php echo $torneo['inscritos']; ?></td>
                    <td style="background-color: rgba(155, 0, 0, 0.442); color: white;">$<?php echo $torneo['precio']; ?></td>
                    <td style="background-color: rgba(155, 0, 0, 0.442); color: white;"><?php echo $torneo['fechainicio']; ?></td>
                    <td style="background-color: rgba(155, 0, 0, 0.442);">
                        <a href="#centro<?php echo $torneo['idcentro']; ?>" class="link_centro" style="color: white;">
                            <?php echo $torneo['nombre_centro']; ?>
                        </a>
                    </td>
                    <td style="background-color: rgba(155, 0, 0, 0.442); color: white;">
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
        }
    } else {
        echo "<div>No hay datos de torneos disponibles</div>";
    }
?>