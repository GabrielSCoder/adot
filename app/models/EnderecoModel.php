<?php

class EnderecoModel
{
    public static function getAll()
    {
        $pdo  = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM endereco");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id)
    {
        $pdo  = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM endereco WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create(Endereco $endereco, PDO $pdo)
    {
        // $pdo  = Database::connect();
        $stmt = $pdo->prepare("INSERT INTO endereco (logradouro, numero, bairro, cidade, ponto_referencia, observacao) values (:logradouro, :numero, :bairro, :cidade, :ponto_referencia, :observacao)");
        $stmt->bindParam(":logradouro", $endereco->logradouro);
        $stmt->bindParam(":numero", $endereco->numero, PDO::PARAM_INT);
        $stmt->bindParam(":bairro", $endereco->bairro);
        $stmt->bindParam(":cidade", $endereco->cidade);
        $stmt->bindParam(":ponto_referencia", $endereco->ponto_referencia);
        $stmt->bindParam(":observacao", $endereco->observacao);
        $stmt->execute();
        return $pdo->lastInsertId();
    }

    public static function update(Endereco $endereco, PDO $pdo)
    {
        // $pdo  = Database::connect();
        $stmt = $pdo->prepare("UPDATE endereco SET logradouro = :logradouro , numero = :numero, bairro = :bairro, cidade = :cidade, ponto_referencia = :ponto_referencia , observacao = :observacao WHERE id = :id");
        $stmt->bindParam(":id", $endereco->id);
        $stmt->bindParam(":logradouro", $endereco->logradouro);
        $stmt->bindParam(":numero", $endereco->numero, PDO::PARAM_INT);
        $stmt->bindParam(":bairro", $endereco->bairro);
        $stmt->bindParam(":cidade", $endereco->cidade);
        $stmt->bindParam(":ponto_referencia", $endereco->ponto_referencia);
        $stmt->bindParam(":observacao", $endereco->observacao);
        return  $stmt->execute();
    }

    public static function delete($id)
    {
        $pdo  = Database::connect();
        $stmt = $pdo->prepare("DELETE FROM endereco WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}