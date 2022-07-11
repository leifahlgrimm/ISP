<form method="post" action="index.php/admin/editcategory/<?= $categoryId?>">
    <div class="card">
        <div class="card-header">
            Bearbeite die Kategorie "<?= $categoryName?>":
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
                <label for="name">Kategoriename</label>
                <input name="name" class="form-control" id="name" value="<?= $categoryName?>">
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-success">Speichern</button>
        </div>
    </div>
</form>