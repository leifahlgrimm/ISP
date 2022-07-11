<form method="post" action="index.php/admin/edituser/<?= $userId?>">
    <div class="card">
        <div class="card-header">
            Bearbeite den Account "<?= $username?>":
        </div>
        <div class="card-body">
            <?php if($hasErrors):?>
                <ul class="alert alert-danger">
                    <?php foreach($errors as $errorMessage):?>
                        <li><?= $errorMessage?></li>
                    <?php endforeach;?>
                </ul>
            <?php endif;?>
            <div class="form-group">
                <label for="username">Benutzername</label>
                <input name="username" class="form-control" id="username" value="<?= $username?>">
                <label for="adminStatus">Soll dieser Account Adminrechte haben?</label>
                <select name="adminStatus" id="adminStatus" class="form-select">
                    <option value="0">Nein</option>
                    <option value="1">Ja</option>
                </select>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-success">Speichern</button>
        </div>
    </div>
</form>