<?php

$isPost = isPost();
$errors = [];
$hasErrors = false;

if($isPost){
    $titel = filter_input(INPUT_POST, 'titel', FILTER_SANITIZE_SPECIAL_CHARS);
    $beschreibung = filter_input(INPUT_POST, 'beschreibung', FILTER_SANITIZE_SPECIAL_CHARS);
    $preis = filter_input(INPUT_POST, 'preis', FILTER_SANITIZE_SPECIAL_CHARS);

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
        addProduct($titel, $beschreibung, $preis);
        header("Location: ".$baseUrl."index.php/admin");
        exit();
    }
}
$hasErrors = count($errors) > 0;