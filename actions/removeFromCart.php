<?php

$routeParts = explode("/",$route);
$productId = (int)$routeParts[3];
removeProductFromCart($userId, $productId);
header("Location: ".$baseUrl."index.php/cart");