<?php
class rasporedServis{
    private $broker;
    public function __construct($b) {
        $this->broker=$b;
    }
    public function vratiSve() {
        $data=$this->broker->ucitaj("select r.*, s.naziv as 'naziv_scene', p.naziv as 'naziv_predstave', p.trajanje, p.ocena from raspored r inner join scena s on (s.id=r.scena_id) inner join predstava p on (p.id=r.predstava_id)");
        $res=[];
        foreach($data as $element){
            $res[]=[
                "id"=>intval($element->id),
                "cena"=>doubleval($element->cena),
                "datum"=>$element->datum,
                "predstava"=>[
                    "id"=>intval($element->predstava_id),
                    "naziv"=>$element->naziv_predstave,
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

    public function create($predstavaID,$scenaID,$cena,$datum) {
        $predstava=$this->broker->ucitaj("select * from predstava where id=".$predstavaID)[0];
        $trajanje=intval($predstava->trajanje);
        $raspored=$this->broker->ucitaj("select r.*, p.trajanje from raspored r inner join predstava p on (p.id=r.predstava_id) where scena_id=".$scenaID);
        $vreme=strtotime($datum);
        $kraj=$vreme+$trajanje*60;
        foreach($raspored as $stavkaRasporeda) {
            $pocetakPredstave=strtotime($stavkaRasporeda->datum);
            $krajPredstave=$pocetakPredstave+intval($stavkaRasporeda->trajanje)*60;
            if($scenaID==intval($stavkaRasporeda->scena_id) &&
                (($pocetakPredstave>=$vreme && $pocetakPredstave<=$kraj)||($krajPredstave>$vreme && $krajPredstave<=$kraj))){
                    throw new Exception("Scena je zauzeta u trazenom terminu!");
                }
        }
        $this->broker->upisi("insert into raspored(predstava_id,scena_id,cena,datum) values(".$predstavaID.",".$scenaID.",".$cena.",'".$datum."')");
    }

    public function delete($id) {
        $this->broker->upisi("delete from raspored where id=".$id);
    }
}
?>