<?php
    include 'dbb.php'
    class Controller{
        private $broker;
        private static $controller;

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