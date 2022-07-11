<?php

// GET

function getUserAddressById(int $userId){
    $sql = "SELECT empfaenger, strasse, hausnummer, plz, stadt
                    FROM adressen
                    WHERE user_id = ".$userId;
    $userAddress = getDB()->query($sql);
    if(0 === $userAddress->rowCount()){
        return [];
    }
    return $userAddress->fetch();
}

// ADD

function addDeliveryAddressForUserId(int $userId, string $empfaenger, string $strasse, string $hausnummer, string $stadt, string $plz): bool{
        $sql = "INSERT INTO adressen
                            SET user_id = :userId,
                            empfaenger = :empfaenger,
                            strasse = :strasse,
                            hausnummer = :hausnummer,
                            plz = :plz,
                            stadt = :stadt";
        $statement = getDB()->prepare($sql);
        if(false === $statement){
            return false;
        }
        return (bool) $statement->execute([
            ':userId'=>$userId,
            ':empfaenger'=>$empfaenger,
            ':strasse'=>$strasse,
            ':hausnummer'=>$hausnummer,
            ':plz'=>$plz,
            ':stadt'=>$stadt
        ]);
}

// UPDATE

function updateDeliveryAddressForUserId(int $userId, string $empfaenger, string $strasse, string $hausnummer, string $stadt, string $plz): bool{
    $sql = "UPDATE adressen
                        SET empfaenger = :empfaenger,
                            strasse = :strasse,
                            hausnummer = :hausnummer,
                            plz = :plz,
                            stadt = :stadt
                        WHERE user_id = :userId";
    $statement = getDB()->prepare($sql);
    if(false === $statement){
        return false;
    }
    return (bool) $statement->execute([
        ':userId'=>$userId,
        ':empfaenger'=>$empfaenger,
        ':strasse'=>$strasse,
        ':hausnummer'=>$hausnummer,
        ':plz'=>$plz,
        ':stadt'=>$stadt
    ]);
}