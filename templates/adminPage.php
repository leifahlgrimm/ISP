<?php require_once __DIR__.'/header.php'?>

<div class="container">
    <div class="row">
        <a class="col text-center btn btn-secondary" data-bs-toggle="collapse" href="#benutzerListe" role="button">Benutzer</a>
        <a class="col text-center btn btn-secondary" data-bs-toggle="collapse" href="#kategorieListe" role="button">Kategorien</a>
        <a class="col text-center btn btn-secondary" data-bs-toggle="collapse" href="#produktListe" role="button">Produkte</a>
    </div>

    <br>

    <div class="collapse" id="benutzerListe">
        <?php require_once __DIR__.'/adminUserList.php'?>
    </div>

    <div class="collapse" id="kategorieListe">
        <?php require_once __DIR__.'/adminCategoryList.php'?>
    </div>

    <div class="collapse" id="produktListe">
        <?php require_once __DIR__.'/adminProductList.php'?>
    </div>

</div>

<?php require_once __DIR__.'/footer.php'?>