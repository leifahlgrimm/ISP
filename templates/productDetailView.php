<?php require_once __DIR__.'/header.php'?>

    <div class="container">
        <div class="row">
            <div class="col-4">
                <img class="productPicture" src="http://placekitten.com/400/400">
            </div>
            <div class="col-8" id="product-details">
                <h2><?= $product['titel']?></h2>
                <br>
                <div>Beschreibung:</div>
                <div><?= $product['beschreibung']?></div>
                <br>
                <span><?= number_format($product['preis']/100,2,",",".")?> € </span>
                <br>
                <br>
                <a href="/index.php/cart/add/<?= $product['id']?>" class="btn btn-success">In den Warenkorb</a>
            </div>
        </div>
    </div>


<?php require_once __DIR__.'/footer.php'?>