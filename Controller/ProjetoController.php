<?php

session_start();

require_once __DIR__ . "/../Model/dao/ProjetoDAO.php";

class ProjetoController
{

    public function cadastrar()
    {
        $idProjeto = $_POST["idProjeto"];
        $orcamento = $_POST["orcamento"];
        $dataInicio = $_POST["dataInicio"];
        $numeroHoras = $_POST["numeroHoras"];

        $projeto = new Projeto($idProjeto, $orcamento, $dataInicio, $numeroHoras);

        $projetoDAO = new ProjetoDAO();
        $projetoDAO->inserir($projeto);

        $_SESSION['resultadoCadastro'] = "<p>Projeto cadastrado com Sucesso!</p>";
        
        header("Location: ../View/Index.php");
        exit();
    }


    public function listar()
    {
        $projetoDAO = new ProjetoDAO();

        $_SESSION['resultadoListar'] = $projetoDAO->listarProjetos();

        header("Location: ../View/Index.php");
        exit();
    }

    public function excluir()
    {
        $projetoDAO = new ProjetoDAO();

        $linhasAfetadas = $projetoDAO->excluirProjetosMenorQue100();

        if ($linhasAfetadas > 0) {
            $_SESSION['resultadoExcluir'] = "<p>Sucesso: $linhasAfetadas projeto(s) excluído(s)!</p>";
        } else {
            $_SESSION['resultadoExcluir'] = "<p>Aviso: Nenhum projeto se enquadra nos critérios para exclusão.</p>";
        }

        header("Location: ../View/Index.php");
        exit();
    }

    public function contar()
    {

        $projetoDAO = new ProjetoDAO();

        $numero = $projetoDAO->mostrarNumeroDeProjetosPosterior2020();

        $_SESSION['resultadoContar'] = "<p>O número de projetos posterior a 2020 é " . $numero . "</p>";

        if($numero == null){
            $_SESSION['resultadoContar'] = "<p>O número de projetos posterior a 2020 é 0</p>";
        }

        header("Location: ../View/Index.php");
        exit();
    }

}

if (isset($_REQUEST['action'])) {

    $projetoDAO = new ProjetoDAO();
    
    $projetoDAO->criarTabela();

    $controller = new ProjetoController();

    switch ($_REQUEST['action']) {
        case 'cadastrar':
            $controller->cadastrar();
            break;
        case 'listar':
            $controller->listar();
            break;
        case 'excluir':
            $controller->excluir();
            break;
        case 'contar':
            $controller->contar();
            break;
    }
}
?>