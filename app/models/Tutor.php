<?php

class Tutor
{
    public $id;
    public $nome_completo;
    public $data_nascimento;
    public $data_cadastro;
    public $endereco_id;
    public $sexo;
    public $contato;
    public $contato_extra;

    public function __construct($params = [])
    {
        $this->id              = $params['id'] ?? null;
        $this->nome_completo   = $params['nome_completo'] ?? '';
        $this->data_nascimento = $params['data_nascimento'] ?? '';
        $this->sexo            = $params['sexo'] ?? null;
        $this->data_cadastro = $params['data_cadastro'] ?? null;
        $this->endereco_id = $param['endereco_id'] ?? null;
        $this->contato = $params['contato'] ?? null;
        $this->contato_extra = $param['contato_extra'] ?? null;
    }
}