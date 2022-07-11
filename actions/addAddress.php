<?php

$isPost = isPost();
$empfaenger = "";
$strasse = "";
$hausnummer = "";
$plz = "";
$stadt = "";
$errors = [];

if($isPost){
    $empfaenger = filter_input(INPUT_POST, 'empfaenger', FILTER_SANITIZE_SPECIAL_CHARS);
    $strasse = filter_input(INPUT_POST, 'strasse', FILTER_SANITIZE_SPECIAL_CHARS);
    $hausnummer = filter_input(INPUT_POST, 'hausnummer', FILTER_SANITIZE_SPECIAL_CHARS);
    $plz = filter_input(INPUT_POST, 'plz', FILTER_SANITIZE_SPECIAL_CHARS);
    $stadt = filter_input(INPUT_POST, 'stadt', FILTER_SANITIZE_SPECIAL_CHARS);

    if (!$empfaenger){
        $errors[] = "Bitte Empfänger eintragen";
    }
    if (!$strasse){
        $errors[] = "Bitte Straße eintragen";
    }
    if (!$hausnummer){
        $errors[] = "Bitte Hausnummer eintragen";
    }
    if (!$plz){
        $errors[] = "Bitte Postleitzahl eintragen";
    }
    if (!$stadt){
        $errors[] = "Bitte Stadt eintragen";
    }
    if(count($errors) === 0){
        addDeliveryAddressForUserId($userId, $empfaenger, $strasse, $hausnummer, $plz, $stadt);
        header("Location: ".$baseUrl."index.php/thankyou");
        exit();
    }
}
$hasErrors = count($errors) > 0;