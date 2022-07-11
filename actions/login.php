<?php

$isPost = isPost();
$username = "";
$password = "";
$hasErrors = false;
$errors = [];

if($isPost){
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password');

    if(false === (bool)$username){
        $errors[] = "Benutzername ist leer";
    }
    if(false === (bool)$password){
        $errors[] = "Passwort ist leer";
    }
    $userData = getUserDataForUserName($username);
    if((bool)$username && 0 === count($userData)){
        $errors[] = "Benutzername existiert nicht";
    }
    if((bool) $password && isset($userData['password']) && password_verify($password, $userData['password'])){
        $errors[] = "Passwort stimmt nicht";
    }
    if(0 === count($errors)){
        $_SESSION['userId'] = (int) $userData['id'];
        moveCartToAnotherUser($_COOKIE['userId'], (int)$userData['id']);
        setcookie('userId', (int)$userData['id'], $baseUrl);
        header("Location: ".$_SESSION['redirectTarget']);
        exit();
    }
}
$hasErrors = count($errors) > 0;