<?php
class rasporedServis{
    private $broker;
    public function _construct($b) {
        $this->broker=$b;
    }
    public function vratiSve() {
        $data=$this->broker->ucitaj("select r.*, s.naziv as 'naziv_scene', p.naziv as 'naziv_predstave', p.trajanje, p.ocena
        from raspored r
        inner join scena s on (s.id=r.scena_id)
        inner join predstava p on (p.id=r.predstava_id");
        $res=[];
        foreach($data as $element){
            $res[]=[
                "id"=>intval($element->id),
                "cena"=>doubleval($element->cena),
                "datum"=>$element->datum,
                "predstava"=>[
                    "id"=>intval($element->predstava_id),
                    "naziv"=>$element->naziv_filma,
                    "trajanje"=>intval($element->trajanje),
                    "ocena"=>doubleval($element->ocena)
                ],
                "scena"=>[
                    "id"=>intval($element->scena),
                    "naziv"=>$element->naziv_scene
                ]
            ];
        }
        return $res;
    }
}
?>