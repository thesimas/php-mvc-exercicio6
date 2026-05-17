<?php
class Projeto
{
    private $idProjeto;
    private $orcamento;
    private $dataInicio;
    private $numeroHoras;

    public function __construct($idProjeto, $orcamento, $dataInicio, $numeroHoras)
    {
        $this->idProjeto = $idProjeto;
        $this->orcamento = $orcamento;
        $this->dataInicio = $dataInicio;
        $this->numeroHoras = $numeroHoras;
    }

    public function getIdProjeto()
    {
        return $this->idProjeto;
    }
    public function getOrcamento()
    {
        return $this->orcamento;
    }
    public function getDataInicio()
    {
        return $this->dataInicio;
    }
    public function getNumeroHoras()
    {
        return $this->numeroHoras;
    }

    public function setIdProjeto($idProjeto)
    {
        $this->idProjeto = $idProjeto;
    }

    public function setOrcamento($orcamento)
    {
        $this->orcamento = $orcamento;
    }

    public function setDataInicio($dataInicio)
    {
        $this->dataInicio = $dataInicio;
    }

    public function setNumeroHoras($numeroHoras)
    {
        $this->numeroHoras = $numeroHoras;
    }
}

?>