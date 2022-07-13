<div class="card card-main card h-100">
    <div class="card-title text-center"><b><?= $product['titel']?></b></div>
    <a href="index.php/product/<?= $product['id']?>">
        <img src="http://placekitten.com/200/200" class="card-img-top" alt="http://placekitten.com/200/200">
    </a>
    <div class="card-body d-flex flex-column">
        <div>
            <p>Beschreibung:</p>
            <?= $product['beschreibung']?>
        </div>
        <?php if($product['kategorie_id']):?>
        <hr>
        <div>
            <?= getCategoryName($product['kategorie_id'])[0]?>
        </div>
        <?php endif;?>
        <div class="mt-auto">
            <hr>
            <?= number_format($product['preis']/100, 2, ",", ".")?> €
        </div>
    </div>
    <div class="card-footer">
        <a href="index.php/product/<?= $product['id']?>" class="btn btn-primary btn-sm">Details</a>
        <a href="index.php/cart/add/<?= $product['id']?>" class="btn btn-success btn-sm">In den Warenkorb</a>
    </div>
</div>