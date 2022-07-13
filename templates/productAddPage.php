<?php require_once __DIR__.'/header.php'?>

    <div class="container">
        <div class="row">
            <a class="btn btn-secondary col-2" href="/index.php/admin">Admin</a>
        </div>
        <div class="row">
            <form method="post" action="index.php/admin/addproduct">
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
                            <input name="titel" class="form-control" id="titel">
                        </div>
                        <div>
                            <label for="beschreibung">Beschreibung des Produkts</label>
                            <input name="beschreibung" class="form-control" id="beschreibung">
                        </div>
                        <div>
                            <label for="preis">Preis des Produkts in Cent</label>
                            <input name="preis" class="form-control" id="preis">
                        </div>
                        <div>
                            <label for="kategorien">Kategorie:</label>
                            <select name="kategorien" id="kategorien" class="form-select">
                                <?php foreach($categories as $category):?>
                                    <option value="<?=$category['id'] ?>"><?= $category['name']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success">Speichern</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php require_once __DIR__.'/footer.php'?>