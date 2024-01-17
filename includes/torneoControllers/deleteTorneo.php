<?php 
    require_once '../db/torneo.php';

    if(isset($_POST['id'])){
        try{
            $id = (int)$_POST['id'];

            $torneo = new Torneo();
            $respuesta = $torneo->deleteTorneo($id);

            echo $respuesta;
        } catch(Exception $e){
            echo 'Error: ' . $e->getMessage();
        }
    }
?>