<?php

class ImagemPetModel
{
    public static function getAllByPetId($id)
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("SELECT * FROM foto_animal WHERE animal_id = :animal_id");

        $stmt->bindParam(":animal_id", $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getFistImgPetById($id)
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("SELECT * FROM foto_animal WHERE animal_id = :animal_id ORDER BY id ASC LIMIT 1");

        $stmt->bindParam(":animal_id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}