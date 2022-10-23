<?php
    include 'dbb.php';
    include 'predstavaServis.php';
    include 'scenaServis.php';
    include 'rasporedServis.php';
    class Controller{
        private $broker;
        private $predstavaServis;
        private $scenaServis;
        private $rasporedServis;
        private static $controller;
        private function __construct(){
            $this->broker=new broker ("localhost","root",'',"pozoriste");
            $this->predstavaServis=new predstavaServis($this->broker);
            $this->scenaServis=new scenaServis($this->broker);
            $this->rasporedServis=new rasporedServis($this->broker);
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
            if ($akcija=="predstava.read") {
                if($metoda!="GET"){
                    throw new Exception("Akcija se poziva samo sa GET metodom!");
                }
                return $this->predstavaServis->vratiSve();
            }
            if ($akcija=="predstava.create") {
                if($metoda!="POST"){
                    throw new Exception("Akcija se moze pozvati samo sa POST metodom!");
                }
                $this->predstavaServis->create($_POST["naziv"],$_POST["trajanje"],$_POST["ocena"]);
                return null;
            }
            if ($akcija=="predstava.update") {
                if($metoda!="POST"){
                    throw new Exception("Akcija se moze pozvati samo sa POST metodom!");
                }
                $this->predstavaServis->update($_POST["id"],$_POST["naziv"],$_POST["trajanje"],$_POST["ocena"]);
                return null;
            }
            if ($akcija=="predstava.delete") {
                if($metoda!="POST"){
                    throw new Exception("Akcija se moze pozvati samo sa POST metodom!");
                }
                $this->predstavaServis->delete($_POST["id"]);
                return null;
            }

            if ($akcija=="scena.read") {
                if($metoda!="GET"){
                    throw new Exception("Akcija se moze pozvati samo sa GET metodom!");
                }
                return $this->scenaServis->vratiSve();
            }

            if ($akcija=="raspored.read") {
                if($metoda!="GET"){
                    throw new Exception("Akcija se moze pozvati samo sa GET metodom!");
                }
                return $this->rasporedServis->vratiSve();
            }
            if ($akcija=="raspored.create") {
                if($metoda!="POST"){
                    throw new Exception("Akcija se moze pozvati samo sa POST metodom!");
                }
                $this->rasporedServis->create($_POST["predstavaID"],$_POST["scenaID"],$_POST["cena"],$_POST["datum"]);
                return null;
            }
            if ($akcija=="raspored.delete") {
                if($metoda!="POST"){
                    throw new Exception("Akcija se moze pozvati samo sa POST metodom!");
                }
                $this->rasporedServis->delete($_POST["id"]);
                return null;
            }
            throw new Exception("Akcija nije podrzana!");
        }

        private function vratiOdgovor($podaci) {
            if(!isset($podaci)) {
                return ["status"=>true];
            }
            return [
                "status"=>true,
                "data"=>$podaci
            ];
        }

        private function vratiGresku($greska) {
            return [
                "status"=>false,
                "error"=>$greska
            ];
        }
    }
?>