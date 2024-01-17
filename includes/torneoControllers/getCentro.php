<?php 
    //Here we have the necessary code to get the sports...
    include_once '../db/torneo.php';
    $torneo = new Torneo();
    $sports = $torneo->getCentro(); 

    if($sports !== null && !empty($sports)){
        foreach($sports as $sport){
?>  
            <option value="<?=$sport['idinstalacionesCentro']?>"><?= $sport['nombre_centro']?></option>
<?php
        }
    } else{
        echo '<option value="0">No hay opciones</option>';
    }
?>