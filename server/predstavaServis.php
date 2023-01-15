<?php
class predstavaServis{
    private $broker;
    public function __construct($b) {
        $this->broker=$b;
    }
    public function vratiSve() {
        return $this->broker->ucitaj("select * from predstava");
    }

    public function create($naziv,$trajanje,$ocena) {
        $this->broker->upisi("insert into predstava(naziv, trajanje, ocena) values('".$naziv."',".$trajanje.",".$ocena.")");
    }
    public function update($id,$naziv,$trajanje,$ocena) {
        $this->broker->upisi("update predstava set naziv='".$naziv."',trajanje=".$trajanje.",ocena=".$ocena." where id=".$id);
    }
    public function delete($id) {
        try{$this->broker->upisi("delete from predstava where id=".$id);}
        catch(Exception $e) {throw new Exception("Ne moze se obrisati predstava dok postoji termin za nju!");}
    }
}
?>