<?php 
    if($mode == "ajout") : ?>
        <h1>Nouvelle leçon</h1>
    <?php else: ?>
        <h1><?= $lesson['libelle']; ?></h1>
    <?php endif; ?>

<form action="" method="POST">

    <div class="form-group row mt-4">
        <label for="libelle" class="col-sm-2 col-form-label">Libellé</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="libelle" name="libelle" value="<?= !empty($lesson['libelle']) ? $lesson['libelle'] : ''; ?>">
        </div>
    </div>

    <div class="form-group row mt-4">
        <label for="categorie" class="col-sm-2 col-form-label">Catéroie</label>
        <div class="col-sm-10">
            <select name="categorie" id="categorie">
                <option value=""></option>
                <?php foreach($categories as $categorie) : ?>
                    <option value="<?= $categorie['id']; ?>" <?= $categorie['id'] == $id_categorie ? "selected" : ''; ?>><?= $categorie['libelle']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="form-group row mt-4">
        <label for="resume" class="col-sm-2 col-form-label">Résumé</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="resume" name="resume"><?= !empty($lesson['resume']) ? $lesson['resume'] : ''; ?></textarea>
        </div>
    </div>

    <button type="submit" class="btn btn-primary mt-4">Valider</button>

</form>