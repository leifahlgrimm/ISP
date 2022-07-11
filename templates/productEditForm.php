<form method="post" action="index.php/admin/editproduct/<?= $product['id']?>">
    <div class="card">
        <div class="card-body">
            <?php if($hasErrors):?>
                <ul class="alert alert-danger">
                    <?php foreach($errors as $errorMessage):?>
                        <li><?= $errorMessage?></li>
                    <?php endforeach;?>
                </ul>
            <?php endif;?>
            <div>
                <label for="titel">Titel des Produkts</label>
                <input name="titel" class="form-control" id="titel" value="<?= (array_key_exists("titel", $product)) ? $product['titel']: "";?>">
            </div>
            <div>
                <label for="beschreibung">Beschreibung des Produkts</label>
                <input name="beschreibung" class="form-control" id="beschreibung" value="<?= (array_key_exists("beschreibung", $product)) ? $product['beschreibung']: "";?>">
            </div>
            <div>
                <label for="preis">Preis des Produkts in Cent</label>
                <input name="preis" class="form-control" id="preis" value="<?= (array_key_exists("preis", $product)) ? $product['preis']: "";?>">
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-success">Speichern</button>
        </div>
    </div>
</form>