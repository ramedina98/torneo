<?php 
    //here we get the data of a given tournament and converd it to json...
    include_once '../db/torneo.php';

    if(isset($_GET['id'])){
        try{
            $torneo = new Torneo();
            //get the id...
            $id = $_GET['id'];
            //get the data from the corresponding table... 
            $response = $torneo->getTorneo($id);
            //convert the response to json format...
            $jsonResponse = json_encode($response);
            //print the response as js Script...
            echo $jsonResponse;
        } catch(Exception $e){
            echo 'Error: ' . $e->getMessage();
        }
    }
?> 