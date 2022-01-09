<h1>Profil utlisateur</h1>

<form action="" method="POST">

    <div class="form-group row mt-4">
        <label for="username" class="col-sm-2 col-form-label">Identifiant</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="username" readonly value="<?= !empty($user['username']) ? $user['username'] : ''; ?>">
        </div>
    </div>
        
    <div class="form-group row mt-4">
        <label for="nom" class="col-sm-2 col-form-label">Nom</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="nom" name="nom" value="<?= !empty($user['nom']) ? $user['nom'] : ''; ?>">
        </div>
    </div>

    <div class="form-group row mt-4">
        <label for="prenom" class="col-sm-2 col-form-label">Prénom</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="prenom" name="prenom" value="<?= !empty($user['prenom']) ? $user['prenom'] : ''; ?>">
        </div>
    </div>

    <div class="form-group row mt-4">
        <label for="password" class="col-sm-2 col-form-label">Mot de passe</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="password" name="password">
        </div>
    </div>

    <div class="form-group row mt-4">
        <label for="password2" class="col-sm-2 col-form-label">Confirmation mot de passe</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="password2" name="password2">
        </div>
    </div>


    <button type="submit" class="btn btn-primary mt-4">Modifier</button>

</form>