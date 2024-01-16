<?php 
    //here we have the necessary code to update the info of a participant...
    include_once '../db/torneo.php';

    if(isset($_POST['data'])){
        try{
            $torneo = new Torneo();
            $data = $_POST['data'];
            $response = $torneo->updateParticipante($data);

            echo $response;
        } catch(Exception $e){
            echo 'Error: ' . $e->getMessage();
        }
    }
?>