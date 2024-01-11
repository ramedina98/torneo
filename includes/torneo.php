<?php 
    //here we get all the information from the torneo database...
    include_once 'db.php';

    class Torneo extends DB_torneo{
        private $deportes; 
        private $socios; 
        private $centros; 

        /*The next methods are the first one since they willl be basic to put
        them in the selects or to compare if the partner exisits in the 
        database to be able to participate in the tournaments...*/
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
        //partner...
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
        //centros...
        public function getCentro(){
            $query = $this->connect()->prepare('SELECT * FROM centro');
            $query->execute();

            try{
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                return $res;
            } catch(PDOException $e){
                echo 'Error al ejecutar la consulta' .$e->getMessage();
                return null;
            }
        }

        //The following methods are more specific and are totally dedicated to tournaments...
        
    }
?>