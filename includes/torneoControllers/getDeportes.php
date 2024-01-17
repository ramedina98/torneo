<?php 
    //Here we have the necessary code to get the sports...
    include_once '../db/torneo.php';
    $torneo = new Torneo();
    $sports = $torneo->getDeportes(); // Agregado el signo de dólar

    if($sports !== null && !empty($sports)){
        foreach($sports as $sport){
?>  
            <option value="<?=$sport['iddeporte']?>"><?= $sport['nombre']?></option>
<?php
        }
    } else{
        echo '<option value="0">No hay opciones</option>';
    }
?>