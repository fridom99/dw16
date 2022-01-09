<?php 
    if($mode == "ajout") : ?>
        <h1>Nouvelle catégorie</h1>
    <?php else: ?>
        <h1><?= $categorie['libelle']; ?></h1>
    <?php endif; ?>

<form action="" method="POST">

    <div class="form-group row mt-4">
        <label for="libelle" class="col-sm-2 col-form-label">Libellé</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="libelle" name="libelle" value="<?= !empty($categorie['libelle']) ? $categorie['libelle'] : ''; ?>">
        </div>
    </div>

    <button type="submit" class="btn btn-primary mt-4">Valider</button>

</form>