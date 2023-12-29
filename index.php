<?php 
    include_once 'includes/user.php';
    include_once 'includes/user_session.php';

    $userSession = new UserSession();
    $user = new User();

    if(isset($_SESSION['user'])){
        /*If there is a session already started, it will notify us and 
        send us to the corresponding dasboar...*/
        $user->setUser($userSession->getCurrentUser());
        include_once 'views/home.php';

    } else if(isset($_POST['username']) && isset($_POST['password'])){
        /*Here we validate the user to see if it is correct or not... */
        //echo 'Validación de login';
        $userForm = $_POST['username'];
        $passForm = $_POST['password'];

        if($user->userExists($userForm, $passForm)){
            //here must be the home page...
            $userSession->setCurrentUser($userForm);
            $user->setUser($userForm);

            include_once 'views/home.php';

        } else{
            //the user does not exits...
            $errorLogin = '<div class="cont_error">
                                <p>Nombre de usuario y/o password incorrecto</p>
                            </div>';
            include_once 'views/login.php';
        }
    } else{
        //If there is no session, it send us to the form to start the session...
        include_once 'views/login.php';
    }
?>