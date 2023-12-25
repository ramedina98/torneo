<?php 
    include_once 'includes/user.php';
    include_once 'includes/user_session.php';

    $userSession = new UserSession();
    $user = new User();

    if(isset($_SESSION['user'])){
        /*If there is a session already started, it will notify us and 
        send us to the corresponding dasboar...*/
        echo 'Hay session, estamos en el dashboard...';

    } else if(isset($_POST['username']) && isset($_POST['password'])){
        /*Here we validate the user to see if it is correct or not... */
        echo 'Validación de login';

        $userForm = $_POST['username'];
        $passForm = $_POST['password'];

        //validamos...
        if($user->userExists($userForm, $passForm)){
            echo 'usuerio validado';
        } else{
            echo 'Usuerio incorrecto';
        }

    } else{
        //If there is no session, it send us to the form to start the session...
        include_once 'views/login.php';
    }
?>