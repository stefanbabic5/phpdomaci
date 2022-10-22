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
                <input class="form-control" type="number" min='0' max='10' id='ocena'>
                <button id='sacuvaj' class="btn btn-primary form-control mt-2">Kreiraj</button>
            </form>
            <button id='obrisi' class="btn btn-danger mt-2 form-control" hidden>Obrisi</button>
            <button id='nazad' class="btn btn-secondary mt-2 form-control" hidden>Nazad</button>
        </div>
    </div>
</div>
<script>

</script>
</body>