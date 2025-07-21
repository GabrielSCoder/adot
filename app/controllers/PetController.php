<?php

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
        $pet = new Pet($_POST);
        $quadro_medico = new QuadroMedico($_POST);

        try {
            var_dump($_POST);
            PetModel::save($pet, $quadro_medico);
            header('Location: ?pagina=pet');
        }
        catch (Exception $e)
        {
            var_dump($e->getMessage());
        }
    }
}