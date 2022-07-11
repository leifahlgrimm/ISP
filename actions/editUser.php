<?php
$routeParts = explode("/",$route);
$userId = (int)$routeParts[3];
$username = getUsernameById($userId)[0];
$isPost = isPost();
$errors = [];
$hasErrors = false;

if($isPost){
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $adminStatus = $_POST['adminStatus'];

    if(!$username){
        $errors[] = "Bitte Benutzernamen angeben";
    }
    var_dump($username, $adminStatus);
    if(count($errors) === 0){
        updateUser($userId, $username, $adminStatus);
        header("Location: ".$baseUrl."index.php/admin");
        exit();
    }
}

$hasErrors = count($errors) > 0;