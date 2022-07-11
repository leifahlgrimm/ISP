<b>Kategorien</b>
<table class="table">
    <thead>
    <tr>
        <th style="width: 20%" scope="col">#</th>
        <th style="width: 20%" scope="col">Name</th>
        <th></th>
        <th></th>
        <th><a class="btn btn-success" href="/index.php/admin/addcategory">Hinzufügen</a></th>
    </tr>
    </thead>

    <tbody>
    <?php foreach($categories as $category):?>
        <tr>
            <td><?= $category['id']?></td>
            <td><?= $category['name']?></td>
            <td style="width: 20%"></td>
            <td><a class="btn btn-secondary" href="/index.php/admin/editcategory/<?= $category['id']?>">Bearbeiten</a></td>
            <td><a class="btn btn-warning" href="/index.php/admin/deletecategory/<?= $category['id']?>">Löschen</a></td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
<br>