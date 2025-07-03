<?php

class Endereco
{
    public $id;
    public $logradouro;
    public $numero;
    public $bairro;
    public $cidade;
    public $ponto_referencia;
    public $observacao;


    public function __construct($params = [])
    {
        $this->id = $params['endereco_id'] ?? null;
        $this->logradouro = $params['logradouro'] ?? "";
        $this->numero = $params['numero'] ?? "";
        $this->bairro = $params['bairro'] ?? "";
        $this->cidade = $params['cidade'] ?? "";
        $this->ponto_referencia = $params['ponto_referencia'] ?? "";
        $this->observacao = $params['observacao'] ?? "";
    }
}