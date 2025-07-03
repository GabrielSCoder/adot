<?php

    class UsuarioModel
    {
        public static function getById($id)
        {
            $pdo = Database::connect();

            $stmt =  $pdo->prepare("SELECT * FROM usuario where id = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public static function getUserByUsername($user)
        {
            $pdo = Database::connect();

            $stmt =  $pdo->prepare("SELECT * FROM usuario where usuario = :usuario");
            $stmt->bindParam(":usuario", $user);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            return $data ? new Usuario($data) : null;
        }

        public static function create(Usuario $usuario)
        {
            $pdo = Database::connect();

            $stmt = $pdo->prepare("INSERT INTO usuario (usuario, senha) VALUES (:usuario, :senha)");
            $stmt->bindParam(":usuario", $usuario->usuario);
            $stmt->bindParam(":senha", $usuario->senha);
            $stmt->execute();
            
            $id = $pdo->lastInsertedId();

            if ($id)
            {
                echo "deu certo!";
            } else
            {
                echo "erro";
            }   
        }

        public static function login (Usuario $usuario)
        {
            $user = UsuarioModel::getUserByUsername($usuario->usuario);

            if ($user && $user->verificarSenha($usuario->senha))
            {
                $_SESSION['usuario_id'] = $user->id;
                $_SESSION['usuario'] = $user->usuario;
                
                header("Location: ?pagina=contato");
            } else {
                var_dump($user);
                echo "Usuário ou senha inválida";
            }
        }
    }