<?php require_once __DIR__.'/header.php'?>

<section class="container" id="products">
    <div class="row">
        <!---- Erstelle Produkte aus Datenbank  ---->
        <?php foreach($products as $product):?>
            <div class="col-auto" style="width: 25%;">
                <?php include 'productCard.php' ?>
            </div>
        <?php endforeach;?>
    </div>
</section>

<?php require_once __DIR__.'/footer.php'?>