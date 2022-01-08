<h1>Liste des leçons</h1>
<table class="table table-hover">
    <thead>
        <th scope="col">Id</th>
        <th scope="col">Libellé</th>
        <th scope="row">Actions</th>
    </thead>
    <tbody>
        <?php foreach( $lessons as $lesson ): ?>
            <tr>
                <td scope="row"><?= $lesson['id']; ?></td>
                <td><?= $lesson['libelle']; ?></td>
                <td></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div>
    <a class="btn btn-primary" href="<?= BASE_URL; ?>lessons/add">Ajouter une leçon</a>
</div>
