<?php 
    //here we get the data of a given tournament and converd it to json...
    include_once '../db/torneo.php';

    if(isset($_GET['id'])){
        try{
            $torneo = new Torneo();
            //get the id...
            $id = $_GET['id'];
            //get the data from the corresponding table... 
            $response = $torneo->getTorneParticipantes($id);
            // Crear un array asociativo que contiene la información del torneo
            $result = array('torneo' => array());

            // Iterar sobre los resultados y agregarlos al array correspondiente
            foreach ($response as $row) {
                // Si aún no se ha agregado la información del torneo, hacerlo
                if (empty($result['torneo'])) {
                    $result['torneo'] = array(
                        'nombre' => $row['nombre'],
                        'limite' => $row['limite'],
                        'inscritos' => $row['numero_de_inscritos'],
                        'fechainicio' => $row['fechainicio'],
                        'precio' => $row['precio_torneo'],
                        'idcentro' => $row['idcentro'],
                        'nombre_deporte' => $row['nombre_deporte'],
                        'nombre_centro' => $row['nombre_centro'],
                    );
                }

                // Agregar información de cada participante
                $result['torneo']['participantes'][] = array(
                    'idsocio' => $row['idsocio'],
                    'nombre_socio' => $row['nombre_socio'],
                    'apellido_paterno' => $row['apellido_paterno'],
                    'apellido_materno' => $row['apellido_materno'],
                    'equipo' => $row['nombreEquipo'],
                    'idregistro' => $row['idinscritoTorneo']
                );
            }

            // Convertir el array asociativo en JSON
            $jsonResponse = json_encode($result);
            // Imprimir la respuesta como script JS
            echo $jsonResponse;
        } catch(Exception $e){
            echo 'Error: ' . $e->getMessage();
        }
    }
?> 