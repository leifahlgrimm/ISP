<div class="col-3">
    <img class="productPicture" src="http://placekitten.com/200/100">
</div>
<div class="col-6">
    <div><?= $cartItem['titel']?></div>
    <div><?= $cartItem['beschreibung']?></div>
</div>
<div class="col-1 text-end">
    <span><?= $cartItem['quantity']?> x </span>
</div>
<div class="col-2 text-end">
    <span><?= number_format($cartItem['preis']/100,2,",",".")?> € </span>
    <br>
    <span class="price"><?= number_format($cartItem['preis'] * $cartItem['quantity']/100, 2, ",",".")?> € </span><span>Zwischensumme</span>
    <br>
    <a href="/index.php/cart/add/<?= $cartItem['product_id']?>" class="btn btn-success">Hinzufügen</a>
    <a href="/index.php/cart/remove/<?= $cartItem['product_id']?>" class="btn btn-warning">Entfernen</a>
</div>