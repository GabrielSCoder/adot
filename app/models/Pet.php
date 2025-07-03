<?php

class Pet
{
    public $id;
    public $nome;
    public $sexo;
    public $data_nascimento;
    public $data_cadastro;
    public $comentario;
    public $tutor_id;
    public $quadro_medico_id;
    public $especie_id;


    public function __construct($params = [])
    {
        $this->id = $params['id'] ?? null;
        $this->nome = $params['nome'] ?? null;
        $this->sexo = $params['sexo'] ?? null;
        $this->data_nascimento = $params['data_nascimento'] ?? null;
        $this->comentario = $params['comentario'] ?? "";
        $this->tutor_id = $params['tutor_id'] ?? null;
        $this->quadro_medico_id = $params['quadro_medico_id'] ?? "";   
        $this->especie_id = $params['especie_id'] ?? null;
    }
}