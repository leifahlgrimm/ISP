<?php require_once __DIR__.'/header.php'?>

    <section class="container" id="createAccount">
        <form method="post" action="index.php/admin/addcategory">
            <div class="card">
                <div class="card-header">
                    Füge eine Kategorie hinzu:
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
                        <input name="name" class="form-control" id="name">
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success">Speichern</button>
                </div>
            </div>
        </form>
    </section>

<?php require_once __DIR__.'/footer.php'?>