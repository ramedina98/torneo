<!--here we only handle the session-->
<?php 
    class UserSession{
        //construct
        public function __construct(){
            /*we initialize the environment to handle sessions...*/
            session_start();
        }

        public function setCurrentUser($user){
            //here we store the user's name...
            $_SESSION['user'] = $user;
        }

        public function getCurrentUser(){
            return $_SESSION['user'];
        }

        public function closeSession(){
            session_unset();
            session_destroy();
        }
    }
?>