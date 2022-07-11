<?php

$isPost = isPost();
$routeParts = explode("/",$route);
$categoryId = (int)$routeParts[3];
$categoryName = getCategoryName($categoryId)[0];
$errors = [];
$hasErrors = false;

if($isPost){
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);

    if (!name){
        $errors[] = "Bitte Titel eintragen";
    }
    if(count($errors) === 0) {
        updateCategory($categoryId, $name);
        header("Location: ".$baseUrl."index.php/admin");
        exit();
    }
}
$hasErrors = count($errors) > 0;
