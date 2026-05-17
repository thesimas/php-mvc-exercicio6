<?php
class Conexao
{
    public static $servidor = "localhost";
    public static $username = "root";
    public static $password = "";

    public static function conectar()
    {
        try {

            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

            $conexao = new mysqli(self::$servidor, self::$username, self::$password, "exercicio_6");
            $conexao->select_db("exercicio_6");
            return $conexao;
        } catch (Exception $exception) {
            //Erro de banco de dados inexistente.

            if ($exception->getCode() == 1049) {
                try {

                    $conexao = new mysqli(self::$servidor, self::$username, self::$password);

                    $conexao->query("CREATE DATABASE IF NOT EXISTS exercicio_6");

                    $conexao->select_db("exercicio_6");

                    return $conexao;

                } catch (Exception $e) {
                    die('Falha ao tentar criar o banco de dados automaticamente: ' . $e->getMessage());
                }
            } else {
                die('Erro fatal ao conectar: ' . $exception->getMessage());
            }
        }
    }

    public static function desconectar($conexao)
    {
        $conexao->close();
    }

}

?>