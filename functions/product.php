<?php

// GET

function getAllProducts(){
    // Hole alle Produkte aus der Datenbank mit:
    // ID, Titel, Beschreibung, Preis
    $selectProducts = "SELECT id,titel,beschreibung,preis,kategorie_id
    FROM products";
    $result = getDB()->query($selectProducts);

    if(!$result){
        return [];
    }
    $products = [];
    while($row = $result->fetch()){
        $products[] = $row;
    }
    return $products;
}

function getSingleProduct($productId){
    $selectProduct = "SELECT id, titel, beschreibung, preis
                        FROM products
                        WHERE id = ".$productId;
    $product = getDB()->query($selectProduct);
    if(!$product){
        return 0;
    }
    return $product->fetch();
}

// ADD

function addProduct($titel, $beschreibung, $preis, $kategorie_id){
    $createQuery = "INSERT INTO products
                    (id, titel, beschreibung, preis, kategorie_id)
                    VALUES (null, :titel, :beschreibung, :preis, :kategorie_id)";
    $statement = getDB()->prepare($createQuery);
    if(false === $statement){
        return false;
    }
    return (bool) $statement->execute([
        ':titel'=>$titel,
        ':beschreibung'=>$beschreibung,
        ':preis'=>$preis,
        ':kategorie_id'=>$kategorie_id
    ]);
}

// UPDATE

function updateProduct($productId, $titel, $beschreibung, $preis, $kategorie_id){
    $updateQuery = "UPDATE products
                        SET titel = :titel,
                            beschreibung = :beschreibung,
                            preis = :preis,
                            kategorie_id = :kategorie_id
                        WHERE id = :productId";
    $statement = getDB()->prepare($updateQuery);
    if(false === $statement){
        return false;
    }
    return (bool) $statement->execute([
        ':titel'=>$titel,
        ':beschreibung'=>$beschreibung,
        ':preis'=>$preis,
        ':productId'=>$productId,
        ':kategorie_id'=>$kategorie_id
    ]);
}

// DELETE

function deleteProduct($productId){
    $deleteQuery = "DELETE FROM products
                    WHERE id = :productId";
    $statement = getDB()->prepare($deleteQuery);
    if(false === $statement){
        return 0;
    }
    return $statement->execute([
        ':productId'=>$productId
    ]);
}