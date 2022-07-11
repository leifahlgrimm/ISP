<b>Benutzer:</b>
<table class="table">
    <thead>
    <tr>
        <th style="width: 20%" scope="col">#</th>
        <th style="width: 20%" scope="col">Username</th>
        <th style="width: 20%" scope="col">Admin</th>
        <th></th>
        <th></th>
    </tr>
    </thead>

    <tbody id="benutzerTabelle">
    <?php foreach($users as $user):?>
        <tr>
            <td><?= $user['id']?></td>
            <td><?= $user['username']?></td>
            <td><?= ($user['isAdmin'] === "1" ? "Ja" : "Nein")?></td>
            <td><a class="btn btn-secondary" href="/index.php/admin/edituser/<?= $user['id']?>">Bearbeiten</a></td>
            <td><a class="btn btn-warning" href="/index.php/admin/deleteuser/<?= $user['id']?>">Löschen</a></td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
<br>