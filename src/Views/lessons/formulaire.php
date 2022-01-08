<h1>Ajouter une leçon</h1>

<?php foreach($messages as $message): ?>
    <p><?= $message; ?>
<?php endforeach; ?>

<form action="" method="POST">

    <div class="form-group row mt-4">
        <label for="libelle" class="col-sm-2 col-form-label">Libellé</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="libelle" name="libelle" value="">
        </div>
    </div>

    <button type="submit" class="btn btn-primary mt-4">Valider</button>

</form>