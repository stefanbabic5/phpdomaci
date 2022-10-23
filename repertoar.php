<?php
    include 'header.php';
?>

<div class="container mt-4">
    <h1>Zakazani termini</h1>
    <div class="row mt-3">
        <div class="col-8">
            <table class="mt-3 table table-dark">
                <thead>
                    <tr>
                        <th>Naziv predstave</th>
                        <th>Cena ulaznice</th>
                        <th>Trajanje predstave</th>
                        <th>Ocena/kritika</th>
                        <th>Scena</th>
                        <th>Pocetak</th>
                    </tr>
                </thead>
                <tbody id='repertoar'>

                </tbody>
            </table>
        </div>
        <div class="col-4">
            <h3 class="text-center">Kreiraj termin za predstavu</h3>
            <form id='forma'>
                <label>Cena karte</label>
                <input class="form-control" type="number" step="any" min='0' id='cena'>
                <label>Datum odrzavanja</label>
                <input class="form-control" type="datetime-local" id='datum'>
                <label>Predstava</label>
                <select class="form-control" id='predstava'></select>
                <label>Scena</label>
                <select class="form-control" id='scena'></select>
                <button class="btn btn-primary form-control mt-2">Kreiraj</button>
            </form>
        </div>
    </div>
</div>
<script>
    let raspored = [];
    $(document).ready(function () {
        ucitajRaspored();
        $("#forma").submit(function (e) {
            e.preventDefault();
            const cena=$("#cena").val();
            const datum=$("#datum").val();
            const predstava=$("#predstava").val();
            const scena=$("#scena").val();
            $.post("./server/index.php?akcija=raspored.create",{
                predstavaID: predstava,
                scenaID: scena,
                datum,
                cena
            }, function(res) {
                res=JSON.parse(res);
                if(!res.status) {
                    alert(res.error);
                }
                ucitajRaspored();
            })
        })
        $.getJSON("./server/index.php?akcija=predstava.read",function (res){
            if(!res.status) {
                alert(res.error);
                return;
            }
            for (let predstava of res.data) {
                $("#predstava").append(`
                <option value="${predstava.id}">${predstava.naziv}</option>
                `)
            }
        })
        $.getJSON("./server/index.php?akcija=scena.read",function (res){
            if(!res.status) {
                alert(res.error);
                return;
            }
            for(let scena of res.data) {
                $("#scena").append(`
                <option value="${scena.id}">${scena.naziv}</option>
                `)
            }
        })
    })

    function ucitajRaspored() {
        $.getJSON("./server/index.php?akcija=raspored.read", function(res) {
            if(!res.status) {
                alert(res.error);
                return;
            }
            raspored=res.data;
            popuniTabelu();
        });
    }

    function popuniTabelu() {
        $("#repertoar").html('');
        for (let stavkaRasporeda of raspored) {
            $("#repertoar").append(`
                <tr>
                    <td>${stavkaRasporeda.predstava.naziv}</td>
                    <td>${stavkaRasporeda.cena}</td>
                    <td>${stavkaRasporeda.predstava.trajanje}</td>
                    <td>${stavkaRasporeda.predstava.ocena}</td>
                    <td>${stavkaRasporeda.scena.naziv}</td>
                    <td>${stavkaRasporeda.datum}</td>
                    <td><button class='btn btn-danger width-100' onClick="obrisi(${stavkaRasporeda.id})">Obrisi</button></td>
                </tr>
            `)
        }
    }
    function obrisi(id) {
        $.post("./server/index.php?akcija=raspored.delete",{id},function(res) {
            res=JSON.parse(res);
            if(!res.status){
                alert(res.error);
            }
            ucitajRaspored();
        })
    }
</script>
</body>