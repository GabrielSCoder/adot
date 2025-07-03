<?php

class TutorController
{
    public function index()
    {
        $title    = "Tutor";
        $message  = "Listas de tutores";
        $tutores  = TutorModel::getAll();
        $viewPath = __DIR__ . "/../views/Tutor/tabela.php";

        include __DIR__ . "/../views/home_template.php";
    }

    public function criar()
    {
        $title    = "Tutor - Criar";
        $message  = "formulario tutor";
        $action   = "?pagina=tutor&action=salvar";
        $viewPath = __DIR__ . "/../views/Tutor/formulario.php";

        include __DIR__ . "/../views/home_template.php";
    }

    public function editar($id)
    {
        $title    = "Tutor - editar";
        $message  = "formulario tutor";
        $tutor    = TutorModel::getById($id);
        $endereco = EnderecoModel::getById($tutor["endereco_id"]);
        $action   = "?pagina=tutor&action=salvar";
        $viewPath = __DIR__ . "/../views/Tutor/formulario.php";

        include __DIR__ . "/../views/home_template.php";
    }

    public function listar()
    {
        $title   = "Lista - Tutores";
        $tutores = TutorModel::getAll();

        $viewPath = __DIR__ . "/../views/Tutor/tabela.php";

        include __DIR__ . "/../views/home_template.php";
    }

    public function deletar($id)
    {
        if (TutorModel::delete($id))
        {
            header("Location: ?pagina=tutor&action=listar");
            exit;
        }
        else
        {
            echo "Erro ao deletar tutor.";
        }
    }


    public function salvar()
    {
        $endereco = new Endereco($_POST);
        $tutor = new Tutor($_POST);

        try {
            TutorModel::save($tutor, $endereco);
            header('Location: ?pagina=tutor&action=listar');
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }
}