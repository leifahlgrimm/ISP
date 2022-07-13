<?php

$isPost = isPost();
$routeParts = explode("/",$route);
$productId = (int)$routeParts[3];
$product = getSingleProduct($productId);
$errors = [];
$hasErrors = false;

if($isPost){
    $titel = filter_input(INPUT_POST, 'titel', FILTER_SANITIZE_SPECIAL_CHARS);
    $beschreibung = filter_input(INPUT_POST, 'beschreibung', FILTER_SANITIZE_SPECIAL_CHARS);
    $preis = filter_input(INPUT_POST, 'preis', FILTER_SANITIZE_SPECIAL_CHARS);
    $kategorie = $_POST['kategorien'];

    if (!$titel){
        $errors[] = "Bitte Titel eintragen";
    }
    if (!$beschreibung){
        $errors[] = "Bitte Beschreibung eintragen";
    }
    if (!$preis){
        $errors[] = "Bitte Preis eintragen";
    }
    if(count($errors) === 0) {
        updateProduct($productId, $titel, $beschreibung, $preis, $kategorie);
        header("Location: ".$baseUrl."index.php/admin");
        exit();
    }
}
$hasErrors = count($errors) > 0;