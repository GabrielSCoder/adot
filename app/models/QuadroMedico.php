<?php

class QuadroMedico
{
    public $id;
    public $vacina_raiva;
    public $remedio_pulga;
    public $remedio_carrapato;
    public $remedio_verme;
    public $castrado;
    public $data_cadastro;

    public function __construct($params = [])
    {
        $this->id = $params['quadro_medico_id'] ?? null;
        $this->vacina_raiva      = isset($params['vacina_raiva']) ? 1 : 0;
        $this->remedio_pulga     = isset($params['remedio_pulga']) ? 1 : 0;
        $this->remedio_carrapato = isset($params['remedio_carrapato']) ? 1 : 0;
        $this->remedio_verme     = isset($params['remedio_verme']) ? 1 : 0;
        $this->castrado          = isset($params['castrado']) ? 1 : 0;
        $this->data_cadastro     = $params['data_cadastro'] ?? null;
    }
}