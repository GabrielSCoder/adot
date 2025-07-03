<?php

class Especie
{
    public $id;
    public $nome;

    public function __construct($params = [])
    {
        $this->id = $params['id'] ?? null;
        $this->nome = $params['nome'] ?? null;
    }
}