<?php

// GET

function isLoggedIn(): bool {
    return isset($_SESSION['userId']);
}

function getCurrentUserId(): int {
    $userId = random_int(0,time());
    // Wenn userId nur in Cookies gesetzt ist (nicht eingeloggt)
    if(isset($_COOKIE['userId'])){
        $userId = (int) $_COOKIE['userId'];
    }
    // Wenn userId in der Session gesetzt ist
    if(isset($_SESSION['userId'])){
        $userId = (int) $_SESSION['userId'];
    }
    return $userId;
}

function getAllUsers(){
    $usersQuery = "SELECT id, username, isAdmin
                    FROM user";
    $statement = getDB()->query($usersQuery);
    if (false === $statement){
        return [];
    }
    $users = [];
    while($row = $statement->fetch()){
        $users[] = $row;
    }
    return $users;
}

function getUsernameById(int $id){
    $sql = "SELECT username FROM user
            WHERE id = ".$id;
    $username = getDB()->query($sql);
    if(false === $username){
        return 0;
    }
    return $username->fetch();
}

function getUserDataForUserName(string $username):array{
    $userdataQuery = "SELECT id, passwort
        FROM user
        WHERE username=:username";
    $statement = getDB()->prepare($userdataQuery);
    if(false === $statement){
        return [];
    }
    $statement->execute([
        ':username' => $username
    ]);
    if(0 === $statement->rowCount()){
        return [];
    }
    $row = $statement->fetch();
    return $row;
}

function isUserAdmin(int $id){
    $adminQuery = "SELECT isAdmin FROM user
                    WHERE id = ".$id;
    $adminStatus = getDB()->query($adminQuery);
    if(false === $adminStatus){
        return 0;
    }
    return $adminStatus->fetchColumn();
}

// ADD

function addUser(string $username, string $password){
    $sql = "INSERT INTO user SET username='".$username."', passwort='".$password."'";
    return getDB()->exec($sql);
}

function addUserWithAdminStatus(string $username, string $password, int $isAdmin){
    $sql = "INSERT INTO user SET username='".$username."', passwort='".$password."', isAdmin='".$isAdmin."'";
    return getDB()->exec($sql);
}

// UPDATE

function promoteUserToAdmin(int $userId){
    $promotionQuery = "UPDATE user
                        SET isAdmin = 1
                        WHERE id = :userId";
    $statement = getDB()->prepare($promotionQuery);
    if(false === $statement){
        return false;
    }
    return $statement->execute([
        ':userId'=>$userId
    ]);
}

function demoteUserFromAdmin(int $userId){
    $promotionQuery = "UPDATE user
                        SET isAdmin = 0
                        WHERE id = :userId";
    $statement = getDB()->prepare($promotionQuery);
    if(false === $statement){
        return false;
    }
    return $statement->execute([
        ':userId'=>$userId
    ]);
}

function updateUser($userId, $username, $adminStatus){
    $updateQuery = "UPDATE user
                        SET username = :username,
                            isAdmin = :isAdmin
                        WHERE id = :id";
    $statement = getDB()->prepare($updateQuery);
    if(false === $statement){
        return false;
    }
    return (bool) $statement->execute([
        ':username'=>$username,
        ':isAdmin'=>$adminStatus,
        ':id'=>$userId
    ]);
}

// DELETE

function deleteUser(int $userId){
    $deleteQuery = "DELETE FROM user
                    WHERE id = :userId";
    $statement = getDB()->prepare($deleteQuery);
    if(false === $statement){
        return 0;
    }
    return $statement->execute([
        ':userId'=>$userId
    ]);
}