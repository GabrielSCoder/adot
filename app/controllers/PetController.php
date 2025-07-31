<?php

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../configs/cloud.php';

class PetController
{
    public function index()
    {
        $pets     = PetModel::getAll();
        $title    = "Pet - lista";
        $viewPath = __DIR__ . "/../views/Pet/tabela.php";
        require __DIR__ . "/../views/home_template.php";
    }

    public function editar($id)
    {
        $pet      = PetModel::getById($id);
        $quadro_medico = QuadroMedicoModel::getById($pet['quadro_medico_id']);
        $tutores  = TutorModel::getAll();
        $especies = EspecieModel::getAll();
        $title    = "Pet - Formulário";
        $action   = "?pagina=pet&action=salvar";
        $viewPath = __DIR__ . "/../views/Pet/formulario.php";
        require __DIR__ . "/../views/home_template.php";
    }

    public function criar()
    {
        $tutores  = TutorModel::getAll();
        $especies = EspecieModel::getAll();
        $title    = "Pet - Formulário";
        $action   = "?pagina=pet&action=salvar";
        $viewPath = __DIR__ . "/../views/Pet/formulario.php";
        require __DIR__ . "/../views/home_template.php";
    }

    public function deletar($id)
    {
        if (PetModel::delete($id))
        {
            header("Location: ?pagina=pet");
            exit;
        }
        else
        {
            echo "Erro ao deletar pet.";
        }
    }

    public function salvar()
    {
        $cloud = Cloud::getCloudinary();
        $pet = new Pet($_POST);
        $quadro_medico = new QuadroMedico($_POST);
        $file  = $_FILES['imagem']['tmp_name'][0] ?? null;
        $pasta = 'Upload/'.$pet->nome;
        $nome = $pet->nome.'_img1';

        try {

            if (!empty($file)) {
                
                $uploadResult =  $cloud->uploadApi()->upload($file, [
                    'folder' => $pasta,
                    'public_id' => $nome,
                    'overwrite' => true
                ]);
    
                $pet->imagem_url = $uploadResult['secure_url'];
            }
            
            PetModel::save($pet, $quadro_medico);
            header('Location: ?pagina=pet');
        }
        catch (Exception $e)
        {
            var_dump($e->getMessage());
        }
    }
}