<?php
require_once "../bd/banco_dados.php";
require_once "../bd/banco_dados_consulta.php";
require_once "../bd/tratamento_var.php";

class recebe_emprestimo extends banco_dados{
    private $idEmprestimo;
    private $data_emprestimo;
    private $data_devolucao_combinada;
    private $data_devolucao_efetiva;
    private $ativo;
    private $matricula;
    private $idItem;
    
    function __construct(){
        tratamento::limpa_variaveis();

        $this->data_emprestimo = $_POST["data_emprestimo"];
        $this->data_devolucao_combinada = $_POST["data_devolucao_combinada"];
        $this->data_devolucao_efetiva = $_POST["data_devolucao_efetiva"];
        $this->ativo = $_POST["ativo"];
        $this->matricula = $_POST["matricula"];
        $this->idItem = $_POST["idItem"];
    }

    public function inserir(){
        try{
            //Insert em sistema_emprestimo.emprestimo
            $query = "INSERT INTO sistema_emprestimo.emprestimo(data_emprestimo, data_devolucao_combinada, data_devolucao_efetiva, ativo, matricula, idItem)
                  VALUES
                  ('$this->data_emprestimo', '$this->data_devolucao_combinada', '$this->data_devolucao_efetiva', '$this->ativo', '$this->matricula', '$this->idItem')";
            $emprestimo_inserir = new banco_dados_consulta($query);
            $emprestimo_inserir->set_con($this->con);
            $emprestimo_inserir->execute_bd();
            header("Location: emprestimos_lista.php");
        }
        catch(PDOException $e){
            echo 'Erro gerado '.$e->getMessage();
        }
    }

    public function atualizar(){
        try{
            $this->idEmprestimo = $_POST['idEmprestimo'];
            //Update em sistema_emprestimo.emprestimo
            $query = "UPDATE sistema_emprestimo.emprestimo
                  SET data_emprestimo='$this->data_emprestimo', data_devolucao_combinada='$this->data_devolucao_combinada',
                  data_devolucao_efetiva='$this->data_devolucao_efetiva', ativo='$this->ativo, matricula='$this->matricula', idItem='$this->idItem'
                  WHERE idEmprestimo='$this->idEmprestimo'";
            $emprestimo_atualizar = new banco_dados_consulta($query);
            $emprestimo_atualizar->set_con($this->con);
            $emprestimo_atualizar->execute_bd();

            header("Location: emprestimos_lista.php");
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
    if(empty($_POST['idEmprestimo'])){
        //Insert
        $novo_emprestimo = new recebe_emprestimo();
        $novo_emprestimo->iniciadb();
        $novo_emprestimo->inserir(); 
    }
    else{
        //Update
        $editar_emprestimo = new recebe_emprestimo();
        $editar_emprestimo->iniciadb();
        $editar_emprestimo->atualizar();
    }
     
}
    
?>