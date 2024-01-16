<?php 
    /*in this file we have all the code needed to check if a id exists in the 
    table inscritosTorneo*/
    include_once '../db/torneo.php';

    //check if the input parameter was recived...
    if(isset($_POST['id'])){
        //we save the id in a variable
        $id = (int)$_POST['id'];

        $torneo = new Torneo();
        
        //we get the data from the table "inscritoparticipante"...
        $socios = $torneo->getSocios();

        /*we create a loop to check if the id exists in the table and then to 
        return the name and surname of the participant...*/
        $encontrado = false;
        $i = 0;
        $sociosCount = count($socios);

        while(!$encontrado && $i < $sociosCount){
            $socio = $socios[$i];

            if($id === $socio['idsocio']){
                echo $socio['nombre'] . ' ' . $socio['apellidoP'] . ' ' . $socio['apellidoM'];
                $encontrado = true; 
            } 

            $i++;
        }

        if(!$encontrado){
            echo 'No existe el socio.';
        }
    }
?>