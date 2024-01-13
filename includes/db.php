<!--this is the code for the connection to the database...-->
<?php
    //We go through the whole process to use the environment variables
    require __DIR__ . '/../vendor/autoload.php'; // Asegúrate de agregar '/../' para subir un nivel y acceder a la carpeta 'vendor'.
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