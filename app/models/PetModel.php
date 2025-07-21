<?php

class PetModel
{
    public static function save(Pet $pet, QuadroMedico $quadro)
    {
        if (!empty($pet->id))
        {
            return self::updateComQuadro($pet, $quadro);
        }
        else
        {
            return self::createWithQuadro($pet, $quadro);
        }
    }

    public static function getAll()
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("SELECT * FROM animal");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id)
    {
        $pdo  = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM animal WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create(Pet $pet)
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("INSERT INTO animal (nome, sexo, data_nascimento, tutor_id, quadro_medico_id, comentario VALUES :nome, :sexo, :data_nascimento, :tutor_id, :quadro_medico_id, :comentario ");
        $stmt->bindParam(":nome", $pet->nome);
        $stmt->bindParam(":sexo", $pet->sexo, PDO::PARAM_INT);
        $stmt->bindParam(":data_nascimento", $pet->data_nascimento);
        $stmt->bindParam(":tutor_id", $pet->tutor_id, PDO::PARAM_INT);
        $stmt->bindParam(":quadro_medico_id", $pet->quadro_medico_id, PDO::PARAM_INT);
        $stmt->bindParam(":comentario", $pet->comentario);

        return $stmt->execute();
    }

    public static function createWithQuadro(Pet $pet ,QuadroMedico $quadro_medico)
    {
        $pdo = Database::connect();

        try {
            $pdo->beginTransaction();

            $quadro_id = QuadroMedicoModel::create($quadro_medico, $pdo);

            $stmt = $pdo->prepare("INSERT INTO animal (nome, sexo, especie_id, data_nascimento, tutor_id, quadro_medico_id, comentario) 
                       VALUES (:nome, :sexo, :especie_id, :data_nascimento, :tutor_id, :quadro_medico_id, :comentario)");
            $stmt->bindParam(":nome", $pet->nome);
            $stmt->bindParam(":sexo", $pet->sexo, PDO::PARAM_INT);
            $stmt->bindParam(":data_nascimento", $pet->data_nascimento);
            $stmt->bindParam(":tutor_id", $pet->tutor_id, PDO::PARAM_INT);
            $stmt->bindParam(":quadro_medico_id", $quadro_id, PDO::PARAM_INT);
            $stmt->bindParam(":comentario", $pet->comentario);
            $stmt->bindParam(":especie_id", $pet->especie_id);
            $stmt->execute();
            $pdo->commit();
            return true;

        } catch (PDOException $e)
        {
            $pdo->rollBack();
            throw new Exception("Erro ao salvar tutor e endereço: " . $e->getMessage());
        }

       
    }

    public static function update(Pet $pet)
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("UPDATE animal SET  nome = :nome, sexo =  :sexo, data_nascimento = :data_nascimento , tutor_id = :tutor_id, quadro_medico_id = :quadro_medico_id, comentario = :comentario WHERE id = :id");

        $stmt->bindParam(":nome", $pet->nome);
        $stmt->bindParam(":sexo", $pet->sexo, PDO::PARAM_INT);
        $stmt->bindParam(":data_nascimento", $pet->data_nascimento);
        $stmt->bindParam(":tutor_id", $pet->tutor_id, PDO::PARAM_INT);
        $stmt->bindParam(":quadro_medico_id", $pet->quadro_medico_id, PDO::PARAM_INT);
        $stmt->bindParam(":comentario", $pet->comentario);

        return $stmt->execute();
    }

    public static function updateComQuadro(Pet $pet, QuadroMedico $quadro_medico)
    {
        $pdo = Database::connect();

        try {

            $pdo->beginTransaction();

            QuadroMedicoModel::update($quadro_medico, $pdo);

            $stmt = $pdo->prepare("UPDATE animal SET  nome = :nome, sexo =  :sexo, data_nascimento = :data_nascimento , tutor_id = :tutor_id, quadro_medico_id = :quadro_medico_id, comentario = :comentario WHERE id = :id");
            $stmt->bindParam(":id", $pet->id);
            $stmt->bindParam(":nome", $pet->nome);
            $stmt->bindParam(":sexo", $pet->sexo, PDO::PARAM_INT);
            $stmt->bindParam(":data_nascimento", $pet->data_nascimento);
            $stmt->bindParam(":tutor_id", $pet->tutor_id, PDO::PARAM_INT);
            $stmt->bindParam(":quadro_medico_id", $pet->quadro_medico_id, PDO::PARAM_INT);
            $stmt->bindParam(":comentario", $pet->comentario);
            $stmt->execute();

            $pdo->commit();
            return true;
        }
        catch (PDOException $e)
        {
            $pdo->rollBack();
            throw new Exception("Erro ao salvar pet e quadro médico: " . $e->getMessage());
        }

    }

    public static function delete($id)
    {
          $pdo = Database::connect();
          $stmt = $pdo->prepare("DELETE FROM animal WHERE id = :id");
          $stmt->bindParam(":id", $id, PDO::PARAM_INT);
          return $stmt->execute();
    }
}