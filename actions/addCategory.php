<?php

$isPost = isPost();
$errors = [];
$hasErrors = false;

if($isPost){
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);

    if (!$name){
        $errors[] = "Bitte Titel eintragen";
    }
    if(count($errors) === 0) {
        addCategory($name);
        header("Location: ".$baseUrl."index.php/admin");
        exit();
    }
}
$hasErrors = count($errors) > 0;
