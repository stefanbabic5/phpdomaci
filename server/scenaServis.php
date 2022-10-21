<?php
class scenaServis{
    private $broker;
    public function _construct($b) {
        $this->broker=$b;
    }
    public function vratiSve() {
        return $this->broker->ucitaj("select * from scena");
    }  
}
?>