<?php

// GET

function getAllCategories(){
    $sql = "SELECT id,name
    FROM kategorien";
    $result = getDB()->query($sql);

    if(!$result){
        return [];
    }
    $categories = [];
    while($row = $result->fetch()){
        $categories[] = $row;
    }
    return $categories;
}

function getCategoryName($categoryId){
    $sql = "SELECT name
                            FROM kategorien
                            WHERE id = ".$categoryId;
    $result = getDB()->query($sql);
    if(!$result){
        return 0;
    }
    return $result->fetch();
}

// ADD

function addCategory($name){
    $sql = "INSERT INTO kategorien
                    (id, name)
                    VALUES (null, :name)";
    $statement = getDB()->prepare($sql);
    if(false === $statement){
        return false;
    }
    return (bool) $statement->execute([
        ':name'=>$name
    ]);
}

// UPDATE

function updateCategory($categoryId, $name){
    $sql = "UPDATE kategorien
                        SET name = :name
                        WHERE id = :categoryId";
    $statement = getDB()->prepare($sql);
    if(false === $statement){
        return false;
    }
    return (bool) $statement->execute([
        ':name'=>$name,
        ':categoryId'=>$categoryId
    ]);
}

// DELETE

function deleteCategory($categoryId){
    $sql = "DELETE FROM kategorien
                    WHERE id = :categoryId";
    $statement = getDB()->prepare($sql);
    if(false === $statement){
        return 0;
    }
    return $statement->execute([
        ':categoryId'=>$categoryId
    ]);
}