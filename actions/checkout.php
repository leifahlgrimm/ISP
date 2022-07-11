<?php
if(getUserAddressById($userId)){
    deleteAllCartItemsForUserId($userId);
    header("Location: /index.php/thankyou");
    exit();
}
$empfaenger = "";
$strasse = "";
$hausnummer = "";
$plz = "";
$stadt = "";
$errors = [];
$hasErrors = count($errors) > 0;