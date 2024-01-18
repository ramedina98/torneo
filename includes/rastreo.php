<?php
    /*here is the code to track the browser, operating system
    and user's IP address... */

    class Rastreo{

        function obtenerSistemaOperativo() {
            $userAgent = $_SERVER['HTTP_USER_AGENT'];
            $userAgent = strtolower($userAgent);
    
            $sistemaOperativo = "Desconocido";
    
            if (strpos($userAgent, "windows") !== false) {
                $sistemaOperativo = "Windows";
            } else if (strpos($userAgent, "linux") !== false) {
                $sistemaOperativo = "Linux";
            } else if (strpos($userAgent, "macintosh") !== false) {
                $sistemaOperativo = "Mac OS";
            } else if(strpos($userAgent, "iphone") !== false){
                $sistemaOperativo = "Iphone";
            }
            return $sistemaOperativo;
        }
    
        function obtenerNavegador() {
            $userAgent = $_SERVER['HTTP_USER_AGENT'];
            $userAgent = strtolower($userAgent);
    
            $navegador = "Desconocido";
    
            if (strpos($userAgent, "version") !== false) {
                $navegador = "Safari";
            } else if (strpos($userAgent, "firefox") !== false) {
                $navegador = "Firefox";
            } else if (strpos($userAgent, "chrome") !== false || strpos($userAgent, "crios") !== false) {
                $navegador = "Google Chrome";
            } else if (strpos($userAgent, "msie") !== false || strpos($userAgent, "trident") !== false) {
                $navegador = "Internet Explorer";
            }
    
            return $navegador;
        }
    
        function obtenerDireccionIP() {
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                return $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                return $_SERVER['REMOTE_ADDR'];
            }
        }
    
        function obtenerFechaHoraLocal() {
            // Set the time zone...
            date_default_timezone_set('America/Mexico_City'); 
        
            // Get the current date...
            $fechaHoraActual = date('Y/m/d H:i:s');
        
            return $fechaHoraActual;
        }
    
        function trackingInformation($empleado, $puesto) {

            $sistema = $this->obtenerSistemaOperativo();
            $navegador = $this->obtenerNavegador();
            $ip = $this->obtenerDireccionIP();
            $fecha = $this->obtenerFechaHoraLocal();

            $data = [
                'sistema' => $sistema,
                'navegador' => $navegador,
                'ip' => $ip, 
                'datetime' => $fecha, 
                'empleado' => $empleado,
                'puesto' => $puesto
            ];
        
            return $data;
        }
    }

?>