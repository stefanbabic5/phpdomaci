<?php
    include 'dbb.php';
    include 'predstavaServis.php';
    include 'scenaServis.php';
    include 'rasporedServis.php'
    class Controller{
        private $broker;
        private static $controller;
        private $predstavaServis;
        private $scenaServis;
        private function _construct(){
            $this->broker=new Broker ("localhost","root",'',"pozoriste");
        }

        public static function getController() {
            if(!isset($controller)){
                $controller=new Controller();
            }
            return $controller;
        }

        public function obradiZahtev() {
            try {
                return $this->vratiOdgovor($this->izvrsi());
            } catch (Exception $ex) {
                return $this->vratiGresku($ex->getMessage());
            }
        }

        private function izvrsi() {
            $akcija = $_GET["akcija"];
            $metoda = $_SERVER["REQUEST_METHOD"];
            if ($akcija="predstava.read") {
                if($metoda!="GET"){
                    throw new Exception("Akcija se poziva samo sa GET metodom!");
                }
                return $this->predstavaServis->vratiSve();
            }
            if ($akcija="predstava.create") {
                if($metoda!="POST"){
                    throw new Exception("Akcija se moze pozvati samo sa POST metodom!");
                }
                $this->predstavaServis->create($_POST["naziv"],$_POST["trajanje"],$_POST["ocena"]);
                return null;
            }
            if ($akcija="predstava.update") {
                if($metoda!="POST"){
                    throw new Exception("Akcija se moze pozvati samo sa POST metodom!");
                }
                $this->predstavaServis->update($_POST["id"],$_POST["naziv"],$_POST["trajanje"],$_POST["ocena"]);
                return null;
            }
            if ($akcija="predstava.delete") {
                if($metoda!="POST"){
                    throw new Exception("Akcija se moze pozvati samo sa POST metodom!");
                }
                $this->predstavaServis->delete($_POST["id"]);
                return null;
            }

            if ($akcija="scena.read") {
                if($metoda!="GET"){
                    throw new Exception("Akcija se moze pzovati samo sa GET metodom!");
                }
                return $this->scenaServis->vratiSve();
            }

            if ($akcija="raspored.read") {
                if($metoda!="GET"){
                    throw new Exception("Akcija se moze pzovati samo sa GET metodom!");
                }
                return $this->rasporedServis->vratiSve();
            }
            throw new Exception("Akcija nije podrzana");
        }

        private function vratiOdgovor($podaci) {
            if(!isset($podaci)) {
                return ["status"=true];
            }
            return [
                "status"=true,
                "data"=$podaci
            ];
        }

        private function vratiGresku($greska) {
            return [
                "status"=false,
                "error"=$greska
            ];
        }
    }
?>