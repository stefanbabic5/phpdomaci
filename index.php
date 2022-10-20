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
            <input type="text" placeholder="Pretrazi..." id='pretraga' class="form-control">
        </div>
        <div class="col-3">
            <input type="date" id='datum' class="form-control">
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
        <tbody id='repertoar'>

        </tbody>
    </table>
</div>

<script>
    
</script>
</body>