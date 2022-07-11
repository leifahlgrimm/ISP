<form method="post" action="index.php/deliveryAddress/add">
    <div class="card">
        <div class="card-header">
            Bitte gib deine Adresse an:
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
                <label for="empfaenger">Empfänger</label>
                <input name="empfaenger" class="form-control" id="empfaenger">
            </div>
            <div class="form-group">
                <label for="strasse">Straße</label>
                <input name="strasse" class="form-control" id="strasse">
            </div>
            <div class="form-group">
                <label for="hausnummer">Hausnummer</label>
                <input name="hausnummer" class="form-control" id="hausnummer">
            </div>
            <div class="form-group">
                <label for="plz">Postleitzahl</label>
                <input name="plz" class="form-control" id="plz">
            </div>
            <div class="form-group">
                <label for="stadt">Stadt</label>
                <input name="stadt" class="form-control" id="stadt">
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-success">Speichern</button>
        </div>
    </div>
</form>