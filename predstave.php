<?php
    include 'header.php';
?>

<div class='container mt-5'>
    <h1 class="text-center">Spisak predstava</h1>
    <div class='row mt-4'>
        <div class='col-8'>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Naziv</th>
                        <th>Trajanje</th>
                        <th>Ocena</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id='predstave'>

                </tbody>
            </table>
        </div>
        <div class='col-4'>
            <h3>Unos predstave</h3>
            <form id='forma'>
                <label>Naziv</label>
                <input class="form-control" type="text" id='naziv'>
                <label>Trajanje</label>
                <input class="form-control" type="number" min='0' id='trajanje'>
                <label>Ocena</label>
                <input class="form-control" type="number" min='0' step="any" max='10' id='ocena'>
                <button id='sacuvaj' class="btn btn-primary form-control mt-2">Kreiraj</button>
            </form>
            <button id='obrisi' class="btn btn-danger mt-2 form-control" hidden>Obrisi</button>
            <button id='nazad' class="btn btn-secondary mt-2 form-control" hidden>Nazad</button>
        </div>
    </div>
</div>
<script>
    let predstave = [];
    let detaljiID = 0;
    $(document).ready(function () {
        ucitajPredstave();
        $("#obrisi").click(function() {
            obrisiPredstavu();
            otvori(0);
        })
        $("#nazad").click(function() {
            otvori(0);
        })
        $("#forma").submit(function(e) {
            e.preventDefault();
            const naziv = $("#naziv").val();
            const trajanje = $("#trajanje").val();
            const ocena = $("#ocena").val();
            $.post("./server/index.php?akcija=predstava."+(detaljiID ? "update" : "create"), {
                naziv,
                ocena,
                trajanje,
                id: detaljiID
            }, function(res){
                res=JSON.parse(res);
                if(!res.status){
                    alert(res.error);
                }
                ucitajPredstave();
                otvori(0);
            })
        })
    })
    function obrisiPredstavu() {
        $.post("./server/index.php?akcija=predstava.delete", {id:detaljiID}, function(res) {
            res=JSON.parse(res);
            if(!res.status){
                alert(res.error);
            }
            ucitajPredstave();
        })
    }
    function ucitajPredstave() {
        $.getJSON("./server/index.php?akcija=predstava.read", function(res) {
            if(!res.status){
                alert(res.error);
                return;
            }
            $("#predstave").html('');
            predstave=res.data;
            for (let predstava of predstave) {
                $("#predstave").append(`
                <tr>
                    <td>${predstava.id}</td>
                    <td>${predstava.naziv}</td>
                    <td>${predstava.trajanje}</td>
                    <td>${predstava.ocena}</td>
                    <td><button onClick="otvori(${predstava.id})" class="btn btn-secondary width-100">Detalji</button></td>
                </tr>
                `)
            }
        })
    }
    function otvori(id) {
        detaljiID = id;
        const predstava = predstave.find(e => e.id==id);
        if (!predstava) {
            $("#naziv").val('');
            $("#trajanje").val('');
            $("#ocena").val('');
            $("#nazad").attr('hidden',true);
            $("#obrisi").attr('hidden',true);
            $("#sacuvaj").html("Kreiraj");
        } else {
            $("#naziv").val(predstava.naziv);
            $("#trajanje").val(predstava.trajanje);
            $("#ocena").val(predstava.ocena);
            $("#nazad").attr('hidden',false);
            $("#obrisi").attr('hidden',false);
            $("#sacuvaj").html("Izmeni");
        }
    }
</script>
</body>