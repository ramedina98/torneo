<?php 
    include_once 'includes/db/user.php';
    include_once 'includes/db/torneo.php';
    include_once 'includes/empleadosControllers/user_session.php';
    include_once 'includes/rastreo.php';

    $userSession = new UserSession();
    $user = new User();
    $torneo = new Torneo();
    $rastreo = new Rastreo();
    
    if(isset($_SESSION['user'])){
        /*If there is a session already started, it will notify us and 
        send us to the corresponding dasboar...*/
        $user->setUser($userSession->getCurrentUser());
        include_once 'views/home.php';

    } else if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login_button'])){
        /*Here we validate the user to see if it is correct or not... */
        //echo 'Validación de login';
        $userForm = $_POST['username'];
        $passForm = $_POST['password'];

        if($user->userExists($userForm, $passForm)){
            //here must be the home page...
            $userSession->setCurrentUser($userForm);
            $user->setUser($userForm);
            $userData = $user->getName();

            session_start();
            
            $_SESSION['userData'] = $userData;

            // the full name of the employee...
            $empleado = $userData['nombre'] . ' ' . $userData['apellido_p'] . ' ' . $userData['apellido_m'];
            
            // employee's position...
            $puesto = $userData['puesto'];
            
            // user data tracking data...
            $data = $rastreo->trackingInformation($empleado, $puesto);

            // we save the data in the database...
            $torneo->postRastreo($data);
            
            include_once 'views/home.php';

        } else{
            //the user does not exits...
            $errorLogin = '<div class="cont_error">
                                <p>Nombre de usuario y/o password incorrecto</p>
                            </div>';
            include_once 'views/login.php';
        }
    } else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register_button'])) {
        //this array will contain all the data to be sent to the database...
        $data = [];

        //Collect data from the form...
        $data['name'] = $_POST['name'];
        $data['last_p'] = $_POST['last_p'];
        $data['last_m'] = $_POST['last_m'];
        $data['username'] = $_POST['username'];
        $data['password'] = $_POST['password'];

        //we will receive an alert
        $result = $user->sentDataUserTable($data);
        
        switch($result){
            //the employee does not exist...
            case 1: 
                $errorSign = '<div class="cont_error">
                            <p>El empleado no existe.</p>
                        </div>';
                include_once 'views/signUp.php';
            break; 
            //the employee already has an account...
            case 2:
                $errorSign = '<div class="cont_error">
                            <p>El empleado ya tiene una cuenta.</p>
                        </div>';
                include_once 'views/signUp.php';
            break;
            //everything was recorded in the database in the right way
            case 3:
                include_once 'views/login.php';
            break;
            //if something goes wrong...
            default: 
                echo 'Algo salio mal';
            break;
        }

    } else if(isset($_GET['register']) && $_GET['register'] === 'true'){
        //we open the registration form...
        include_once 'views/signUp.php';

    } else{
        //If there is no session, it send us to the form to start the session...
        include_once 'views/login.php';
    }
?>