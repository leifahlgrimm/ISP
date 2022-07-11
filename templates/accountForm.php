<form method="post" action="index.php/account">
    <div class="card">
        <div class="card-body">
            <?php if($hasErrors):?>
                <ul class="alert alert-danger">
                    <?php foreach($errors as $errorMessage):?>
                        <li><?= $errorMessage?></li>
                    <?php endforeach;?>
                </ul>
            <?php endif;?>
            <div class="row">
                <div class="col">
                    <label for="empfaenger">Voller Name</label>
                    <input name="empfaenger" class="form-control" id="empfaenger" value="<?= (array_key_exists("empfaenger", $userAddress)) ? $userAddress['empfaenger']: "";?>">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="strasse">Straße</label>
                    <input name="strasse" class="form-control" id="strasse" value="<?= (array_key_exists("strasse", $userAddress)) ? $userAddress['strasse']:"";?>">
                </div>
                <div class="col">
                    <label for="hausnummer">Hausnummer</label>
                    <input name="hausnummer" class="form-control" id="hausnummer" value="<?= (array_key_exists("hausnummer", $userAddress)) ? $userAddress['hausnummer']:"";?>">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="plz">Postleitzahl</label>
                    <input name="plz" class="form-control" id="plz" value="<?= (array_key_exists("plz", $userAddress)) ? $userAddress['plz']:"";?>">
                </div>
                <div class="col">
                    <label for="stadt">Stadt</label>
                    <input name="stadt" class="form-control" id="stadt" value="<?= (array_key_exists("stadt", $userAddress)) ? $userAddress['stadt']:"";?>">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-success">Speichern</button>
        </div>
    </div>
</form>