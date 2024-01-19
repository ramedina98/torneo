<?php 
    //here is the code required to extract the data from specific center...
    include_once '../db/torneo.php';

    if(isset($_GET['id'])){
        try{
            $torneo = new Torneo();
            //we obtain the id...
            $id = $_GET['id'];

            //response...
            $response = $torneo->getInstalacion($id);

            //convert the response to json format...
            $jsonResponse = json_encode($response);
            //print the response as js Script...
            echo $jsonResponse;
            
        } catch(Exception $e){
            echo 'Error: ' . $e->getMessage();
        }
    }
?>