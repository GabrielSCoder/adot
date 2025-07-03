<?php

class QuadroMedicoModel 
{
    public static function getById($id)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM quadro_medico WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create(QuadroMedico $quadro_medico, PDO $pdo)
    {
        // $pdo = Database::connect();
        $stmt = $pdo->prepare("INSERT INTO quadro_medico (castrado, vacina_raiva, remedio_carrapato, remedio_pulga, remedio_verme) VALUES (:castrado, :vacina_raiva, :remedio_carrapato, :remedio_pulga, :remedio_verme)");
        $stmt->bindParam(":castrado", $quadro_medico->castrado, PDO::PARAM_INT );
        $stmt->bindParam(":vacina_raiva", $quadro_medico->vacina_raiva, PDO::PARAM_INT);
        $stmt->bindParam(":remedio_pulga", $quadro_medico->remedio_pulga, PDO::PARAM_INT);
        $stmt->bindParam(":remedio_carrapato", $quadro_medico->remedio_carrapato, PDO::PARAM_INT);
        $stmt->bindParam(":remedio_verme", $quadro_medico->remedio_verme, PDO::PARAM_INT);
        $stmt->execute();
        return $pdo->lastInsertId();
    }


    public static function update(QuadroMedico $quadro_medico, PDO $pdo )
    {
        // $pdo = Database::connect();
        $stmt = $pdo->prepare("UPDATE quadro_medico SET castrado = :castrado, vacina_raiva = :vacina_raiva, remedio_carrapato = :remedio_carrapato, remedio_pulga = :remedio_pulga, remedio_verme = :remedio_verme WHERE id = :id");
        $stmt->bindParam(":id", $quadro_medico->id, PDO::PARAM_INT);
        $stmt->bindParam(":castrado", $quadro_medico->castrado, PDO::PARAM_INT);
        $stmt->bindParam(":vacina_raiva", $quadro_medico->vacina_raiva, PDO::PARAM_INT);
        $stmt->bindParam(":remedio_pulga", $quadro_medico->remedio_pulga, PDO::PARAM_INT);
        $stmt->bindParam(":remedio_carrapato", $quadro_medico->remedio_carrapato, PDO::PARAM_INT);
        $stmt->bindParam(":remedio_verme", $quadro_medico->remedio_verme, PDO::PARAM_INT);
        $stmt->execute();
        return $pdo->lastInsertId();
    }

    public static function delete($id)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("DELETE FROM quadro_medico WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}