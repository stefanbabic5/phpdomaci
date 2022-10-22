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
                <input class="form-control" type="number" min='0' id='cena'>
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
</body>