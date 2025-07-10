<?php

class AdocaoController
{
    public function index()
    {
        $title = "Adoção";
        $message = "Adote um pet com responsabilidade!";
        $viewPath = __DIR__ . "/../views/adocaoView.php";
        $pets = PetModel::getAll();

        foreach ($pets as &$pet)
        {
            $imagem = ImagemPetModel::getFistImgPetById($pet['id']);
            $pet['foto_url'] = $imagem ? $imagem['caminho'] : 'img/default.png';
        }

        unset($pet);
        
        include __DIR__ . "/../views/home_template.php";
    }

    public function detalhes() 
    {
        $id = $_GET['id'];
        $pet = PetModel::getById($id);
        $title = "Detalhes";
        $quadro = QuadroMedicoModel::getById($pet['quadro_medico_id']);
        $tutor = TutorModel::getById($pet['tutor_id']);
        $endereco = EnderecoModel::getById($tutor['endereco_id']);
        $viewPath = __DIR__ . "/../views/Pet/detalhes.php";
        $imagem = ImagemPetModel::getFistImgPetById($pet['id']);
        $pet['foto_url'] = $imagem ? $imagem['caminho'] : 'img/default.png';
        
        include __DIR__ . "/../views/home_template.php";
    }
}