<?php

    include_once 'empleadosControllers/user_session.php';

    $userSession = new UserSession();
    $userSession->closeSession();

    header("location: ../index.php");

?>