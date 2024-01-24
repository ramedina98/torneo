<?php 
    //this file has the necessary code to register a new participant...
    include_once '../db/torneo.php';
    include_once '../email/sendEmail.php';

    if(isset($_POST['data'])){
        try{
            $torneo = new Torneo();
            $send = new SendEmail();
            $data = $_POST['data'];
            $response = $torneo->postParticipante($data);

            //we send an email to thanks the participant...

            //partner id...
            $idSocio = $data['idsocio'];

            //tournament id...
            $idTorneo = $data['torneo'];

            //email of the partner
            $correo = $data['correo'];

            //the ids necessary for the search of the information for the mailing...
            $ids = [
                'idSocio' => $idSocio, 
                'idTorneo' => $idTorneo
            ];

            $registroInfo = $torneo->getRegistroInfo($ids);

            //checar por que los datos no estan saliendo, no me llega ningun correo...
            $mensaje = [
                'nombre' => $registroInfo['nombre'],
                'apellidoP' => $registroInfo['apellidoP'],
                'apellidoM' => $registroInfo['apellidoM'], 
                'nombreTorneo' => $registroInfo['nombre_torneo'], 
                'fecha' => $registroInfo['fecha'], 
                'centro' => $registroInfo['nombre_centro']
            ];

            //this function sends an email to the member who has just signed up for a new tournamet...
            $email = $send->envio($mensaje, $correo);

            echo $email;

            echo 'Mensaje de exito: ' . $response;
            
        } catch(Exception $e){
            echo 'Mensaje: ' . $e->getMessage();
        }
    }
?>