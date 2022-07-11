<?php

$isPost = isPost();
$username = "";
$password = "";
$errors = [];

if($isPost){
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password');
    $password = password_hash($password, PASSWORD_DEFAULT);

    if(!$username){
        $errors[] = "Bitte Benutzernamen angeben";
    }
    if(getUserDataForUserName($username)){
        $errors[] = "Benutzername exisitiert bereits";
    }
    if(!$password){
        $errors[] = "Bitte Passwort angeben";
    }
    if(count($errors) === 0){
        addUser($username, $password);
        header("Location: ".$baseUrl."index.php/login");
        exit();
    }
}

$hasErrors = count($errors) > 0;