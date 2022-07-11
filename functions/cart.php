<?php

// GET

function getCartItemsForUserId(int $userId): array{
    $sql = "SELECT product_id, titel, beschreibung, preis, quantity
    FROM warenkorb 
    JOIN products ON(warenkorb.product_id = products.id) 
    WHERE user_id = ".$userId;

    $results = getDB()->query($sql);
    if($results === false){
        return [];
    }
    $foundProducts = [];
    while($row = $results->fetch()){
        $foundProducts[] = $row;
    }
    return $foundProducts;
}

function getCartSumForUserId(int $userId): int{
    $sql = "SELECT SUM(preis * quantity)
    FROM warenkorb 
    JOIN products ON(warenkorb.product_id = products.id) 
    WHERE user_id = ".$userId;
    $result = getDB()->query($sql);
    if($result === false){
        return 0;
    }
    return (int) $result->fetchColumn();
}

function getSingleProductQuantityFromCart(int $userId, int $productId){
    $sql = "SELECT quantity FROM warenkorb 
                        WHERE user_id = ".$userId." AND product_id = ".$productId;
    $quantity = getDB()->query($sql);
    if(!$quantity){
        return 0;
    }
    return $quantity->fetchColumn();
}

function getAllProductQuantityFromCart(int $userId){
    $sql = "SELECT SUM(quantity) FROM warenkorb WHERE user_id =".$userId;
    $quantity = getDB()->query($sql);
    if($quantity === false){
        return 0;
    }
    return $quantity->fetchColumn();
}

// ADD

function addProductToCart(int $userId, int $productId){
    $sql = "INSERT INTO warenkorb SET quantity = 1, user_id = :userId,product_id = :productId
                      ON DUPLICATE KEY UPDATE quantity = quantity + 1
                      ";
    $statement = getDB()->prepare($sql);
    $statement->execute([
        'userId' => $userId,
        'productId' => $productId
    ]);
}

// UPDATE

function moveCartToAnotherUser(int $sourceId, int $targetId): int{
    $sql = "UPDATE warenkorb 
                    SET user_id=:targetId 
                    WHERE user_id=:sourceId";
    $statement = getDB()->prepare($sql);
    if(false === $statement){
        return 0;
    }
    return $statement->execute([
        'targetId'=>$targetId,
        'sourceId'=>$sourceId
    ]);
}

// DELETE

function removeProductFromCart(int $userId, int $productId){
    // Wenn Anzahl des Produkts im Warenkorb größer als 1,
    // Dann reduziere Anzahl um 1
    if((int)getSingleProductQuantityFromCart($userId, $productId) > 1){
        $sql = "UPDATE warenkorb SET quantity = quantity - 1
                        WHERE product_id = :productId AND user_id = :userId";
        $statement = getDB()->prepare($sql);
        if(false === $statement){
            return 0;
        }
        return $statement->execute([
            'userId'=>$userId,
            'productId'=>$productId
        ]);
    }
    // Sonst lösche Produkt aus Warenkorb
    return deleteCartItemForUserId($userId, $productId);
}

function deleteCartItemForUserId(int $userId, int $productId){
    $sql = "DELETE FROM warenkorb
                    WHERE user_id = :userId
                    AND product_id = :productId";
    $statement = getDB()->prepare($sql);
    if(false === $statement){
        return 0;
    }
    return $statement->execute([
        ':userId'=>$userId,
        ':productId'=>$productId
    ]);
}

function deleteAllCartItemsForUserId(int $userId){
    $sql = "DELETE FROM warenkorb
                    WHERE user_id = :userId";
    $statement = getDB()->prepare($sql);
    if(false === $statement){
        return 0;
    }
    return $statement->execute([
        ':userId'=>$userId
    ]);
}