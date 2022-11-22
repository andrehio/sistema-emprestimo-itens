<?php
require_once "../bd/banco_dados.php";
require_once "../bd/banco_dados_consulta.php";
require_once "../bd/tratamento_var.php";
class recebe_usuario extends banco_dados{
    private $matricula;
    private $cpf;
    private $nome;
    private $sobrenome;
    private $telefone;
    private $email;
    private $ativo;
    private $senha;
    private $data_cadastro;
    private $nivel;
    private $query;
    private $is_sucesso;
    
    function __construct(){
        tratamento::limpa_variaveis();

        //Sistema_Emprestimo.Usuario
        $this->cpf = $_POST["cpf_novo"];
        $this->nome = $_POST["primeiro_nome_novo"];
        $this->sobrenome = $_POST["sobrenome_novo"];
        $this->ativo = $_POST["usuario_status_novo"];

        //Sistema_Emprestimo.Login
        $this->email = $_POST["email_novo"];
        $this->senha = $_POST["senha_novo"] == "" ? $this->email : $_POST["senha_novo"];
        $this->telefone = $_POST["telefone_novo"];
        $this->nivel = $_POST["nivel_novo"];
        $this->data_cadastro = $_POST["usuario_data_novo"];
    }

    public function inserir(){
        try{
            //Insert em sistema_emprestimo.usuario
            $query = "INSERT INTO sistema_emprestimo.usuario(cpf, nome, sobrenome, ativo)
                  VALUES
                  ('$this->cpf', '$this->nome', '$this->sobrenome', '$this->ativo')";
            $usuario_inserir = new banco_dados_consulta($query);
            $usuario_inserir->set_con($this->con);
            $usuario_inserir->execute_bd();

            //Select matricula em sistema_emprestimo.usuario
            $this->matricula = $this->con->lastInsertId();

            //Insert em sistema_emprestimo.login
            $query = "INSERT INTO Sistema_Emprestimo.Login(email, senha, telefone, data_cadastro, nivel, matricula)
                  VALUES
                  ('$this->email', '$this->senha', '$this->telefone', '$this->data_cadastro', '$this->nivel', '$this->matricula')";
            $usuario_inserir->set_query($query);
            $usuario_inserir->execute_bd();
            header("Location: usuario_lista.php");
        }
        catch(PDOException $e){
            echo 'Erro gerado '.$e->getMessage();
        }
    }

    public function atualizar(){
        try{
            $this->matricula = $_POST['matricula'];
            //Update em sistema_emprestimo.usuario
            $query = "UPDATE sistema_emprestimo.usuario
                  SET cpf='$this->cpf', nome='$this->nome', sobrenome='$this->sobrenome', ativo='$this->ativo'
                  WHERE matricula='$this->matricula'";
            $usuario_atualizar = new banco_dados_consulta($query);
            $usuario_atualizar->set_con($this->con);
            $usuario_atualizar->execute_bd();

            //Update em sistema_emprestimo.login
            $query = "UPDATE Sistema_Emprestimo.Login
                  SET email='$this->email', senha='$this->senha', telefone='$this->telefone', data_cadastro='$this->data_cadastro', nivel='$this->nivel'
                  WHERE matricula='$this->matricula'";
            $usuario_atualizar->set_query($query);
            $usuario_atualizar->execute_bd();
            header("Location: usuario_lista.php");
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
    if(empty($_POST['matricula'])){
        //Insert
        $novo_cadastro = new recebe_usuario();
        $novo_cadastro->iniciadb();
        $novo_cadastro->inserir(); 
    }
    else{
        //Update
        $editar_cadastro = new recebe_usuario();
        $editar_cadastro->iniciadb();
        $editar_cadastro->atualizar();
    }
     
}

?>