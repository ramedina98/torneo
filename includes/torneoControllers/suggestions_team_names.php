<?php 
    /* This file contains the code needed to create the function 
    that will provide us with recommendations of team names. 
    It will retrieve the existing team names from the database... */
    include_once '../db/torneo.php';

    // Check if the input parameter was received...
    if (isset($_POST['inputText'])) {
        $torneo = new Torneo();

        // Get all the data from the corresponding table...
        $participantes = $torneo->getParticipantes();

        // Extract team names from the array of participantes...
        $teamNames = array_column($participantes, 'nombreEquipo');
        
        //we remove repeated names...
        $uniqueTeamNames = array_unique($teamNames);

        // Filter suggestions based on the search input...
        $inputText = strtolower($_POST['inputText']);
        $sugerencias = array_filter($uniqueTeamNames, function ($equipo) use ($inputText) {
            return strpos(strtolower($equipo), $inputText) !== false;
        });

        // Show the suggestions as HTML elements...
        foreach ($sugerencias as $equipo) {
            echo '<div class="sugerencia_item">' . htmlspecialchars($equipo) . '</div>';
        }
    }
?>