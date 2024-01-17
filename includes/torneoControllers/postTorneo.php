<?php 
    //here we have the necessary code to send the data to torneo table...
    include_once '../db/torneo.php';

    if(isset($_POST['data'])){
        try{
            $torneo = new Torneo();
            $data = $_POST['data'];
            $response = $torneo->postTorneo($data);

            echo 'Respuesta: ' . $response;
        } catch(Exception $e){
            echo 'Error: ' . $e->getMessage();
        }
    }
?>