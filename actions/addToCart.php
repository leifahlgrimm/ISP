<?php

// Teile in alle einzelnen Elemente auf
$routeParts = explode("/",$route);
$productId = (int)$routeParts[3];
addProductToCart($userId, $productId);
header("Location: ".$baseUrl."index.php/cart");