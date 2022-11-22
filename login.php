<?php
require_once "bd/banco_dados.php";
require_once "bd/banco_dados_consulta.php";
require_once "bd/tratamento_var.php";

class login extends banco_dados{
    private $cpf;
    private $senha;
    private $nivel;
    private $ativo;

    function __construct(){
        tratamento::limpa_variaveis();

        //Sistema_Emprestimo.Usuario
        $this->cpf = $_POST["cpf"];
        $this->senha = $_POST["senha"];
    }

    public function autenticar(){
        try{
            //Select em sistema_emprestimo.login
            $consulta = "SELECT U.cpf, L.senha, L.nivel, U.ativo
                FROM sistema_emprestimo.usuario as U 
                JOIN sistema_emprestimo.login as L
                ON U.matricula = L.matricula AND U.cpf = '$this->cpf'";
            $consulta_login = new banco_dados_consulta($consulta);
            $consulta_login->set_con($this->con);
            $dados_login = $consulta_login->consulta_tudo();
            if ($dados_login[0]['senha'] == $this->senha){
                if($dados_login[0]['nivel'] == 'adm'){
                    if($dados_login[0]['ativo'] == '1'){
                        session_start();
                        $_SESSION['cpf']=$dados_login[0]['cpf'];
                        $_SESSION['nivel']=$dados_login[0]['nivel'];
                        header("Location: adm/emprestimos_lista.php");
                    }
                    else{
                        echo $dados_login[0]['ativo'];
                        //header("Location: index.php?erro=3");
                    }
                }
                else{
                    header("Location: index.php?erro=2");
                }
            }
            else{
                header("Location: index.php?erro=1");
            }
            
        }
        catch(PDOException $e){
            echo 'Erro gerado '.$e->getMessage();
        }
    }

}

// MAIN
if (!isset($_POST) || empty($_POST)) {
    echo 'Nada foi postado.';
}
else{
    $login = new login();
    $login->iniciadb();
    $login->autenticar();
     
}
?>