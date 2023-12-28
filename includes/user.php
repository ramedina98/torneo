<!--Here we validate that the user exist and obtain his/her data...-->
<?php
    include_once 'db.php';
    //we create our class and extend it...
    class User extends DB_empleados{
        private $nombre; 
        private $username;

        public function userExists($user, $pass){
            $md5pass = md5($pass);

            $query = $this->connect()->prepare('SELECT * FROM user WHERE user_name = :user AND password = :pass');
            $query->execute(['user' => $user, 'pass' => $md5pass]);
            
            if($query->rowCount()){
                return true;
            } else{
                return false;
            }
        }

        //En esta funcion debo de tomar la información de la tabla empleados, comparando con el 
        //id que esta en el registro correspondiente...
        public function setUser($user){
            $query = $this->connect()->prepare('SELECT * FROM user WHERE user_name = :user');
            $query->execute(['user' => $user]);

            foreach($query as $currentUser){
                $this->username = $currentUser['user_name'];
            }
        }

        public function getName(){
            return $this->nombre;
        }
    }
?>