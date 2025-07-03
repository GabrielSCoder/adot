<?php


class Router
{

    public $rotas_protegidas = ['tutor', 'pet'];
    
    public function start($urlGet)
    {
        $pagina = $urlGet['pagina'] ?? 'home';
        $controllerName = ucfirst($pagina) . "Controller";
        $action = $urlGet['action'] ?? "index";
        $id = $urlGet['id'] ?? null;

        if (in_array($pagina, $this->rotas_protegidas)) 
        {
            AuthController::verificar();
        }

        if (class_exists($controllerName)) 
        {
            $controller = new $controllerName();

            if (method_exists($controller, $action))
            {
                if ($id !== null)
                {
                    $controller->$action($id);
                }
                else 
                {
                    $controller->$action();
                }
            } 
            else 
            {
                echo "Método '{$action}' não encontrado em {$controllerName}";
            }
        } 
        else 
        {
            echo "Controller '{$controllerName}' não encontrado.";
        }
    }
}