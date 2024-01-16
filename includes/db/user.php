<!--Here we validate that the user exist and obtain his/her data...-->
<?php
    include_once 'db.php';
    //we create our class and extend it...
    class User extends DB_empleados{ 
        private $username;
        private $id_worker;

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
                //actually it is not the name, it is the id of the worker...
                $this->id_worker = $currentUser['id_trabajador'];
            }
        }

        public function getName(){
            $query = $this->connect()->prepare('SELECT * FROM empleado WHERE id_empleado = :id');
            $query->execute(['id' => $this->id_worker]);
        
            // Fetching the data
            $result = $query->fetch(PDO::FETCH_ASSOC);
        
            if ($result) {
                $requiredData = [
                    'nombre' => $result['nombre'],
                    'apellido_p' => $result['apellido_p'],
                    'apellido_m' => $result['apellido_m'],
                    'puesto' => $result['puesto']
                ];
        
                return $requiredData;
            } else {
                return null; // O devuelve un valor por defecto, o maneja este caso según tu lógica de la aplicación
            }
        }

        public function sentDataUserTable($data){
            //check if the form has been sent through the post method...
            if($data !== null) {
                //Collect data from the array...
                $name = $data['name'];
                $last_p = $data['last_p'];
                $last_m = $data['last_m'];
                $username = $data['username'];
                $password = $data['password'];

                //sql query to insert the data in the corresponding table...
                try{
                    /*First I have to make suer that the employee exists in the
                    employee table... */
                    //query to search the employee in the employee table...
                    $stmt_empleado = $this->connect()->prepare('SELECT * FROM empleado WHERE nombre = :nom AND apellido_p = :last_p AND apellido_m = :last_m');
                    $stmt_empleado->bindParam(':nom', $name); 
                    $stmt_empleado->bindParam(':last_p', $last_p); 
                    $stmt_empleado->bindParam(':last_m', $last_m); 
                    $stmt_empleado->execute();
                    $empleado_existente = $stmt_empleado->fetch();

                    if(!$empleado_existente){
                        /*We return 1 to indicate that the employuee does not exits
                        int that employee database...*/
                        return 1;
                    } else{
                        //we get the id of the employee...
                        $id_employee = $empleado_existente['id_empleado'];
                        /*If it does exist, now we must verify if the employee already has an 
                        account, if not, we contunue to register him/her...*/
                        $stmt_user = $this->connect()->prepare("SELECT * FROM user WHERE id_trabajador = :id_trabajador");
                        $stmt_user->bindParam(':id_trabajador', $id_employee);
                        $stmt_user->execute();
                        $usuario_existente = $stmt_user->fetch();

                        if ($usuario_existente) {
                            /*We return 2 to indicate that the employee already has
                            an account...*/
                            return 2;
                        } else {
                            //we encode the password before it is saved...
                            $passMd5 = md5($password);
                            //send the data to the user table...
                            $sql_insert = "INSERT INTO user (user_name, `password`, id_trabajador) VALUES (:username, :pass, :id_trabajador)";
                            $stmt_insert = $this->connect()->prepare($sql_insert);
                            $stmt_insert->bindParam(':username', $username);
                            $stmt_insert->bindParam(':pass', $passMd5);
                            $stmt_insert->bindParam(':id_trabajador', $id_employee);

                            try {
                                $stmt_insert->execute();
                                /*We return 3 to indicate that the registration was made 
                                successfully.*/
                                return 3;
                            } catch (PDOException $e) {
                                echo "Error al insertar el registro: " . $e->getMessage();
                            }
                        }
                    }

                }catch(PDOException $e){
                    //Show error menssage if something went wrong
                    echo "Error al buscar al empleado: " . $e->getMessage();
                } 
            } else {
                echo 'No se han recibido datos.';
            }
        }
    }
?>