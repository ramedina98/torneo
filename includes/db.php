<!--this is the code for the connection to the database...-->
<?php
    class DB_torneo{
        private $host; 
        private $db; 
        private $user; 
        private $password; 
        private $charset; 

        public function __construct(){
            $this->host = 'localhost';
            $this->db = 'torneos';
            $this->user = 'root';
            $this->password = "";
            $this->charset = 'utf8mb4';
        }

        function connect(){
            try{
                $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];

                $pdo = new PDO($connection, $this->user, $this->password, $options);
        
                return $pdo;

            }catch(PDOException $e){
                die("Error connection: " . $e->getMessage()); 
                return false;
            }
        }
    }
    
    class DB_empleados{
        private $host; 
        private $db; 
        private $user; 
        private $password; 
        private $charset; 

        public function __construct(){
            $this->host = 'localhost';
            $this->db = 'empleados';
            $this->user = 'root';
            $this->password = "";
            $this->charset = 'utf8mb4';
        }

        function connect(){
            try{
                $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];

                $pdo = new PDO($connection, $this->user, $this->password, $options);
        
                return $pdo;

            }catch(PDOException $e){
                die("Error connection: " . $e->getMessage()); 
                return false;
            }
        }
    }

    /*
    $database1 = new DB_torneo();
    $database2 = new DB_empleados();

    $pdo_connection = $database1->connect();
    $pdo_connection2 = $database2->connect();

    if ($pdo_connection && $pdo_connection2) {
        echo 'Conexión exitosa a ambas bases de datos';
    } else {
        echo 'Fallo la conexión...';
    }
    */
?>