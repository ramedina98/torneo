<?php 
    //this file has the necessary code to register a new participant...
    include_once '../db/torneo.php';

    if(isset($_POST['data'])){
        try{
            $torneo = new Torneo();
            $data = $_POST['data'];
            $response = $torneo->postParticipante($data);

            echo 'Mensaje de exito: ' . $response;
        } catch(Exception $e){
            echo 'Mensaje: ' . $e->getMessage();
        }
    }
?>