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
            $idSocio = $data['idsocio'];
            $correo = $data['correo'];
            $registroInfo = $torneo->getRegistroInfo($idSocio);

            //checar por que los datos no estan saliendo, no me llega ningun correo...
            $mensaje = [
                'nombre' => $registroInfo['nombre'],
                'apellidoP' => $registroInfo['apellidoP'],
                'apellidoM' => $registroInfo['apellidoM'], 
                'nombreTorneo' => $registroInfo['nombre_torneo'], 
                'fecha' => $registroInfo['fecha'], 
                'centro' => $registroInfo['nombre_centro']
            ];

            $email = $send->envio($mensaje, $correo);

            echo $email;

            echo 'Mensaje de exito: ' . $response;
        } catch(Exception $e){
            echo 'Mensaje: ' . $e->getMessage();
        }
    }
?>