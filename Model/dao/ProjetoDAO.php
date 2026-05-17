<?php

require_once __DIR__ . "/../../Config/Conexao.php";
require_once __DIR__ . "/../domain/Projeto.php";
class ProjetoDAO
{

    public function criarTabela()
    {
        $conexao = Conexao::conectar();
        $sql = "CREATE TABLE IF NOT EXISTS projeto (
                    id_projeto VARCHAR(50) unique PRIMARY KEY,
                    orcamento DECIMAL(10, 2),
                    data_inicio DATE,
                    numero_horas INT
                )ENGINE=innoDB;";

        $conexao->execute_query($sql);

        Conexao::desconectar($conexao);
    }

    public function listarProjetos()
    {
        $conexao = Conexao::conectar();

        $sql = "SELECT id_projeto, orcamento FROM projeto;";

        $stmt = $conexao->execute_query($sql);

        $resultados = $stmt->fetch_all(MYSQLI_ASSOC);

        Conexao::desconectar($conexao);

        return $resultados;
    }

    public function inserir(Projeto $projeto)
    {
        $conexao = Conexao::conectar();
        $sql = "INSERT INTO projeto (id_projeto, orcamento, data_inicio, numero_horas) VALUES (?, ?, ?, ?)";

        $id = $projeto->getIdProjeto();
        $orcamento = $projeto->getOrcamento();
        $dataInicio = $projeto->getDataInicio();
        $numeroHoras = $projeto->getNumeroHoras();

        $stmt = $conexao->prepare($sql);
        $stmt->bind_param('sdsi', $id, $orcamento, $dataInicio, $numeroHoras);
        $stmt->execute();

        Conexao::desconectar($conexao);
    }

    public function mostrarNumeroDeProjetosPosterior2020()
    {
        $conexao = Conexao::conectar();

        $sql = "SELECT COUNT(*) as total FROM projeto WHERE data_inicio > '2020-01-01'";

        $stmt = $conexao->execute_query($sql);
        
        $linha = $stmt->fetch_assoc();
        
        $quantidade = $linha['total'];
        
        Conexao::desconectar($conexao);
        
        
        if ($quantidade > 0) {
            return $quantidade;
        } else {
            return "<p>Não tem nenhum projeto posterior a 2020</p>";
        }

    }

    public function excluirProjetosMenorQue100()
    {
        $conexao = Conexao::conectar();

        $sql = "DELETE FROM projeto WHERE numero_horas < 100 and orcamento < 1000";

        $conexao->execute_query($sql);

        $linhasExcluidas = $conexao->affected_rows;

        Conexao::desconectar($conexao);

        return $linhasExcluidas;
    }
}
?>