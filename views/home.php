<?php 
  //iniciamos la session...
  session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Torneos</title>
  <!--TODO: desarrollar esto...-->
  <meta name="description" content="¡Regístrate para participar en los emocionantes torneos deportivos ofrecidos por el Gimnasio NombreDelGimnasio! Encuentra información detallada sobre los eventos, deportes en competición, condiciones de participación y más. ¡Explora nuestro calendario de torneos y únete a la acción deportiva!">
  <meta name="keywords" content="torneos deportivos, registro de torneos, deportes en competición, condiciones de participación, gimnasio, actividades deportivas, calendario de torneos, inscripciones a eventos deportivos">

  <!-- Favicons -->
  <link href="assets/img/icon.ico" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="style/css/style.css" rel="stylesheet">
  <!-- custom styles--> 
  <link rel="stylesheet" href="./style/main.css">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">CoreFury Gym</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <!-- TODO: checar si es necesario esta barra de busqueda...
    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div> End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <!--TODO: creo que esto si estaria chido conservarlo, solo hay que
        encontrarle una funcionalidad real...-->
        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Anna Nelson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>6 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>David Muldon</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>8 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <!--Aquí tenemos los datos del usuario en el header-->
            <?php 
              //verificamos si existe la variable sesion 'userData' y si tiene datos...
              if(isset($_SESSION['userData']) && !empty($_SESSION['userData'])){
                //obtener los datos del usuario de la sesion...
                $userData = $_SESSION['userData'];

                //ahora podemos acceder a los datos del usuario como un array...
                if (is_array($userData) && isset($userData['nombre'])) {

                    $cadena = $userData['nombre'];
                    //verificamos si la cadena no esta vacia...
                    if(!empty($cadena)){
                      //obtenemos la primera letra de la cadena y la convertimos en mayuscula...
                      $primeraLetra = strtoupper($cadena[0]);

                      $inicialMayuscula = $primeraLetra;
                    } else{
                      $inicialMayuscula = '';//si la cadena vacia se retorna una cadena vacia...
                    }
                    echo "<img src='assets/img/{$userData['nombre']}_{$userData['apellido_p']}.jpg' alt='Profile' class='rounded-circle'>";
                    echo "<span class='d-none d-md-block dropdown-toggle ps-2'>{$inicialMayuscula}. {$userData['apellido_p']}</span>";
                } else {
                    echo "<span class='d-none d-md-block dropdown-toggle ps-2'>Nombre no disponible</span>";
                }
              } else{
                //ahora podemos acceder a los datos del usuario como un array...
                echo '<span class="d-none d-md-block dropdown-toggle ps-2">Nombre</span>';
              }
            ?>
          </a><!-- End Profile Iamge Icon -->
          <!--NOTE: a excepcion del boton de sign out, todos los demas no tendran
            funcionalidad...-->
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <!--Aquí va el nombre dentro del drop down menu...-->
              <?php 
                //verificamos si existe la variable sesion 'userData' y si tiene datos...
                if(isset($_SESSION['userData']) && !empty($_SESSION['userData'])){
                  echo "<h6>{$userData['nombre']} {$userData['apellido_p']}</h6>";
                  echo "<span>{$userData['puesto']}</span>";
                }
              ?>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>Mi perfil</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Ajustes de la cuenta</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Ayuda</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="includes/logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Salir</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav navegador" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="#inicio" id="inicio">
          <i class="bi bi-grid"></i>
          <span>Inicio</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="#participantes" id="participantes">
          <i class="bi bi-person"></i><span>Participantes</span>
        </a>
      </li><!-- End Participantes Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="#torneos" id="torneos">
          <i class="bi bi-dice-2-fill"></i><span>Torneos</span>
        </a>
      </li><!-- End Torneos Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="#centros" id="centros">
          <i class="bi bi-building-fill"></i><span>Centros</span>
        </a>
      </li><!-- End Centros Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="#deportes" id="deportes">
          <i class="bi bi-dribbble"></i><span>Deportes</span>
        </a>
      </li><!-- End Deportes Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
    <!--TODO: esto va a ser dinamico, tiene que cambiar conforme a 
    la seccion donde estes...-->
    <div class="pagetitle">
      <h1 id="title"></h1>
    </div><!-- End Page Title -->

      <!--Principal-->
    <section class="section" id="container_components">
      <!--Here we inject the components...-->
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>CoreFury Gym</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Powered by <a href="https://www.unedl.edu.mx/portal/" target="_blank">UNEDL</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="logic/js/main.js"></script>
  <!--Jquery-->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="./logic/main.js"></script>
  <script src="./logic/components.js"></script>
</body>

</html>