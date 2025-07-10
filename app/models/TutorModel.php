<?php

class TutorModel
{

    public static function save(Tutor $tutor, Endereco $endereco)
    {
        if (!empty($tutor->id) && !empty($endereco->id))
        {
            return self::updateComEndereco($tutor, $endereco);
        }
        else
        {
            return self::createComEndereco($tutor, $endereco);
        }
    }

    public static function getAll()
    {
        $pdo  = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM tutor");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id)
    {
        $pdo  = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM tutor WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create(Tutor $tutor)
    {
        $pdo  = Database::connect();
        $stmt = $pdo->prepare("INSERT INTO tutor (nome_completo, data_nascimento, sexo, contato, contato_extra) values (:nome_completo, :data_nascimento, :sexo, :contato, :contato_extra)");
        $stmt->bindParam(":nome_completo", $tutor->nome_completo);
        $stmt->bindParam(":data_nascimento", $tutor->data_nascimento);
        $stmt->bindParam(":sexo", $tutor->sexo);
        $stmt->bindParam(":contato", $tutor->contato);
        $stmt->bindParam(":contato_extra", $tutor->contato_extra);
        return $stmt->execute();
    }

    public static function createComEndereco(Tutor $tutor, Endereco $endereco)
    {
        $pdo = Database::connect();

        try {
            $pdo->beginTransaction();

            $enderecoId = EnderecoModel::create($endereco, $pdo);

            $stmt2 = $pdo->prepare("
            INSERT INTO tutor (nome_completo, data_nascimento, sexo, endereco_id, contato, contato_extra)
            VALUES (:nome_completo, :data_nascimento, :sexo, :endereco_id, :contato, :contato_extra)
            ");
            $stmt2->bindParam(":nome_completo", $tutor->nome_completo);
            $stmt2->bindParam(":data_nascimento", $tutor->data_nascimento);
            $stmt2->bindParam(":sexo", $tutor->sexo);
            $stmt2->bindParam(":endereco_id", $enderecoId);
            $stmt2->bindParam(":contato", $tutor->contato);
            $stmt2->bindParam(":contato_extra", $tutor->contato_extra);
            $stmt2->execute();

            $pdo->commit();
            return true;

        }
        catch (PDOException $e)
        {
            $pdo->rollBack();
            throw new Exception("Erro ao salvar tutor e endereço: " . $e->getMessage());
        }
    }

    public static function update(Tutor $tutor)
    {
        $pdo  = Database::connect();
        $stmt = $pdo->prepare("UPDATE tutor SET nome_completo = :nome_completo, data_nascimento = :data_nascimento, sexo = :sexo, contato = :contato, contato_extra = :contato_extra WHERE id = :id");
        $stmt->bindParam(":id", $tutor->id);
        $stmt->bindParam(":nome_completo", $tutor->nome_completo);
        $stmt->bindParam(":data_nascimento", $tutor->data_nascimento);
        $stmt->bindParam(":sexo", $tutor->sexo);
        $stmt->bindParam(":contato", $tutor->contato);
        $stmt->bindParam(":contato_extra", $tutor->contato_extra);
        return $stmt->execute();
    }

    public static function updateComEndereco(Tutor $tutor, Endereco $endereco)
    {
        $pdo = Database::connect();

        try {

            $pdo->beginTransaction();

            EnderecoModel::update($endereco, $pdo);

            $stmt = $pdo->prepare("UPDATE tutor SET nome_completo = :nome_completo, data_nascimento = :data_nascimento, sexo = :sexo, contato = :contato, contato_extra = :contato_extra WHERE id = :id");
            $stmt->bindParam(":id", $tutor->id);
            $stmt->bindParam(":nome_completo", $tutor->nome_completo);
            $stmt->bindParam(":data_nascimento", $tutor->data_nascimento);
            $stmt->bindParam(":sexo", $tutor->sexo);
            $stmt->bindParam(":contato", $tutor->contato);
            $stmt->bindParam(":contato_extra", $tutor->contato_extra);
            $stmt->execute();

            $pdo->commit();
            return true;
        }
        catch (PDOException $e)
        {
            $pdo->rollBack();
            throw new Exception("Erro ao salvar tutor e endereço: " . $e->getMessage());
        }

    }

    public static function delete($id)
    {
        $pdo  = Database::connect();
        $stmt = $pdo->prepare("DELETE FROM tutor WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}