<?php 
    //here we get all the information from the torneo database...
    include_once 'db.php';

    class Torneo extends DB_torneo{
        private $deportes; 
        private $socios; 
        private $centros; 

        //GET

        //sports...
        public function getDeportes(){
            $query = $this->connect()->prepare('SELECT * FROM deportes');
            $query->execute();

            try{
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                return $res;
            } catch(PDOException $e){
                echo 'Error al ejecutar la consulta' . $e->getMessage();
                return null; 
            }
        }

        //partners...
        public function getSocios(){
            $query = $this->connect()->prepare('SELECT * FROM socio');
            $query->execute();

            try{
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                return $res;
            } catch(PDOException $e){
                echo 'Error al ejecutar la consulta' .$e->getMessage();
                return null;
            }
        }

        //partner...
        public function getSocio($id){
            try{
                $query = $this->connect()->prepare('SELECT nombre, apellidoP, apellidoM FROM socio WHERE idsocio = :id');
                $query->execute(['id' => $id]);

                $res = $query->fetch(PDO::FETCH_ASSOC);
                return $res;
            } catch(Exception $e){
                echo 'Error: ' . $e->getMessage();
            }
        }

        //centers...
        public function getCentro(){
            $query = $this->connect()->prepare('SELECT ic.idinstalacionesCentro, ic.instalacion, c.nombre AS nombre_centro
            FROM instalacionesCentro AS ic
            INNER JOIN centro AS c ON ic.centro = c.idcentro;');
            
            $query->execute();

            try{
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                return $res;
            } catch(PDOException $e){
                echo 'Error al ejecutar la consulta' .$e->getMessage();
                return null;
            }
        }
        
        //a specific center...
        public function getInstalacion($id){
            try{
                $query = $this->connect()->prepare('SELECT 
                        ic.idinstalacionesCentro, 
                        c.idcentro,
                        c.nombre AS nombre_centro,
                        c.calle AS calle_centro,
                        c.numExt AS numExt_centro,
                        c.numInt AS numInt_centro,
                        c.colonia AS colonia_centro,
                        c.cp AS cp_centro,
                        c.municipio AS municipio_centro,
                        c.estado AS estado_centro,
                        i.idinstalacion,
                        i.dias_abierto,
                        i.horario,
                        i.telefono,
                        i.email
                    FROM instalacionesCentro AS ic
                    INNER JOIN centro AS c ON ic.centro = c.idcentro
                    INNER JOIN instalaciones AS i ON ic.instalacion = i.idinstalacion
                    WHERE c.idcentro = :id');
                    
                $query->execute(['id' => $id]);

                $res = $query->fetch(PDO::FETCH_ASSOC);
                return $res;
                
            } catch(Exception $e){
                echo 'Error: ' . $e->getMessage();
            }
        }

        //The following methods are more specific and are totally dedicated to tournaments...
        //tournament participants...
        public function getParticipantes(){
            $query = $this->connect()->prepare('SELECT 
                IT.idinscritoTorneo,
                S.idsocio,
                S.nombre AS nombreSocio,
                S.apellidoP,
                S.apellidoM,
                IT.cuota,
                IT.statusPago,
                IT.nombreEquipo,
                IT.torneo AS idTorneo,
                T.nombre AS nombreTorneo, 
                T.precio_torneo AS precio
            FROM inscritoTorneo AS IT
            JOIN socio AS S ON IT.socio = S.idsocio
            JOIN torneo AS T ON IT.torneo = T.idtorneo;');
            $query->execute();

            try{
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                return $res;
            } catch(PDOException $e){
                echo 'Error al ejecutar la consulta' .$e->getMessage();
                return null;
            }
        }

        //search and obtain info from a participant...
        public function getParticipante($id){
            $query = $this->connect()->prepare('SELECT * FROM inscritoTorneo WHERE idinscritoTorneo = :id');
            $query->execute(['id' => $id]);

            try{
                $res = $query->fetch(PDO::FETCH_ASSOC);
                return $res;
            } catch(PDOException $e){
                echo 'Error al ejecutar la consulta' .$e->getMessage();
                return null;
            }
        }

        //existing tournaments...
        public function getTorneos(){
            $query = $this->connect()->prepare('SELECT
                T.idtorneo,
                T.nombre AS nombre_torneo,
                D.nombre AS nombre_deporte,
                T.precio_torneo AS precio,
                T.limite,
                T.numero_de_inscritos AS inscritos,
                T.precio_torneo AS precio,
                T.fechainicio AS fechainicio,
                C.nombre AS nombre_centro,
                C.idcentro
            FROM
                torneo T
            JOIN
                deportes D ON T.deporte = D.iddeporte
            JOIN
                instalacionesCentro IC ON T.instalacionesCentro = IC.idinstalacionesCentro
            JOIN
                centro C ON IC.centro = C.idcentro;');
            $query->execute();

            try{
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                return $res;
            } catch(PDOException $e){
                echo 'Error al ejecutar la consulta' .$e->getMessage();
                return null;
            }
        }
        
        //get an specific tournament...
        public function getTorneo($id){
            $query = $this->connect()->prepare('SELECT * FROM torneo WHERE idtorneo = :id');

            $query->execute(['id' => $id]);

            try{
                $res = $query->fetch(PDO::FETCH_ASSOC);
                return $res;
            } catch(PDOException $e){
                echo 'Error al ejecutar la consulta' .$e->getMessage();
                return null;
            }
        }
        
        /*need to obtain the information of a specific tournament and the participants that are in it...*/
        public function getTorneParticipantes($id){
            $query = $this->connect()->prepare('SELECT T.nombre, T.limite, T.fechainicio, 
            T.precio_torneo, T.numero_de_inscritos,
            C.idcentro, D.nombre as nombre_deporte, 
            C.nombre AS nombre_centro, 
            IT.nombreEquipo, IT.idinscritoTorneo,
            S.nombre AS nombre_socio, S.apellidoP AS apellido_paterno, 
            S.apellidoM AS apellido_materno, 
            S.idsocio
            FROM torneo AS T
            JOIN deportes AS D ON T.deporte = D.iddeporte
            JOIN instalacionesCentro AS I ON T.instalacionesCentro = I.idinstalacionesCentro
            JOIN centro AS C ON I.centro = C.idcentro
            LEFT JOIN inscritoTorneo AS IT ON T.idtorneo = IT.torneo
            LEFT JOIN socio AS S ON IT.socio = S.idsocio
            WHERE T.idtorneo = :id');

            $query->execute(['id' => $id]);

            try{
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                return $res;
            } catch(PDOException $e){
                echo 'Error al ejecutar la consulta' .$e->getMessage();
                return null;
            }
        }

        /*in this function, we retrive specific information required to send an email expressing
        gratitude to the partnert for registering in the tournament that she/he chose...
        
        we need: 
        1. Name and surname.
        2. tournament name. 
        3. tournamen date. 
        4. name of the center where the tournament will be held.

        getRegistroInfo() = getRegistrationData();
        */
        public function getRegistroInfo($ids){
            $idSocio = $ids['idSocio'];
            $idTorneo = $ids['idTorneo'];

            try{
                $query = $this->connect()->prepare('SELECT S.nombre, S.apellidoP, S.apellidoM,
                T.nombre AS nombre_torneo, T.fechainicio AS fecha,
                C.nombre AS nombre_centro
                FROM socio AS S
                JOIN inscritoTorneo AS IT ON S.idsocio = IT.socio AND IT.torneo = :idtorneo
                JOIN torneo AS T ON IT.torneo = T.idtorneo
                JOIN instalacionesCentro AS IC ON T.instalacionesCentro = IC.idinstalacionesCentro
                JOIN centro AS C ON IC.centro = C.idcentro
                WHERE S.idsocio = :id');

                $query->execute([
                    'id' => $idSocio,
                    'idtorneo' => $idTorneo
                ]);

                $res = $query->fetch(PDO::FETCH_ASSOC);
                return $res;

            } catch(Exception $e){
                echo 'Error: ' . $e->getMessage();
            }
        }

        //POST...
        //registration of a new participant...
        public function postParticipante($data){
            try{
                //we prepare the data obtained by the form...
                $idSocio = (int)$data['idsocio'];
                $cuota = (double)$data['cuota'];
                $estatusPago = (int)$data['estatus'];
                $nombreEquipo = $data['nombreEquipo'];
                $torneo = (int)$data['torneo'];

                //send the data...
                $query = $this->connect()->prepare("INSERT INTO inscritoTorneo (socio, cuota, statusPago, nombreEquipo, torneo)
                VALUES('$idSocio', '$cuota', '$estatusPago', '$nombreEquipo', '$torneo')");
                $query->execute();

                echo 'Participante inscrito con exito.';

            } catch(Exception $e){
                echo 'Error: ' . $e->getMessage();
            }
        }

        //registration of a new tournament...
        public function postTorneo($data){
            try{
                //we prepare the data obtained by the form...
                $nombre = $data['nombre'];
                $deporte = (int)$data['deporte'];
                $limite = (int)$data['limite'];
                $fechainicio = $data['fechainicio'];
                $instalacionCentro = (int)$data['instalacionesCentro'];
                $precio = (double)$data['precioTorneo'];

                //send the data...
                $query = $this->connect()->prepare("INSERT INTO torneo (nombre, deporte, limite, fechainicio, instalacionesCentro, precio_torneo)
                        VALUES(:nombre, :deporte, :limite, :fechainicio, :instalacionCentro, :precio)");
                $query->execute([
                    'nombre' => $nombre,
                    'deporte' => $deporte,
                    'limite' => $limite,
                    'fechainicio' => $fechainicio,
                    'instalacionCentro' => $instalacionCentro, 
                    'precio' => $precio
                ]);


                echo 'Torneo inscrito con exito.';

            } catch(Exception $e){
                echo 'Error: ' . $e->getMessage();
            }
        }

        //account login tracking
        /*who, on what device (OS), browser and location logged in...*/
        public function postRastreo($data){
            try{
                //I prepare the info...
                $sistemaOp = $data['sistema']; 
                $navegador = $data['navegador'];
                $usuarioIp = $data['ip'];
                $horaFecha = $data['datetime'];
                $empleado = $data['empleado'];
                $puesto = $data['puesto'];

                //we create the corresponding query...
                $query = $this->connect()->prepare("INSERT INTO rastreo (navegador, direccionIp, dispo_sistema, empleado, puesto, fecha)
                VALUES(:nav, :ip, :sistema, :empleado, :puesto, :fecha)");
                //execute the query...
                $query->execute([
                    'nav' => $navegador, 
                    'ip' => $usuarioIp, 
                    'sistema' => $sistemaOp, 
                    'empleado' => $empleado,
                    'puesto' => $puesto,
                    'fecha' => $horaFecha
                ]);

            } catch(Exception $e){

                echo 'Error: ' . $e->getMessage();
            }
        }

        //UPDATE...
        public function updateParticipante($data){
            try{
                //we prepare the data obtained by the form...
                $idstorneo = (int)$data['idinscritoTorneo'];
                $idSocio = (int)$data['idsocio'];
                $cuota = (double)$data['cuota'];
                $estatusPago = (int)$data['estatus'];
                $nombreEquipo = $data['nombreEquipo'];
                $torneo = (int)$data['torneo'];

                $query = $this->connect()->prepare('UPDATE inscritoTorneo 
                SET socio = :idSocio,
                    cuota = :cuota,
                    statusPago = :estatusPago,
                    nombreEquipo = :nombreEquipo,
                    torneo = :torneo
                WHERE idinscritoTorneo = :idstorneo');
                $query->execute([
                    'idstorneo' => $idstorneo,
                    'idSocio' => $idSocio,
                    'cuota' => $cuota,
                    'estatusPago' => $estatusPago,
                    'nombreEquipo' => $nombreEquipo,
                    'torneo' => $torneo,
                ]);

                echo 'actualizado con exito';
            } catch(Exception $e){
                echo 'Error: ' . $e->getMessage();
            }
        }

        public function updateTorneo($data){
            try{
                //we prepare the data obtained by the form...
                $idtorneo = (int)$data['idtorneo'];//registration id...
                $nombre = $data['nombre']; //the name of the tournament...
                $deporte = (int)$data['deporte']; //sport id...
                $limite = (int)$data['limite'];//maximun number of participants...
                $fecha = $data['fechainicio'];//event start date and time...
                $instalacionCentro = (int)$data['instalacionesCentro'];//center id...
                $precio = (double)$data['precioTorneo'];

                $query = $this->connect()->prepare('UPDATE torneo 
                SET nombre = :nombre,
                    deporte = :deporte,
                    limite = :limite,
                    fechainicio = :fechainicio,
                    instalacionesCentro = :instalacionCentro, 
                    precio_torneo = :precio
                WHERE idtorneo = :idtorneo');
                $query->execute([
                    'idtorneo' => $idtorneo,
                    'nombre' => $nombre,
                    'deporte' => $deporte,
                    'limite' => $limite,
                    'fechainicio' => $fecha,
                    'instalacionCentro' => $instalacionCentro,
                    'precio' => $precio
                ]);

                echo 'actualizado con exito';

            } catch(Exception $e){
                echo 'Error: ' . $e->getMessage();
            }
        }

        //DELETE...
        public function deleteParticipante($id){
            try{
                $query = $this->connect()->prepare("DELETE FROM inscritoTorneo WHERE idinscritoTorneo = $id");
                $query->execute();

                echo 'Borrado con exito.';

            } catch (Exception $e){
                echo 'Error: ' . $e->getMessage();
            }
        }

        public function deleteTorneo($id){
            try{
                $query = $this->connect()->prepare("DELETE FROM torneo WHERE idtorneo = $id");
                $query->execute();

                echo 'Borrado exitoso.';

            } catch(Exception $e){
                echo 'Error: ' . $e->getMessage();
            }
        }
    }
?>