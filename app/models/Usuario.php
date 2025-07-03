<?php

class Usuario
{
    public $id;
    public $usuario;
    public $senha;
    public $data_cadastro;

    public function __construct($params = [])
    {
        $this->id = $params['id'] ?? null;
        $this->usuario = $params['usuario'] ?? null;
        $this->senha = $params['senha'] ?? null;
        $this->data_cadastro = $params['data_cadastro'] ?? null;
    }

    public function criptografar()
    {
        $this->senha = password_hash($this->senha, PASSWORD_DEFAULT);
    }

    public function verificarSenha($senha)
    {
        return password_verify($senha, $this->senha);
    }
}