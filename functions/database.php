<?php

// GET

function getDB(): PDO
{
    static $db;
    // falls DB bereits existiert, return
    if($db instanceof PDO) {
        return $db;
    }
    // falls nicht, erstelle neue Instanz der DB und gib sie zurück
    require_once CONFIG_DIR.'/database.php';
    $dsn = sprintf("mysql:host=%s;dbname=%s;charset=%s", DB_HOST, DB_DATABASE, DB_CHARSET);
    $db = new PDO($dsn,DB_USERNAME,DB_PASSWORD);
    return $db;
}

function printDBErrorMessage(){
    $info = getDB()->errorInfo();
    if(isset($info[2])){
        return $info[2];
    }
    return '';
}