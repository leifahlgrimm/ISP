<b>Produkte:</b>
<table class="table">
    <thead>
    <tr>
        <th style="width: 20%" scope="col">#</th>
        <th style="width: 20%" scope="col">Titel</th>
        <th style="width: 20%" scope="col">Preis</th>
        <th></th>
        <th><a class="btn btn-success" href="/index.php/admin/addproduct">Hinzufügen</a></th>
    </tr>
    </thead>

    <tbody>
    <?php foreach($products as $product):?>
        <tr>
            <td><?= $product['id']?></td>
            <td><?= $product['titel']?></td>
            <td><?= number_format($product['preis']/100, 2, ",", ".")?> €</td>
            <td><a class="btn btn-secondary" href="/index.php/admin/editproduct/<?= $product['id']?>">Bearbeiten</a></td>
            <td><a class="btn btn-warning" href="/index.php/admin/deleteproduct/<?= $product['id']?>">Löschen</a></td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
<br>