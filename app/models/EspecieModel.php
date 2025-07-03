<?php

class EspecieModel
{
    public static function getAll()
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM especie");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}