<?php
    include 'header.php';
?>

<div class="container mt-5">
    <h1 class="text-center">Pretraga repertoara</h1>
    <div class="row mt-4">
        <div class="col-4">
            <select class="form-control" id="predstava">
                <option value="0">
                    Sve predstave
                </option>
            </select>
        </div>
        <div class="col-5">
            <input type="text" placeholder="Pretrazi..." id="pretraga" class="form-control">
        </div>
        <div class="col-3">
            <input type="date" id="datum" class="form-control">
        </div>
    </div>
    <table class="mt-3 table table-dark">
        <thead>
            <tr>
                <th>Naziv predstave</th>
                <th>Cena ulaznice</th>
                <th>Trajanje predstave</th>
                <th>Ocena predstave</th>
                <th>Scena</th>
                <th>Pocetak</th>
            </tr>
        </thead>
        <tbody id="repertoar">

        </tbody>
    </table>
</div>

<script>
    let raspored = [];
    $(document).ready(function(){
        $("#predstava").change(function() {
            popuniTabelu();
        })
        $("#pretraga").change(function() {
            popuniTabelu();
        })
        $("#datum").change(function() {
            popuniTabelu();
        })
        $.getJSON('./server/index.php?akcija=raspored.read', function (res) {
            if (!res.status) {
                alert(res.error);
                return;
            }
            raspored = res.data;
            popuniTabelu();
        });
        $.getJSON('./server/index.php?akcija=predstava.read', function (res) {
            if (!res.status) {
                alert(res.error);
                return;
            }
            for (let predstava of res.data) {
                $("#predstava").append(`
                <option value="${predstava.id}">${predstava.naziv}</option>
                `)
            }
        })
    })
    function popuniTabelu() {
        const predstavaID=Number($("#predstava").val());
        const datumStr=$("#datum").val();
        const datum=new Date(datumStr);
        const pretraga=$("#pretraga").val();
        const filtrirani=raspored.filter(function(element) {
            const elementDatum=new Date(element.datum);
            return (predstavaID==0 || element.predstava.id==predstavaID)
                && (element.predstava.naziv.includes(pretraga) || element.scena.naziv.includes(pretraga))
                && (datumStr==='' || (datum.getDate()===elementDatum.getDate() && datum.getMonth()===elementDatum.getMonth() && datum.getFullYear()===elementDatum.getFullYear()))
        })
        $("#repertoar").html('');
        for (let tabela of filtrirani) {
            $("#repertoar").append(`
            <tr>
                <td>${tabela.predstava.naziv}</td>
                <td>${tabela.cena}</td>
                <td>${tabela.predstava.trajanje}</td>
                <td>${tabela.predstava.ocena}</td>
                <td>${tabela.scena.naziv}</td>
                <td>${tabela.datum}</td>
            </tr>
            `)
        }
    }
</script>
</body>