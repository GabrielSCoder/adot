<?php

// require __DIR__ . '/../configs/cloud.php';

class PetModel
{
    public static function validar(Pet $pet, $edicao = false)
    {
        $erros = [];

        if ($edicao && empty($pet->id))
        {
            $erros[] = "Id obrigatório";
        }
        if (empty($pet->nome))
        {
            $erros[] = "Nome do pet obrigatório";
        }
        if (empty($pet->tutor_id))
        {
            $erros[] = "Tutor obrigatório";
        }
        if (empty($pet->data_nascimento))
        {
            $erros[] = "Data de nascimento obrigatório";
        }
        if (empty($pet->especie_id))
        {
            $erros[] = "Espécie obrigatória";
        }
        if (!isset($pet->sexo) || $pet->sexo === '')
        {
            $erros[] = "Sexo do pet obrigatório";
        }

        if (count($erros) > 0)
        {
            var_dump($pet);
            throw new Exception(implode("<br>", $erros));
        }
    }

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
        PetModel::validar($pet);
        $stmt = $pdo->prepare("INSERT INTO animal (nome, sexo, data_nascimento, tutor_id, quadro_medico_id, comentario, imagem_url VALUES :nome, :sexo, :data_nascimento, :tutor_id, :quadro_medico_id, :comentario, :imagem_url ");
        $stmt->bindParam(":nome", $pet->nome);
        $stmt->bindParam(":sexo", $pet->sexo, PDO::PARAM_INT);
        $stmt->bindParam(":data_nascimento", $pet->data_nascimento);
        $stmt->bindParam(":tutor_id", $pet->tutor_id, PDO::PARAM_INT);
        $stmt->bindParam(":quadro_medico_id", $pet->quadro_medico_id, PDO::PARAM_INT);
        $stmt->bindParam(":comentario", $pet->comentario);

        return $stmt->execute();
    }

    public static function createWithQuadro(Pet $pet, QuadroMedico $quadro_medico)
    {
        $pdo = Database::connect();
        PetModel::validar($pet);

        try {
            $pdo->beginTransaction();

            $quadro_id = QuadroMedicoModel::create($quadro_medico, $pdo);

            $stmt = $pdo->prepare("INSERT INTO animal (nome, sexo, especie_id, data_nascimento, tutor_id, quadro_medico_id, comentario, imagem_url)
                       VALUES (:nome, :sexo, :especie_id, :data_nascimento, :tutor_id, :quadro_medico_id, :comentario, :imagem_url)");
            $stmt->bindParam(":nome", $pet->nome);
            $stmt->bindParam(":sexo", $pet->sexo, PDO::PARAM_INT);
            $stmt->bindParam(":data_nascimento", $pet->data_nascimento);
            $stmt->bindParam(":tutor_id", $pet->tutor_id, PDO::PARAM_INT);
            $stmt->bindParam(":quadro_medico_id", $quadro_id, PDO::PARAM_INT);
            $stmt->bindParam(":comentario", $pet->comentario);
            $stmt->bindParam(":especie_id", $pet->especie_id);
            $stmt->bindParam(":imagem_url", $pet->imagem_url);
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

    public static function update(Pet $pet)
    {
        $pdo     = Database::connect();
        $petResp = PetModel::getById($pet->id);
        PetModel::validar($pet, true);

        if (!empty($petResp['nome']))
        {
            $stmt = $pdo->prepare("UPDATE animal SET  nome = :nome, sexo =  :sexo, data_nascimento = :data_nascimento , tutor_id = :tutor_id, quadro_medico_id = :quadro_medico_id, comentario = :comentario, imagem_url = :imagem_url, especie_id = :especie_id WHERE id = :id");

            $stmt->bindParam(":nome", $pet->nome);
            $stmt->bindParam(":sexo", $pet->sexo, PDO::PARAM_INT);
            $stmt->bindParam(":data_nascimento", $pet->data_nascimento);
            $stmt->bindParam(":tutor_id", $pet->tutor_id, PDO::PARAM_INT);
            $stmt->bindParam(":quadro_medico_id", $pet->quadro_medico_id, PDO::PARAM_INT);
            $stmt->bindParam(":comentario", $pet->comentario);
            $stmt->bindParam(":especie_id", $pet->especie_id, PDO::PARAM_INT);

            if (!empty($pet->imagem_url))
            {
                $stmt->bindParam(":imagem_url", $pet->imagem_url);
            }
            else
            {
                $img = getenv("diretorio_base") . '/' . $petResp['nome'] . '/' . $petResp['nome'] . '_img1';

                PetModel::deletePetImgs($img);
            }

            return $stmt->execute();
        }

        throw new Exception("Pet não existente");
    }

    public static function updateComQuadro(Pet $pet, QuadroMedico $quadro_medico)
    {
        $pdo     = Database::connect();
        $petResp = PetModel::getById($pet->id);
        PetModel::validar($pet, true);

        if (!empty($petResp['nome']))
        {
            try {

                $pdo->beginTransaction();

                QuadroMedicoModel::update($quadro_medico, $pdo);

                $stmt = $pdo->prepare("UPDATE animal SET  nome = :nome, sexo =  :sexo, data_nascimento = :data_nascimento , tutor_id = :tutor_id, quadro_medico_id = :quadro_medico_id, comentario = :comentario, imagem_url = :imagem_url,  especie_id = :especie_id WHERE id = :id");
                $stmt->bindParam(":id", $pet->id);
                $stmt->bindParam(":nome", $pet->nome);
                $stmt->bindParam(":sexo", $pet->sexo, PDO::PARAM_INT);
                $stmt->bindParam(":data_nascimento", $pet->data_nascimento);
                $stmt->bindParam(":tutor_id", $pet->tutor_id, PDO::PARAM_INT);
                $stmt->bindParam(":quadro_medico_id", $pet->quadro_medico_id, PDO::PARAM_INT);
                $stmt->bindParam(":comentario", $pet->comentario);
                $stmt->bindParam(":especie_id", $pet->especie_id, PDO::PARAM_INT);

                if (empty($pet->imagem_url))
                {
                    $img = getenv("diretorio_base") . '/' . $petResp['nome'] . '/' . $petResp['nome'] . '_img1';
                    PetModel::deletePetImgs($img);
                }
                
                $stmt->bindParam(":imagem_url", $pet->imagem_url);
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
    }

    public static function delete($id)
    {
        $pdo  = Database::connect();
        $stmt = $pdo->prepare("DELETE FROM animal WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function deletePetImgs($url)
    {
        $cloude = Cloud::getCloudinary();
        $cloude->uploadApi()->destroy($url);
    }
}