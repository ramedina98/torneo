<?php 

	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';

  use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;


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

	class SendEmail{

        public function __construct(){
            $this->userName = $_ENV['EMAIL_USER']; 
            $this->password = $_ENV['EMAIL_PASSWORD']; 
        }

        function envio($data, $correo){
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);
    
            try {
                
                //Server settings
                $mail->SMTPDebug = 2;
                $mail->isSMTP();                                    
                $mail->Host       = 'smtp.hostinger.com';          
                $mail->SMTPAuth   = true;            
                $mail->Username   = $this->userName; 
                $mail->Password   = $this->password;
                $mail->SMTPSecure = 'ssl';
                $mail->Port       = 465;

                $mail->setFrom("ricardo@abarrotesuniversidad.shop", "CoreFury Gym");
                $mail->addAddress($correo);
    
                //Content
                $mail->isHTML(true); 
                $mail->Subject = "Gracias por darte la oportunidad de cambiar tu vida";
                $mail->Body    =  '<!DOCTYPE html>
                <html lang="en">
                <head>
                  <meta charset="UTF-8">
                  <meta name="viewport" content="width=device-width, initial-scale=1.0">
                  <title>Título del Email</title>
                  <style>
                    body {
                      font-family: Arial, sans-serif;
                      margin: 0;
                      padding: 0;
                      background-color: #f4f4f4;
                    }
                
                    .email-container {
                      width: 100%;
                      max-width: 600px;
                      margin: 0 auto;
                      padding: 20px;
                      background-color: #ffffff;
                      text-align: center;
                    }
                
                    footer {
                      text-align: center;
                      padding: 10px;
                      background-color: #8098b1;
                      color: #ffffff;
                    
                    }
                  </style>
                </head>
                <body>
                  <div class="email-container">
                    <!-- Contenido del email aquí -->
                    <h1>Datos dados de alta </h1>
                        <a href="">
                            <img src="https://images.unsplash.com/photo-1593079831268-3381b0db4a77?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fGdpbW5hc2lvfGVufDB8fDB8fHww" alt="">
                        </a>
                        <p>Su incripcion a sido realizada con exito: '. $data['nombre'] .' '. $data['apellidoP'] .' '. $data['apellidoM'] .'</p>
                        <p>Le recordamos asistir 10 minutos antes de su torneo</p>
                        <ul style="list-style:none;">
                            <li style="color: rgb(0, 62, 105);"><p>' .$data['nombreTorneo']. '</p></li>
                            <li style="color: rgb(0, 62, 105);"><p>Fechas y hora: ' .$data['fecha']. '</p></li>
                            <li style="color: rgb(0, 62, 105);"><p>Instalaciones: ' .$data['centro']. '</p></li>
                        </ul>
                    <footer>
                        <p>Sigenos en nuestras redes sociales </p>
                            <a href="">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAWxJREFUSEvFlT1KBEEQhb+Njc01F8UL+HMMQVhNBQVPoN5AUWMVFsy9gHoD8QJqZGBuYKLzpGoYarvHtpdlC5alZ6bqvVd/PWDKNphyfGYGsAAMgQ375YS+2osH4ATwc/t9SsEOcFWROgW/NqAsgJi/VAR3F4HsNqql6NeiAjGXgv/YJrDeOBybk1QIJAkg9lKRMjmK4ZsFFBGdF42Up1XsBZoE+E5E7sqet/cfRuTezl1SDloMIDZfwLYxF4lHYAS8Z2rWpj7WICrwfF4Ce0HdBbDfgEqF2rlrxQAq1p0xXgpBnoEV4KhT4LHU/6VAnXFuLJcDwBOwOimAd8QZcBAAToFDG8rY2sUp8g76BLaANQNRkW+BOVMXm68YQI5j02nRVFhv02KAVEc4iNLly6xvCfYOWs2qiOx7V8Wky05gGszsstMHtetavpobKWgtd6NJiQZI/3FKY0r8HrgpvXAS+67+0czu5HrKwfMHAP9OGcBddWEAAAAASUVORK5CYII="/>
                            </a>
                            <a href="">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAATtJREFUSEu1lY0RwiAMhdNJ1EnUSdRJ1EnUSdRJdBT7esA9aALhznLn0Qrke/lpGGThMSxsXzyAnYhsRQQzft9xfoX5HZ5NnTXAWkRuwWjNUQD3ATjbZwHO485LR/gAuYvItTyjAbzGYRRe8oCoDFICcOBTUQ6jMAC1cbAgrJ84LyXg2Yj5Rol16TEg2DcNBhxDUi0HoBrq4oC3B6ouPoeko9IyQCv2HN+WmLSXPUBJ4qA1oD7GviUG6uFF5gGSW1YFw3oAKQ/sgQbIEma4ZhXGZJsB2kYPQBOWCoIBWlxjG4AYPHMFxWftu1EBaGTw4h9JTvnq+dC8SU4VVOYA77VW4QWkj0wD4D+rxj2AZrOL8dcgLQCvpzz2XDgWYNZBuUo8V2Zsanw9oqWsxq75sG6yCPEAKpXbXloc8AOPHlEZbVZaMAAAAABJRU5ErkJggg=="/>
                 
                            </a>
                      <p>Gracias por darte la oportunidad de cambiar tu vida </p>      
                      <p>©️ 2024 Tu Empresa. Todos los derechos reservados.</p>
                    </footer>
                  </div>
                </body>
                </html>';
            
    
                $mail->send();
                echo 'Message has been sent';
    
            } catch (Exception $e) {
                echo "Error: {$mail->ErrorInfo}";
            }
        }
    }
?>