<h1>Liste des categories</h1>
<table class="table table-hover">
    <thead>
        <th scope="col">Id</th>
        <th scope="col">Libellé</th>
        <th scope="row">Actions</th>
    </thead>
    <tbody>
        <?php foreach( $categories as $categorie ): ?>
            <tr>
                <td scope="row"><?= $categorie['id']; ?></td>
                <td><?= $categorie['libelle']; ?></td>
                <td></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<div>
    <a class="btn btn-primary" href="<?= BASE_URL; ?>categories/add">Ajouter une categorie</a>
</div>
