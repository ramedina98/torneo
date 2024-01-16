<div>
    <?php 
        // Verificamos si el 'id' existe en la cadena de consulta
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            echo '<div><h2>¡Sí existe un id: ' . $id . '</h2></div>';
        } else {
            echo 'No hay id en la cadena de consulta';
        }

        var_dump($_GET);
    ?>
</div>