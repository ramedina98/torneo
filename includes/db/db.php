<?php
    //We go through the whole process to use the environment variables
    require __DIR__ . '/../../vendor/autoload.php'; 
    use Dotenv\Dotenv;
    //this try catch is to make sure that everything is ok and we will not get any errors...
    try {
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();
    } catch (Exception $e) {
        die("Error loading Dotenv: " . $e->getMessage());
    }

    //classes start here...
    class DB_torneo{
        private $host; 
        private $db; 
        private $user; 
        private $password; 
        private $charset; 

        public function __construct(){
            $this->host = $_ENV['DB_HOST_TORNEOS'];
            $this->db = $_ENV['DB_TABLE_TORNEOS'];
            $this->user = $_ENV['DB_USER_TORNEOS'];
            $this->password = $_ENV['DB_PASSWORD_TORNEOS'];
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
            $this->host = $_ENV['DB_HOST_EMPLEADOS'];
            $this->db = $_ENV['DB_TABLE_EMPLEADOS'];
            $this->user = $_ENV['DB_USER_EMPLEADOS'];
            $this->password = $_ENV['DB_PASSWORD_EMPLEADOS'];
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
?>