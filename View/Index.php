<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercício 6 - MVC</title>
    <link rel="stylesheet" href="Assets/style.css">
</head>
<body>
    <h1>Exercício 6 em Arquitetura MVC</h1>
    <form action="../Controller/ProjetoController.php?action=cadastrar" method="post">
        <fieldset>
            <legend>Informações do Projeto</legend>
            <label for="id">ID do projeto:</label>
            <input type="text" id="id" name="idProjeto" required  placeholder="ID do Projeto é único">
    
            <label for="orcamento">Orçamento (R$):</label>
            <input type="number" id="orcamento" name="orcamento" min="0" step="0.01" required>
            
            <label for="data_inicio">Data de Inicio:</label>
            <input type="date" id="data_inicio" name="dataInicio" required>
            
            <label for="numero_horas">Número de horas para a execução do projeto:</label>
            <input type="number" id="numero_horas" name="numeroHoras" required>
        
            <input type="submit" value="Cadastrar Projeto">
        </fieldset>
    </form>
    <div>
        <button name="bt-listar" class="listar"><a href="../Controller/ProjetoController.php?action=listar">Listar Projetos</a></button>
        <button name="bt-contar" class="contar"><a href="../Controller/ProjetoController.php?action=contar">Número de Projetos Posterior a 2020</a></button>
        <button name="bt-excluir" class="excluir"><a href="../Controller/ProjetoController.php?action=excluir">Excluir Projetos com menos de 100 horas e orçamento menor que R$ 1.000,00</a></button>
    </div>

    <?php
        if(isset($_SESSION['resultadoCadastro'])){
            echo $_SESSION['resultadoCadastro'];

            //Método unset apaga o resultado da sessão.
            unset($_SESSION['resultadoCadastro']); 
        }

        if(isset($_SESSION['resultadoContar'])){
            echo $_SESSION['resultadoContar'];
            unset($_SESSION['resultadoContar']);
        }
        
        if(isset($_SESSION['resultadoListar'])){
        echo "<table> 
                <tr>
                    <th>ID projeto</th>
                    <th>Orçamento</th>
                </tr>";

        foreach ($_SESSION['resultadoListar'] as $projeto) {
            echo "<tr>
                    <td>" . $projeto['id_projeto'] . "</td>
                    <td>R$ " . number_format($projeto['orcamento'], 2, ',', '.') . "</td>
                </tr>";
        }
        echo "</table>";
        unset($_SESSION['resultadoListar']);
    }

        if(isset($_SESSION['resultadoExcluir'])){
            echo $_SESSION['resultadoExcluir'];
            unset($_SESSION['resultadoExcluir']);
        }
    ?>

    <footer>
        &copy; Desenvolvido por: <span>Luciano Simas Junior</span>
    </footer>
</body>
</html>